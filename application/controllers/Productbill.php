<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productbill extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lppm_model');
        $this->load->model('user_model');
        $this->load->model('bahan_model');
        $this->load->model('status_model');
        $this->load->model('satuan_model');
        $this->load->model('po_model');
        $this->load->model('receipt_model');
        $this->load->model('receiptbill_model');
        $this->load->model('productbill_model');
        $this->load->model('bahan_tersedia_model');
        $this->load->model('stock_model');
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $params = array();
        $params['lppm_no'] = $this->input->get('lppm_no');
        $params['po_no'] = $this->input->get('po_no');
        $params['nama_bahan'] = $this->input->get('nama_bahan');

        $data['pbill'] = $this->productbill_model->takeAll($params);
        $this->load->view('dash/header');
        $this->load->view('productbill/index', $data);
        $this->load->view('dash/footer');
    }

    public function Approve($kode_bon = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($kode_bon)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }

        $data['view'] = $this->productbill_model->takeOne($kode_bon);

        $this->load->view('dash/header');
        $this->load->view('productbill/approve', $data);
        $this->load->view('dash/footer');
    }

    public function lookat($kode_bon = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($kode_bon)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }

        $data['view'] = $this->productbill_model->takeOne($kode_bon);
        $data['status'] = $this->status_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('productbill/view', $data);
        $this->load->view('dash/footer');
    }

    public function actionApprove($kode_bon = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($kode_bon)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }

        if (empty($this->input->post('created_date'))) {
            $this->session->set_tempdata('msgntf', 'Harap isi data dengan benar!!', 1);
            redirect('productbill/');
            return false;
        }

        $data['approve'] = '1';
        $data['tgl_pengeluaran'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));

        $pekerjaan = $this->productbill_model->takeOne($kode_bon);
        $available = $this->bahan_tersedia_model->takeOne($pekerjaan['bahan_id']);
        $stock = $this->stock_model->takeOne($pekerjaan['pekerjaan_id'], $pekerjaan['bahan_id'], date('Y-m-d', strtotime($data['tgl_pengeluaran'])));

        $stocks['created_date'] = date('Y-m-d', strtotime($data['tgl_pengeluaran']));
        $stocks['qty_pengeluaran'] = $pekerjaan['qty_permintaan'];
        // $stocks['qty_terima'] = $stock['qty_terima'];
        if ($available['stock_awal'] == null) {
            $stocks['qty_awal'] = 0;
        }
        if ($stock['qty_awal'] == null) {
            $stocks['qty_awal'] = $available['stock_awal'];
        }
        if ($stock['qty_awal'] !== null) {
            $stocks['qty_awal'] = $stock['qty_awal'];
        }

        $stocks['stock_akhir'] = ($stock['terima'] + $stocks['qty_awal']) -  $stocks['qty_pengeluaran'];
        // var_dump($stock);
        // return var_dump($stocks);
        $this->db->trans_start();
        if ($stock == null) {
            $stocks['bahan_id'] = $pekerjaan['bahan_id'];
            $stocks['pekerjaan_id'] = $pekerjaan['pekerjaan_id'];
            $this->stock_model->create($stocks);
        }

        if ($stock !== null) {
            $this->stock_model->update($pekerjaan['pekerjaan_id'], $pekerjaan['bahan_id'], $stocks);
        }

        if ($available !== null) {
            // $tersedia['bahan_id'] = $pekerjaan['bahan_id'];
            $tersedia['stock_awal'] = $available['stock_awal'] - $stocks['qty_pengeluaran'];
            $this->bahan_tersedia_model->update($pekerjaan['bahan_id'], $tersedia);
        }

        $approve = $this->productbill_model->update($kode_bon, $data);
        $this->lppm_model->Update($pekerjaan['pekerjaan_id'], array(
            'disposisi_id' => '6'
        ));
        $this->db->trans_complete();

        if (!$approve) {
            $this->session->set_tempdata('msgntf', 'Gagal Approve Data', 1);
        }

        if ($approve) {
            $this->session->set_tempdata('msgout', 'Berhasil Approve Data', 1);
        }

        redirect('productbill/');
    }

    public function Allmonthly()
    {
        for ($months = 1; $months < 13; $months++) {

            // $data['penerimaan'][$months] = $this->receipt_model->countAllpenerimaan($months);
            $data['pengeluaran'][$months] = $this->productbill_model->countAllpengeluaran(date("Y") . $months);

            // if ($data['penerimaan'][$months]['permonth'] == null) {
            //     $data['penerimaan'][$months]['permonth'] = '0';
            // }
            if ($data['pengeluaran'][$months] == null) {
                $data['pengeluaran'][$months] = '0';
            }
            // var_dump($data['pengeluaran'][$months]);
        }

        echo json_encode($data['pengeluaran']);
    }
}
