<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_comment($data)
    {
        return $this->db->insert('comments', $data);
    }

    public function get_post_comments($post_id)
    {
        $this->db->select('comments.*, users.first_name, users.last_name, users.profile_photo');
        $this->db->from('comments');
        $this->db->join('users', 'users.id = comments.user_id');
        $this->db->where('post_id', $post_id);
        $this->db->order_by('comments.created_at', 'ASC');
        return $this->db->get()->result();
    }

    public function get_comment_count($post_id)
    {
        $this->db->where('post_id', $post_id);
        return $this->db->count_all_results('comments');
    }

    public function get_user_replies($user_id, $limit = 50, $offset = 0)
    {
        $this->db->select('comments.*, posts.content as parent_content, parent_author.first_name as parent_author_first, parent_author.last_name as parent_author_last');
        $this->db->from('comments');
        $this->db->join('posts', 'posts.id = comments.post_id');
        $this->db->join('users as parent_author', 'parent_author.id = posts.user_id');
        $this->db->where('comments.user_id', $user_id);
        $this->db->order_by('comments.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
}
