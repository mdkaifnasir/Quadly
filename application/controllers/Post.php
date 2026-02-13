<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Post_model');
        $this->load->model('User_model');
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->output->set_status_header(401)->set_output(json_encode(['error' => 'Unauthorized']));
            return;
        }
    }

    // 1. Translate post content
    public function translate($post_id)
    {
        // Validate ownership / permissions
        $post = $this->Post_model->get_post($post_id);
        if (!$post) {
            return $this->output->set_status_header(404)->set_output(json_encode(['error' => 'Post not found']));
        }
        // Detect language and translate (placeholder using external service)
        $translated = $this->Post_model->translate_content($post->content);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true, 'translated' => $translated]));
    }

    // 2. Copy link – simply return the public URL
    public function copy_link($post_id)
    {
        $url = base_url('post/view/' . $post_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true, 'url' => $url]));
    }

    // 3. Save / 4. Unsave
    public function save($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->Post_model->save_for_user($post_id, $user_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }
    public function unsave($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->Post_model->unsave_for_user($post_id, $user_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

    // 5. Not Interested – remove from feed (simple flag)
    public function not_interested($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->Post_model->mark_not_interested($post_id, $user_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

    // 6. Mute user
    public function mute_user($target_user_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->User_model->mute_user($user_id, $target_user_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

    // 7. Restrict user
    public function restrict_user($target_user_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->User_model->restrict_user($user_id, $target_user_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

    // 8. Block user (destructive)
    public function block_user($target_user_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->User_model->block_user($user_id, $target_user_id);
        // Log moderation action
        $this->load->model('Moderation_model');
        $this->Moderation_model->log_action($user_id, 'block', $target_user_id);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

    // 9. Report post (destructive)
    public function report($post_id)
    {
        $type = $this->input->post('type'); // spam, hate, etc.
        $details = $this->input->post('details');
        $user_id = $this->session->userdata('user_id');
        $this->load->model('Report_model');
        $this->Report_model->create_report($user_id, $post_id, $type, $details);
        // Log moderation action
        $this->load->model('Moderation_model');
        $this->Moderation_model->log_action($user_id, 'report', $post_id, $type);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }
    // 10. Delete post (destructive)
    public function delete($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $post = $this->Post_model->get_post($post_id);
        if ($post && $post->user_id == $user_id) {
            $this->Post_model->delete_post($post_id);
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['success' => true]));
        } else {
            $this->output->set_status_header(403)
                ->set_output(json_encode(['error' => 'Forbidden']));
        }
    }
    // 11. Toggle Like
    public function toggle_like()
    {
        $post_id = $this->input->post('post_id');
        $user_id = $this->session->userdata('user_id');

        if (!$post_id) {
            echo json_encode(['status' => 'error', 'message' => 'Post ID required']);
            return;
        }

        $action = $this->Post_model->toggle_like($post_id, $user_id);

        // Get new count
        $post = $this->Post_model->get_post($post_id);

        echo json_encode([
            'status' => 'success',
            'action' => $action,
            'new_count' => $post->likes_count
        ]);
    }
}
?>