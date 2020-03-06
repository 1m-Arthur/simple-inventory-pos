<?php

use PhpParser\Node\Stmt\Return_;

defined('BASEPATH') or exit('No direct script access allowed');

class Receipt extends CI_Controller
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
        $this->load->model('bahan_tersedia_model');
        $this->load->model('stock_model');
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['receipt'] = $this->receipt_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('receipt/index', $data);
        $this->load->view('dash/footer');
    }

    public function lookat($penerimaanid = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($penerimaanid)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receipt/');
            return false;
        }
        $data['view'] = $this->receipt_model->takeOne($penerimaanid);

        if ($data['view']['user_id'] !== null) {
            $data['user'] = $this->user_model->takeOne($data['view']);
        }
        $data['status'] = $this->status_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('receipt/view', $data);
        $this->load->view('dash/footer');
    }

    public function Confirm()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['user'] = $this->user_model->takeAll();
        $data['purchase'] = $this->receipt_model->takePO();

        $this->load->view('dash/header');
        $this->load->view('receipt/add', $data);
        $this->load->view('dash/footer');
    }

    public function actionConfirm()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $this->form_validation->set_rules('penerima', 'Material', 'required');
        // $this->form_validation->set_rules('supplier', 'supplier', 'required');
        $this->form_validation->set_rules('po', 'Nomor PO', 'required');
        $this->form_validation->set_rules('created_date', 'Tanggal Penerimaan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dash/header');
            $this->load->view('receipt/add');
            $this->load->view('dash/footer');
            return false;
        }

        $pekerjaan_id = htmlspecialchars($this->input->post('po'));
        $data['user_id'] = htmlspecialchars($this->input->post('penerima'));

        $pekerjaan = $this->lppm_model->takeOne($pekerjaan_id);

        $lppm['disposisi_id'] = '5';
        // $lppm['tgl_penerimaan']  = date('Y-m-d H:i:s');
        $lppm['tgl_penerimaan']  = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
        $available = $this->bahan_tersedia_model->takeOne($pekerjaan['bahan_id']);
        $stock = $this->stock_model->takeOne($pekerjaan_id, $pekerjaan['bahan_id'], date('Y-m-d', strtotime($lppm['tgl_penerimaan'])));
        // return var_dump($stock);
        $stocks['created_date'] = date('Y-m-d', strtotime($lppm['tgl_penerimaan']));
        $stocks['qty_terima'] = $pekerjaan['qty'];
        if ($this->input->post('created_date') == null) {
            $this->session->set_tempdata('msgntf', 'Tanggal tidak boleh kosong', 1);
            redirect('receipt/');
            return false;
        }
        if ($available['stock_awal'] == null) {
            $stocks['qty_awal'] = 0;
        }
        if ($available['stock_awal'] !== null) {
            $stocks['qty_awal'] = $available['stock_awal'];
        }
        $stocks['stock_akhir'] = $stocks['qty_terima'] + $stocks['qty_awal'];
        // return var_dump($stocks);

        $this->db->trans_start();
        if ($stock == null) {
            $stocks['bahan_id'] = $pekerjaan['bahan_id'];
            $stocks['pekerjaan_id'] = $pekerjaan_id;
            $this->stock_model->create($stocks);
        }
        if ($stock !== null) {
            $stocks['qty_terima'] = $pekerjaan['qty'] + $stocks['qty_awal'];
            $stocks['stock_akhir'] = $stocks['qty_terima'] + $stocks['qty_awal'];
            $this->stock_model->update($pekerjaan_id, $pekerjaan['bahan_id'], $stocks);
        }
        if ($available == null) {
            $tersedia['bahan_id'] = $pekerjaan['bahan_id'];
            $tersedia['stock_awal'] = $pekerjaan['qty'];
            $this->bahan_tersedia_model->create($tersedia);
        }
        if ($available !== null) {
            // $tersedia['bahan_id'] = $pekerjaan['bahan_id'];
            $tersedia['stock_awal'] = $pekerjaan['qty'] + $available['stock_awal'];
            $this->bahan_tersedia_model->update($pekerjaan['bahan_id'], $tersedia);
        }

        $confirm = $this->receipt_model->update($pekerjaan_id, $data);
        $this->lppm_model->Update($pekerjaan_id, $lppm);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_tempdata('msgntf', 'Gagal menambah Data', 1);
            redirect('receipt/');
            return false;
        }

        if ($this->db->trans_status() === true) {
            $this->session->set_tempdata('msgout', 'Berhasil menambah Data', 1);
            redirect('receipt/');
        }
    }

    public function update($penerimaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($penerimaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('receipt/');
            return false;
        }

        $data['view'] = $this->receipt_model->takeOne($penerimaan_id);
        $data['purchase'] = $this->receipt_model->takePOAll();
        $data['user'] = $this->user_model->takeAll();
        // return var_dump($data);
        $this->load->view('dash/header');
        $this->load->view('receipt/update', $data);
        $this->load->view('dash/footer');
    }

    public function actionUpdate($penerimaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($penerimaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('receipt/');
            return false;
        }

        $this->form_validation->set_rules('penerima', 'Material', 'required');
        // $this->form_validation->set_rules('supplier', 'supplier', 'required');
        $this->form_validation->set_rules('po', 'Nomor PO', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dash/header');
            $this->load->view('receipt/add');
            $this->load->view('dash/footer');
            return false;
        }

        $pekerjaan_id = htmlspecialchars($this->input->post('po'));
        $data['user_id'] = htmlspecialchars($this->input->post('penerima'));
        // $data['nama_supplier'] = htmlspecialchars($this->input->post('supplier'));

        $pekerjaan = $this->lppm_model->takeOne($pekerjaan_id);

        $lppm['disposisi_id'] = '5';

        if (!empty($this->input->post('created_date'))) {
            $lppm['tgl_penerimaan']  = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
            $available = $this->bahan_tersedia_model->takeOne($pekerjaan['bahan_id']);
            $stock = $this->stock_model->takeOne($pekerjaan_id, $pekerjaan['bahan_id'], date('Y-m-d', strtotime($lppm['tgl_penerimaan'])));
            $this->stock_model->update($pekerjaan_id, $pekerjaan['bahan_id'], array('created_date' => date('Y-m-d', strtotime($lppm['tgl_penerimaan']))));
        }

        $this->db->trans_start();
        $update = $this->receipt_model->update($pekerjaan_id, $data);
        $this->lppm_model->Update($pekerjaan_id, $lppm);
        $this->db->trans_complete();

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal memperbaharui Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil memperbaharui Data', 1);
        }

        redirect('receipt/');
    }

    public function Drop($penerimaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($penerimaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('receipt/');
            return false;
        }

        // $pekerjaan_id = htmlspecialchars($this->input->post('po'));
        $po = $this->po_model->takeOne($penerimaan_id);
        $data['user_id'] = null;
        // $data['nama_supplier'] = null;
        $lppm['disposisi_id'] = '4';
        $lppm['tgl_penerimaan']  = null;

        $pekerjaan = $this->lppm_model->takeOne($po['pekerjaan_id']);
        $available = $this->bahan_tersedia_model->takeOne($pekerjaan['bahan_id']);

        $this->db->trans_start();
        if ($available !== null) {
            $tersedia['stock_awal'] = $available['stock_awal'] - $pekerjaan['qty'];
            $stock = $this->bahan_tersedia_model->update($pekerjaan['bahan_id'], $tersedia);
        }
        $update = $this->receipt_model->update($po['pekerjaan_id'], $data);
        $this->lppm_model->Update($po['pekerjaan_id'], $lppm);
        $this->db->trans_complete();

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal menghapus Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil menghapus Data', 1);
        }

        redirect('receipt/');
    }

    public function Allmonthly()
    {
        for ($months = 1; $months < 13; $months++) {

            $data['penerimaan'][$months] = $this->receipt_model->countAllpenerimaan(date("Y") . $months);
            // $data['pengeluaran'][$months] = $this->productbill_model->countAllpengeluaran($months);

            if ($data['penerimaan'][$months] == null) {
                $data['penerimaan'][$months] = '0';
            }
            // if ($data['pengeluaran'][$months]['permonth'] == null) {
            //     $data['pengeluaran'][$months]['permonth'] = '0';
            // }
        }

        echo json_encode($data['penerimaan']);
    }
}
