<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_model extends CI_Model
{
    public function takeAll()
    {
        return $this->db->select('*')
            ->from('tbl_satuan')
            ->get()
            ->result_array();
    }
}
