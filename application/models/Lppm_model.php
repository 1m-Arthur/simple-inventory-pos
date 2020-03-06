<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lppm_model extends CI_Model
{
    public function takeAll()
    {
        return $this->db->select('pekerjaan_id, lppm_no, first_name, last_name, lppm_no, nama_bahan, a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->where('a.disposisi_id < 4')
            ->or_where('a.disposisi_id', '7')
            ->order_by('pekerjaan_id', 'DESC')
            ->get()
            ->result_array();
    }

    public function takeOne($pekerjaanid)
    {
        $this->db->select('a.pekerjaan_id, a.bahan_id, a.satuan_id, a.lppm_no, b.first_name, b.last_name, a.lppm_no, c.nama_bahan, a.disposisi_id, 
                            d.nama_disposisi, a.qty, e.nama_satuan, a.created_date, a.tgl_diperlukan, a.tgl_pengajuan, a.tgl_reject, a.tgl_approve, 
                            a.tgl_po')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->where('pekerjaan_id', $pekerjaanid);
        return $this->db->get()->row_array();
    }

    public function create($params)
    {
        $this->db->insert('pekerjaan', $params);

        return $this->db->affected_rows();
    }

    public function Update($pekerjaanid, $params)
    {
        $this->db->where('pekerjaan_id', $pekerjaanid)
            ->update('pekerjaan', $params);

        return $this->db->affected_rows();
    }

    public function takeNumber($date)
    {
        $this->db->select('COUNT(tgl_pengajuan) as serial, tgl_pengajuan')->from('pekerjaan')
            ->select('(SELECT `lppm_no` FROM pekerjaan where DATE_FORMAT(tgl_pengajuan,"%Y-%m-%d") = "' . $date . '" ORDER BY lppm_no DESC LIMIT 1) as lppm_no')
            ->where('DATE_FORMAT(tgl_pengajuan,"%Y-%m-%d") =', $date)
            ->order_by('lppm_no', 'DESC');
        return $this->db->get()->row_array();
    }

    public function Delete($pekerjaanid)
    {
        $this->db->where('pekerjaan_id', $pekerjaanid)
            ->delete('pekerjaan');

        return $this->db->affected_rows();
    }

    public function NoLppm()
    {
        return $this->db->select('pekerjaan_id, lppm_no, qty, nama_satuan, nama_bahan')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->where_not_in('lppm_no', null)
            ->where('a.disposisi_id ', '3')
            ->get()
            ->result_array();
    }

    public function LppmAntrian()
    {
        $this->db->select('count(*) as total')
            ->from('pekerjaan')
            ->where('disposisi_id <= 4');
        // ->or_where('disposisi_id', '6');

        return $this->db->get()->row_array();
    }
}
