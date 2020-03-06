<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lppm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lppm_model');
        $this->load->model('user_model');
        $this->load->model('bahan_model');
        $this->load->model('status_model');
        $this->load->model('satuan_model');
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['lppm'] = $this->lppm_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('lppm/index', $data);
        $this->load->view('dash/footer');
    }

    public function Add()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['bahan'] = $this->bahan_model->takeAll();
        $data['satuan'] = $this->satuan_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('lppm/add', $data);
        $this->load->view('dash/footer');
    }

    public function AddAction()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $this->form_validation->set_rules('bahan', 'Material', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('tgl_diperlukan', 'Tanggal', 'required');
        $this->form_validation->set_rules('created_date', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dash/header');
            $this->load->view('lppm/add');
            $this->load->view('dash/footer');
            return false;
        }
        if (empty($this->input->post('created_date'))) {
            $this->session->set_tempdata('msgntf', 'Harap isi data dengan benar!!', 1);
            redirect('productbill/');
            return false;
        }

        $data['user_id'] = $this->session->userdata('userid');
        $data['bahan_id'] = ($this->input->post('bahan'));
        $data['disposisi_id'] = '1';
        $data['qty'] = ($this->input->post('qty'));
        $data['satuan_id'] = ($this->input->post('satuan'));
        $data['created_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
        // $data['created_date'] = date('Y-m-d H:i:s');
        $data['tgl_diperlukan'] = date('Y-m-d', strtotime($this->input->post('tgl_diperlukan')));

        $create = $this->lppm_model->create($data);

        if (!$create) {
            $this->session->set_tempdata('msgntf', 'Gagal menambah Data', 1);
        }

        if ($create) {
            $this->session->set_tempdata('msgout', 'Berhasil menambah Data', 1);
        }
        redirect('lppm/');
    }

    public function lookat($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $role = $this->session->userdata('role');

        $data['status'] = $this->status_model->takeAll();
        $data['view'] = $this->lppm_model->takeOne($pekerjaan_id);

        if ($data['view']['pekerjaan_id'] == null) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('lppm/');
            return false;
        }

        $this->load->view('dash/header');
        if (($role == 1) || ($role == 2) || ($role == 3)) {
            $this->load->view('lppm/approve', $data);
        } else {
            $this->load->view('lppm/view', $data);
        }
        // $this->load->view('lppm/approve', $data);
        $this->load->view('dash/footer');
    }

    public function Updates($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($pekerjaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }

        $data['bahan'] = $this->bahan_model->takeAll();
        $data['status'] = $this->status_model->takeAll();
        $data['lppm'] = $this->lppm_model->takeOne($pekerjaan_id);
        $data['satuan'] = $this->satuan_model->takeAll();

        if ($data['lppm']['pekerjaan_id'] == null) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('lppm/');
            return false;
        }

        if ($data['lppm']['disposisi_id'] > 1) {
            $this->session->set_tempdata('msgntf', 'Data yang sudah diajukan tidak dapat di ubah!!', 1);
            redirect('lppm/');
            return false;
        }

        $this->load->view('dash/header');
        $this->load->view('lppm/update', $data);
        $this->load->view('dash/footer');
    }

    public function actionUpdate($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $this->form_validation->set_rules('bahan', 'Material', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('tgl_diperlukan', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dash/header');
            $this->load->view('lppm/add');
            $this->load->view('dash/footer');
            return false;
        }

        if ($pekerjaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }

        $lppm = $this->lppm_model->takeOne($pekerjaan_id);

        if ($lppm['pekerjaan_id'] == null) {
            $this->session->set_tempdata('msgntf', 'Data tidak dapat ditemukan!!', 1);
            redirect('lppm/');
            return false;
        }

        if ($lppm['disposisi_id'] > 1) {
            $this->session->set_tempdata('msgntf', 'Data yang sudah diajukan tidak dapat di ubah!!', 1);
            redirect('lppm/');
            return false;
        }

        $data['bahan_id'] = htmlspecialchars($this->input->post('bahan'));
        $data['qty'] = htmlspecialchars($this->input->post('qty'));
        $data['satuan_id'] = htmlspecialchars($this->input->post('satuan'));
        if (!empty($this->input->post('created_date'))) {
            $data['created_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
        }
        if (!empty($this->input->post('tgl_diperlukan'))) {
            $data['tgl_diperlukan'] = date('Y-m-d', strtotime(htmlspecialchars($this->input->post('tgl_diperlukan'))));
        }

        $update = $this->lppm_model->update($pekerjaan_id, $data);

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah Data', 1);
        }
        redirect('lppm/');
    }

    public function Ajukan($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($pekerjaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }

        $data['disposisi_id'] = '2';
        $data['tgl_pengajuan'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));;
        $data['lppm_no'] = $this->takeSerial(date('Y-m-d', strtotime($data['tgl_pengajuan'])));
        $ajukan = $this->lppm_model->update($pekerjaan_id, $data);
        if (!$ajukan) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah Data', 1);
        }

        if ($ajukan) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah Data', 1);
        }
        redirect('lppm/');
    }

    public function Approve($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($pekerjaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }

        $this->load->model('po_model');

        $lppm = $this->lppm_model->takeOne($pekerjaan_id);

        if ($lppm['tgl_pengajuan'] == null) {
            $data['tgl_pengajuan'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));
            $data['lppm_no'] = $this->takeSerial(date('Y-m-d', strtotime($data['tgl_pengajuan'])));
        }

        $data['disposisi_id'] = '3';
        // $data['tgl_approve'] = date('Y-m-d H:i:s');
        $data['tgl_approve'] = date('Y-m-d H:i:s', strtotime($this->input->post('created_date') . ":00"));

        $this->db->trans_start();
        $ajukan = $this->lppm_model->update($pekerjaan_id, $data);
        $this->po_model->create(array(
            'pekerjaan_id' => $pekerjaan_id
        ));
        $this->db->trans_complete();

        if (!$ajukan) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah Data', 1);
        }

        if ($ajukan) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah Data', 1);
        }
        redirect('lppm/');
    }

    public function Reject($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $role = $this->session->userdata('role');

        if ($pekerjaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }
        // return var_dump($role);
        if (!($role <= 3)) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }

        $data['disposisi_id'] = '7';
        $data['tgl_reject'] = date('Y-m-d H:i:s');

        $ajukan = $this->lppm_model->update($pekerjaan_id, $data);
        if (!$ajukan) {
            $this->session->set_tempdata('msgntf', 'Gagal Reject Data', 1);
        }

        if ($ajukan) {
            $this->session->set_tempdata('msgout', 'Berhasil Reject Permintaan Data', 1);
        }
        redirect('lppm/');
    }

    public function Drop($pekerjaan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($pekerjaan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('lppm/');
            return false;
        }

        $lppm = $this->lppm_model->takeOne($pekerjaan_id);

        if ($lppm['disposisi_id'] > 1) {
            $this->session->set_tempdata('msgntf', 'Data yang sudah diajukan tidak dapat di ubah!!', 1);
            redirect('lppm/');
            return false;
        }

        if ($lppm['user_id'] !== $this->session->userdata('userid')) {
            $this->session->set_tempdata('msgntf', 'Hanya penginput data yang berhak menghapus!!', 1);
            redirect('lppm/');
            return false;
        }

        $drop = $this->lppm_model->delete($pekerjaan_id);

        if ($drop) {
            $this->session->set_tempdata('msgout', 'Berhasil menghapus Data', 1);
        }
        redirect('lppm/');
    }

    private function takeSerial($date)
    {
        $number = $this->lppm_model->takeNumber($date);

        if ($number['serial'] == null || $number['serial'] == '0') {
            $incr = $number['serial'] + 1;
        }
        if ($number['serial'] !== null) {
            $incr = substr($number['lppm_no'], 9, 4) + 1;
        }

        if (strlen($incr) == 1) {
            $lppm = "LP-" . date('ymd', strtotime($date)) . "000" . $incr;
        }
        if (strlen($incr) == 2) {
            $lppm = "LP-" . date('ymd', strtotime($date)) . "00" . $incr;
        }
        if (strlen($incr) == 3) {
            $lppm = "LP-" . date('ymd', strtotime($date)) . "0" . $incr;
        }
        if (strlen($incr) > 3) {
            $lppm = "LP-" . date('ymd', strtotime($date)) . $incr;
        }
        return $lppm;
    }
}
