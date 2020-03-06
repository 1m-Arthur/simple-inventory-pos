<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receiptbill extends CI_Controller
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

        $data['rbill'] = $this->receiptbill_model->takeAll($params);
        $this->load->view('dash/header');
        $this->load->view('receiptbill/index', $data);
        $this->load->view('dash/footer');
    }

    public function Add()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['user'] = $this->user_model->takeAll();
        $data['purchase'] = $this->receiptbill_model->takePO();
        $this->load->view('dash/header');
        $this->load->view('receiptbill/add', $data);
        $this->load->view('dash/footer');
    }

    public function actionAdd()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $this->form_validation->set_rules('pelaksana', 'Pelaksana', 'required');
        $this->form_validation->set_rules('nama_penerima', 'Penerima', 'required');
        $this->form_validation->set_rules('po', 'Nomor PO', 'required');
        $this->form_validation->set_rules('qty_permintaan', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->user_model->takeAll();
            $data['purchase'] = $this->receiptbill_model->takePO();
            $this->load->view('dash/header');
            $this->load->view('receiptbill/add', $data);
            $this->load->view('dash/footer');
            return false;
        }

        if (empty($this->input->post('created_date'))) {
            $this->session->set_tempdata('msgntf', 'Harap isi data dengan benar!!', 1);
            redirect('productbill/');
            return false;
        }

        $data['user_id'] = htmlspecialchars($this->input->post('pelaksana'));
        $data['nama_penerima'] = htmlspecialchars($this->input->post('nama_penerima'));
        $data['purchase_id'] = htmlspecialchars($this->input->post('po'));

        $po = $this->po_model->takeOne($data['purchase_id']);
        $pekerjaan = $this->receiptbill_model->takePenerimaan($po['pekerjaan_id']);
        $data['penerimaan_id'] = $pekerjaan['penerimaan_id'];
        $data['qty_permintaan'] = htmlspecialchars($this->input->post('qty_permintaan'));
        $data['keterangan'] = htmlspecialchars($this->input->post('keterangan'));
        $data['tgl_permintaan'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
        $data['kode_bon_permintaan'] = $this->takeSerial(date('Y-m-d', strtotime($data['tgl_permintaan'])));

        if ($data['qty_permintaan'] <= 0) {
            $this->session->set_tempdata('msgntf', 'Quantity tidak boleh kurang dari nol', 1);
            redirect('receiptbill/');
        }

        $available = $this->bahan_tersedia_model->takeOne($pekerjaan['bahan_id']);
        $tersedia = $available['stock_awal'] - $data['qty_permintaan'];

        if ($tersedia < 0) {
            $this->session->set_tempdata('msgntf', 'Quantity tidak dapat kurang dari stock tersedia!!', 1);
            redirect('receiptbill/');
            return false;
        }

        $pengeluaran['kode_bon_permintaan'] = $data['kode_bon_permintaan'];

        $this->db->trans_start();
        $this->productbill_model->create($pengeluaran);
        $create = $this->receiptbill_model->create($data);
        $this->db->trans_complete();

        if (!$create) {
            $this->session->set_tempdata('msgntf', 'Gagal tambah Data', 1);
        }

        if ($create) {
            $this->session->set_tempdata('msgout', 'Berhasil tambah Data', 1);
        }

        redirect('receiptbill/');
    }

    public function lookat($bon_permintaan = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($bon_permintaan)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }

        $data['view'] = $this->receiptbill_model->takeOne($bon_permintaan);
        $data['status'] = $this->status_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('receiptbill/view', $data);
        $this->load->view('dash/footer');
    }

    public function update($bon_permintaan = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($bon_permintaan)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }
        $data['rbill'] = $this->receiptbill_model->takeOne($bon_permintaan);
        $data['user'] = $this->user_model->takeAll();
        $data['purchase'] = $this->receiptbill_model->takePO();

        $this->load->view('dash/header');
        $this->load->view('receiptbill/update', $data);
        $this->load->view('dash/footer');
    }

    public function actionUpdate($bon_permintaan = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($bon_permintaan)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }
        $this->form_validation->set_rules('pelaksana', 'Pelaksana', 'required');
        $this->form_validation->set_rules('nama_penerima', 'Penerima', 'required');
        $this->form_validation->set_rules('po', 'Nomor PO', 'required');
        $this->form_validation->set_rules('qty_permintaan', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['rbill'] = $this->receiptbill_model->takeOne($bon_permintaan);
            $data['user'] = $this->user_model->takeAll();
            $data['purchase'] = $this->receiptbill_model->takePO();

            $this->load->view('dash/header');
            $this->load->view('receiptbill/update', $data);
            $this->load->view('dash/footer');
            return false;
        }

        $data['user_id'] = htmlspecialchars($this->input->post('pelaksana'));
        $data['nama_penerima'] = htmlspecialchars($this->input->post('nama_penerima'));
        $data['purchase_id'] = htmlspecialchars($this->input->post('po'));
        $data['qty_permintaan'] = htmlspecialchars($this->input->post('qty_permintaan'));
        $data['keterangan'] = htmlspecialchars($this->input->post('keterangan'));

        if (!empty($this->input->post('created_date'))) {
            $data['tgl_permintaan'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
        }

        if ($data['qty_permintaan'] <= 0) {
            $this->session->set_tempdata('msgntf', 'Quantity tidak boleh kurang dari nol', 1);
            redirect('receiptbill/');
        }

        $cekbill = $this->productbill_model->takeOne($bon_permintaan);

        if ($cekbill['approve'] !== null) {
            $this->session->set_tempdata('msgntf', 'Data tidak boleh diubah setelah di approve!!', 1);
            redirect('receiptbill/');
            return false;
        }
        if ($cekbill['approve'] == '1') {
            $this->session->set_tempdata('msgntf', 'Data tidak boleh diubah setelah di approve!!', 1);
            redirect('receiptbill/');
            return false;
        }

        $update = $this->receiptbill_model->update($bon_permintaan, $data);

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal tambah Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil tambah Data', 1);
        }

        redirect('receiptbill/');
    }

    public function Drop($bon_permintaan = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($bon_permintaan)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('receiptbill/');
            return false;
        }

        $cekbill = $this->productbill_model->takeOne($bon_permintaan);

        if ($cekbill['approve'] !== null) {
            $this->session->set_tempdata('msgntf', 'Data tidak boleh diubah setelah di approve!!', 1);
            redirect('receiptbill/');
            return false;
        }
        if ($cekbill['approve'] == '1') {
            $this->session->set_tempdata('msgntf', 'Data tidak boleh diubah setelah di approve!!', 1);
            redirect('receiptbill/');
            return false;
        }
        $drop = $this->receiptbill_model->delete($bon_permintaan);

        if ($drop) {
            $this->session->set_tempdata('msgout', 'Berhasil menghapus Data', 1);
        }
        redirect('receiptbill/');
    }

    private function takeSerial($date)
    {
        $number = $this->receiptbill_model->takeNumber($date);
        if ($number['serial'] == null || $number['serial'] == '0') {
            $incr = $number['serial'] + 1;
        }
        if ($number['serial'] !== null) {
            $incr = substr($number['kode_bon_permintaan'], 10, 4) + 1;
        }

        if (strlen($incr) == 1) {
            $lppm = "BP-" . date('ymd', strtotime($date)) . "100" . $incr;
        }
        if (strlen($incr) == 2) {
            $lppm = "BP-" . date('ymd', strtotime($date)) . "10" . $incr;
        }
        if (strlen($incr) > 3) {
            $lppm = "BP-" . date('ymd', strtotime($date)) . "1" . $incr;
        }
        return $lppm;
    }
}
