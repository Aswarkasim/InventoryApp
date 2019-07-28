<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function listing()
    {
        $this->db->select('tbl_masuk.*,
                        tbl_barang.nama_barang')
            ->from('tbl_masuk')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_masuk.id_barang', 'left')
            ->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }
    public function listingKeluar()
    {
        $this->db->select('tbl_keluar.*,
                        tbl_barang.nama_barang')
            ->from('tbl_keluar')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_keluar.id_barang', 'left')
            ->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }

    function addStok($stok_total, $id_barang)
    {
        $this->db->query("UPDATE tbl_barang SET `stok` = '$stok_total' WHERE `id_barang` = '$id_barang'");
    }

    public function listingRange($awal, $akhir)
    {
        $this->db->select('tbl_masuk.*,
                        tbl_barang.nama_barang')
            ->from('tbl_masuk')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_masuk.id_barang', 'left')
            ->where('tanggal >= ', $awal)
            //->where('tanggal <= ', $akhir)
            ->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }
    // public function listingRange($awal, $akhir)
    // {
    //     $this->db->query("select * from 'tbl_barang' where 'date_created' between '$awal' and '$akhir'");
    //     return $this->db->get()->result();
    // }
}
