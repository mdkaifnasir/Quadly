<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->load->model('Post_model');

        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Patch session if missing data (for users logged in before the update)
        if ($this->session->userdata('logged_in') && !$this->session->userdata('username')) {
            $this->load->model('User_model');
            $user_id = $this->session->userdata('user_id');

            // Validate user_id exists and is numeric
            if ($user_id && is_numeric($user_id)) {
                $user = $this->User_model->get_user_by_id($user_id);
                if ($user && $user->email === $this->session->userdata('email')) {
                    $this->session->set_userdata([
                        'username' => $user->username,
                        'profile_photo' => $user->profile_photo
                    ]);
                } else {
                    // Session corrupted - clear it
                    $this->session->sess_destroy();
                    redirect('auth/login');
                    return;
                }
            } else {
                // Invalid user_id - clear session
                $this->session->sess_destroy();
                redirect('auth/login');
                return;
            }
        }

        $data['posts'] = $this->Post_model->get_feed();

        // Check verification status for the banner
        $data['is_unverified'] = false;
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model');
            $curr_u = $this->User_model->get_user_by_id($this->session->userdata('user_id'));
            if ($curr_u && ($curr_u->status !== 'active' || !$curr_u->is_verified)) {
                $data['is_unverified'] = true;
            }
        }

        $this->load->view('home', $data);
    }

    public function submit_post()
    {
        header('Content-Type: application/json');

        $user_id = $this->session->userdata('user_id') ?: 1;
        $content = trim($this->input->post('content'));

        // Restriction for unverified users
        $this->load->model('User_model');
        $current_user = $this->User_model->get_user_by_id($user_id);
        if ($current_user && ($current_user->status !== 'active' || !$current_user->is_verified)) {
            echo json_encode(['status' => 'error', 'message' => 'Your account is pending verification. You cannot post until an admin verifies your profile.']);
            return;
        }

        // Validation
        if (empty($content) && empty($_FILES['media']['name'])) {
            echo json_encode(['status' => 'error', 'message' => 'Thread cannot be empty']);
            return;
        }

        if (strlen($content) > 500) {
            echo json_encode(['status' => 'error', 'message' => 'Thread is too long (max 500 characters)']);
            return;
        }

        // Hashtags and Mentions Extraction
        preg_match_all('/#(\w+)/', $content, $h_matches);
        preg_match_all('/@(\w+)/', $content, $m_matches);
        $hashtags = !empty($h_matches[1]) ? implode(',', $h_matches[1]) : NULL;
        $mentions = !empty($m_matches[1]) ? implode(',', $m_matches[1]) : NULL;

        // Media Upload
        $image = NULL;
        $video = NULL;

        if (!empty($_FILES['media']['name'])) {
            $media_data = $this->_upload_any_media('media');
            if (isset($media_data['error'])) {
                echo json_encode(['status' => 'error', 'message' => $media_data['error']]);
                return;
            }
            if ($media_data['is_image'])
                $image = $media_data['file_name'];
            else
                $video = $media_data['file_name'];
        }

        $data = [
            'user_id' => $user_id,
            'content' => $content,
            'image' => $image,
            'video' => $video,
            'hashtags' => $hashtags,
            'mentions' => $mentions,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->load->model('Post_model');
        if ($this->Post_model->create_post($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save thread']);
        }
    }

    private function _upload_any_media($field)
    {
        $config['upload_path'] = './uploads/posts/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|mp4|mov|avi|wmv';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($field)) {
            $data = $this->upload->data();
            return [
                'file_name' => $data['file_name'],
                'is_image' => in_array($data['file_ext'], ['.gif', '.jpg', '.jpeg', '.png', '.webp'])
            ];
        } else {
            return ['error' => $this->upload->display_errors('', '')];
        }
    }



    public function get_comments($post_id)
    {
        $this->load->model('Comment_model');
        $comments = $this->Comment_model->get_post_comments($post_id);

        // Add full path for avatars
        foreach ($comments as &$c) {
            $c->profile_photo = $c->profile_photo ? base_url('uploads/' . $c->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($c->first_name) . '&background=random';
            $c->created_at_human = date('j M, H:i', strtotime($c->created_at));
        }

        echo json_encode($comments);
    }

    public function submit_comment()
    {
        $this->load->model('Comment_model');

        $user_id = $this->session->userdata('user_id') ?: 1; // Fallback to 1 for test
        $post_id = $this->input->post('post_id');
        $content = $this->input->post('content');

        // Restriction for unverified users
        $this->load->model('User_model');
        $current_user = $this->User_model->get_user_by_id($user_id);
        if ($current_user && ($current_user->status !== 'active' || !$current_user->is_verified)) {
            echo json_encode(['status' => 'error', 'message' => 'Action restricted. Your account is pending verification.']);
            return;
        }

        if (empty($content) || empty($post_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Empty content']);
            return;
        }

        $data = [
            'post_id' => $post_id,
            'user_id' => $user_id,
            'content' => $content
        ];

        if ($this->Comment_model->add_comment($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function handle_repost()
    {
        $this->load->model('Repost_model');
        $user_id = $this->session->userdata('user_id') ?: 1;
        $post_id = $this->input->post('post_id');
        $comment = $this->input->post('comment'); // For quote reposts

        // Restriction for unverified users
        $this->load->model('User_model');
        $current_user = $this->User_model->get_user_by_id($user_id);
        if ($current_user && ($current_user->status !== 'active' || !$current_user->is_verified)) {
            echo json_encode(['status' => 'error', 'message' => 'Action restricted. Your account is pending verification.']);
            return;
        }

        // Check if already reposted
        if ($this->Repost_model->is_reposted($post_id, $user_id)) {
            // Option to undo
            if ($this->input->post('action') == 'undo') {
                if ($this->Repost_model->undo_repost($post_id, $user_id)) {
                    echo json_encode(['status' => 'success', 'action' => 'undone']);
                } else {
                    echo json_encode(['status' => 'error']);
                }
            } else {
                echo json_encode(['status' => 'exists', 'message' => 'Already reposted']);
            }
            return;
        }

        if ($this->Repost_model->repost($post_id, $user_id, $comment)) {
            echo json_encode(['status' => 'success', 'action' => 'reposted']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    private function _upload_image()
    {
        if (empty($_FILES['image']['name']))
            return null;

        $config['upload_path'] = './uploads/posts/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        // Ensure directory exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        } else {
            // Log error or flash message
            return null;
        }
    }
}
