<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('barang/Barang_model');
        if ($this->session->userdata('id_user') == "") {
            redirect('admin/auth');
        }
    }

    // List all your items
    public function index()
    {
        if ($this->session->userdata('id_user') == "") {
            redirect('error_page');
        }

        $barang = $this->Barang_model->listing();
        $data = [
            'title'     => 'Manajemen Barang Barang',
            'back'      => 'barang/barang',
            'barang'    => $barang,
            'content'   => 'barang/barang/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function barangData()
    {
        $barang = $this->Barang_model->listing();
        echo json_encode($barang);
    }

    // Add a new item
    public function add()
    {
        if (($this->session->userdata('id_user') == "") || $this->session->userdata('role') != "Admin") {
            redirect('error_page');
        }

        $jenis = $this->Crud_model->listing('tbl_jenis');
        $satuan = $this->Crud_model->listing('tbl_satuan');
        $valid = $this->form_validation;
        $valid->set_rules('nama_barang', 'Nama Barang', 'required|is_unique[tbl_barang.nama_barang]', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Tambah Barang',
                'back'      => 'barang/barang',
                'jenis'     => $jenis,
                'satuan'    => $satuan,
                'content'   => 'barang/barang/add'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'id_barang'     => $i->post('id_barang'),
                'nama_barang'   => $i->post('nama_barang'),
                'id_jenis'     => $i->post('id_jenis'),
                'id_satuan'     => $i->post('id_satuan'),
            ];
            $this->Crud_model->add('tbl_barang', $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('barang/barang');
        }
    }

    //Update one item
    public function update($id_barang)
    {
        if (($this->session->userdata('id_user') == "") || $this->session->userdata('role') != "Admin") {
            redirect('error_page');
        }

        $jenis = $this->Crud_model->listing('tbl_jenis');
        $satuan = $this->Crud_model->listing('tbl_satuan');
        $barang = $this->Crud_model->listingOne('tbl_barang', 'id_barang', $id_barang);
        $valid = $this->form_validation;
        $valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Edit Barang ',
                'back'      => 'barang/barang',
                'barang'    => $barang,
                'satuan'     => $satuan,
                'jenis'     => $jenis,
                'content'   => 'barang/barang/update'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'id_barang'     => $id_barang,
                'nama_barang'   => $i->post('nama_barang'),
                'id_jenis'      => $i->post('id_jenis'),
                'id_satuan'     => $i->post('id_satuan'),
            ];
            $this->Crud_model->edit('tbl_barang', 'id_barang', $id_barang, $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('barang/barang');
        }
    }

    //Delete one item
    public function delete($id_barang)
    {
        if (($this->session->userdata('id_user') == "") || $this->session->userdata('role') != "Admin") {
            redirect('error_page');
        }
        $this->Crud_model->delete('tbl_barang', 'id_barang', $id_barang);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('barang/barang');
    }

    function cari()
    {
        $data['cariberdasarkan'] = $this->input->post('cariberdasarkan');
        $data['yangdicari'] = $this->input->post('yangdicari');

        $data['barang'] = $this->Barang_model->cari($data['cariberdasarkan'], $data['yangdicari'])->result();
        $data['jumlah'] = count($data['barang']);
        $data['content'] = 'barang/barang/index';

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}
