<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['member'] = $this->db->get('daftar_alat')->num_rows();
        $data['totusers'] = $this->db->get('masker_user')->num_rows();
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('template/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New Role Added!
                </div>');
            redirect('admin/role');
        }
    }
    public function roleaccess($role_id)
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id!=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/role-access', $data);
            $this->load->view('template/footer');
        }
    }
    public function changeaccess()
    {
        $menuId = $this->input->post('menuId');
        $roleId = $this->input->post('roleId');

        $data = [
            'menu_id' => $menuId,
            'role_id' => $roleId,
        ];
        $result =  $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {

            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Changed
        </div>');
    }

    public function users()
    {

        $data['ureaders'] = $this->db->get('daftar_alat')->result_array();
        $data['title'] = "Macco Reader User";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/ureader', $data);
        $this->load->view('template/footer');
    }
    public function deletemembers()
    {
        $id = $_GET['id'];
        $idu = $_GET['idu'];
        $data['alat'] = $this->db->query("SELECT `daftar_alat`.`id` FROM `daftar_alat` INNER JOIN `reader_user` ON `daftar_alat`.`id` = `reader_user`.`id_reader` WHERE daftar_alat.id='$idu'")->result_array();
        $this->db->delete('user', ['email' => $id]);
        $this->db->delete('daftar_alat', ['email' => $id]);
        $this->db->delete('reader_user', ['id_reader' => $data['alat']['0']['id']]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Member has Deleted!
        </div>');
        redirect('admin/users');
    }

    public function detail()
    {
        $id = $this->input->get('id');
        $data['member'] = $this->db->get("daftar_alat")->row_array();
        $data['alat'] = $this->db->query("SELECT * FROM `daftar_alat` INNER JOIN `reader_user` ON `daftar_alat`.`id` = `reader_user`.`id_reader` WHERE daftar_alat.id='$id'")->result_array();
        $data['title'] = "Macco Reader User";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/member_detail', $data);
        $this->load->view('template/footer');
    }

    public function addmask()
    {
        $cek = $this->db->get_where('masker', ['id_masker' => $this->input->post('barcode')])->row_array();
        $this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
        $this->form_validation->set_rules('tag', 'Tag', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Add Mask";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['tag'] = $this->db->get('scanner_machine')->result_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/addmask', $data);
            $this->load->view('template/footer');
        } else if ($cek) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Mask Already Added !
            </div>');
            redirect('admin/addmask');
        } else {
            $data = [
                'id_masker' => $this->input->post('barcode'),
                'tag' => $this->input->post('tag'),
            ];
            $this->db->insert('masker', $data);
            $this->db->where('tag', $this->input->post('tag'));
            $this->db->delete('scanner_machine');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Mask Has Added !
            </div>');
            redirect('admin/addmask');
        }
    }
}
