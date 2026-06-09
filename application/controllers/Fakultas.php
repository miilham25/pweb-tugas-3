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

    public function tambah()
    {
        $this->form_validation->set_rules('fakultas_id', 'ID Fakultas', 'required|numeric|is_unique[fakultas.fakultas_id]', [
            'required'  => 'Kolom {field} wajib diisi dan tidak boleh kosong.',
            'numeric'   => 'Kolom {field} harus berupa angka.',
            'is_unique' => 'ID Fakultas tersebut sudah terdaftar di sistem.'
        ]);
        
        $this->form_validation->set_rules('fakultas_name', 'Nama Fakultas', 'required|min_length[3]|max_length[100]|is_unique[fakultas.fakultas_name]', [
            'required'   => 'Kolom {field} wajib diisi.',
            'min_length' => 'Nama Fakultas terlalu pendek, minimal 3 karakter.',
            'max_length' => 'Nama Fakultas terlalu panjang, maksimal 100 karakter.',
            'is_unique'  => 'Nama Fakultas tersebut sudah terdaftar di database.'
        ]);

        if ($this->form_validation->run() === TRUE) {
            $payload = [
                'fakultas_id'   => $this->input->post('fakultas_id', true),
                'fakultas_name' => $this->input->post('fakultas_name', true)
            ];
            
            $this->FakultasModel->insert($payload);
            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Simpan Berhasil',
                'text'  => 'Data fakultas baru telah disimpan ke sistem.'
            ]);
            redirect('fakultas');
        }

        $data['title'] = "Form Data Fakultas";
        $data['form_action'] = base_url('fakultas/tambah');
        $data['submit_label'] = 'Simpan';
        $data['form_value'] = null;

        $this->load->view('layout/header', $data);
        $this->load->view('fakultas/form', $data);
        $this->load->view('layout/footer');
    }
} 