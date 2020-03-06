<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('depart_model');
        $this->load->model('receipt_model');
        $this->load->model('lppm_model');
        $this->load->model('productbill_model');
    }

    public function index()
    {
        if ($this->session->userdata('is_login') == true) {
            $setdata['penerimaan'] = $this->receipt_model->totalPenerimaan();
            $setdata['antrian'] = $this->lppm_model->LppmAntrian();
            $setdata['pengeluaran'] = $this->productbill_model->totalPengeluaran();

            $this->load->view('dash/header');
            $this->load->view('admin/index', $setdata);
            $this->load->view('dash/footer');
        }
        if ($this->session->userdata('is_login') == false) {
            $this->load->view('auth/login-page');
        }
    }

    public function login()
    {

        if ($this->session->userdata('is_login') == true) {
            redirect('./');
        }

        $data['username'] = $this->input->post('username');
        $data['pass'] = $this->input->post('pass');

        if ($data['username'] == '') {
            $this->session->set_tempdata('msgntf', 'Username tidak boleh kosong', 1);
            redirect('./');
        }

        if ($data['pass'] == '') {
            $this->session->set_tempdata('msgntf', 'Password tidak boleh kosong', 1);
            redirect('./');
        }

        $user = $this->user_model->login($data);

        if (!password_verify($data['pass'], $user['password'])) {
            $this->session->set_tempdata('msgntf', 'Username atau password salah', 1);
            redirect('./');
        }

        if (!$user) {
            $this->session->set_tempdata('msgntf', 'Username atau password salah', 1);
            redirect('./');
        }

        $data = [
            'userid' => $user['user_id'],
            'nickname' => $user['first_name'],
            'role' => $user['departemen_id'],
            'is_login' => 'true'
        ];
        unset($user['username'], $user['password']);
        $this->session->set_userdata($data);

        $setdata['penerimaan'] = $this->receipt_model->totalPenerimaan();
        $setdata['antrian'] = $this->lppm_model->LppmAntrian();
        $setdata['pengeluaran'] = $this->productbill_model->totalPengeluaran();

        $this->load->view('dash/header');
        $this->load->view('admin/index', $setdata);
        $this->load->view('dash/footer');
        redirect('./', 'refresh');
    }

    public function logout()
    {
        if (empty($this->session->userdata('nickname')) && empty($this->session->userdata('is_login')) && empty($this->session->userdata('role'))) {
            $this->session->set_tempdata('msgntf', 'Anda Belum Login sama sekali', 1);
            redirect('./', 'refresh');
        }
        $this->session->unset_userdata('nickname');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('is_login');

        $this->session->set_tempdata('msgout', 'Anda Berhasil Logout', 1);
        redirect('./');
        $this->session->sess_destroy();
    }

    public function changepass()
    {
        $this->load->view('dash/header');
        $this->load->view('user/changepass');
        $this->load->view('dash/footer');
    }

    public function userlist()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $data['user'] = $this->user_model->takeAll();
        $data['department'] = $this->depart_model->takeAll();
        $this->load->view('dash/header');
        $this->load->view('user/index', $data);
        $this->load->view('dash/footer');
    }

    public function userAdd()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($this->session->userdata('role') !== '1') {
            redirect('./');
            return false;
        }

        $data['username'] = htmlspecialchars($this->input->post('username'));
        $data['password'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
        $data['first_name'] = htmlspecialchars($this->input->post('first_name'));
        $data['last_name'] = htmlspecialchars($this->input->post('last_name'));
        $data['departemen_id'] = htmlspecialchars($this->input->post('departemen'));

        if (empty($data['username']) || empty($data['password']) || empty($data['first_name']) || empty($data['departemen_id'])) {
            $this->session->set_tempdata('msgntf', 'Harap lengkapi data!', 1);
            redirect('user/userlist');
            return false;
        }

        $user = $this->user_model->takeOne($data);

        if ($user) {
            $this->session->set_tempdata('msgntf', 'User tidak tersedia', 1);
            redirect('user/userlist');
            return false;
        }

        $create = $this->user_model->create($data);

        if (!$create) {
            $this->session->set_tempdata('msgntf', 'Gagal menambah User', 1);
        }

        if ($create) {
            $this->session->set_tempdata('msgout', 'Berhasil menambah User', 1);
        }
        redirect('user/userlist');
    }

    public function Updates($userid = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($this->session->userdata('role') !== '1') {
            redirect('./');
            return false;
        }

        if ($userid == '1') {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        if ($userid == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        $data['user'] = $this->user_model->takeOne(array('user_id' => $userid));
        $data['department'] = $this->depart_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('user/updates', $data);
        $this->load->view('dash/footer');
    }

    public function actionUpdate($userid = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($this->session->userdata('role') !== '1') {
            redirect('./');
            return false;
        }

        if ($this->input->post('departemen') == '1') {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        if ($userid == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        if (!empty($this->input->post('pass'))) {
            $data['password'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]');
        }

        $this->form_validation->set_rules('first_name', 'Firstname', 'required');
        $this->form_validation->set_rules('departemen', 'Firstname', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->user_model->takeOne(array('user_id' => $userid));
            $data['department'] = $this->depart_model->takeAll();

            $this->load->view('dash/header');
            $this->load->view('user/updates', $data);
            $this->load->view('dash/footer');
            return false;
        }

        $data['first_name'] = htmlspecialchars($this->input->post('first_name'));
        $data['last_name'] = htmlspecialchars($this->input->post('last_name'));
        $data['departemen_id'] = htmlspecialchars($this->input->post('departemen'));

        $update = $this->user_model->update($userid, $data);

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah Data', 1);
        }
        redirect('user/userlist');
    }

    public function userDrop($userid = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        if ($this->session->userdata('role') !== '1') {
            redirect('./');
            return false;
        }

        if ($userid == '1') {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        if (empty($userid)) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }
        $drop = $this->user_model->delete($userid);

        if ($drop) {
            $this->session->set_tempdata('msgout', 'Berhasil menghapus Data', 1);
        }
        redirect('user/userlist');
    }


    public function changepass_Self()
    {
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('pass_confirm', 'Password Confirmation', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dash/header');
            $this->load->view('user/changepass');
            $this->load->view('dash/footer');
            return false;
        }

        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $user_id = $this->session->userdata('userid');

        if ($user_id == '' || $this->input->post('pass') == '' || $this->input->post('pass_confirm') == '') {
            redirect('user/changepass', 'refresh');
        }

        if ($this->input->post('pass') !== $this->input->post('pass_confirm')) {
            $this->session->set_tempdata('msgntf', 'Password tidak cocok', 1);
            redirect('user/changepass');
            return false;
        }

        $data['password'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
        $update = $this->user_model->update_pass($user_id, $data);

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah kata sandi', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah kata sandi', 1);
        }
        redirect('user/changepass');
    }

    public function Update_Self()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $userid = $this->session->userdata('userid');

        if ($userid == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        $data['user'] = $this->user_model->takeOne(array('user_id' => $userid));
        $data['department'] = $this->depart_model->takeAll();

        $this->load->view('dash/header');
        $this->load->view('user/change_info', $data);
        $this->load->view('dash/footer');
    }

    public function actionUpdate_Self()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('./');
            $this->session->sess_destroy();
        }

        $user_id = $this->session->userdata('userid');

        if ($user_id == null) {
            $this->session->set_tempdata('msgntf', 'Anda tidak diizinkan', 1);
            redirect('user/userlist');
            return false;
        }

        if (!empty($this->input->post('pass'))) {
            $data['password'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]');
        }

        $this->form_validation->set_rules('first_name', 'Firstname', 'required');
        $this->form_validation->set_rules('departemen', 'Department', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->user_model->takeOne(array('user_id' => $user_id));
            $data['department'] = $this->depart_model->takeAll();

            $this->load->view('dash/header');
            $this->load->view('user/change_info', $data);
            $this->load->view('dash/footer');
            return false;
        }

        $data['first_name'] = htmlspecialchars($this->input->post('first_name'));
        $data['last_name'] = htmlspecialchars($this->input->post('last_name'));
        $data['departemen_id'] = htmlspecialchars($this->input->post('departemen'));

        $update = $this->user_model->update($user_id, $data);

        if (!$update) {
            $this->session->set_tempdata('msgntf', 'Gagal mengubah Data', 1);
        }

        if ($update) {
            $this->session->set_tempdata('msgout', 'Berhasil mengubah Data', 1);
        }
        redirect('user/userlist');
    }
}
