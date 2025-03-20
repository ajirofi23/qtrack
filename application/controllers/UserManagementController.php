<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagementController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Model'); // Load model jika diperlukan
        check_login();
    }

    public function index(){
      $data['title']      = 'Users Management';
      $data['conten']     = 'admin/page/user_managemen/view';
      $data['data_users'] = $this->M_Model->get_data('tbl_users');
      $this->load->view('admin/template/template',$data);
    }

    public function tambah(){
      $data['title']      = 'Tambah User Management';
      $data['conten']     = 'admin/page/user_managemen/tambah';
      $this->load->view('admin/template/template',$data);
    }

    public function proses_tambah(){
      if ($this->input->post()) {
          $nama_lengkap = $this->input->post('nama_lengkap');
          $no_tlp       = $this->input->post('no_tlp');
          $email        = $this->input->post('email');
          $password     = $this->input->post('password');
          $role         = $this->input->post('role');

          if ($this->M_Model->is_email($email)) {
              $response = array(
                  'status'    => 'error',
                  'message'   => 'Email sudah terdaftar.'
              );
          } else {
              $id_user = $this->M_Model->generate_user_id();

              // Generate Token Konfirmasi
              $token = substr(bin2hex(random_bytes(3)), 0, 6);
              $data   = array(
                  'id_user'       => $id_user,
                  'nama_lengkap'  => $nama_lengkap,
                  'email'         => $email,
                  'no_tlp'        => $no_tlp,
                  'password'      => password_hash($password, PASSWORD_BCRYPT),
                  'role'          => $role,
                  'token'         => $token,
                  'status'        => '1'
              );

              if ($this->M_Model->Insert_Data($data,'tbl_users')) {
                  $response = array(
                    'status'    => 'success',
                    'message'   => 'Berhasil menyimpan data.'
                );
              } else {
                  $response = array(
                      'status'    => 'error',
                      'message'   => 'Terjadi kesalahan saat menyimpan data.'
                  );
              }
          }

          echo json_encode($response);
      } else {
          show_error('No direct script access allowed', 403);
      }
    }

    public function hapus($id) {
      // Panggil fungsi hapus dari model
      $result = $this->M_Model->hapus('id_user', $id, 'tbl_users'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

      // Redirect ke halaman tertentu setelah penghapusan
      if ($result) {
          $this->session->set_flashdata('swal', [
              'icon' => 'success',
              'title' => 'Sukses!',
              'text' => 'Data berhasil dihapus.'
          ]);
      } else {
          $this->session->set_flashdata('swal', [
              'icon' => 'error',
              'title' => 'Gagal!',
              'text' => 'Gagal menghapus data.'
          ]);
      }
      redirect('UserManagementController');
    }
}
