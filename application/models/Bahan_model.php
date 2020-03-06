<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_model extends CI_Model
{
    public function takeAll()
    {
        return $this->db->select('*')
            ->from('tbl_bahan_baku')
            ->get()
            ->result_array();
    }

    public function takeOne($bahanid)
    {
        $this->db->select('*')
            ->from('tbl_bahan_baku')
            ->where('bahan_id', $bahanid);

        return $this->db->get()->row_array();
    }

    public function create($params)
    {
        $this->db->insert('tbl_bahan_baku', $params);

        return $this->db->affected_rows();
    }

    public function update($bahanid, $params)
    {
        $this->db->where('bahan_id', $bahanid)
            ->update('tbl_bahan_baku', $params);
        return $this->db->affected_rows();
    }

    public function delete($bahanid)
    {
        $this->db->where('bahan_id', $bahanid)
            ->delete('tbl_bahan_baku');
        return $this->db->affected_rows();
    }
}
