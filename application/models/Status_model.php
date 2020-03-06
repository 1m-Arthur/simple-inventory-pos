<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_model extends CI_Model
{
    public function takeAll()
    {
        return $this->db->select('*')
            ->from('tbl_disposisi')
            ->get()
            ->result_array();
    }
}
