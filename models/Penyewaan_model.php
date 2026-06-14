<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewaan_model extends CI_Model {

    protected $table = 'penyewaan';

    public function get_all() {
        $this->db->select('penyewaan.*, unit_ps.nomor_unit, unit_ps.tipe, pelanggan.nama AS nama_pelanggan, pelanggan.no_hp');
        $this->db->from($this->table);
        $this->db->join('unit_ps', 'unit_ps.id = penyewaan.id_unit');
        $this->db->join('pelanggan', 'pelanggan.id = penyewaan.id_pelanggan');
        $this->db->order_by('penyewaan.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_aktif() {
        $this->db->select('penyewaan.*, unit_ps.nomor_unit, unit_ps.tipe, unit_ps.tarif_per_jam, pelanggan.nama AS nama_pelanggan, pelanggan.no_hp');
        $this->db->from($this->table);
        $this->db->join('unit_ps', 'unit_ps.id = penyewaan.id_unit');
        $this->db->join('pelanggan', 'pelanggan.id = penyewaan.id_pelanggan');
        $this->db->where('penyewaan.status', 'aktif');
        $this->db->order_by('penyewaan.jam_mulai', 'ASC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('penyewaan.*, unit_ps.nomor_unit, unit_ps.tipe, unit_ps.tarif_per_jam, pelanggan.nama AS nama_pelanggan');
        $this->db->from($this->table);
        $this->db->join('unit_ps', 'unit_ps.id = penyewaan.id_unit');
        $this->db->join('pelanggan', 'pelanggan.id = penyewaan.id_pelanggan');
        $this->db->where('penyewaan.id', $id);
        return $this->db->get()->row();
    }

    public function count_by_status($status) {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function count_hari_ini() {
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->count_all_results($this->table);
    }

    public function pendapatan_hari_ini() {
        $this->db->select_sum('total_bayar');
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $query = $this->db->get($this->table)->row();
        return $query->total_bayar ?? 0;
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
