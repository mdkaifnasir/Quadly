<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moderation_model extends CI_Model
{
    public function log_action($user_id, $action, $target_id, $details = null)
    {
        $data = [
            'user_id' => $user_id,
            'action' => $action,
            'target_id' => $target_id,
            'details' => $details,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('moderation_logs', $data);
    }
}
