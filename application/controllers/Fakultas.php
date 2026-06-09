<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->load->model('FakultasModel');
    }

    public function index()
    {
        $data['title'] = "Daftar Fakultas";
        $data['fakultas_data'] = $this->FakultasModel->getAll();
        
        $this->load->view('layout/header', $data);
        $this->load->view('fakultas/index', $data);
        $this->load->view('layout/footer');
    }
}