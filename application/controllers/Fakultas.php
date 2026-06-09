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

    public function ubah($id)
    {
        $record = $this->FakultasModel->getById($id);
        if (!$record) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Gagal Memuat',
                'text'  => 'Target data fakultas tidak ditemukan.'
            ]);
            redirect('fakultas');
        }

        $this->form_validation->set_rules(
            'fakultas_name', 
            'Nama Fakultas', 
            'required|min_length[3]|max_length[100]|callback_check_nama_fakultas_unik['.$id.']',
            [
                'required'   => 'Kolom {field} tidak boleh dikosongkan.',
                'min_length' => 'Nama Fakultas minimal diisi dengan 3 karakter.',
                'max_length' => 'Nama Fakultas maksimal diisi dengan 100 karakter.'
            ]
        );

        if ($this->form_validation->run() === TRUE) {
            $payload = [
                'fakultas_name' => $this->input->post('fakultas_name', true)
            ];

            $this->FakultasModel->update($id, $payload);
            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Update Sukses',
                'text'  => 'Perubahan data fakultas telah diperbarui.'
            ]);
            redirect('fakultas');
        }

        $data['title'] = "Form Perubahan Fakultas";
        $data['form_action'] = base_url('fakultas/ubah/' . $id);
        $data['submit_label'] = 'Update';
        $data['form_value'] = $record;

        $this->load->view('layout/header', $data);
        $this->load->view('fakultas/form', $data);
        $this->load->view('layout/footer');
    }

    public function check_nama_fakultas_unik($str, $id)
    {
        $this->db->where('fakultas_name', $str);
        $this->db->where('fakultas_id !=', $id);
        $query = $this->db->get('fakultas');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_nama_fakultas_unik', '{field} sudah digunakan oleh fakultas lain, silakan gunakan nama berbeda.');
            return FALSE;
        }
        
        return TRUE;
    }
}