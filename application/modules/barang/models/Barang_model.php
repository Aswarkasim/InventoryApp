<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function listing()
    {
        $this->db->select('tbl_barang.*,
                        tbl_jenis.nama_jenis,
                        tbl_satuan.nama_satuan')
            ->from('tbl_barang')
            ->join('tbl_jenis', 'tbl_jenis.id_jenis = tbl_barang.id_jenis', 'left')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_barang.id_satuan', 'left');
        return $this->db->get()->result();
    }
    public function listingOne($field, $where)
    {
        $this->db->select('tbl_barang.*,
                        tbl_jenis.nama_jenis,
                        tbl_satuan.nama_satuan')
            ->from('tbl_barang')
            ->join('tbl_jenis', 'tbl_jenis.id_jenis = tbl_barang.id_jenis', 'left')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_barang.id_satuan', 'left')
            ->where($field, $where);
        return $this->db->get()->row();
    }

    function cari($berdasarkan, $yangdicari)
    {
        $this->db->select('tbl_barang.*,
                        tbl_jenis.nama_jenis,
                        tbl_satuan.nama_satuan')
            ->from('tbl_barang')
            ->join('tbl_jenis', 'tbl_jenis.id_jenis = tbl_barang.id_jenis', 'left')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_barang.id_satuan', 'left');

        switch ($berdasarkan) {
            case "";
                $this->db->like('id_barang', $yangdicari);
                $this->db->or_like('nama_barang', $yangdicari);
                break;
            default:
                $this->db->like($berdasarkan, $yangdicari);
        }
        return $this->db->get();
    }

    public function listingMinimum($min)
    {
        $query = $this->db->select('tbl_barang.*,
                                    tbl_jenis.nama_jenis,
                                    tbl_satuan.nama_satuan')
            ->from('tbl_barang')
            ->join('tbl_jenis', 'tbl_jenis.id_jenis = tbl_barang.id_jenis', 'left')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_barang.id_satuan', 'left')
            ->where('stok<=', $min)
            ->get();
        return $query->result();
    }
}
