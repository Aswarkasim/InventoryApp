<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        if (($this->session->userdata('id_user') == "") || $this->session->userdata('role') != "Admin") {
            redirect('error_page');
        }
    }

    // List all your items
    public function index()
    {
        $jenis = $this->Crud_model->listing('tbl_jenis');
        $data = [
            'title'     => 'Manajemen Jenis Barang',
            'back'      => 'barang/jenis',
            'jenis'    => $jenis,
            'content'   => 'barang/jenis/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama_jenis', 'Nama Jenis', 'required|is_unique[tbl_jenis.nama_jenis]', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Tambah Jenis',
                'back'      => 'barang/jenis',
                'content'   => 'barang/jenis/add'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_jenis'   => $i->post('nama_jenis')
            ];
            $this->Crud_model->add('tbl_jenis', $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('barang/jenis');
        }
    }

    //Update one item
    public function update($id_jenis)
    {
        $jenis = $this->Crud_model->listingOne('tbl_jenis', 'id_jenis', $id_jenis);
        $valid = $this->form_validation;
        $valid->set_rules('nama_jenis', 'Nama Jenis', 'required', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Edit Jenis ',
                'back'      => 'barang/jenis',
                'jenis'    => $jenis,
                'content'   => 'barang/jenis/update'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_jenis'   => $i->post('nama_jenis')
            ];
            $this->Crud_model->edit('tbl_jenis', 'id_jenis', $id_jenis, $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('barang/jenis');
        }
    }

    //Delete one item
    public function delete($id_jenis)
    {
        $this->Crud_model->delete('tbl_jenis', 'id_jenis', $id_jenis);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('barang/jenis');
    }
}
