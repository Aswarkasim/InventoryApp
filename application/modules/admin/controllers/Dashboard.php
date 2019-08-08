<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('id_user') == "") {
            redirect('admin/auth');
        }
    }


    public function index()
    {
        $this->load->model('barang/Barang_model');

        $id_user = $this->session->userdata('id_user');
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
        $barang = $this->Crud_model->listing('tbl_barang');
        $masuk = $this->Crud_model->listing('tbl_masuk');
        $keluar = $this->Crud_model->listing('tbl_keluar');
        $userAll = $this->Crud_model->listing('tbl_user');
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $min_barang = $this->Barang_model->listingMinimum($konfigurasi->stok_min);
        $data = [
            'title'     => 'Dashboard',
            'user'      => $user,
            'barang'      => $barang,
            'masuk'      => $masuk,
            'keluar'      => $keluar,
            'min_barang'      => $min_barang,
            'userAll'      => $userAll,
            'konfigurasi'      => $konfigurasi,
            'content'   => 'admin/dashboard/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function edit_min()
    {
        $i = $this->input;
        $data = [
            'stok_min'   => $i->post('stok_min'),
        ];
        $this->Crud_model->edit('tbl_konfigurasi', 'id_konfigurasi', '1', $data);
        $this->session->set_flashdata('msg', 'Stok minimum diubah');
        redirect('admin/dashboard');
    }
}

/* End of file Dashboard.php */
