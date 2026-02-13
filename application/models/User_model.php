<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function student_id_exists($id)
    {
        $this->db->where('student_id', $id);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function username_exists($username, $exclude_id = null)
    {
        $this->db->where('username', $username);
        if ($exclude_id)
            $this->db->where('id !=', $exclude_id);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function verify_user($credential, $password)
    {
        $this->db->group_start();
        $this->db->where('email', $credential);
        $this->db->or_where('student_id', $credential);
        $this->db->or_where('username', $credential);
        $this->db->group_end();

        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Verify password
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }


    public function get_all_users($limit, $offset, $search = null, $role = null)
    {
        if ($search) {
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('username', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('student_id', $search);
            $this->db->group_end();

            // Advanced Ranking: Priority to exact username matches
            $this->db->order_by("CASE WHEN username = " . $this->db->escape($search) . " THEN 0 ELSE 1 END", "ASC", FALSE);
        }

        if ($role && $role != 'all') {
            $this->db->where('role', $role);
        }

        $this->db->limit($limit, $offset);
        if (!$search)
            $this->db->order_by('created_at', 'DESC');
        return $this->db->get('users')->result();
    }

    public function count_all_users($search = null, $role = null)
    {
        if ($search) {
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }

        if ($role && $role != 'all') {
            $this->db->where('role', $role);
        }
        return $this->db->count_all_results('users');
    }

    public function get_user_stats()
    {
        return [
            'pending_faculty' => $this->db->where('role', 'faculty')->where('status', 'pending')->count_all_results('users'),
            'total_users' => $this->db->count_all_results('users'),
            'suspended' => $this->db->where('status', 'suspended')->count_all_results('users'),
            'faculty_count' => $this->db->where('role', 'faculty')->count_all_results('users'),
            'student_count' => $this->db->where('role', 'student')->count_all_results('users')
        ];
    }

    public function update_status($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function get_user_by_username($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('users', $data);
        error_log("DEBUG_UPDATE_USER: ID=$id, Data=" . print_r($data, true) . ", Result=" . ($result ? 'TRUE' : 'FALSE'));
        if (!$result) {
            error_log("DEBUG_UPDATE_ERROR: " . $this->db->error()['message']);
        }
        return $result;
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function get_user_by_token($token)
    {
        // Token must match AND not be expired
        $this->db->where('reset_token', $token);
        $this->db->where('reset_token_expire >', date('Y-m-d H:i:s'));
        $query = $this->db->get('users');

        log_message('error', 'DB Query for Token: ' . $this->db->last_query());

        return $query->row();

    }

    // --- Social Interactions Helpers ---

    public function mute_user($user_id, $target_user_id)
    {
        $data = ['user_id' => $user_id, 'muted_user_id' => $target_user_id, 'created_at' => date('Y-m-d H:i:s')];
        return $this->db->insert('mutes', $data);
    }

    public function restrict_user($user_id, $target_user_id)
    {
        $data = ['user_id' => $user_id, 'restricted_user_id' => $target_user_id, 'created_at' => date('Y-m-d H:i:s')];
        return $this->db->insert('restrictions', $data);
    }

    public function block_user($user_id, $target_user_id)
    {
        $data = ['user_id' => $user_id, 'blocked_user_id' => $target_user_id, 'created_at' => date('Y-m-d H:i:s')];
        return $this->db->insert('blocks', $data);
    }

    public function report_user($reporter_id, $reported_user_id, $reason)
    {
        $data = [
            'reporter_id' => $reporter_id,
            'reported_user_id' => $reported_user_id,
            'reason' => $reason,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('reports', $data);
    }

    public function is_muted($user_id, $target_user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('muted_user_id', $target_user_id);
        return $this->db->count_all_results('mutes') > 0;
    }

    public function is_restricted($user_id, $target_user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('restricted_user_id', $target_user_id);
        return $this->db->count_all_results('restrictions') > 0;
    }

    public function is_blocked($user_id, $target_user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('blocked_user_id', $target_user_id);
        return $this->db->count_all_results('blocks') > 0;
    }

    public function unmute_user($user_id, $target_user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('muted_user_id', $target_user_id);
        return $this->db->delete('mutes');
    }

    public function unrestrict_user($user_id, $target_user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('restricted_user_id', $target_user_id);
        return $this->db->delete('restrictions');
    }

    public function unblock_user($user_id, $target_user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('blocked_user_id', $target_user_id);
        return $this->db->delete('blocks');
    }

    public function get_all_reports()
    {
        $this->db->select('reports.*, 
                           reporter.first_name as reporter_first_name, reporter.last_name as reporter_last_name, reporter.profile_photo as reporter_photo,
                           reported.first_name as reported_first_name, reported.last_name as reported_last_name, reported.profile_photo as reported_photo, reported.username as reported_username');
        $this->db->from('reports');
        $this->db->join('users as reporter', 'reporter.id = reports.reporter_id');
        $this->db->join('users as reported', 'reported.id = reports.reported_user_id');
        $this->db->order_by('reports.created_at', 'DESC');
        return $this->db->get()->result();
    }
}
