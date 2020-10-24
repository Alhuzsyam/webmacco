<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Macco extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function readuser_get()
    {
        // Users from a data store e.g. database
        // $users = [
        //     ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
        //     ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
        //     ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        // ];
        $users = $this->db->get_where("masker_user")->result_array();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $user = NULL;

            if (!empty($users)) {
                foreach ($users as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $user = $value;
                    }
                }
            }

            if (!empty($user)) {
                $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function readuserid_get($id)
    {
        $users = $this->db->get_where("masker_user", ['id_user' => $id])->result_array();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $user = NULL;

            if (!empty($users)) {
                foreach ($users as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $user = $value;
                    }
                }
            }

            if (!empty($user)) {
                $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function register_get()
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $id_masker = $_GET['id_masker'];
        $no_induk = $_GET['no_induk'];
        $nik = $_GET['nik'];
        $nama = $_GET['nama'];
        $no_kk = $_GET['no_kk'];
        $alamat = $_GET['alamat'];
        $email = $_GET['email'];
        $users = $this->db->select('nik')->get_where("masker_user", ['nik' => $nik])->row_array();




        if ($users['nik'] == $nik) {
            $this->set_response('login', REST_Controller::HTTP_OK);
        } else {

            $data = [
                'id_user' =>  $randomString,
                'id_masker' => $id_masker,
                'no_induk' => $no_induk,
                'nik' => $nik,
                'nama' => $nama,
                'no_kk' => $no_kk,
                'alamat' => $alamat,
                'email' => $email
            ];
            $this->db->insert('masker_user', $data);
            $sukses = [
                'status' => 'Registered',
                'id' => $data['id_user']
            ];
            $this->set_response($sukses, REST_Controller::HTTP_OK);
        }
    }
    public function getlocation_get()
    {
        $id = $_GET['id'];
        $locations = $this->db->get_where('daftar_alat')->result_array();
        // echo json_encode($data);
        $base_location = array(
            'logitude' => $_GET['long'],
            'latitude' => $_GET['lat'],
        );
        $this->db->update('masker_user', $base_location, array('id_user' => $id));
        foreach ($locations as $key => $location) {
            $a = $base_location['latitude'] - $location['latitude'];
            $b = $base_location['logitude'] - $location['longitude'];
            $distance = sqrt(($a ** 2) + ($b ** 2));
            $distances[$key] = $distance;
        }
        asort($distances);
        $closest = $locations[key($distances)];

        // echo "Closest foreach suburb is: " . $closest['alamat'];
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
    public function registmasker_get()
    {
        $id_masker = $_GET['id_masker'];
        $id_user = $_GET['id_user'];
        $users = $this->db->select('*')->get_where("masker", ['id_masker' => $id_masker])->row_array();
        if ($users['id_masker'] == $id_masker) {
            if ($users['id_user'] == null) {
                $this->db->set(['id_user' => $id_user])->where(['id_masker' => $id_masker])->update('masker');
                $this->set_response(['status' => 'sukses'], REST_Controller::HTTP_OK);
            } else {
                $this->set_response(['status' => 'sudah ada'], REST_Controller::HTTP_OK);
            }
        } else {
            $this->set_response(['status' => 'tidak ditemukan'], REST_Controller::HTTP_OK);
        }
    }
    public function isitag_get()
    {

        $id = $_GET['idreader'];
        $tag = $_GET['tag'];
        $data = [
            'id_reader' => $id,
            'tag' => $tag
        ];
        $check = $this->db->get_where('scanner_machine', ['tag' => $tag])->row_array();
        if ($check['tag'] == $tag) {
            $this->set_response(['status' => 'sudah ada'], REST_Controller::HTTP_OK);
        } else {
            $this->db->insert('scanner_machine', $data);
            $this->set_response(['status' => 'sukses'], REST_Controller::HTTP_OK);
        }
    }
    public function scan_get()
    {
        $tag = $_GET['tag'];
        $data = $this->db->get_where('masker', ['tag' => $tag])->row_array();
        // var_dump($data);
        $read = [
            'id_reader' => $data['tag'],
            'id_reader_user' => $data['id_user']
        ];
        $check = $this->db->get('masker_raders')->row_array();
        if ($check['id_reader'] == $tag) {
            $this->set_response(['status' => 'already scanned'], REST_Controller::HTTP_OK);
        } else {
            $this->db->insert('masker_raders', $read);
            $this->set_response(['status' => 'scanned'], REST_Controller::HTTP_OK);
        }
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
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
            $this->set_response(['status' => 'Sukses! email berhasil dikirim("Gunakan Masker Anda")'], REST_Controller::HTTP_OK);
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}
