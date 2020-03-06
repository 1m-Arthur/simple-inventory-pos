<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_tersedia_model extends CI_Model
{

    public function takeAll()
    {
        return $this->db->select('tersedia_id, nama_bahan, stock_awal')
            ->from('bahan_tersedia as a')
            ->join('tbl_bahan_baku as b', 'a.bahan_id = b.bahan_id')
            ->get()
            ->result_array();
    }

    public function takeOne($bahan_id)
    {
        $this->db->select('tersedia_id, nama_bahan, stock_awal')
            ->from('bahan_tersedia as a')
            ->join('tbl_bahan_baku as b', 'a.bahan_id = b.bahan_id')
            ->where('a.bahan_id', $bahan_id);

        return $this->db->get()->row_array();
    }

    public function create($params)
    {
        $this->db->insert('bahan_tersedia', $params);

        return $this->db->affected_rows();
    }

    public function update($bahan_id, $params)
    {
        $this->db->where('bahan_id', $bahan_id)
            ->update('bahan_tersedia', $params);

        return $this->db->affected_rows();
    }
}
