<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function create_report($user_id, $post_id, $type, $details)
    {
        $data = [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'report_type' => $type,
            'details' => $details,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ];
        return $this->db->insert('reports', $data);
    }
}
