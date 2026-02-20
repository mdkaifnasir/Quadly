<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Post_model');
    }

    public function index()
    {
        $query = $this->input->get('q');
        $type = $this->input->get('type') ?: 'all';
        $data['query'] = $query;
        $data['type'] = $type;

        if ($query) {
            $data['people'] = ($type == 'all' || $type == 'people') ? $this->User_model->get_all_users(10, 0, $query) : [];
            $data['threads'] = ($type == 'all' || $type == 'threads') ? $this->Post_model->search_posts($query, 10, 0) : [];
            $data['hashtags'] = ($type == 'all' || $type == 'hashtags') ? $this->Post_model->search_hashtags($query, 10, 0) : [];
        } else {
            $data['people'] = [];
            $data['threads'] = [];
            $data['hashtags'] = [];
        }

        $this->load->view('search', $data);
    }

    public function query()
    {
        $q = $this->input->get('q');
        if (!$q) {
            echo json_encode([]);
            return;
        }

        $results = [
            'people' => $this->User_model->get_all_users(5, 0, $q),
            'threads' => $this->Post_model->search_posts($q, 5, 0),
            'hashtags' => $this->Post_model->search_hashtags($q, 5, 0)
        ];

        header('Content-Type: application/json');
        echo json_encode($results);
    }
}
