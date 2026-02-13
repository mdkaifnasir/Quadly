<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->order_by('name', 'ASC')->get('departments')->result();
    }

    public function get_active() {
        return $this->db->where('is_active', 1)->order_by('name', 'ASC')->get('departments')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('departments', ['id' => $id])->row();
    }

    public function create($data) {
        return $this->db->insert('departments', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('departments', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('departments');
    }
}
