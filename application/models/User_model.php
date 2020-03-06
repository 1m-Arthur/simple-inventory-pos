<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function login($params)
    {
        return $this->db->select('*')
            ->from('users')
            ->where('username', $params['username'])
            ->get()
            ->row_array();
    }

    public function takeOne($params)
    {
        $this->db->select('*')
            ->from('users');
        if (isset($params['user_id'])) {
            $this->db->where('user_id', $params['user_id']);
        }
        if (isset($params['username'])) {
            $this->db->where('username', $params['username']);
        }
        return $this->db
            ->get()
            ->row_array();
    }

    public function takeAll()
    {
        return $this->db->select('user_id,username,password,first_name,last_name,nama_departemen')
            ->from('users as a')
            ->join('tbl_departemen as b','a.departemen_id = b.departemen_id')
            ->where_not_in('a.user_id','1')
            ->get()
            ->result_array();
    }

    public function update_pass($id, $params)
    {
        $this->db->where(' user_id ', $id)
            ->update(' users ', $params);

        return $this->db->affected_rows();
    }

    public function create($params)
    {
        $this->db->insert('users', $params);
        
        return $this->db->affected_rows();
    }

    public function update($userid, $params)
    {
        $this->db->where('user_id', $userid)
            ->update('users', $params);
            
        return $this->db->affected_rows();
    }

    public function delete($userid)
    {
        $this->db->where('user_id', $userid)
        ->delete('users');
        
        return $this->db->affected_rows();
    }
}

 
