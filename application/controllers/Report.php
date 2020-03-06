<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdfgenerator');
        $this->load->model('report_receipt_model');
        $this->load->model('report_product_model');
        $this->load->model('stock_model');
        $this->load->model('bahan_model');
    }
    function index()
    {
        $data = "what do u looking 4?";
        echo $data;
        header("refresh:3;url=../report/stock");
    }
    public function receipt()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['bahan'] = $this->bahan_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('report/receipt', $data);
        $this->load->view('dash/footer');
    }

    public function printReceipt()
    {
        $params = array();

        $params['start_date'] = htmlspecialchars(date("Y-m-d", strtotime($this->input->get('start_date'))));
        $params['end_date'] = htmlspecialchars(date("Y-m-d", strtotime($this->input->get('end_date'))));

        if (empty($params['start_date'])) {
            $this->session->set_tempdata('msgntf', 'Start Date tidak boleh kosong!!', 1);
            redirect('report/receipt');
            return false;
        }
        if (empty($params['end_date'])) {
            $this->session->set_tempdata('msgntf', 'End Date tidak boleh kosong!!', 1);
            redirect('report/receipt');
            return false;
        }
        if ($params['start_date'] > $params['end_date']) {
            $this->session->set_tempdata('msgntf', 'start date tidak boleh melebihi end date!!', 1);
            redirect('report/receipt');
            return false;
        }

        $data['report'] = $this->report_receipt_model->take($params);
        $data['params'] = $params;

        $html = $this->load->view('print/receipt', $data, true);
        $filename = 'penerimaan_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    public function product()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['bahan'] = $this->bahan_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('report/product', $data);
        $this->load->view('dash/footer');
    }

    public function printProduct()
    {
        $params = array();

        $params['start_date'] = htmlspecialchars(date("Y-m-d", strtotime($this->input->get('start_date'))));
        $params['end_date'] = htmlspecialchars(date("Y-m-d", strtotime($this->input->get('end_date'))));


        if (empty($params['start_date'])) {
            $this->session->set_tempdata('msgntf', 'Start Date tidak boleh kosong!!', 1);
            redirect('report/product');
            return false;
        }
        if (empty($params['end_date'])) {
            $this->session->set_tempdata('msgntf', 'End Date tidak boleh kosong!!', 1);
            redirect('report/product');
            return false;
        }
        if ($params['start_date'] > $params['end_date']) {
            $this->session->set_tempdata('msgntf', 'start date tidak boleh melebihi end date!!', 1);
            redirect('report/product');
            return false;
        }
        if (!empty($this->input->get('bahan'))) {
            $params['bahan'] = htmlspecialchars($this->input->get('bahan'));
        }

        $data['report'] = $this->report_product_model->take($params);

        $html = $this->load->view('print/product', $data, true);
        $filename = 'pengeluaran_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    public function stock()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }
        $data['bahan'] = $this->bahan_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('report/stock', $data);
        $this->load->view('dash/footer');
    }

    public function printStock()
    {
        $params = array();

        $params['start_date'] = htmlspecialchars(date("Y-m-d", strtotime($this->input->get('start_date'))));
        $params['end_date'] = htmlspecialchars(date("Y-m-d", strtotime($this->input->get('end_date'))));

        if (empty($params['start_date'])) {
            $this->session->set_tempdata('msgntf', 'Start Date tidak boleh kosong!!', 1);
            redirect('report/product');
            return false;
        }
        if (empty($params['end_date'])) {
            $this->session->set_tempdata('msgntf', 'End Date tidak boleh kosong!!', 1);
            redirect('report/product');
            return false;
        }
        if ($params['start_date'] > $params['end_date']) {
            $this->session->set_tempdata('msgntf', 'start date tidak boleh melebihi end date!!', 1);
            redirect('report/product');
            return false;
        }
        if (!empty($this->input->get('bahan'))) {
            $params['bahan'] = htmlspecialchars($this->input->get('bahan'));
        }

        $data['report'] = $this->stock_model->take($params);

        $html = $this->load->view('print/stock', $data, true);
        $filename = 'stock_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }
}
