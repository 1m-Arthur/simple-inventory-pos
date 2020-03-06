<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Depart_model extends CI_Model
{
    public function takeAll()
    {
        return $this->db->select('*')
            ->from('tbl_departemen')
            ->get()
            ->result_array();
    }
}
