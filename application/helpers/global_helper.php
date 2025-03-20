<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_login')) {
    /**
     * Memeriksa status login dan roles pengguna.
     * Jika tidak login, redirect ke AuthController.
     * Jika login tetapi roles tidak sesuai, redirect ke UserController.
     */
    function check_login() {
        $CI =& get_instance(); // Mendapatkan instance CI

        // Periksa apakah pengguna sudah login
        if (!$CI->session->userdata('is_login')) {
            redirect('AuthController'); // Redirect ke halaman login
        }

        // Periksa roles pengguna
        $roles = $CI->session->userdata('roles');
        $allowed_roles = ['cs', 'admin', 'teller']; // Daftar roles yang diizinkan

        // Jika roles tidak ada dalam daftar yang diizinkan, redirect ke UserController
        if (!in_array($roles, $allowed_roles)) {
            redirect('UserController'); // Redirect ke halaman user
        }
    }

    function check_user(){
      $CI =& get_instance();

      if(!$CI->session->userdata('is_login')){
        redirect('AuthController');
      }

      $roles = $CI->session->userdata('roles');
      $allowed_roles = 'user';

      if($roles != $allowed_roles){
        redirect('HomeController');
      }
    }
}