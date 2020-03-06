<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_product_model extends CI_Model
{

    public function take($params)
    {
        $this->db->select('first_name, last_name, nama_penerima, 
                        keterangan, a.kode_bon_permintaan, qty_permintaan,
                        e.tgl_diperlukan, harga_satuan, total_harga,
                        nama_bahan, tgl_permintaan, nama_satuan, 
                        approve')
            ->from('permintaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('penerimaan as c', 'a.penerimaan_id = c.penerimaan_id')
            ->join('purchase_order as d', 'a.purchase_id = d.purchase_id')
            ->join('pekerjaan as e', 'c.pekerjaan_id = e.pekerjaan_id')
            ->join('tbl_bahan_baku as f', 'e.bahan_id = f.bahan_id')
            ->join('tbl_satuan as g', 'e.satuan_id = g.satuan_id')
            ->join('pengeluaran as h', 'a.kode_bon_permintaan = h.kode_bon_permintaan')
            ->where('h.approve = 1')
            ->where('e.disposisi_id = 5')
            ->or_where('e.disposisi_id = 6');

        if (isset($params['start_date'])) {
            $this->db->where('a.tgl_permintaan >=', $params['start_date'] . " 00:00:00");
        }

        if (isset($params['end_date'])) {
            $this->db->where('a.tgl_permintaan <=', $params['end_date'] . " 23:59:59");
        }

        if (isset($params['bahan'])) {
            $this->db->where('e.bahan_id', $params['bahan']);
        }

        return $this->db->get()->result_array();
    }
}
