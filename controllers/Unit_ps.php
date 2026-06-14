<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_ps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('auth');
        $this->load->model('Unit_ps_model');
        $this->load->library('form_validation');
        cek_login();
    }

    public function index() {
        $data['title']    = 'Data Unit PS - PS Rental';
        $data['unit_list'] = $this->Unit_ps_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('unit_ps/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        $data['title'] = 'Tambah Unit PS';
        $this->load->view('layouts/header', $data);
        $this->load->view('unit_ps/form', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan() {
        $this->form_validation->set_rules('nomor_unit', 'Nomor Unit', 'required|trim|is_unique[unit_ps.nomor_unit]');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|trim');
        $this->form_validation->set_rules('tarif_per_jam', 'Tarif Per Jam', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[tersedia,dipakai]');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Tambah Unit PS';
            $this->load->view('layouts/header', $data);
            $this->load->view('unit_ps/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Unit_ps_model->insert([
                'nomor_unit'   => $this->input->post('nomor_unit', TRUE),
                'tipe'         => $this->input->post('tipe', TRUE),
                'tarif_per_jam'=> $this->input->post('tarif_per_jam'),
                'status'       => $this->input->post('status'),
            ]);
            $this->session->set_flashdata('success', 'Unit PS berhasil ditambahkan.');
            redirect('unit_ps');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Unit PS';
        $data['unit']  = $this->Unit_ps_model->get_by_id($id);
        if (!$data['unit']) { show_404(); }
        $this->load->view('layouts/header', $data);
        $this->load->view('unit_ps/form', $data);
        $this->load->view('layouts/footer');
    }

    public function update($id) {
        $unit = $this->Unit_ps_model->get_by_id($id);
        if (!$unit) { show_404(); }

        $nomor_rule = ($unit->nomor_unit === $this->input->post('nomor_unit', TRUE))
            ? 'required|trim'
            : 'required|trim|is_unique[unit_ps.nomor_unit]';

        $this->form_validation->set_rules('nomor_unit', 'Nomor Unit', $nomor_rule);
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|trim');
        $this->form_validation->set_rules('tarif_per_jam', 'Tarif Per Jam', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[tersedia,dipakai]');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Edit Unit PS';
            $data['unit']  = $unit;
            $this->load->view('layouts/header', $data);
            $this->load->view('unit_ps/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Unit_ps_model->update($id, [
                'nomor_unit'   => $this->input->post('nomor_unit', TRUE),
                'tipe'         => $this->input->post('tipe', TRUE),
                'tarif_per_jam'=> $this->input->post('tarif_per_jam'),
                'status'       => $this->input->post('status'),
            ]);
            $this->session->set_flashdata('success', 'Unit PS berhasil diperbarui.');
            redirect('unit_ps');
        }
    }

    public function hapus($id) {
        $unit = $this->Unit_ps_model->get_by_id($id);
        if (!$unit) { show_404(); }
        if ($unit->status === 'dipakai') {
            $this->session->set_flashdata('error', 'Unit yang sedang dipakai tidak bisa dihapus.');
            redirect('unit_ps');
        }
        $this->Unit_ps_model->delete($id);
        $this->session->set_flashdata('success', 'Unit PS berhasil dihapus.');
        redirect('unit_ps');
    }
}
