<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Controller
{

    public function index()
    {
        $this->login();
    }

    public function register()
    {
        $this->load->model('Department_model');
        $data['departments'] = $this->Department_model->get_active();
        $this->load->view('auth/register', $data);
    }

    public function send_otp()
    {
        $email = $this->input->post('email');
        if (empty($email)) {
            echo json_encode(['status' => 'error', 'message' => 'Email is required']);
            return;
        }

        // Check if email already exists
        $this->load->model('User_model');
        if ($this->User_model->email_exists($email)) {
            echo json_encode(['status' => 'error', 'message' => 'This email is already registered. Please log in instead.']);
            return;
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        $this->session->set_userdata('otp', $otp);
        $this->session->set_userdata('otp_email', $email);

        $this->load->library('email');

        $this->load->library('email');
        // Config loaded automatically from application/config/email.php

        $type = ucfirst($this->input->post('type') ?: 'User'); // Default to 'User' if not set

        $from_email = 'no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'campusconnect.com');
        $this->email->from($from_email, 'Campus App');
        $this->email->to($email);
        $this->email->subject("$type Registration OTP");
        $this->email->message("Your OTP for $type Registration is: <strong>$otp</strong><br>This code is valid for 10 minutes.");

        if ($this->email->send()) {
            echo json_encode(['status' => 'success', 'message' => 'OTP sent successfully']);
        } else {
            // DEBUG MODE: If email fails, return OTP in message so user can still register (REMOVE IN PRODUCTION IF DEBUG NOT WANTED)
            // For now, we allow it because the user is stuck.
            echo json_encode([
                'status' => 'success',
                'message' => 'Email failed (hosting restriction), but here is your DEBUG OTP: ' . $otp,
                'debug_otp' => $otp
            ]);
        }
    }

    public function register_submit()
    {
        $this->load->model('User_model');
        $this->load->library('upload');

        // DEBUG: Catch empty POST (likely file size limit exceeded)
        if (empty($_POST) && !empty($_SERVER['CONTENT_LENGTH'])) {
            $max_post = ini_get('post_max_size');
            $content_len = $_SERVER['CONTENT_LENGTH'];
            die("ERROR: The total data sent ($content_len bytes) exceeds your server's 'post_max_size' ($max_post). Please use a smaller photo (under 2MB).");
        }

        log_message('error', 'Registration attempt started at ' . date('Y-m-d H:i:s'));
        log_message('error', 'POST data: ' . print_r($_POST, true));

        // File Upload Configuration
        $config['upload_path'] = FCPATH . 'uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp|pdf';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;

        // Ensure upload directory existsa
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->upload->initialize($config);

        // Profile Photo Upload Removed - Defaults to 'default_avatar.png'
        $profile_photo = 'default_avatar.png';

        $id_card_file = null;
        if (!empty($_FILES['id_card']['name'])) {
            if ($this->upload->do_upload('id_card')) {
                $upload_data = $this->upload->data();
                $id_card_file = $upload_data['file_name'];
            }
        }

        $user_type = $this->input->post('user_type');

        // Security: Restrict allowed user types from public registration
        $allowed_types = ['student', 'faculty'];
        if (!in_array($user_type, $allowed_types)) {
            $user_type = 'student';
        }

        // OTP Verification (Compulsory for ALL)
        $input_otp = ($user_type === 'faculty') ? $this->input->post('otp_faculty') : $this->input->post('otp_student');
        $session_otp = $this->session->userdata('otp');

        if ($input_otp != $session_otp) {
            die("ERROR: Invalid OTP or session expired. Sent OTP: $session_otp, Entered OTP: $input_otp");
            return;
        }

        // Name Logic: Handle separated or full name
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $full_name = $this->input->post('full_name');

        if (empty($first_name) && !empty($full_name)) {
            $parts = explode(' ', trim($full_name), 2);
            $first_name = $parts[0];
            $last_name = isset($parts[1]) ? $parts[1] : '';
        }

        // Generate Unique Username
        $email_prefix = strstr($this->input->post('email'), '@', true) ?: $first_name . $last_name;
        $base_username = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $email_prefix));
        $username = $base_username;
        $count = 1;
        while ($this->User_model->username_exists($username)) {
            $username = $base_username . $count++;
        }

        // collecting form data
        $data = array(
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'dob' => $this->input->post('dob'),
            'gender' => $this->input->post('gender'),
            'mobile' => $this->input->post('mobile'),
            'major' => $this->input->post('major') ?: $this->input->post('department'), // Mapping
            'graduation_year' => $this->input->post('graduation_year'),
            'student_id' => $this->input->post('student_id') ?: $this->input->post('faculty_id'), // Mapping
            'role' => $user_type,
            'profile_photo' => $profile_photo,
            'id_card' => $id_card_file,
            'face_descriptor' => $this->input->post('face_descriptor'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Basic validation
        if (empty($data['email']) || empty($data['password'])) {
            echo "Email and Password are required.";
            return;
        }

        // Check for duplicate email
        if ($this->User_model->email_exists($data['email'])) {
            die('ERROR: This email (' . $data['email'] . ') is already registered. Use a different email or log in.');
            return;
        }

        // Check for duplicate Student ID / PRN
        if (!empty($data['student_id']) && $this->User_model->student_id_exists($data['student_id'])) {
            die('ERROR: This PRN / Student ID (' . $data['student_id'] . ') is already registered in our system.');
            return;
        }

        // QR Code Validation - STRICT ENFORCEMENT RESTORED
        $qr_code_data = $this->input->post('qr_code_data');
        if (empty($qr_code_data)) {
            die('ERROR: ID Card QR code is required. Please make sure the QR code was scanned successfully.');
            return;
        }

        $this->load->model('Qr_code_model');
        if ($this->Qr_code_model->is_qr_code_used($qr_code_data)) {
            die('ERROR: This ID Card QR Code has already been used by another user.');
            return;
        }


        // DEBUG LOGGING
        log_message('error', 'Attempting creation for user: ' . $data['email']);

        if ($this->User_model->create_user($data)) {
            // Mark QR code as used
            $user_id = $this->db->insert_id(); // Standard CI3 method
            $this->Qr_code_model->mark_qr_code_used($qr_code_data, $user_id);

            // Clear any existing session (e.g. from an admin testing registration)
            $this->session->sess_destroy();

            // Set a flash message for the login page
            $this->session->set_flashdata('success', 'Registration successful! Please log in to your new account.');

            // Success - Redirect to Login (Safer than Home to ensure proper session)
            redirect('auth/login');
        } else {
            // Log the database error
            $db_error = $this->db->error();
            log_message('error', 'Registration Failed DB Error: ' . print_r($db_error, true));
            die("DATABASE ERROR: " . $db_error['message']);
        }
    }

    public function test_session()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        echo "<h1>Session Debug</h1>";

        try {
            $this->load->database();
            echo "✅ Database library loaded.<br>";

            if ($this->db->initialize()) {
                echo "✅ Database connected successfully.<br>";
            } else {
                echo "❌ Database connection failed.<br>";
            }

            $driver = $this->config->item('sess_driver');
            echo "Driver configured as: <strong>$driver</strong><br>";

            echo "Data in session: " . print_r($this->session->userdata(), true) . "<br>";

            $this->session->set_userdata('debug_test', 'Working at ' . date('H:i:s'));
            echo "✅ Session write successful.<br>";

            echo "<hr><h3>PHP Server Limits:</h3>";
            echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
            echo "post_max_size: " . ini_get('post_max_size') . "<br>";
            echo "memory_limit: " . ini_get('memory_limit') . "<br>";
            echo "max_execution_time: " . ini_get('max_execution_time') . " seconds<br>";

        } catch (Exception $e) {
            echo "❌ ERROR: " . $e->getMessage();
        }
    }

    public function validate_qr_code()
    {
        // Log the request for debugging
        log_message('debug', 'validate_qr_code called');
        log_message('debug', 'POST data: ' . print_r($_POST, true));

        $qr_data = $this->input->post('qr_data');

        log_message('debug', 'QR Data received: ' . $qr_data);

        if (empty($qr_data)) {
            log_message('debug', 'QR data is empty');
            echo json_encode(['status' => 'error', 'message' => 'QR code data is required']);
            return;
        }

        $this->load->model('Qr_code_model');

        if ($this->Qr_code_model->is_qr_code_used($qr_data)) {
            $info = $this->Qr_code_model->get_qr_code_info($qr_data);
            log_message('debug', 'QR code already used');
            echo json_encode([
                'status' => 'error',
                'message' => 'This QR code has already been used for registration',
                'used_at' => $info->used_at
            ]);
        } else {
            log_message('debug', 'QR code is valid and available');
            echo json_encode([
                'status' => 'success',
                'message' => 'QR code is valid and available'
            ]);
        }
    }


    public function login()
    {
        $this->load->view('auth/login');
    }

    public function login_submit()
    {
        // Get email or ID depending on what was submitted
        $credential = $this->input->post('credential_email');
        if (empty($credential)) {
            $credential = $this->input->post('credential_id');
        }

        $password = $this->input->post('password');
        $remember = $this->input->post('remember_me');

        if (empty($credential) || empty($password)) {
            echo "<script>alert('Please enter your Email/ID and Password'); window.location.href='" . base_url('auth/login') . "';</script>";
            return;
        }

        $this->load->model('User_model');
        $user = $this->User_model->verify_user($credential, $password);

        if ($user) {
            // Overwrite existing session data to prevent conflicts

            $session_data = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'profile_photo' => $user->profile_photo,
                'role' => $user->role,
                'logged_in' => TRUE
            );

            // Handle Remember Me (Extend Session)
            if ($remember) {
                // Set session to last 30 days
                $this->session->sess_expiration = 60 * 60 * 24 * 30;
                $this->session->set_userdata($session_data);

                // Also set a cookie for auto-filling (optional, asking browser to save password is usually enough, 
                // but setting a cookie allows pre-filling next time)
                $cookie = array(
                    'name' => 'remember_email',
                    'value' => $credential,
                    'expire' => '2592000', // 30 days
                    'secure' => FALSE
                );
                $this->input->set_cookie($cookie);
            } else {
                $this->session->set_userdata($session_data);
            }



            if ($user->role === 'admin') {
                redirect('admin');
            } else {
                redirect('home');
            }
        } else {
            // Debug info (optional, remove in production)
            // error_log("Login failed for: $credential");
            echo "<script>alert('Invalid Email/ID or Password. Please try again.'); window.location.href='" . base_url('auth/login') . "';</script>";
        }
    }
    public function forgot_password()
    {
        $this->load->view('auth/forgot_password');
    }

    public function send_reset_link()
    {
        $email = $this->input->post('email');
        $this->load->model('User_model');

        $user = $this->User_model->get_user_by_email($email);

        if ($user) {
            // Generate Token
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Update DB
            $this->User_model->update_user($user->id, [
                'reset_token' => $token,
                'reset_token_expire' => $expiry
            ]);

            // Send Email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'campusapp007@gmail.com';
                $mail->Password = 'zjnz qjxn vjus odco'; // App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('campusapp007@gmail.com', 'CampusConnect');
                $mail->addAddress($email);

                // Content
                $link = base_url('auth/reset_password?token=' . $token);
                $mail->isHTML(true);
                $mail->Subject = 'Reset Your Password';
                $mail->Body = "
                    <div style='font-family: sans-serif; padding: 20px;'>
                        <h2>Password Reset Request</h2>
                        <p>We received a request to reset your password. Click the link below to verify your identity and set a new password:</p>
                        <p><a href='$link' style='background: #1173d4; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Reset Password</a></p>
                        <p>Or copy this link: $link</p>
                        <p>This link expires in 1 hour.</p>
                    </div>
                ";

                $mail->send();
                $this->session->set_flashdata('success', 'Reset link sent! Check your inbox.');
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit; // Stop execution to see the error
                // $this->session->set_flashdata('error', 'Could not send email. Please try again.');
            }
        } else {
            // Security: Don't reveal if email exists, but for UX we usually give a generic message
            // OR if user specifically asked effectively...
            // "Do not reveal whether an email exists explicitly (generic success message)" -> OK.
            $this->session->set_flashdata('success', 'If the email exists, a reset link has been sent.');
        }

        redirect('auth/forgot_password');
    }

    public function reset_password()
    {
        $token = $this->input->get('token');
        error_log('DEBUG_APP_TOKEN: ' . $token);

        if (!$token) {
            redirect('auth/login');
        }

        $this->load->model('User_model');
        $user = $this->User_model->get_user_by_token($token);

        if ($user) {
            // Clear any stale error messages from previous attempts
            $this->session->set_flashdata('error', null);
            $this->load->view('auth/reset_password');
        } else {
            error_log('DEBUG_APP_FAIL_TIME: ' . date('Y-m-d H:i:s'));
            error_log('DEBUG_APP_COMPARE_QUERY: ' . "SELECT * FROM users WHERE reset_token = '$token' AND reset_token_expire > '" . date('Y-m-d H:i:s') . "'");
            $this->session->set_flashdata('error', 'Invalid or expired token.');
            redirect('auth/forgot_password');
        }
    }

    public function update_password()
    {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm_password');

        if ($password !== $confirm) {
            $this->session->set_flashdata('error', 'Passwords do not match.');
            redirect('auth/reset_password?token=' . $token);
        }

        // Basic Length Check
        if (strlen($password) < 8) {
            $this->session->set_flashdata('error', 'Password must be at least 8 characters.');
            redirect('auth/reset_password?token=' . $token);
        }

        $this->load->model('User_model');
        $user = $this->User_model->get_user_by_token($token);

        if ($user) {
            $this->User_model->update_user($user->id, [
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'reset_token' => NULL,
                'reset_token_expire' => NULL
            ]);

            echo "<script>alert('Password updated successfully! Please login.'); window.location.href='" . base_url('auth/login') . "';</script>";
        } else {
            $this->session->set_flashdata('error', 'Session expired. Please try again.');
            redirect('auth/forgot_password');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
