<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['map'] = $this->db->get_where('daftar_alat', ['email' => $data['user']['email']])->row_array();
        $email =  $data['map']['email'];
        $data['role'] = $this->db->query("SELECT user.role_id FROM `user` INNER JOIN daftar_alat ON user.email = daftar_alat.email WHERE daftar_alat.email = '$email'")->row_array();
        $this->load->view('map/header', $data);
        // $this->load->view('map/topbar');
        $this->load->view('map/index');
        $this->load->view('map/footer');
    }
    public function fetchmarker()
    {
        $data = $this->db->query('SELECT reader_user.nama_gedung,reader_user.latitude,reader_user.longitude,reader_user.foto,daftar_alat.alamat,daftar_alat.nama_instansi FROM `reader_user` INNER JOIN `daftar_alat` ON `reader_user`.`id_reader` = `daftar_alat`.`id`')->result_array();
        echo json_encode($data);
    }
    public function fetchuser()
    {
        $data = $this->db->get('masker_user')->result_array();
        echo json_encode($data);
    }
}
