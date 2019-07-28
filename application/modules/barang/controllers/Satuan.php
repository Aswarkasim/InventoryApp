<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
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
        $satuan = $this->Crud_model->listing('tbl_satuan');
        $data = [
            'back'      => 'barang/satuan',
            'satuan'    => $satuan,
            'content'   => 'barang/satuan/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama_satuan', 'Nama Satuan', 'required|is_unique[tbl_satuan.nama_satuan]', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Tambah Satuan',
                'back'      => 'barang/satuan',
                'content'   => 'barang/satuan/add'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_satuan'   => $i->post('nama_satuan')
            ];
            $this->Crud_model->add('tbl_satuan', $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('barang/satuan');
        }
    }

    //Update one item
    public function update($id_satuan)
    {
        $satuan = $this->Crud_model->listingOne('tbl_satuan', 'id_satuan', $id_satuan);
        $valid = $this->form_validation;
        $valid->set_rules('nama_satuan', 'Nama Satuan', 'required', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Edit Satuan ',
                'back'      => 'barang/satuan',
                'satuan'    => $satuan,
                'content'   => 'barang/satuan/update'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_satuan'   => $i->post('nama_satuan')
            ];
            $this->Crud_model->edit('tbl_satuan', 'id_satuan', $id_satuan, $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('barang/satuan');
        }
    }

    //Delete one item
    public function delete($id_satuan)
    {
        $this->Crud_model->delete('tbl_satuan', 'id_satuan', $id_satuan);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('barang/satuan');
    }
}
