<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_code_model extends CI_Model
{
    private $table = 'used_qr_codes';

    /**
     * Check if a QR code has already been used
     * @param string $qr_data The QR code data to check
     * @return bool True if already used, false otherwise
     */
    public function is_qr_code_used($qr_data)
    {
        $this->db->where('qr_code_data', $qr_data);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Mark a QR code as used
     * @param string $qr_data The QR code data
     * @param int $user_id The user ID who used it
     * @return bool True on success, false on failure
     */
    public function mark_qr_code_used($qr_data, $user_id)
    {
        $data = array(
            'qr_code_data' => $qr_data,
            'user_id' => $user_id,
            'used_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table, $data);
    }

    /**
     * Get information about a QR code
     * @param string $qr_data The QR code data
     * @return object|null QR code record or null if not found
     */
    public function get_qr_code_info($qr_data)
    {
        $this->db->where('qr_code_data', $qr_data);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return null;
    }

    /**
     * Get all QR codes used by a specific user
     * @param int $user_id The user ID
     * @return array Array of QR code records
     */
    public function get_user_qr_codes($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
