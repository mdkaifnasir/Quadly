<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Post_model');
        $this->load->model('Comment_model');
        $this->load->model('Follow_model');
    }

    public function index($id = null)
    {
        if ($id === null) {
            $id = $this->session->userdata('user_id');
            if (!$id) {
                redirect('auth/login');
                return;
            }
        }

        if (!$id) {
            show_error("No user found.");
            return;
        }

        // Check if $id is numeric (original ID) or string (username)
        if (is_numeric($id)) {
            $user = $this->User_model->get_user_by_id($id);
        } else {
            $user = $this->User_model->get_user_by_username($id);
        }

        if (!$user)
            show_404();

        // Initial load of content for all 3 tabs
        $data['user'] = $user;
        $data['threads'] = $this->Post_model->get_user_threads($user->id);
        $data['replies'] = $this->Comment_model->get_user_replies($user->id);
        $data['reposts'] = $this->Post_model->get_user_reposts_only($user->id);

        // Follow Data
        $current_user_id = $this->session->userdata('user_id');
        $data['is_following'] = $this->Follow_model->is_following($current_user_id, $user->id);
        $data['followers_count'] = $this->Follow_model->get_followers_count($user->id);
        $data['following_count'] = $this->Follow_model->get_following_count($user->id);

        $this->load->view('profile', $data);
    }

    public function update()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id');
        $username = strtolower(trim($this->input->post('username')));

        // Remove @ if present
        $username = ltrim($username, '@');

        // Basic validation: alphanumeric and underscores, 3-30 chars
        if (!preg_match('/^[a-zA-Z0-9_]{3,30}$/', $username)) {
            $this->session->set_flashdata('error', 'Username must be 3-30 characters and contain only letters, numbers, and underscores.');
            redirect('profile');
        }

        // Check uniqueness
        if ($this->User_model->username_exists($username, $user_id)) {
            $this->session->set_flashdata('error', 'This username is already taken.');
            redirect('profile');
        }

        $data = [
            'username' => $username,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'bio' => $this->input->post('bio'),
            'link' => $this->input->post('link')
        ];

        // Handle Profile Photo Upload
        if (!empty($_FILES['profile_photo']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size'] = 5120; // 5MB
            $config['encrypt_name'] = TRUE;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }

            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_photo')) {
                $upload_data = $this->upload->data();
                $data['profile_photo'] = $upload_data['file_name'];
            }
        }

        if ($this->User_model->update_user($user_id, $data)) {
            $this->session->set_flashdata('success', 'Profile updated successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile.');
        }

        redirect('profile');
    }
}
