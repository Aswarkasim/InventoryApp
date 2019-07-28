<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('transaksi/Transaksi_model');
        $this->load->model('barang/Barang_model', 'BM');
        if (($this->session->userdata('id_user') == "") || $this->session->userdata('role') != "Admin") {
            redirect('error_page');
        }
    }

    // List all your items
    public function index()
    {
        $barang = $this->Crud_model->listing('tbl_barang');
        $keluar = $this->Crud_model->listing('tbl_keluar', 'tanggal', 'DESC');
        $data = [
            'title'     => 'Manajemen Barang Keluar',
            'back'      => 'keluar/keluar',
            'keluar'    => $keluar,
            'barang'    => $barang,
            'content'   => 'transaksi/keluar/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function add()
    {
        $barang = $this->Crud_model->listing('tbl_barang');
        $jenis = $this->Crud_model->listing('tbl_jenis');
        $satuan = $this->Crud_model->listing('tbl_satuan');
        $valid = $this->form_validation;
        $valid->set_rules('jumlah', 'Jumlah Stok', 'required', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s telah ada'));
        $abcd = $this->input->post('id_barang');
        $valid = $this->form_validation->set_rules('id_barang', 'Barang', 'required|callback_select_validate');

        if ($valid->run() === FALSE) {
            $this->index();
            // $data = [
            //     'title'     => 'Tambah Barang Keluar',
            //     'back'      => 'keluar/keluar',
            //     'jenis'     => $jenis,
            //     'satuan'    => $satuan,
            //     'barang'    => $barang,
            //     'content'   => 'transaksi/keluar/index'
            // ];
            // $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $id_barang = $i->post('id_barang');
            $bkeluar = $this->BM->listingOne('id_barang', $id_barang);
            $tanggal = $i->post('tanggal');
            if ($tanggal == "") {
                $tanggal = date('y-m-d h-i-s');
            }
            $data = [
                'id_keluar'      => 'TK' . date('Ymd') . random_string('numeric', '5'),
                'tanggal'       => $tanggal,
                'id_barang'     => $i->post('id_barang'),
                'nama_barang'     => $bkeluar->nama_barang,
                'nama_jenis'     => $bkeluar->nama_jenis,
                'nama_satuan'     => $bkeluar->nama_satuan,
                'jumlah'        => $i->post('jumlah')
            ];
            $stok_keluar     = $i->post('jumlah');
            $stok_barang = $this->Crud_model->listingOne('tbl_barang', 'id_barang', $id_barang);
            $stok_sementara = $stok_barang->stok;
            $stok_total =  $stok_sementara - $stok_keluar;

            $this->Crud_model->add('tbl_keluar', $data);
            $this->Transaksi_model->addStok($stok_total, $id_barang);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('transaksi/keluar');
        }
    }


    //Delete one item
    public function delete($id_keluar)
    {

        $this->Crud_model->delete('tbl_keluar', 'id_keluar', $id_keluar);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('transaksi/keluar');
    }

    function cancel($id_keluar)
    {
        $keluar = $this->Crud_model->listingOne('tbl_keluar', 'id_keluar', $id_keluar);
        $id_barang = $keluar->id_barang;
        $barang = $this->Crud_model->listingOne('tbl_barang', 'id_barang', $id_barang);
        $stok_keluar = $keluar->jumlah;
        $stok_barang = $barang->stok;
        $stok = $stok_barang + $stok_keluar;

        $this->Transaksi_model->addStok($stok, $id_barang);

        $this->Crud_model->delete('tbl_keluar', 'id_keluar', $id_keluar);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('transaksi/keluar');
    }

    function loadStok()
    {
        $id_barang = $_GET['id_barang'];
        $this->Crud_model->listingOne('tbl_barang', 'id_barang', $id_barang);
    }

    // Below function is called for validating select option field.
    function select_validate($abcd)
    {
        // 'none' is the first option that is default "-------Choose City-------"
        if ($abcd == "none") {
            $this->form_validation->set_message('select_validate', 'Anda belum memilih barang');
            return false;
        } else {
            // User picked something.
            return true;
        }
    }
}
