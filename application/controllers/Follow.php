<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Follow extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            if ($this->input->is_ajax_request()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Please login first']);
                exit;
            }
            redirect('auth/login');
        }
        $this->load->model('Follow_model');
    }

    public function toggle()
    {
        header('Content-Type: application/json');

        $following_id = $this->input->post('user_id');
        $follower_id = $this->session->userdata('user_id');

        if (!$following_id || $following_id == $follower_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid user']);
            return;
        }

        if ($this->Follow_model->is_following($follower_id, $following_id)) {
            $this->Follow_model->unfollow($follower_id, $following_id);
            echo json_encode(['status' => 'success', 'action' => 'unfollowed']);
        } else {
            $this->Follow_model->follow($follower_id, $following_id);
            echo json_encode(['status' => 'success', 'action' => 'followed']);
        }
    }

    public function status($user_id)
    {
        header('Content-Type: application/json');
        $follower_id = $this->session->userdata('user_id');
        $is_following = $this->Follow_model->is_following($follower_id, $user_id);
        echo json_encode(['status' => 'success', 'is_following' => $is_following]);
    }
    public function get_followers($user_id)
    {
        header('Content-Type: application/json');
        $followers = $this->Follow_model->get_followers($user_id);
        // Enrich with follow status for the current user (to show Follow/Unfollow button in list)
        $current_user = $this->session->userdata('user_id');
        foreach ($followers as &$f) {
            $f->is_following = $this->Follow_model->is_following($current_user, $f->id);
            $f->is_self = ($f->id == $current_user);
            $f->profile_photo = $f->profile_photo ? base_url('uploads/' . $f->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($f->first_name) . '&background=random';
        }
        echo json_encode($followers);
    }

    public function get_following($user_id)
    {
        header('Content-Type: application/json');
        $following = $this->Follow_model->get_following($user_id);
        $current_user = $this->session->userdata('user_id');
        foreach ($following as &$f) {
            $f->is_following = $this->Follow_model->is_following($current_user, $f->id);
            $f->is_self = ($f->id == $current_user);
            $f->profile_photo = $f->profile_photo ? base_url('uploads/' . $f->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($f->first_name) . '&background=random';
        }
        echo json_encode($following);
    }
}
