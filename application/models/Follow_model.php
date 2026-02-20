<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Follow_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function follow($follower_id, $following_id)
    {
        if ($follower_id == $following_id)
            return false;

        $data = [
            'follower_id' => $follower_id,
            'following_id' => $following_id
        ];

        // Use ignore to avoid duplicate key errors if already following
        return $this->db->insert('follows', $data);
    }

    public function unfollow($follower_id, $following_id)
    {
        $this->db->where('follower_id', $follower_id);
        $this->db->where('following_id', $following_id);
        return $this->db->delete('follows');
    }

    public function is_following($follower_id, $following_id)
    {
        $this->db->where('follower_id', $follower_id);
        $this->db->where('following_id', $following_id);
        return $this->db->count_all_results('follows') > 0;
    }

    public function get_followers_count($user_id)
    {
        $this->db->where('following_id', $user_id);
        return $this->db->count_all_results('follows');
    }

    public function get_following_count($user_id)
    {
        $this->db->where('follower_id', $user_id);
        return $this->db->count_all_results('follows');
    }

    public function get_followers($user_id)
    {
        $this->db->select('users.*');
        $this->db->from('follows');
        $this->db->join('users', 'users.id = follows.follower_id');
        $this->db->where('follows.following_id', $user_id);
        return $this->db->get()->result();
    }

    public function get_following($user_id)
    {
        $this->db->select('users.*');
        $this->db->from('follows');
        $this->db->join('users', 'users.id = follows.following_id');
        $this->db->where('follows.follower_id', $user_id);
        return $this->db->get()->result();
    }
}
