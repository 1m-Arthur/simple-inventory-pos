<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stock_model extends CI_Model
{

    public function take($params)
    {
        $this->db->select('qty_awal as awal, COALESCE(sum(qty_terima), 0) as terima, 
                            COALESCE(sum(qty_pengeluaran), 0) as pengeluaran, 
                            stock_akhir as akhir, nama_bahan, created_date')
            ->from('stock as a')
            ->join('tbl_bahan_baku as b', 'a.bahan_id = b.bahan_id')
            ->order_by('a.bahan_id', 'ASC')
            // ->order_by('created_date', 'DESC')
            ->group_by('a.bahan_id')
            ->group_by('a.created_date');

        if (isset($params['start_date'])) {
            $this->db->where('a.created_date >=', $params['start_date'] . " 00:00:00");
        }

        if (isset($params['end_date'])) {
            $this->db->where('a.created_date <=', $params['end_date'] . " 23:59:59");
        }

        if (isset($params['bahan'])) {
            $this->db->where('a.bahan_id', $params['bahan']);
        }

        return $this->db->get()->result_array();
    }

    public function takeOne($pekerjaan_id, $bahan_id, $created_date)
    {
        // $this->db->select('qty_awal as awal, COALESCE(sum(qty_terima), 0) as terima, 
        //                     COALESCE(sum(qty_pengeluaran), 0) as pengeluaran, 
        //                     (qty_awal + COALESCE(sum(qty_terima))) - COALESCE(sum(qty_pengeluaran), 0) as akhir')
        $this->db->select('qty_awal, qty_terima as terima, qty_pengeluaran as pengeluaran, stock_akhir as akhir')
            ->from('stock')
            // ->where('pekerjaan_id', $pekerjaan_id)
            ->where('bahan_id', $bahan_id)
            ->where('created_date', $created_date)
            ->group_by('bahan_id');

        return $this->db->get()->row_array();
    }

    public function takeOnes($pekerjaan_id, $bahan_id, $created_date)
    {
        // $this->db->select('qty_awal as awal, COALESCE(sum(qty_terima), 0) as terima, 
        //                     COALESCE(sum(qty_pengeluaran), 0) as pengeluaran, 
        //                     (qty_awal + COALESCE(sum(qty_terima))) - COALESCE(sum(qty_pengeluaran), 0) as akhir')
        $this->db->select('qty_awal, qty_terima as terima, qty_pengeluaran as pengeluaran, stock_akhir as akhir')
            ->from('stock')
            ->where('pekerjaan_id', $pekerjaan_id)
            ->where('bahan_id', $bahan_id)
            ->where('created_date', $created_date)
            ->group_by('bahan_id');

        return $this->db->get()->row_array();
    }

    public function create($params)
    {
        $this->db->insert('stock', $params);

        return $this->db->affected_rows();
    }

    public function update($id_pekerjaan, $bahan_id, $params)
    {
        $this->db->where('pekerjaan_id', $id_pekerjaan)
            ->where('bahan_id', $bahan_id)
            ->update('stock', $params);

        return $this->db->affected_rows();
    }
}
