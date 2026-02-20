<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['conversations'] = $this->Message_model->get_recent_conversations($user_id);
        $data['page'] = 'messages';
        $this->load->view('messages/inbox', $data);
    }

    public function user($id)
    {
        $user_id = $this->session->userdata('user_id');
        $data['partner'] = $this->User_model->get_user_by_id($id);
        if (!$data['partner'])
            show_404();

        $data['messages'] = $this->Message_model->get_conversation($user_id, $id);
        $this->load->view('messages/chat', $data);
    }

    public function send()
    {
        $sender_id = $this->session->userdata('user_id');
        $receiver_id = $this->input->post('receiver_id');
        $message = $this->input->post('message');

        $attachment_path = null;
        $type = 'text';

        // Handle File Upload
        if (!empty($_FILES['attachment']['name'])) {
            $config['upload_path'] = './uploads/messages/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
            $config['max_size'] = 10240; // 10MB
            $config['encrypt_name'] = TRUE; // Random name

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('attachment')) {
                $upload_data = $this->upload->data();
                $attachment_path = 'messages/' . $upload_data['file_name'];

                // Determine type
                $ext = strtolower($upload_data['file_ext']);
                if ($ext == '.mp4') {
                    $type = 'video';
                } else {
                    $type = 'image';
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
                return;
            }
        }

        if (!empty($message) || $attachment_path) {
            // If message is empty but has attachment, use a placeholder or empty string
            $message = $message ?? '';
            $this->Message_model->send_message($sender_id, $receiver_id, $message, $attachment_path, $type);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Message empty']);
        }
    }

    public function fetch($partner_id)
    {
        $user_id = $this->session->userdata('user_id');
        $messages = $this->Message_model->get_conversation($user_id, $partner_id);

        // Return simple JSON for the frontend to render bubbles
        // In a real app, we'd optimization this to only fetch NEW messages
        echo json_encode(['messages' => $messages, 'current_user_id' => $user_id]);
    }
}
