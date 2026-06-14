<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';

// Dashboard
$route['dashboard'] = 'dashboard/index';

// Unit PS
$route['unit_ps'] = 'unit_ps/index';
$route['unit_ps/tambah'] = 'unit_ps/tambah';
$route['unit_ps/simpan'] = 'unit_ps/simpan';
$route['unit_ps/edit/(:num)'] = 'unit_ps/edit/$1';
$route['unit_ps/update/(:num)'] = 'unit_ps/update/$1';
$route['unit_ps/hapus/(:num)'] = 'unit_ps/hapus/$1';

// Pelanggan
$route['pelanggan'] = 'pelanggan/index';
$route['pelanggan/tambah'] = 'pelanggan/tambah';
$route['pelanggan/simpan'] = 'pelanggan/simpan';
$route['pelanggan/edit/(:num)'] = 'pelanggan/edit/$1';
$route['pelanggan/update/(:num)'] = 'pelanggan/update/$1';
$route['pelanggan/hapus/(:num)'] = 'pelanggan/hapus/$1';

// Penyewaan
$route['penyewaan'] = 'penyewaan/index';
$route['penyewaan/tambah'] = 'penyewaan/tambah';
$route['penyewaan/simpan'] = 'penyewaan/simpan';
$route['penyewaan/selesai/(:num)'] = 'penyewaan/selesai/$1';
$route['penyewaan/hapus/(:num)'] = 'penyewaan/hapus/$1';
$route['penyewaan/aktif'] = 'penyewaan/aktif';
