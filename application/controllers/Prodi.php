<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->load->model(['ProdiModel', 'FakultasModel']);
    }

    public function index()
    {
        $data['title'] = "Manajemen Program Studi";
        $data['prodi_data'] = $this->ProdiModel->getAll();

        $this->load->view('layout/header', $data);
        $this->load->view('prodi/index', $data);
        $this->load->view('layout/footer');
    }
}