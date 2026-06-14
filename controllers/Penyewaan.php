<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewaan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('auth');
        $this->load->model(['Penyewaan_model', 'Unit_ps_model', 'Pelanggan_model']);
        $this->load->library('form_validation');
        cek_login();
    }

    public function index() {
        $data['title']          = 'Data Penyewaan - PS Rental';
        $data['penyewaan_list'] = $this->Penyewaan_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('penyewaan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function aktif() {
        $data['title']          = 'Penyewaan Aktif - PS Rental';
        $data['penyewaan_list'] = $this->Penyewaan_model->get_aktif();
        $this->load->view('layouts/header', $data);
        $this->load->view('penyewaan/aktif', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        $data['title']          = 'Tambah Penyewaan';
        $data['unit_list']      = $this->Unit_ps_model->get_tersedia();
        $data['pelanggan_list'] = $this->Pelanggan_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('penyewaan/form', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan() {
        $this->form_validation->set_rules('id_unit', 'Unit PS', 'required|numeric');
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required|numeric');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('durasi_jam', 'Durasi Jam', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() === FALSE) {
            $data['title']          = 'Tambah Penyewaan';
            $data['unit_list']      = $this->Unit_ps_model->get_tersedia();
            $data['pelanggan_list'] = $this->Pelanggan_model->get_all();
            $this->load->view('layouts/header', $data);
            $this->load->view('penyewaan/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $id_unit    = $this->input->post('id_unit');
            $durasi_jam = $this->input->post('durasi_jam');
            $unit       = $this->Unit_ps_model->get_by_id($id_unit);

            if (!$unit || $unit->status !== 'tersedia') {
                $this->session->set_flashdata('error', 'Unit tidak tersedia.');
                redirect('penyewaan/tambah');
            }

            // Hitung total bayar otomatis
            $total_bayar = $durasi_jam * $unit->tarif_per_jam;

            $this->Penyewaan_model->insert([
                'id_unit'       => $id_unit,
                'id_pelanggan'  => $this->input->post('id_pelanggan'),
                'jam_mulai'     => $this->input->post('jam_mulai'),
                'durasi_jam'    => $durasi_jam,
                'total_bayar'   => $total_bayar,
                'status'        => 'aktif',
            ]);

            // Update status unit menjadi dipakai
            $this->Unit_ps_model->update($id_unit, ['status' => 'dipakai']);

            $this->session->set_flashdata('success', 'Penyewaan berhasil dicatat. Total bayar: Rp ' . number_format($total_bayar, 0, ',', '.'));
            redirect('penyewaan');
        }
    }

    public function selesai($id) {
        $sewa = $this->Penyewaan_model->get_by_id($id);
        if (!$sewa) { show_404(); }

        $this->Penyewaan_model->update($id, ['status' => 'selesai']);
        $this->Unit_ps_model->update($sewa->id_unit, ['status' => 'tersedia']);

        $this->session->set_flashdata('success', 'Penyewaan selesai. Unit PS kembali tersedia.');
        redirect('penyewaan');
    }

    public function hapus($id) {
        $sewa = $this->Penyewaan_model->get_by_id($id);
        if (!$sewa) { show_404(); }

        if ($sewa->status === 'aktif') {
            $this->Unit_ps_model->update($sewa->id_unit, ['status' => 'tersedia']);
        }

        $this->Penyewaan_model->delete($id);
        $this->session->set_flashdata('success', 'Data penyewaan berhasil dihapus.');
        redirect('penyewaan');
    }
}
