<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all posts joined with user details
    public function get_feed($limit = 50, $offset = 0)
    {
        $select = 'posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, posts.created_at, users.first_name, users.last_name, users.profile_photo, users.role, users.major';

        // Fetch regular posts
        $this->db->select($select . ', "post" as item_type, NULL as reposted_by, NULL as repost_comment', FALSE);
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $posts_query = $this->db->get_compiled_select();

        // Fetch reposts
        $this->db->select('posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, reposts.created_at, users.first_name, users.last_name, users.profile_photo, users.role, users.major, "repost" as item_type, CONCAT(reposter.first_name, " ", reposter.last_name) as reposted_by, reposts.comment as repost_comment', FALSE);
        $this->db->from('reposts');
        $this->db->join('posts', 'posts.id = reposts.original_post_id');
        $this->db->join('users', 'users.id = posts.user_id'); // Original Author
        $this->db->join('users as reposter', 'reposter.id = reposts.user_id'); // Person who reposted
        $reposts_query = $this->db->get_compiled_select();

        // Combine and sort
        $query = $this->db->query("($posts_query) UNION ALL ($reposts_query) ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
        return $query->result();
    }

    public function get_active_stories()
    {
        $this->db->select('stories.*, users.first_name, users.last_name, users.profile_photo');
        $this->db->from('stories');
        $this->db->join('users', 'users.id = stories.user_id');
        $this->db->where('stories.expires_at >', date('Y-m-d H:i:s'));
        $this->db->order_by('stories.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function create_post($data)
    {
        return $this->db->insert('posts', $data);
    }

    public function get_post($id)
    {
        return $this->db->get_where('posts', ['id' => $id])->row();
    }

    public function delete_post($id)
    {
        return $this->db->delete('posts', ['id' => $id]);
    }

    // Get user specific posts + reposts
    public function get_user_feed($user_id, $limit = 50, $offset = 0)
    {
        $select = 'posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, posts.created_at, users.first_name, users.last_name, users.profile_photo, users.role, users.major';

        // Fetch regular posts by this user
        $this->db->select($select . ', "post" as item_type, NULL as reposted_by, NULL as repost_comment', FALSE);
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('posts.user_id', $user_id);
        $posts_query = $this->db->get_compiled_select();

        // Fetch reposts by this user
        $this->db->select('posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, reposts.created_at, users.first_name, users.last_name, users.profile_photo, users.role, users.major, "repost" as item_type, CONCAT(reposter.first_name, " ", reposter.last_name) as reposted_by, reposts.comment as repost_comment', FALSE);
        $this->db->from('reposts');
        $this->db->join('posts', 'posts.id = reposts.original_post_id');
        $this->db->join('users', 'users.id = posts.user_id'); // Original Author
        $this->db->join('users as reposter', 'reposter.id = reposts.user_id'); // Reposter (the profile owner)
        $this->db->where('reposts.user_id', $user_id);
        $reposts_query = $this->db->get_compiled_select();

        // Combine and sort
        $query = $this->db->query("($posts_query) UNION ALL ($reposts_query) ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
        return $query->result();
    }

    // Get ONLY original threads (not reposts)
    public function get_user_threads($user_id, $limit = 50, $offset = 0)
    {
        $this->db->select('posts.*, users.first_name, users.last_name, users.profile_photo, users.role, users.major, "post" as item_type');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('posts.user_id', $user_id);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    // Get ONLY reposts for a specific user
    public function get_user_reposts_only($user_id, $limit = 50, $offset = 0)
    {
        $this->db->select('posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, users.first_name, users.last_name, users.profile_photo, users.role, users.major, "repost" as item_type, CONCAT(reposter.first_name, " ", reposter.last_name) as reposted_by, reposts.comment as repost_comment, reposts.created_at', FALSE);
        $this->db->from('reposts');
        $this->db->join('posts', 'posts.id = reposts.original_post_id');
        $this->db->join('users', 'users.id = posts.user_id'); // Original Author
        $this->db->join('users as reposter', 'reposter.id = reposts.user_id');
        $this->db->where('reposts.user_id', $user_id);
        $this->db->order_by('reposts.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    // Search posts and reposts by content
    public function search_posts($query, $limit = 50, $offset = 0)
    {
        $select = 'posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, posts.created_at, users.first_name, users.last_name, users.profile_photo, users.role, users.major';

        // Fetch regular posts matching query
        $this->db->select($select . ', "post" as item_type, NULL as reposted_by, NULL as repost_comment', FALSE);
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->like('posts.content', $query);
        $posts_query = $this->db->get_compiled_select();

        // Fetch reposts matching query (search in original content OR repost comment)
        $this->db->select('posts.id, posts.user_id, posts.content, posts.image, posts.video, posts.likes_count, posts.reposts_count, posts.hashtags, posts.mentions, posts.visibility, reposts.created_at, users.first_name, users.last_name, users.profile_photo, users.role, users.major, "repost" as item_type, CONCAT(reposter.first_name, " ", reposter.last_name) as reposted_by, reposts.comment as repost_comment', FALSE);
        $this->db->from('reposts');
        $this->db->join('posts', 'posts.id = reposts.original_post_id');
        $this->db->join('users', 'users.id = posts.user_id'); // Original Author
        $this->db->join('users as reposter', 'reposter.id = reposts.user_id');
        $this->db->group_start();
        $this->db->like('posts.content', $query);
        $this->db->or_like('reposts.comment', $query);
        $this->db->group_end();
        $reposts_query = $this->db->get_compiled_select();

        // Combine and sort (Ranked by recency and popularity)
        $final_query = $this->db->query("($posts_query) UNION ALL ($reposts_query) ORDER BY (likes_count + reposts_count) DESC, created_at DESC LIMIT $limit OFFSET $offset");
        return $final_query->result();
    }

    // Search hashtags (this is a simple implementation searching for #tag in content)
    public function search_hashtags($query, $limit = 50, $offset = 0)
    {
        // For a more robust hashtag system, you'd have a separate 'hashtags' table.
        // This query finds unique tags used in posts.
        $this->db->select('content');
        $this->db->like('content', '#' . $query);
        $posts = $this->db->get('posts')->result();

        $tags = [];
        foreach ($posts as $post) {
            preg_match_all('/#(\w+)/', $post->content, $matches);
            foreach ($matches[1] as $tag) {
                if (stripos($tag, $query) !== false) {
                    $tags[$tag] = ($tags[$tag] ?? 0) + 1;
                }
            }
        }

        arsort($tags);
        $result = [];
        $i = 0;
        foreach ($tags as $tag => $count) {
            if ($i >= $offset && count($result) < $limit) {
                $result[] = (object) ['tag' => $tag, 'count' => $count];
            }
            $i++;
        }
        return $result;
    }

    // --- New Action Methods for Three-Dot Menu ---

    // Placeholder translation using external service (mock)
    public function translate_content($text)
    {
        // In real implementation, call a translation API.
        return '[Translated] ' . $text;
    }

    // Save post for a user
    public function save_for_user($post_id, $user_id)
    {
        $data = ['post_id' => $post_id, 'user_id' => $user_id, 'saved_at' => date('Y-m-d H:i:s')];
        // Using IGNORE or checking existence would be better, but keeping it simple
        return $this->db->insert('saved_posts', $data);
    }

    // Unsave post for a user
    public function unsave_for_user($post_id, $user_id)
    {
        $this->db->where(['post_id' => $post_id, 'user_id' => $user_id]);
        return $this->db->delete('saved_posts');
    }

    // Mark post as not interested for a user
    public function mark_not_interested($post_id, $user_id)
    {
        $data = ['post_id' => $post_id, 'user_id' => $user_id, 'created_at' => date('Y-m-d H:i:s')];
        return $this->db->insert('not_interested', $data);
    }
    // Toggle Like
    public function toggle_like($post_id, $user_id)
    {
        // Check if already liked
        $this->db->where('user_id', $user_id);
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('likes');

        if ($query->num_rows() > 0) {
            // Unlike
            $this->db->delete('likes', ['user_id' => $user_id, 'post_id' => $post_id]);
            // Decrement post likes count
            $this->db->set('likes_count', 'likes_count-1', FALSE);
            $this->db->where('id', $post_id);
            $this->db->update('posts');
            return 'unliked';
        } else {
            // Like
            $this->db->insert('likes', ['user_id' => $user_id, 'post_id' => $post_id]);
            // Increment post likes count
            $this->db->set('likes_count', 'likes_count+1', FALSE);
            $this->db->where('id', $post_id);
            $this->db->update('posts');
            return 'liked';
        }
    }

    public function is_liked($post_id, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('post_id', $post_id);
        return $this->db->count_all_results('likes') > 0;
    }
}