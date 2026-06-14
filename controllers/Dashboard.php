<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('auth');
        $this->load->model(['Unit_ps_model', 'Pelanggan_model', 'Penyewaan_model']);
        cek_login();
    }

    public function index() {
        $data['title']             = 'Dashboard - PS Rental';
        $data['total_unit']        = $this->Unit_ps_model->count_all();
        $data['unit_tersedia']     = $this->Unit_ps_model->count_by_status('tersedia');
        $data['unit_dipakai']      = $this->Unit_ps_model->count_by_status('dipakai');
        $data['total_pelanggan']   = $this->Pelanggan_model->count_all();
        $data['sewa_aktif']        = $this->Penyewaan_model->count_by_status('aktif');
        $data['sewa_hari_ini']     = $this->Penyewaan_model->count_hari_ini();
        $data['pendapatan_hari_ini'] = $this->Penyewaan_model->pendapatan_hari_ini();
        $data['list_aktif']        = $this->Penyewaan_model->get_aktif();

        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layouts/footer');
    }
}
