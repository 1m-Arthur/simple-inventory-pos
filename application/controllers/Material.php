<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bahan_model');
        $this->load->model('bahan_tersedia_model');
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['material'] = $this->bahan_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('material/index', $data);
        $this->load->view('dash/footer');
    }

    public function Add()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['nama_bahan'] = htmlspecialchars($this->input->post('nama_bahan'));

        if (empty($data['nama_bahan'])) {
            $this->session->set_tempdata('msgntf', 'Harap isi Material', 1);
            redirect('material/');
            return false;
        }

        $create = $this->bahan_model->create($data);

        if (!$create) {
            $this->session->set_tempdata('msgntf', 'Gagal menambah Material', 1);
        }

        if ($create) {
            $this->session->set_tempdata('msgout', 'Berhasil menambah Material', 1);
        }
        redirect('material/');
    }

    public function updates($bahan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($bahan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('material/');
            return false;
        }

        $data['material'] = $this->bahan_model->takeOne($bahan_id);
        $this->load->view('dash/header');
        $this->load->view('material/update', $data);
        $this->load->view('dash/footer');
    }

    public function actionUpdate($bahan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($bahan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('material/');
            return false;
        }

        $this->form_validation->set_rules('nama_bahan', 'Material', 'required');

        if ($this->form_validation->run() == false) {
            $data['material'] = $this->bahan_model->takeOne($bahan_id);

            $this->load->view('dash/header');
            $this->load->view('material/update', $data);
            $this->load->view('dash/footer');
            return false;
        }

        $data['nama_bahan'] = htmlspecialchars($this->input->post('nama_bahan'));

        $update = $this->bahan_model->update($bahan_id, $data);

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah Data', 1);
        }
        redirect('material/');
    }

    public function Drop($bahan_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($bahan_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('material/');
            return false;
        }

        $delete = $this->bahan_model->delete($bahan_id);

        if (!$delete) {
            $this->session->set_tempdata('msgntf', 'Gagal menghapus Data', 1);
        }

        if ($delete) {
            $this->session->set_tempdata('msgout', 'Berhasil menghapus Data', 1);
        }
        redirect('material/');
    }

    public function stock()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['stock'] = $this->bahan_tersedia_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('material/stock', $data);
        $this->load->view('dash/footer');
    }
}
