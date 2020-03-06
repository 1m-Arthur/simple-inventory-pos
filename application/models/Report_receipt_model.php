<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_receipt_model extends CI_Model
{

    public function take($params)
    {
        $this->db->select('first_name, last_name, lppm_no, nama_bahan, 
                            qty, nama_satuan, created_date,
                            po_no, harga_satuan, total_harga, tgl_penerimaan, nama_supplier')
            ->from('pekerjaan as a')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->join('penerimaan as g', 'a.pekerjaan_id = g.pekerjaan_id')
            ->join('users as b', 'g.user_id = b.user_id')
            ->where('a.disposisi_id = 5')
            ->or_where('a.disposisi_id = 6');

        if (isset($params['start_date'])) {
            $this->db->where('a.tgl_penerimaan >=', $params['start_date'] . " 00:00:00");
        }

        if (isset($params['end_date'])) {
            $this->db->where('a.tgl_penerimaan <=', $params['end_date'] . " 23:59:59");
        }

        if (isset($params['bahan'])) {
            $this->db->where('a.bahan_id', $params['bahan']);
        }

        return $this->db->get()->result_array();
    }
}
