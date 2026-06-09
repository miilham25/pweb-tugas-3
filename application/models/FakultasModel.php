<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakultasModel extends CI_Model {

    private $table = 'fakultas';

    public function getAll()
    {
        return $this->db->order_by('fakultas_name', 'ASC')->get($this->table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['fakultas_id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['fakultas_id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['fakultas_id' => $id]);
    }
}