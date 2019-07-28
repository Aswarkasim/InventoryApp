<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

    }

    // List all your items
    public function index()
    {
        $data = [
            'back'      => 'transaksi/keluar',
            'content'   => 'transaksi/masuk/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $data = [
            'back'      => 'transaksi/keluar',
            'content'   => 'transaksi/masuk/add'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Update one item
    public function update()
    {
        $data = [
            'back'      => 'transaksi/keluar',
            'content'   => 'transaksi/masuk/update'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Delete one item
    public function delete()
    { }
}
