<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Po extends CI_Controller
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
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['po'] = $this->po_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('po/index', $data);
        $this->load->view('dash/footer');
    }

    public function Add()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['lppm'] = $this->lppm_model->NoLppm();

        $this->load->view('dash/header');
        $this->load->view('po/add', $data);
        $this->load->view('dash/footer');
    }

    public function actionAdd()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $this->form_validation->set_rules('lppm', 'Material', 'required');
        $this->form_validation->set_rules('harga', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('dash/header');
            $this->load->view('PO/add');
            $this->load->view('dash/footer');
            return false;
        }
        if (empty($this->input->post('created_date'))) {
            $this->session->set_tempdata('msgntf', 'Harap isi data dengan benar!!', 1);
            redirect('productbill/');
            return false;
        }

        $pekerjaan_id = htmlspecialchars($this->input->post('lppm'));
        $data['harga_satuan'] = htmlspecialchars($this->input->post('harga'));
        // $data['po_no'] = $this->takeSerial();

        $pekerjaan = $this->lppm_model->takeOne($pekerjaan_id);
        $data['total_harga'] = $pekerjaan['qty'] * $data['harga_satuan'];

        $lppm['disposisi_id'] = '4';
        // $lppm['tgl_po']  = date('Y-m-d H:i:s');
        $lppm['tgl_po']  = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
        $data['po_no'] = $this->takeSerial(date('Y-m-d', strtotime($lppm['tgl_po'])));
        $data['nama_supplier'] = htmlspecialchars($this->input->post('supplier'));
        // return var_dump($data['po_no']);

        $this->db->trans_start();
        $update = $this->po_model->update($pekerjaan_id, $data);
        $this->lppm_model->Update($pekerjaan_id, $lppm);
        $this->receipt_model->create(array(
            'pekerjaan_id' => $pekerjaan_id
        ));
        $this->db->trans_complete();

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal menambah Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil menambah Data', 1);
        }

        redirect('PO/');
    }

    public function lookat($purchasingid = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if (empty($purchasingid)) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('PO/');
            return false;
        }
        $data['view'] = $this->po_model->takeOne($purchasingid);
        $data['status'] = $this->status_model->takeAll();
        // return var_dump($data['view']);

        $this->load->view('dash/header');
        $this->load->view('po/view', $data);
        $this->load->view('dash/footer');
    }

    private function takeSerial($date)
    {

        $number = $this->po_model->takeNumber($date);
        if ($number['serial'] == null || $number['serial'] == '0') {
            $incr = $number['serial'] + 1;
        }
        if ($number['serial'] !== null) {
            $incr = substr($number['po_no'], 10, 3) + 1;
        }
        // return var_dump($incr);

        if (strlen($incr) == 1) {
            $lppm = "PO-" . date('ymd', strtotime($date)) . "100" . $incr;
        }
        if (strlen($incr) == 2) {
            $lppm = "PO-" . date('ymd', strtotime($date)) . "10" . $incr;
        }
        if (strlen($incr) > 3) {
            $lppm = "PO-" . date('ymd', strtotime($date)) . "1" . $incr;
        }
        return $lppm;
    }
}
