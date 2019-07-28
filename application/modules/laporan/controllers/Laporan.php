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
        $data = array(
            'title'     => 'Cetak laporan barang',
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
        $masuk = $this->Laporan_model->list_masuk_tgl($awal, $akhir);
        $data = array(
            'title'     => 'Cetak laporan barang',
            'tanggal'   => date('d M Y'),
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
        $keluar = $this->Laporan_model->list_keluar_tgl($awal, $akhir);
        $data = array(
            'title'     => 'Cetak laporan barang',
            'tanggal'   => date('d M Y'),
            'keluar'    => $keluar
        );
        $this->load->view('laporan/keluar_cetak', $data, FALSE);
    }
}
