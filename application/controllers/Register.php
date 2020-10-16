<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['instansi'] = $this->db->get("instansi")->result_array();
        $data['title'] = "Ragistration";
        $this->load->view('auth/auth_header', $data);
        $this->load->view('auth/daftar', $data);
        $this->load->view('auth/auth_footer', $data);
    }
    public function registration()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[daftar_alat.email]', [
            'is_unique' => 'this email has already regitered'
        ]);
        $this->form_validation->set_rules('jinstansi', 'Jinstansi', 'trim|required');
        $this->form_validation->set_rules('country_selector', 'Negara', 'trim|required');
        $this->form_validation->set_rules('telp', 'Telphone', 'trim|required');
        $this->form_validation->set_rules('hp', 'Handphone', 'trim|required');
        $this->form_validation->set_rules('instansi', 'Instansi', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('foto', 'Foto', 'trim|required');
        $this->form_validation->set_rules('alamat_lengkap', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
        if ($this->form_validation->run() ==  FALSE) {
            $data['instansi'] = $this->db->get("instansi")->result_array();
            $data['title'] = "Ragistration";
            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/daftar', $data);
            $this->load->view('auth/auth_footer', $data);
        } else {

            $jinstansi = (int) $this->input->post('jinstansi');
            $data = [
                'penaggung_jawab' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'Jenis_instansi' => $jinstansi,
                'negara' => $this->input->post('country_selector'),
                'telephone' => $this->input->post('telp'),
                'hp' => $this->input->post('hp'),
                'nama_instansi' => $this->input->post('instansi'),
                'username' => $this->input->post('username'),
                'alamat' => $this->input->post('alamat_lengkap'),
                'kota' => $this->input->post('kota'),
                'foto' => 'avatar.png',
                'longitude' => $this->input->post('long'),
                'latitude' => $this->input->post('lat'),
            ];
            $this->db->insert('daftar_alat', $data);
            redirect("register");
        }
    }
}
