<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Memuat database
    }

    public function generate_user_id() {
        $date = date('Ymd'); // Format: TahunBulanTanggal (contoh: 20231025)
        $random = mt_rand(1000, 9999); // Angka acak 4 digit
        return 'U' . $date . $random; // Format: USER202310251234
    }

    // Method untuk menambahkan user baru
    public function register_user($data) {
        return $this->db->insert('tbl_users', $data);
    }

    // Method untuk memeriksa apakah email sudah terdaftar
    public function is_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_users');
        return $query->num_rows() > 0;
    }

    public function get_user_by_token($token) {
        $this->db->where('token', $token);
        return $this->db->get('tbl_users')->row();
    }

    public function activate_user($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->update('tbl_users', array('status' => '1')); // Ubah status menjadi 1 (aktif)
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_users'); 

        if ($query->num_rows() > 0) {
            return $query->row(); 
        } else {
            return null; // Jika tidak ada pengguna ditemukan
        }
    }

    public function get_data($tables) {
        // Load database library (jika belum di-load di autoload)
        $this->load->database();
    
        // Validasi parameter $tables
        if (empty($tables)) {
            return array(); // Kembalikan array kosong jika tabel tidak valid
        }
    
        // Query untuk mengambil data dari tabel
        $query = $this->db->get($tables);
    
        // Cek apakah query berhasil
        if ($query) {
            // Kembalikan hasil query dalam bentuk array
            return $query->result_array();
        } else {
            // Jika query gagal, kembalikan array kosong
            return array();
        }
    }

    public function Insert_Data($data,$table) {
        return $this->db->insert($table, $data);
    }

    public function hapus($pk, $id, $table) {

    
        // Validasi parameter $id
        if (empty($id)) {
            $this->session->set_flashdata('status', 'error');
            $this->session->set_flashdata('message', 'ID tidak valid.');
            return false;
        }
    
        // Query untuk menghapus data berdasarkan ID
        $this->db->where($pk, $id); // Gunakan $pk sebagai kolom primary key
        $delete = $this->db->delete($table); // Gunakan $table sebagai nama tabel
    
        // Cek apakah query berhasil
        if ($delete) {
            $this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('message', 'Data berhasil dihapus.');
            return true;
        } else {
            $this->session->set_flashdata('status', 'error');
            $this->session->set_flashdata('message', 'Gagal menghapus data.');
            return false;
        }
    }

}