<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }
    public function edit()
    {
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Profile";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|svg';
                $config['max_size'] =    '5000';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                    $old_image = $data['user']['image'];

                    if ($old_image != 'default.svg') {
                        unlink(FCPATH . './assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Can not update photo !
                    </div>');
                    redirect('user');
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your data has been edited !
            </div>');
            redirect('user');
        }
    }
    public function lengkapi()
    {
        $this->form_validation->set_rules('instansi', 'Nama Instansi', 'trim|required');
        $this->form_validation->set_rules('negara', 'Negara', 'trim|required');
        $this->form_validation->set_rules('hp', 'NO HP', 'trim|required');
        $this->form_validation->set_rules('telephone', 'NO TELEPHONE', 'trim|required');
        $this->form_validation->set_rules('jinstansi', 'Jenis Instansi', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
        $this->form_validation->set_rules('alamat_lengkap', 'Alamat', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Lengkapi Profile";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['lengkapi'] = $this->db->get_where('daftar_alat', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/lengkapi', $data);
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $data = [
                'nama_instansi' => $this->input->post('instansi'),
                'Jenis_instansi' => $this->input->post('jinstansi'),
                'negara' => $this->input->post('negara'),
                'telephone' => $this->input->post('telephone'),
                'hp' => $this->input->post('hp'),
                'alamat' => $this->input->post('alamat_lengkap'),
                'kota' => $this->input->post('kota'),
                'username' => $this->input->post('username'),
                'latitude' => $this->input->post('lat'),
                'longitude' => $this->input->post('long'),
                'foto' => $this->_uploadImage(),
            ];
            // $upload_image = $_FILES['image']['name'];
            // if ($upload_image) {
            //     $config['allowed_types'] = 'gif|jpg|png|svg';
            //     $config['max_size'] =    '5000';
            //     $config['upload_path'] = './assets/img/image/';
            //     $this->load->library('upload', $config);
            //     if ($this->upload->do_upload('image')) {
            //         $data['user'] = $this->db->get_where('daftar_alat', ['email' => $email])->row_array();
            //         $old_image = $data['user']['image'];

            //         if ($old_image != 'defaultgedung.svg') {
            //             unlink(FCPATH . './assets/img/image/' . $old_image);
            //         }
            //         $new_image = $this->upload->data('file_name');
            //         $this->db->set('foto', $new_image);
            //     } else {
            //         $this->upload->display_errors();
            //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            //         Can not update photo !
            //         </div>');
            //         redirect('user');
            //     }
            // }
            $this->db->where('email', $email);
            $this->db->update('daftar_alat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your data has been edited !
            </div>');
            redirect('user/lengkapi');
        }
    }
    private function _uploadImage()
    {
        $config['allowed_types'] = 'gif|jpg|png|svg';
        $config['max_size'] =    '5000';
        $config['upload_path'] = './assets/img/profile/';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        return "defaultgedung.svg";
    }
    private function _uploadFoto()
    {
        $config['allowed_types'] = 'gif|jpg|png|svg';
        $config['max_size'] =    '5000';
        $config['upload_path'] = './assets/img/profile/';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        return "defaultgedung.svg";
    }

    public function device()
    {
        $this->form_validation->set_rules('gedung', 'Nama Gedung', 'trim|required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'trim|required|min_length[10]|max_length[1000]');
        if ($this->form_validation->run() ==  FALSE) {
            $data['alat'] = $this->db->get_where('daftar_alat', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = "Device";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/tmabahalat', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_reader' => $this->input->post('id'),
                'nama_gedung' => $this->input->post('gedung'),
                'ket' => $this->input->post('ket'),
                'foto' => $this->_uploadFoto(),
            ];
            $this->db->insert('reader_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your data has been added !
            </div>');
            redirect('user/device');
        }
    }
    public  function listdevice()
    {

        $data['alat'] = $this->db->get_where('daftar_alat', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['alat']['id'];
        $data['list'] = $this->db->get_where('reader_user', ['id_reader' => $id])->result_array();
        $data['title'] = "Device List";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/list', $data);
        $this->load->view('template/footer');
    }
    public function detaillist()
    {
        $data['alat'] = $this->db->get_where('daftar_alat', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['alat']['id'];
        $data['list'] = $this->db->get_where('reader_user', ['id_reader' => $id])->result_array();
        $data['detail'] = $this->db->get_where('reader_user', ['id_reader_user' => $_GET['id']])->row_array();
        $data['title'] = "Device List";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/listdetail', $data);
        $this->load->view('template/footer');
    }
    public function deletelist()
    {
        $id = $this->input->get('id');
        $this->db->where(['id_reader_user' => $id]);
        $this->db->delete('reader_user');
        redirect('user/listdevice');
    }
}
