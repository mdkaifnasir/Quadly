<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Department_model');

        // Check if logged in and is admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $search = $this->input->get('search');
        $role = $this->input->get('role');

        $data['users'] = $this->User_model->get_all_users(50, 0, $search, $role);
        $data['stats'] = $this->User_model->get_user_stats();
        $data['search'] = $search;
        $data['role_filter'] = $role;
        $data['page'] = 'users'; // For active state

        $this->load->view('admin/dashboard', $data);
    }

    public function overview()
    {
        $data['stats'] = $this->User_model->get_user_stats();
        $data['page'] = 'dashboard';
        $this->load->view('admin/overview', $data);
    }

    public function post()
    {
        $data['page'] = 'post';
        $this->load->view('admin/post', $data);
    }

    public function reports()
    {
        $data['page'] = 'reports';
        $data['reports'] = $this->User_model->get_all_reports();
        $this->load->view('admin/reports', $data);
    }

    public function media()
    {
        $this->load->model('Message_model');
        $data['page'] = 'media';
        $data['media_files'] = $this->Message_model->get_all_media();
        $this->load->view('admin/media', $data);
    }

    public function settings()
    {
        $data['page'] = 'settings';
        $this->load->view('admin/settings', $data);
    }

    public function face_search()
    {
        $data['page'] = 'face_search';
        // Optimize: Only fetch users who actually have a face descriptor
        $this->db->select('id, first_name, last_name, role, profile_photo, student_id, face_descriptor');
        $this->db->where('face_descriptor !=', NULL);
        $this->db->where('face_descriptor !=', "");
        $data['users_with_faces'] = $this->db->get('users')->result();

        $this->load->view('admin/face_search', $data);
    }

    public function verify_user($id)
    {
        $this->User_model->update_status($id, ['status' => 'active', 'is_verified' => 1]);
        redirect('admin');
    }

    public function suspend_user($id)
    {
        $this->User_model->update_status($id, ['status' => 'suspended']);
        redirect('admin');
    }

    public function activate_user($id)
    {
        $this->User_model->update_status($id, ['status' => 'active']);
        redirect('admin');
    }

    public function delete_user($id)
    {
        $this->User_model->delete_user($id);
        redirect('admin');
    }

    public function edit_user($id)
    {
        $data['user'] = $this->User_model->get_user_by_id($id);
        if (!$data['user']) {
            show_404();
        }
        $data['departments'] = $this->Department_model->get_active();
        $this->load->view('admin/edit_user', $data);
    }

    public function edit_user_submit($id)
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'student_id' => $this->input->post('student_id'),
            'role' => $this->input->post('role'),
            'major' => $this->input->post('major'), // Ideally this should now match department names
            'status' => $this->input->post('status')
        );

        $this->User_model->update_user($id, $data);
        redirect('admin');
    }

    // --- Department Management ---

    public function departments()
    {
        $data['page'] = 'departments';
        $data['departments'] = $this->Department_model->get_all();
        $this->load->view('admin/departments', $data);
    }

    public function add_department()
    {
        $data['page'] = 'departments';
        $this->load->view('admin/department_form', $data);
    }

    public function save_department()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        );
        $this->Department_model->create($data);
        redirect('admin/departments');
    }

    public function edit_department($id)
    {
        $data['page'] = 'departments';
        $data['department'] = $this->Department_model->get_by_id($id);
        if (!$data['department'])
            show_404();
        $this->load->view('admin/department_form', $data);
    }

    public function update_department($id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        );
        $this->Department_model->update($id, $data);
        redirect('admin/departments');
    }

    public function delete_department($id)
    {
        $this->Department_model->delete($id);
        redirect('admin/departments');
    }
    // --- Face Search Logging ---

    public function log_face_search()
    {
        // AJAX Request
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input)
            return;

        $data = array(
            'admin_id' => $this->session->userdata('user_id'),
            'search_type' => $input['search_type'] ?? 'upload',
            'matches_found' => intval($input['matches_found'] ?? 0)
        );

        $this->db->insert('face_search_logs', $data);
        echo json_encode(['status' => 'success']);
    }

    public function get_face_search_history()
    {
        $this->db->select('face_search_logs.*, users.first_name, users.last_name');
        $this->db->from('face_search_logs');
        $this->db->join('users', 'users.id = face_search_logs.admin_id');
        $this->db->order_by('search_timestamp', 'DESC');
        $this->db->limit(10);
        $logs = $this->db->get()->result();

        // Format for display
        foreach ($logs as &$log) {
            $log->time_ago = $this->time_elapsed_string($log->search_timestamp);
            $log->admin_name = $log->first_name . ' ' . $log->last_name;
        }

        echo json_encode($logs);
    }

    private function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        // Calculate weeks manually
        $weeks = floor($diff->d / 7);
        $days = $diff->d - ($weeks * 7);

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        // Map values to string keys
        $values = array(
            'y' => $diff->y,
            'm' => $diff->m,
            'w' => $weeks,
            'd' => $days,
            'h' => $diff->h,
            'i' => $diff->i,
            's' => $diff->s,
        );

        foreach ($string as $k => &$v) {
            if ($values[$k]) {
                $v = $values[$k] . ' ' . $v . ($values[$k] > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
