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

    public function tambah()
    {
        $this->form_validation->set_rules('prodi_id', 'ID Prodi', 'required|numeric|is_unique[prodi.prodi_id]', [
            'required'  => 'Kolom {field} wajib diisi.',
            'numeric'   => 'Kolom {field} harus diisi pakai angka.',
            'is_unique' => 'ID Prodi tersebut sudah terdaftar di database.'
        ]);

        $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required', [
            'required'  => 'Kamu harus memilih {field} penaung.'
        ]);

        $this->form_validation->set_rules('prodi_name', 'Nama Prodi', 'required|min_length[3]|max_length[100]|is_unique[prodi.prodi_name]', [
            'required'   => 'Kolom {field} tidak boleh kosong.',
            'min_length' => 'Nama Prodi minimal 3 karakter.',
            'max_length' => 'Nama Prodi maksimal 100 karakter.',
            'is_unique'  => 'Nama Prodi tersebut sudah ada sebelumnya.'
        ]);

        $this->form_validation->set_rules('prodi_strata', 'Strata', 'required', [
            'required'  => 'Pilih salah satu jenjang {field} pendidikan.'
        ]);

        if ($this->form_validation->run() === TRUE) {
            $payload = [
                'prodi_id'     => $this->input->post('prodi_id', true),
                'fakultas_id'  => $this->input->post('fakultas_id', true),
                'prodi_name'   => $this->input->post('prodi_name', true),
                'prodi_strata' => $this->input->post('prodi_strata', true)
            ];

            $this->ProdiModel->insert($payload);
            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil Disimpan',
                'text'  => 'Data program studi baru telah ditambahkan ke sistem.'
            ]);
            redirect('prodi');
        }

        $data['title'] = "Registrasi Prodi Baru";
        $data['form_action'] = base_url('prodi/tambah');
        $data['submit_label'] = 'Simpan';
        $data['fakultas_options'] = $this->FakultasModel->getAll();
        $data['form_value'] = null;

        $this->load->view('layout/header', $data);
        $this->load->view('prodi/form', $data);
        $this->load->view('layout/footer');
    }
}