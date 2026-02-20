<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interactions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        // Ensure user is logged in for all interactions
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
            exit;
        }
    }

    public function toggle_mute($target_id)
    {
        $user_id = $this->session->userdata('user_id');

        if ($this->User_model->is_muted($user_id, $target_id)) {
            $this->User_model->unmute_user($user_id, $target_id);
            $new_status = 'unmuted';
        } else {
            $this->User_model->mute_user($user_id, $target_id);
            $new_status = 'muted';
        }

        echo json_encode(['status' => 'success', 'new_state' => $new_status]);
    }

    public function toggle_restrict($target_id)
    {
        $user_id = $this->session->userdata('user_id');

        if ($this->User_model->is_restricted($user_id, $target_id)) {
            $this->User_model->unrestrict_user($user_id, $target_id);
            $new_status = 'unrestricted';
        } else {
            $this->User_model->restrict_user($user_id, $target_id);
            $new_status = 'restricted';
        }

        echo json_encode(['status' => 'success', 'new_state' => $new_status]);
    }

    public function toggle_block($target_id)
    {
        $user_id = $this->session->userdata('user_id');

        if ($this->User_model->is_blocked($user_id, $target_id)) {
            $this->User_model->unblock_user($user_id, $target_id);
            $new_status = 'unblocked';
        } else {
            $this->User_model->block_user($user_id, $target_id);
            $new_status = 'blocked';
        }

        echo json_encode(['status' => 'success', 'new_state' => $new_status]);
    }

    public function report($target_id)
    {
        $user_id = $this->session->userdata('user_id');
        $reason = $this->input->post('reason');

        if (empty($reason)) {
            echo json_encode(['status' => 'error', 'message' => 'Reason cannot be empty']);
            return;
        }

        if ($this->User_model->report_user($user_id, $target_id, $reason)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to submit report']);
        }
    }

    public function get_status($target_id)
    {
        $user_id = $this->session->userdata('user_id');

        echo json_encode([
            'is_muted' => $this->User_model->is_muted($user_id, $target_id),
            'is_restricted' => $this->User_model->is_restricted($user_id, $target_id),
            'is_blocked' => $this->User_model->is_blocked($user_id, $target_id)
        ]);
    }
}
