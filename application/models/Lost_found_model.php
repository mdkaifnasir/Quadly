<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lost_found_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_items($type = NULL, $status = 'active', $limit = 20, $offset = 0)
    {
        $this->db->select('lost_found_items.*, users.first_name, users.last_name, users.profile_photo');
        $this->db->from('lost_found_items');
        $this->db->join('users', 'users.id = lost_found_items.user_id');

        if ($type) {
            $this->db->where('lost_found_items.type', $type);
        }

        if ($status) {
            $this->db->where('lost_found_items.status', $status);
        }

        $this->db->order_by('lost_found_items.created_at', 'DESC');
        $this->db->limit($limit, $offset);

        return $this->db->get()->result();
    }

    public function get_item($id)
    {
        $this->db->select('lost_found_items.*, users.first_name, users.last_name, users.profile_photo, users.username');
        $this->db->from('lost_found_items');
        $this->db->join('users', 'users.id = lost_found_items.user_id');
        $this->db->where('lost_found_items.id', $id);
        return $this->db->get()->row();
    }

    public function create_item($data)
    {
        return $this->db->insert('lost_found_items', $data);
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('lost_found_items', ['status' => $status]);
    }

    public function get_my_items($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('lost_found_items')->result();
    }

    public function delete_item($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('lost_found_items');
    }

    public function add_reply($data)
    {
        return $this->db->insert('lost_found_replies', $data);
    }

    public function get_replies($item_id)
    {
        $this->db->select('lost_found_replies.*, users.first_name, users.last_name, users.profile_photo');
        $this->db->from('lost_found_replies');
        $this->db->join('users', 'users.id = lost_found_replies.user_id');
        $this->db->where('item_id', $item_id);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get()->result();
    }
}
