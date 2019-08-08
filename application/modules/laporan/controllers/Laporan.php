<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf_report');
        $this->load->model('Laporan_model');
    }
    public function barang()
    {


        $barang = $this->Laporan_model->list_barang();
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $data = array(
            'title'     => 'Cetak laporan barang',
            'tanggal'   => date('d M Y'),
            'konfigurasi' => $konfigurasi,
            'barang'    => $barang
        );
        $this->load->view('laporan/barang', $data, FALSE);
    }

    function masuk()
    {
        $data = [
            'content'   => 'laporan/masuk_index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function cetak_masuk()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $masuk = $this->Laporan_model->list_masuk_tgl($awal, $akhir);
        $data = array(
            'title'     => 'Cetak laporan barang',
            'tanggal'   => date('d M Y'),
            'konfigurasi' => $konfigurasi,
            'masuk'    => $masuk
        );
        $this->load->view('laporan/masuk_cetak', $data, FALSE);
    }

    function keluar()
    {
        $data = [
            'content'   => 'laporan/keluar_index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function cetak_keluar()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $keluar = $this->Laporan_model->list_keluar_tgl($awal, $akhir);
        $data = array(
            'title'     => 'Cetak laporan barang',
            'tanggal'   => date('d M Y'),
            'konfigurasi' => $konfigurasi,
            'keluar'    => $keluar
        );
        $this->load->view('laporan/keluar_cetak', $data, FALSE);
    }
}
