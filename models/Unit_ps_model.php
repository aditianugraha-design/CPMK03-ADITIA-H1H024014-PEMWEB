<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_ps_model extends CI_Model {

    protected $table = 'unit_ps';

    public function get_all() {
        return $this->db->order_by('nomor_unit', 'ASC')->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_tersedia() {
        return $this->db->get_where($this->table, ['status' => 'tersedia'])->result();
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function count_by_status($status) {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
