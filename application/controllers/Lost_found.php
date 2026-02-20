<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lost_found extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('Lost_found_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $type = $this->input->get('type');
        $items = $this->Lost_found_model->get_items($type);

        // Add replies to each item
        foreach ($items as $item) {
            $item->replies = $this->Lost_found_model->get_replies($item->id);
        }

        $data['items'] = $items;
        $data['current_type'] = $type;
        $data['title'] = 'Lost & Found Hub';

        $this->load->view('lost_found/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Report Lost or Found Item';
        $this->load->view('lost_found/create', $data);
    }

    public function store()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('item_name', 'Item Name', 'required');
        $this->form_validation->set_rules('type', 'Report Type', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('lost_found/create');
        } else {
            $image = NULL;
            if (!empty($_FILES['image']['name'])) {
                $image = $this->_upload_image();
            }

            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'type' => $this->input->post('type'),
                'item_name' => $this->input->post('item_name'),
                'description' => $this->input->post('description'),
                'location' => $this->input->post('location'),
                'category' => $this->input->post('category'),
                'image' => $image,
                'status' => 'active'
            ];

            if ($this->Lost_found_model->create_item($data)) {
                $this->session->set_flashdata('success', 'Item reported successfully!');
                redirect('lost_found');
            } else {
                $this->session->set_flashdata('error', 'Failed to report item.');
                redirect('lost_found/create');
            }
        }
    }

    public function resolve($id)
    {
        $item = $this->Lost_found_model->get_item($id);
        if ($item && $item->user_id == $this->session->userdata('user_id')) {
            if ($this->Lost_found_model->update_status($id, 'resolved')) {
                $this->session->set_flashdata('success', 'Item marked as resolved!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update status.');
            }
        } else {
            $this->session->set_flashdata('error', 'Unauthorized action.');
        }
        redirect('lost_found');
    }

    public function delete($id)
    {
        $item = $this->Lost_found_model->get_item($id);
        if ($item && $item->user_id == $this->session->userdata('user_id')) {
            // Delete image if exists
            if ($item->image) {
                $path = './uploads/lost_found/' . $item->image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            if ($this->Lost_found_model->delete_item($id)) {
                $this->session->set_flashdata('success', 'Post deleted successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete post.');
            }
        } else {
            $this->session->set_flashdata('error', 'Unauthorized action.');
        }
        redirect('lost_found');
    }

    public function add_reply($item_id)
    {
        $content = $this->input->post('content');
        if (empty($content)) {
            $this->session->set_flashdata('error', 'Reply cannot be empty.');
            redirect('lost_found');
        }

        $data = [
            'item_id' => $item_id,
            'user_id' => $this->session->userdata('user_id'),
            'content' => $content
        ];

        if ($this->Lost_found_model->add_reply($data)) {
            $this->session->set_flashdata('success', 'Reply added!');
        } else {
            $this->session->set_flashdata('error', 'Failed to add reply.');
        }
        redirect('lost_found');
    }

    private function _upload_image()
    {
        $config['upload_path'] = './uploads/lost_found/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        } else {
            return NULL;
        }
    }
}
