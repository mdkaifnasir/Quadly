<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repost_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function repost($post_id, $user_id, $comment = null)
    {
        $this->db->trans_start();

        $data = [
            'original_post_id' => $post_id,
            'user_id' => $user_id,
            'comment' => $comment
        ];

        $this->db->insert('reposts', $data);

        // Update count in posts table
        $this->db->set('reposts_count', 'reposts_count+1', FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function undo_repost($post_id, $user_id)
    {
        $this->db->trans_start();

        $this->db->where(['original_post_id' => $post_id, 'user_id' => $user_id]);
        $this->db->delete('reposts');

        if ($this->db->affected_rows() > 0) {
            $this->db->set('reposts_count', 'reposts_count-1', FALSE);
            $this->db->where('id', $post_id);
            $this->db->update('posts');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function is_reposted($post_id, $user_id)
    {
        $query = $this->db->get_where('reposts', ['original_post_id' => $post_id, 'user_id' => $user_id]);
        return $query->num_rows() > 0;
    }

    public function get_user_reposts($user_id)
    {
        $this->db->select('reposts.*, posts.content, posts.image, users.first_name, users.last_name, users.profile_photo');
        $this->db->from('reposts');
        $this->db->join('posts', 'posts.id = reposts.original_post_id');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('reposts.user_id', $user_id);
        return $this->db->get()->result();
    }
}
