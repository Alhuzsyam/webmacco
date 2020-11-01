<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Macco extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->methods['users_get']['limit'] = 500;
        $this->methods['users_post']['limit'] = 100;
        $this->methods['users_delete']['limit'] = 50;
        $this->load->model('users_model');
    }



    public function index_get()
    {
        $id = $this->get('id');

        if ($id == null) {
            $user_macco = $this->users_model->get_all_user();
        } else {
            $user_macco = $this->users_model->get_all_user($id);
        }

        if ($user_macco) {
            $this->response($user_macco, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ditemukan data property'
            ], 404);
        }
    }





    public function index_post()
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $id_masker = $this->post('id_masker');
        $no_induk = $this->post('no_induk');
        $nik = $this->post('nik');
        $no_kk = $this->post('no_kk');
        $nama = $this->post('nama');
        $alamat = $this->post('alamat');
        $email = $this->post('email');


        $data1 = [
            'id_user' =>  $randomString,
            'id_masker' => $id_masker,
            'no_induk' => $no_induk,
            'nik' => $nik,
            'no_kk' => $no_kk,
            'nama' => $nama,
            'alamat' => $alamat,
            'email' => $email,
        ];

        $cek_nik = $this->users_model->cek_nik($nik);
        $cek_email = $this->users_model->cek_email($email);

        if ($cek_email && $cek_nik) {
            $this->response([
                'status' => true,
                'message' => 'NIK dan Email Sudah Terdaftar',
                'login' => 'OK'
            ], 200);
        } else if ($cek_nik) {
            $this->response([
                'status' => true,
                'message' => 'NIK Sudah Terdaftar',
                'akses' => 'Tidak diizinkan Daftar',
                'login' => 'NO'
            ], 200);
        } else if ($cek_email) {
            $this->response([
                'status' => true,
                'message' => 'Email Sudah Terdaftar',
                'akses' => 'Tidak diizinkan',
                'login' => 'NO'
            ], 200);
        } else {
            $tambah_user = $this->users_model->tambah_user($data1);
            if ($tambah_user) {
                $this->response([
                    'status' => true,
                    'message' => 'Berhasil Tambah User',
                    'Proses' => 'Resgister Awal',
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal Tambah User'
                ], 404);
            }
        }
    }


    //tambahkan model
    public function getlocation_post()
    {
        $id = $this->post('id');
        $locations = $this->users_model->get_location();
        $base_location = array(
            'logitude' => $this->post('long'),
            'latitude' => $this->post('lat'),
        );
        $this->users_model->set_loc($base_location, $id);

        foreach ($locations as $key => $location) {
            $a = $base_location['latitude'] - $location['latitude'];
            $b = $base_location['logitude'] - $location['longitude'];
            $distance = sqrt(($a ** 2) + ($b ** 2));
            $distances[$key] = $distance;
        }
        asort($distances);
        $closest = $locations[key($distances)];

        $terdekat = [
            'latitude' => $closest['latitude'],
            'longitude' => $closest['longitude'],
            'alamat' => $closest['alamat'],
            'user' => $id,
        ];
        $scan = $this->db->get_where('masker_raders', ['id_reader_user' => $id])->row_array();
        if ($scan['id_reader_user'] == $id) {
            $this->db->where('id_reader_user', $id);
            $this->db->delete('masker_raders');
            echo json_encode($terdekat);
        } else {
            $scan = $this->db->get_where('masker_user', ['id_user' => $id])->row_array();
            $email = $scan['email'];
            $this->_kirim($email);
            // $this->set_response(['status' => 'anda tidak menggunakan masker'], REST_Controller::HTTP_OK);
        }
    }
    public function registmasker_post()
    {
        $id_masker = $this->post('id_masker');
        $id_user = $this->post('id_user');
        $users = $this->users_model->get_masker($id_masker);
        if ($users['id_masker'] == $id_masker) {
            if ($users['id_user'] == null) {
                $daftar = $this->users_model->daftar_masker($id_user, $id_masker);
                $this->set_response(['message' => 'masker berhasil di daftarkan', 'status' => 'OK'], REST_Controller::HTTP_OK);
            } else {
                $this->set_response(['status' => 'sudah ada'], REST_Controller::HTTP_OK);
            }
        } else {
            $this->set_response(['status' => 'tidak ditemukan'], REST_Controller::HTTP_OK);
        }
    }
    public function isitag_get()
    {


        $tag = $this->get('tag');
        $id = $this->get('id_reader');


        $data = [
            'tag' => $tag,
            'id_reader' => $id,
        ];
        $cek_tag = $this->users_model->check_tags($tag);
        $cek_id = $this->users_model->check_id($id);

        if ($cek_tag && $cek_id) {
            $this->response([
                'status' => true,
                'message' => 'Id_reader dan Tag Sudah Terdaftar',
            ], 200);
        } else if ($cek_tag) {
            $this->response([
                'status' => true,
                'message' => 'Tag Sudah Terdaftar',
                'akses' => 'Tidak diizinkan Daftar',
            ], 200);
        } else if ($cek_id) {
            $this->response([
                'status' => true,
                'message' => 'Id Sudah Terdaftar',
                'akses' => 'Tidak diizinkan',
            ], 200);
        } else {
            $tambah_user = $this->users_model->tambah_tag($data);
            if ($tambah_user) {
                $this->response([
                    'status' => true,
                    'message' => 'Berhasil Tambah Tag',
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal Tambah User'
                ], 404);
            }
        }
    }
    public function scan_get()
    {
        $tag = $_GET['tag'];
        $data = $this->users_model->check_mask($tag);
        $read = [
            'id_reader' => $data['tag'],
            'id_reader_user' => $data['id_user']
        ];
        $check = $this->db->get('masker_raders')->row_array();
        if ($check['id_reader'] == $tag) {
            $this->response([
                'status' => false,
                'message' => 'Already Scaned'
            ], 200);
        } else {
            $tambah_mreader = $this->users_model->tambah_mreader($read);
            if ($tambah_mreader) {
                $this->response([
                    'status' => true,
                    'message' => 'Scaned'
                ], 200);
            }
        }
    }



    private function _kirim($email)
    {
        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'email@gmail.com',  // Email gmail
            'smtp_pass'   => 'passwordgmail',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('macco@gmail.com', 'Macco.com');

        // Email penerima
        $this->email->to('$email'); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject('Warrning | Macco.com');

        // Isi email
        $this->email->message("Anda telah melanggar new normal gunakan masker anda");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            // echo 'Sukses! email berhasil dikirim.';
            $this->set_response(['status' => 'email berhasil dikirim', 'mesaage' => '(Gunakan Masker Anda)'], REST_Controller::HTTP_OK);
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}
