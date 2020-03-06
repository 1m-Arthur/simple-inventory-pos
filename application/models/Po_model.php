<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Po_model extends CI_Model
{

    public function takeAll()
    {
        return $this->db->select('a.pekerjaan_id, lppm_no, first_name, last_name, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    purchase_id, po_no, harga_satuan, total_harga, tgl_po')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            // ->where('a.disposisi_id ', '3')
            ->where('a.disposisi_id ', '4')
            ->or_where('a.disposisi_id ', '5')
            ->order_by('po_no', 'DESC')
            ->get()
            ->result_array();
    }

    public function takeOne($purchaseid)
    {
        $this->db->select('a.pekerjaan_id, lppm_no, first_name, last_name, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    tgl_diperlukan, tgl_pengajuan, tgl_approve, tgl_po, purchase_id, 
                                    po_no, harga_satuan, total_harga, tgl_po, tgl_penerimaan, nama_supplier')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->where('purchase_id', $purchaseid);
        // ->where('a.disposisi_id ', '3')
        // ->or_where('a.disposisi_id ', '4')
        // ->or_where('a.disposisi_id ', '5');

        return $this->db->get()->row_array();
    }

    public function create($params)
    {
        $this->db->insert('purchase_order', $params);

        return $this->db->affected_rows();
    }

    public function update($pekerjaan_id, $params)
    {
        $this->db->where('pekerjaan_id', $pekerjaan_id)
            ->update('purchase_order', $params);

        return $this->db->affected_rows();
    }

    public function takeNumber($date)
    {
        $this->db->select('COUNT(tgl_po) as serial')
            ->from('pekerjaan as a')
            ->join('purchase_order as b', 'a.pekerjaan_id = b.pekerjaan_id')
            ->select('(SELECT `po_no` FROM `pekerjaan` as `a` JOIN `purchase_order` as `b` ON `a`.`pekerjaan_id` = `b`.`pekerjaan_id` where DATE_FORMAT(tgl_po,"%Y-%m-%d") = "' . $date . '" ORDER BY po_no DESC LIMIT 1) as po_no')
            // ->where('DATE_FORMAT(tgl_po,"%Y-%m-%d")', $date)
            ->where('DATE_FORMAT(tgl_po,"%Y-%m-%d") =', $date)
            ->order_by('po_no', 'DESC');
        return $this->db->get()->row_array();
    }
}
