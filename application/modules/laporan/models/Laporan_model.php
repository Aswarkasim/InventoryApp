<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    function list_barang()
    {
        $this->db->select('tbl_barang.*,
                        tbl_jenis.nama_jenis,
                        tbl_satuan.nama_satuan')
            ->from('tbl_barang')
            ->join('tbl_jenis', 'tbl_jenis.id_jenis = tbl_barang.id_jenis', 'left')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_barang.id_satuan', 'left');
        return $this->db->get()->result();
    }
    function list_masuk_tgl($awal, $akhir)
    {
        $this->db->select('*')
            ->from('tbl_masuk')
            ->where('tanggal >=', $awal)
            ->where('tanggal <=', $akhir)
            ->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }
    function list_keluar_tgl($awal, $akhir)
    {
        $this->db->select('*')
            ->from('tbl_keluar')
            ->where('tanggal >=', $awal)
            ->where('tanggal <=', $akhir)
            ->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }
}
