<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productbill_model extends CI_Model
{

    public function takeOne($kode_permintaan)
    {
        $this->db->select('first_name, last_name, created_date, nama_penerima, 
                            keterangan, a.kode_bon_permintaan, qty_permintaan, a.purchase_id, d.po_no,
                            e.lppm_no, e.tgl_diperlukan, harga_satuan, total_harga, nama_supplier,
                            nama_bahan, tgl_permintaan, nama_satuan,tgl_pengajuan, tgl_approve,
                            tgl_po, tgl_penerimaan,disposisi_id, a.user_id, approve, c.pekerjaan_id, e.bahan_id, e.qty')
            ->from('permintaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('penerimaan as c', 'a.penerimaan_id = c.penerimaan_id')
            ->join('purchase_order as d', 'a.purchase_id = d.purchase_id')
            ->join('pekerjaan as e', 'c.pekerjaan_id = e.pekerjaan_id')
            ->join('tbl_bahan_baku as f', 'e.bahan_id = f.bahan_id')
            ->join('tbl_satuan as g', 'e.satuan_id = g.satuan_id')
            ->join('pengeluaran as h', 'a.kode_bon_permintaan = h.kode_bon_permintaan')
            ->where('a.kode_bon_permintaan', $kode_permintaan)
            ->order_by('a.kode_bon_permintaan', 'DESC');

        return $this->db->get()->row_array();
    }

    public function takeAll($params)
    {
        $this->db->select('first_name, last_name, created_date, 
                            nama_penerima, keterangan, a.kode_bon_permintaan, tgl_permintaan, approve')
            ->from('permintaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('penerimaan as c', 'a.penerimaan_id = c.penerimaan_id')
            ->join('purchase_order as d', 'a.purchase_id = d.purchase_id')
            ->join('pekerjaan as e', 'c.pekerjaan_id = e.pekerjaan_id')
            ->join('pengeluaran as f', 'a.kode_bon_permintaan = f.kode_bon_permintaan')
            ->join('tbl_bahan_baku as g', 'e.bahan_id = g.bahan_id')
            ->order_by('kode_bon_permintaan', 'DESC');

        if (!empty($params['lppm_no'])) {
            $this->db->where('e.lppm_no ', $params['lppm_no']);
        }

        if (!empty($params['po_no'])) {
            $this->db->or_where('d.po_no ', $params['po_no']);
        }

        if (!empty($params['nama_bahan'])) {
            $this->db->or_where('g.nama_bahan ', $params['nama_bahan']);
        }

        return $this->db->get()->result_array();
    }

    public function create($params)
    {
        $this->db->insert('pengeluaran', $params);

        return $this->db->affected_rows();
    }

    public function update($kode_permintaan, $params)
    {
        $this->db->where('kode_bon_permintaan', $kode_permintaan)
            ->update('pengeluaran', $params);

        return $this->db->affected_rows();
    }

    public function totalPengeluaran()
    {
        $this->db->select('count(qty_permintaan) as total')
            ->from('pengeluaran as a')
            ->join('permintaan as b', 'a.kode_bon_permintaan = b.kode_bon_permintaan')
            ->where('a.approve', '1');
        // ->or_where('disposisi_id', '6');

        return $this->db->get()->row_array();
    }

    public function countAllpengeluaran($month)
    {
        $this->db->select('count(*) as permonth')
            ->from('pengeluaran')
            ->where('DATE_FORMAT(`tgl_pengeluaran`,"%Y-%c") ', $month)
            ->where_not_in(null, 'tgl_pengeluaran')
            ->group_by('DATE_FORMAT(`tgl_pengeluaran`,"%Y-%m")');

        return $this->db->get()->row_array();
    }
}
