<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
    public function index()
    {
        $data['map'] = $this->db->get('daftar_alat')->result_array();
        $this->load->view('map/header', $data);
        // $this->load->view('map/topbar');
        $this->load->view('map/index');
        $this->load->view('map/footer');
    }
    public function fetchmarker()
    {
        $data = $this->db->get('daftar_alat')->result_array();
        echo json_encode($data);
    }
}
