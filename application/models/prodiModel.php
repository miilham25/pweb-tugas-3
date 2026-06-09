<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdiModel extends CI_Model {

    private $table = 'prodi';

    public function getAll()
    {
        return $this->db->select('p.*, f.fakultas_name')
                        ->from($this->table . ' p')
                        ->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'inner')
                        ->order_by('p.prodi_id', 'ASC')
                        ->get()
                        ->result_array();
    }

    public function getById($id)
    {
        return $this->db->where('prodi_id', $id)->get($this->table)->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('prodi_id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('prodi_id', $id)->delete($this->table);
    }
}