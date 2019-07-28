<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Masuk extends CI_Controller
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
        $masuk = $this->Crud_model->listing('tbl_masuk', 'tanggal', 'DESC');
        $data = [
            'title'     => 'Manajemen Barang Masuk',
            'back'      => 'masuk/masuk',
            'masuk'    => $masuk,
            'barang'    => $barang,
            'content'   => 'transaksi/masuk/index'
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
            //     'title'     => 'Tambah Barang Masuk',
            //     'back'      => 'masuk/masuk',
            //     'jenis'     => $jenis,
            //     'satuan'    => $satuan,
            //     'barang'    => $barang,
            //     'content'   => 'transaksi/masuk/index'
            // ];
            // $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $id_barang = $i->post('id_barang');
            $bmasuk = $this->BM->listingOne('id_barang', $id_barang);
            $tanggal = $i->post('tanggal');
            if ($tanggal == "") {
                $tanggal = date('y-m-d h-i-s');
            }
            $data = [
                'id_masuk'      => 'TM' . date('Ymd') . random_string('numeric', '5'),
                'tanggal'       => $tanggal,
                'id_barang'     => $i->post('id_barang'),
                'nama_barang'     => $bmasuk->nama_barang,
                'nama_jenis'     => $bmasuk->nama_jenis,
                'nama_satuan'     => $bmasuk->nama_satuan,
                'jumlah'        => $i->post('jumlah')
            ];
            $stok_masuk     = $i->post('jumlah');
            $stok_barang = $this->Crud_model->listingOne('tbl_barang', 'id_barang', $id_barang);
            $stok_sementara = $stok_barang->stok;
            $stok_total = $stok_masuk + $stok_sementara;

            $this->Crud_model->add('tbl_masuk', $data);
            $this->Transaksi_model->addStok($stok_total, $id_barang);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('transaksi/masuk');
        }
    }


    //Delete one item
    public function delete($id_masuk)
    {

        $this->Crud_model->delete('tbl_masuk', 'id_masuk', $id_masuk);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('transaksi/masuk');
    }

    function cancel($id_masuk)
    {
        $masuk = $this->Crud_model->listingOne('tbl_masuk', 'id_masuk', $id_masuk);
        $id_barang = $masuk->id_barang;
        $barang = $this->Crud_model->listingOne('tbl_barang', 'id_barang', $id_barang);
        $stok_masuk = $masuk->jumlah;
        $stok_barang = $barang->stok;
        $stok = $stok_barang - $stok_masuk;

        $this->Transaksi_model->addStok($stok, $id_barang);

        $this->Crud_model->delete('tbl_masuk', 'id_masuk', $id_masuk);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('transaksi/masuk');
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

    // function LaporanContent()
    // {
    //     $awal = '2019-06-29';
    //     $akhir = '2019-06-29 08:08:00';
    //     $data['masuk'] = $this->Transaksi_model->listingRange($awal, $akhir);
    //     $this->load->view('transaksi/masuk/laporan', $data);
    // }

    // function laporan()
    // {
    //     $html_content = '<h3>
    //     convert html to pdf
    // </h3><br>';
    //     $html_content .= $this->LaporanContent();
    //     $this->pdf->loadHtml($html_content);
    //     $this->pdf->render();
    //     $this->pdf->stream("Tranaksi Masuk", array("Attachement" => true));
    // }
}
