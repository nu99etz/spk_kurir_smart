<?php

$config = array();

// Config URL
$config['base_url'] = "http://localhost";
$config['root'] = '/home/nu99etz/public_html';
$config['path'] = '/spk_kurir_smart';
$config['assets'] = $config['path'] . '/assets/';
$config['helpers'] = '../helpers/';
$config['models'] = '../models/';
$config['upload'] = '../upload/';
$config['view_upload'] = $config['path'] . '/upload/';
$config['include'] = $config['path'] . '/include/';
$config['vendor'] = '../vendor/';

// Config DB
$config['db_host'] = "localhost";
$config['db_name'] = "spk_karywan_smart";
$config['db_username'] = "root";
$config['db_password'] = "sapi";

// Config Tampilan

// Main Navbar ("dark" = Gelap, "light" = Terang)
$config['main-color'] = "dark";

// Secondary Navbar ("primary" = Biru, "success" = Hijau, "danger" = Merah, "warning" = Kuning, "secondary" = Abu-abu, "dark" = HItam Gelap)
$config['second-color'] = "red";

// Nama Aplikasi
$config['tenants-name'] = "SPK KURIR SMART";

// Config Mengaktifkan Mode Import (true = 'aktif', false = 'tidak aktif')
$config['import_mode'] = false;

// nama pemilik aplikasi
$config['nama_mhs_npm'] = "Rama - NPM";