<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
    public function index()
    {
        // $this->load->view('map/header');
        // $this->load->view('map/topbar');
        $this->load->view('map/index');
        // $this->load->view('map/footer');
    }
}
