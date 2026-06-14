<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('auth');
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
        cek_login();
    }

    public function index() {
        $data['title']          = 'Data Pelanggan - PS Rental';
        $data['pelanggan_list'] = $this->Pelanggan_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        $data['title'] = 'Tambah Pelanggan';
        $this->load->view('layouts/header', $data);
        $this->load->view('pelanggan/form', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan() {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric|min_length[10]|max_length[15]');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Tambah Pelanggan';
            $this->load->view('layouts/header', $data);
            $this->load->view('pelanggan/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Pelanggan_model->insert([
                'nama'  => $this->input->post('nama', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan.');
            redirect('pelanggan');
        }
    }

    public function edit($id) {
        $data['title']     = 'Edit Pelanggan';
        $data['pelanggan'] = $this->Pelanggan_model->get_by_id($id);
        if (!$data['pelanggan']) { show_404(); }
        $this->load->view('layouts/header', $data);
        $this->load->view('pelanggan/form', $data);
        $this->load->view('layouts/footer');
    }

    public function update($id) {
        $pelanggan = $this->Pelanggan_model->get_by_id($id);
        if (!$pelanggan) { show_404(); }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric|min_length[10]|max_length[15]');

        if ($this->form_validation->run() === FALSE) {
            $data['title']     = 'Edit Pelanggan';
            $data['pelanggan'] = $pelanggan;
            $this->load->view('layouts/header', $data);
            $this->load->view('pelanggan/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Pelanggan_model->update($id, [
                'nama'  => $this->input->post('nama', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Data pelanggan berhasil diperbarui.');
            redirect('pelanggan');
        }
    }

    public function hapus($id) {
        $pelanggan = $this->Pelanggan_model->get_by_id($id);
        if (!$pelanggan) { show_404(); }
        $this->Pelanggan_model->delete($id);
        $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus.');
        redirect('pelanggan');
    }
}
