<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Receiptbill_model extends CI_Model
{
    public function takeAll($params)
    {
        $this->db->select('first_name, last_name, created_date, 
                            nama_penerima, keterangan, kode_bon_permintaan, tgl_permintaan')
            ->from('permintaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('penerimaan as c', 'a.penerimaan_id = c.penerimaan_id')
            ->join('purchase_order as d', 'a.purchase_id = d.purchase_id')
            ->join('pekerjaan as e', 'c.pekerjaan_id = e.pekerjaan_id')
            ->join('tbl_bahan_baku as f', 'e.bahan_id = f.bahan_id')
            ->order_by('kode_bon_permintaan', 'DESC');

        if (!empty($params['lppm_no'])) {
            $this->db->where('e.lppm_no ', $params['lppm_no']);
        }

        if (!empty($params['po_no'])) {
            $this->db->or_where('d.po_no ', $params['po_no']);
        }

        if (!empty($params['nama_bahan'])) {
            $this->db->or_where('f.nama_bahan ', $params['nama_bahan']);
        }

        return $this->db->get()->result_array();
    }

    public function takeOne($kode_permintaan)
    {
        $this->db->select('first_name, last_name, created_date, nama_penerima, 
                            keterangan, kode_bon_permintaan, qty_permintaan, a.purchase_id, d.po_no,
                            e.lppm_no, e.tgl_diperlukan, harga_satuan, total_harga, nama_supplier,
                            nama_bahan, tgl_permintaan, nama_satuan,tgl_pengajuan, tgl_approve,
                            tgl_po, tgl_penerimaan,disposisi_id, a.user_id')
            ->from('permintaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('penerimaan as c', 'a.penerimaan_id = c.penerimaan_id')
            ->join('purchase_order as d', 'a.purchase_id = d.purchase_id')
            ->join('pekerjaan as e', 'c.pekerjaan_id = e.pekerjaan_id')
            ->join('tbl_bahan_baku as f', 'e.bahan_id = f.bahan_id')
            ->join('tbl_satuan as g', 'e.satuan_id = g.satuan_id')
            ->where('kode_bon_permintaan', $kode_permintaan)
            ->order_by('kode_bon_permintaan', 'DESC');

        return $this->db->get()->row_array();
    }

    public function takePO()
    {
        return $this->db->select('a.pekerjaan_id, first_name, last_name, lppm_no, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    purchase_id, po_no, harga_satuan, total_harga, tgl_po')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->where('a.disposisi_id ', '5')
            // ->or_where('a.disposisi_id ', '5')
            ->order_by('po_no', 'ASC')
            ->group_by('a.bahan_id')
            ->get()
            ->result_array();
    }

    public function takeNumber($date)
    {
        $this->db->select('COUNT(tgl_permintaan) as serial')
            ->select('(SELECT `kode_bon_permintaan` FROM permintaan where DATE_FORMAT(tgl_permintaan,"%Y-%m-%d") = "' . $date . '" ORDER BY kode_bon_permintaan DESC LIMIT 1) as kode_bon_permintaan')
            ->from('permintaan')
            ->where('DATE_FORMAT(tgl_permintaan,"%Y-%m-%d") ', $date)
            ->order_by('kode_bon_permintaan', 'DESC');
        return $this->db->get()->row_array();
    }

    public function takePenerimaan($pekerjaan_id)
    {
        $this->db->select('a.pekerjaan_id, lppm_no, first_name, last_name, nama_bahan, 
                                    a.disposisi_id, nama_disposisi, qty, nama_satuan, created_date,
                                    tgl_diperlukan, tgl_pengajuan, tgl_approve, tgl_po, f.purchase_id, 
                                    po_no, harga_satuan, total_harga, penerimaan_id, g.user_id,
                                    nama_supplier, tgl_penerimaan, a.bahan_id')
            ->from('pekerjaan as a')
            ->join('users as b', 'a.user_id = b.user_id')
            ->join('tbl_bahan_baku as c', 'a.bahan_id = c.bahan_id')
            ->join('tbl_disposisi as d', 'a.disposisi_id = d.disposisi_id')
            ->join('tbl_satuan as e', 'a.satuan_id = e.satuan_id')
            ->join('purchase_order as f', 'a.pekerjaan_id = f.pekerjaan_id')
            ->join('penerimaan as g', 'a.pekerjaan_id = g.pekerjaan_id')
            ->where('a.pekerjaan_id', $pekerjaan_id);

        return $this->db->get()->row_array();
    }

    public function create($params)
    {
        $this->db->insert('permintaan', $params);

        return $this->db->affected_rows();
    }

    public function update($kode_permintaan, $params)
    {
        $this->db->where('kode_bon_permintaan', $kode_permintaan)
            ->update('permintaan', $params);

        return $this->db->affected_rows();
    }

    public function delete($kode_permintaan)
    {
        $this->db->where('kode_bon_permintaan', $kode_permintaan)
            ->delete('permintaan');

        return $this->db->affected_rows();
    }
}
