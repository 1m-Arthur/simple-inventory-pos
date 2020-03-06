<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Receipt_model extends CI_Model
{

    public function takeAll()
    {
        return $this->db->select('a.pekerjaan_id, first_name, last_name, lppm_no, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    purchase_id, po_no, harga_satuan, total_harga, tgl_po, tgl_penerimaan')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->where('a.disposisi_id ', '5')
            ->or_where('a.disposisi_id ', '6')
            ->order_by('po_no', 'DESC')
            ->get()
            ->result_array();
    }
    // belom kelar yang takeone
    public function takeOne($penerimaan_id)
    {
        $this->db->select('a.pekerjaan_id, lppm_no, b.first_name, last_name, a.bahan_id, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    tgl_diperlukan, tgl_pengajuan, tgl_approve, tgl_po, f.purchase_id, 
                                    po_no, harga_satuan, total_harga, penerimaan_id, g.user_id,
                                    nama_supplier, tgl_penerimaan')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->join('penerimaan as g', 'a.pekerjaan_id = g.pekerjaan_id')
            ->where('purchase_id', $penerimaan_id);

        return $this->db->get()->row_array();
    }

    public function takePO()
    {
        return $this->db->select('a.pekerjaan_id, first_name, last_name, lppm_no, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    purchase_id, po_no, harga_satuan, total_harga, tgl_po')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->where('a.disposisi_id ', '4')
            // ->or_where('a.disposisi_id ', '5')
            ->order_by('po_no', 'ASC')
            ->get()
            ->result_array();
    }

    public function takePOAll()
    {
        return $this->db->select('a.pekerjaan_id, first_name, last_name, lppm_no, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    purchase_id, po_no, harga_satuan, total_harga, tgl_po')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->where('a.disposisi_id ', '4')
            ->or_where('a.disposisi_id ', '5')
            ->order_by('po_no', 'ASC')
            ->get()
            ->result_array();
    }

    public function create($params)
    {
        $this->db->insert('penerimaan', $params);

        return $this->db->affected_rows();
    }

    public function update($pekerjaan_id, $params)
    {
        $this->db->where('pekerjaan_id', $pekerjaan_id)
            ->update('penerimaan', $params);

        return $this->db->affected_rows();
    }

    public function totalPenerimaan()
    {
        $this->db->select('count(qty) as total')
            ->from('pekerjaan')
            ->where('disposisi_id', '5')
            ->or_where('disposisi_id', '6');

        return $this->db->get()->row_array();
    }

    public function countAllpenerimaan($month)
    {
        $this->db->select('COALESCE(count(*), 0)as permonth')
            ->from('pekerjaan as a')
            ->join('penerimaan as b', 'a.pekerjaan_id = b.pekerjaan_id')
            ->where('DATE_FORMAT(`tgl_penerimaan`,"%Y-%c") = ' . $month)
            ->where('disposisi_id >=', '5')
            ->where_not_in('7', 'disposisi_id')
            ->group_by('DATE_FORMAT(`tgl_penerimaan`,"%Y-%m")');

        return $this->db->get()->row_array();
    }
}
