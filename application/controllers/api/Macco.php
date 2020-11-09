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
        $this->load->model('Users_Model');
    }



    public function index_get()
    {
        $id = $this->get('id');

        if ($id == null) {
            $user_macco = $this->Users_Model->get_all_user();
        } else {
            $user_macco = $this->Users_Model->get_all_user($id);
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
        $nik = $this->post('nik');
        $no_kk = $this->post('no_kk');
        $nama = $this->post('nama');
        $alamat = $this->post('alamat');
        $email = $this->post('email');


        $data1 = [
            'id_user' =>  $randomString,
            'nik' => $nik,
            'no_kk' => $no_kk,
            'nama' => $nama,
            'alamat' => $alamat,
            'email' => $email,
        ];

        $cek_nik = $this->Users_Model->cek_nik($nik);
        $cek_email = $this->Users_Model->cek_email($email);
        $cek_id = $this->Users_Model->cek_id($nik);
        if ($cek_email && $cek_nik) {
            $this->response([
                'status' => true,
                'message' => 'NIK dan Email Sudah Terdaftar',
                'login' => 'OK',
                'id_user' => $cek_id['id_user']
            ], 200);
        } else if ($cek_nik) {
            $this->response([
                'status' => true,
                'message' => 'NIK Sudah Terdaftar',
                'akses' => 'Tidak diizinkan Daftar',
                'login' => 'NO',
                'id_user' => $cek_id['id_user']
            ], 200);
        } else if ($cek_email) {
            $this->response([
                'status' => true,
                'message' => 'Email Sudah Terdaftar',
                'akses' => 'Tidak diizinkan',
                'login' => 'NO',
                'id_user' => $cek_id['id_user']
            ], 200);
        } else {
            $tambah_user = $this->Users_Model->tambah_user($data1);
            if ($tambah_user) {
                $this->response([
                    'status' => true,
                    'message' => 'Berhasil Tambah User',
                    'Proses' => 'Resgister Awal',
                    'id_user' => $randomString
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal Tambah User'
                ], 404);
            }
        }
    }

    public function getlocation_post()
    {
        $id = $this->post('id');
        $locations = $this->Users_Model->get_location();
        $base_location = array(
            'logitude' => $this->post('long'),
            'latitude' => $this->post('lat'),
        );
        $this->Users_Model->set_loc($base_location, $id);

        foreach ($locations as $key => $location) {
            $a = $base_location['latitude'] - $location['latitude'];
            $b = $base_location['logitude'] - $location['longitude'];
            $distance = sqrt(($a ** 2) + ($b ** 2));
            $distances[$key] = $distance;
        }
        asort($distances);
        $closest = $locations[key($distances)];
        $lat2 = $closest['latitude'];
        $lat1 = $this->post('lat');
        $lon1 = $this->post('long');
        $lon2 = $closest['longitude'];
        $R =  6378.137; // Radius of earth in KM
        $dLat = ($lat2 * M_PI) / 180 - ($lat1 * M_PI) / 180;
        $dLon = ($lon2 * M_PI) / 180 - ($lon1 * M_PI) / 180;
        $a =  sin($dLat / 2) * sin($dLat / 2) + cos(($lat1 * M_PI) / 180) * cos(($lat2 * M_PI) / 180) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c;
        $jarak =  $d * 1000; // meters
        $terdekat = [
            'latitude' => $closest['latitude'],
            'longitude' => $closest['longitude'],
            'id_alat' => $closest['id_reader'],
            // 'alamat' => $closest['alamat'],
            'user' => $id,
            'jarak' => $jarak
        ];

        if ($jarak > 10) {
            echo "Tidak ada macco";
            $this->db->set('payment', "true");
            $this->db->where('id_user', $id);
            $this->db->update('masker_user');
        } else {
            // echo "ada macco";
            $cari = $this->db->get_where('reader_user', ['id_reader' => $terdekat['id_alat']])->row_array();
            $scan = $this->db->get_where('masker_raders', ['id_reader' => $cari['id_reader_user']])->row_array();
            $str_scan = explode(",", $scan['id_reader_user']);
            // print_r($str_scan);
            // exit;
            $check = false;
            foreach ($str_scan as $sc) :
                if ($sc == $id) {

                    $check = true;
                    break;
                }

            endforeach;

            if ($check == true) {
                // var_dump($sc);
                var_dump($check);
                // $this->db->where('id_reader_user', $id);
                // $this->db->delete('masker_raders');
                $this->db->set('payment', "true");
                $this->db->where('id_user', $id);
                $this->db->update('masker_user');
                $this->response(['status' => true, 'message' => 'beres'], 200);
            } else {
                $scan = $this->db->get_where('masker_user', ['id_user' => $id])->row_array();
                $email = $scan['email'];
                $this->db->set('payment', "False");
                $this->db->where('id_user', $id);
                $this->db->update('masker_user');
                $this->response(['status' => false, 'message' => 'use your mask'], 200);
                $this->_kirim($email);
                // json_encode("'status'=>'gunakan masker'");
                // $this->set_response(['status' => 'anda tidak menggunakan masker'], REST_Controller::HTTP_OK);
            }
        }

        $scan = $this->db->get_where('masker_raders', ['id_reader_user' => $id])->row_array();
        if ($scan['id_reader_user'] == $id) {
            $this->db->where('id_reader_user', $id);
            // $this->db->delete('masker_raders');
            // echo json_encode($terdekat);
            $this->response($terdekat);
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
        $users = $this->Users_Model->get_masker($id_masker);
        if ($users['id_masker'] == $id_masker) {
            if ($users['id_user'] == null) {
                $this->Users_Model->daftar_masker($id_user, $id_masker);
                $this->set_response(['message' => 'masker berhasil di daftarkan', 'status' => 'OK', 'id_masker' => $id_masker, 'id_user' => $id_user], REST_Controller::HTTP_OK);
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
        ];
        $cek_tag = $this->Users_Model->check_tags($tag);
        if ($cek_tag) {
            $this->response([
                'status' => true,
                'message' => 'Tag Sudah Terdaftar',
                'akses' => 'Tidak diizinkan Daftar',
            ], 200);
        } else {
            $tambah_user = $this->Users_Model->tambah_tag($data);
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
        $tag = $this->input->get('tag');
        $splil_tag = explode(',', $tag);
        $id = $this->input->get('id_alat');
        $void = "";
        foreach ($splil_tag as $sp) :
            $data = $this->Users_Model->check_mask($sp);
            if ($data != null) {
                $void = $void . $data['id_user'] . ',';
            }
        endforeach;
        $read = [
            'id_reader' => $id,
            'id_reader_user' => $void
        ];
        $check = $this->db->get('masker_raders')->row_array();
        if ($check) {
            if ($data) {
                $this->db->set('id_reader_user', $void);
                $this->db->where('id_reader', $id);
                $this->db->update('masker_raders');
                $this->response([
                    'status' => true,
                    'message' => 'Already Scaned'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'tag not found'
                ], 200);
            }
        } else {
            $tambah_mreader = $this->Users_Model->tambah_mreader($read);
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
        $config = [
            'protocol'  => 'smtp',
            //'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'Maccomask@gmail.com',
            'smtp_pass' => 'Alhamdulillah12345678',
            'smtp_port' => '587',
            'smtp_crypto' => 'tls',
            'smtp_timeout' => '30',
            'charset' => 'iso-8859-1',
            'newline' => "\r\n",
            'wordwrap' => TRUE,
            'mailtype' => 'html'
        ];
        $this->email->initialize($config);
        $this->email->from('Maccomask@gmail.com', 'Macco Masker');
        $this->email->to($email);

        $this->email->subject('Warning !! (Macco)');
        $this->email->message('Tetap Waspada Gunakan Masker anda !!');
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function table_get()
    {
        $table = $this->input->get('table');
        $data = $this->Users_Model->get_table($table);
        if ($data) {
            $this->response([
                'table' => $table,
                'message' => $data
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'table noting found'
            ], 200);
        }
    }
    public function delmask_get()
    {
        $id = $this->input->get('id');
        $cek = $this->Users_Model->cek_mask($id);

        if ($cek) {
            $this->Users_Model->delete_mask($id);
            $this->response([
                'status' => true,
                'id_masker' => $id,
                'message' => 'Mask has ben deleted'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Nothing found'
            ], 404);
        }
    }
    public function edituser_post()
    {
        $id = $this->input->get('id');
        $nik = $this->post('nik');
        $no_kk = $this->post('no_kk');
        $nama = $this->post('nama');
        $alamat = $this->post('alamat');
        $email = $this->post('email');


        $data = [
            'nik' => $nik,
            'no_kk' => $no_kk,
            'nama' => $nama,
            'alamat' => $alamat,
            'email' => $email,
        ];
        $edit = $this->Users_Model->edit_user($id, $data);
        if ($edit) {
            $this->response([
                'status' => true,
                'message' => 'data has updated'
            ], 200);
        }
    }
    public function maskeruser_get()
    {
        $id = $this->input->get('id');
        $muser = $this->Users_Model->getmaskeruser($id);
        if ($muser) {
            $this->response($muser);
        } else {
            $this->response([
                'status' => false,
                'message' => 'not found'
            ]);
        }
    }
}
