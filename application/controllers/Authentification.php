<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentification extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Pasword', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Login";
            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/masuk');
            $this->load->view('auth/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Password !
                    </div>');
                    redirect('authentification');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This Email has been not Activated !
                </div>');
                redirect('authentification');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered !
           </div>');
            redirect('authentification');
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', [
            'is_unique' => 'this email has already regitered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
            'matches'     => 'Password dont match!',
            'min_length'  => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Ragistration";
            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/mendaftar');
            $this->load->view('auth/auth_footer');
        } else {
            $data = [
                'name'      =>  htmlspecialchars($this->input->post('name', true)),
                'email'     =>  htmlspecialchars($this->input->post('email', true)),
                'image'     => 'default.svg',
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'   => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $data2 = [
                'penaggung_jawab'      =>  htmlspecialchars($this->input->post('name', true)),
                'email'     =>  htmlspecialchars($this->input->post('email', true)),
                'Jenis_instansi' => '-',
                'negara' => '-',
                'telephone' => '-',
                'hp' => '-',
                'nama_instansi' => '-',
                'username' => '-',
                'alamat' => '-',
                'kota' => '-',
                'foto' => 'defaultgedung.jpg',
                'longitude' => '-',
                'latitude' => '-',
            ];

            $this->db->insert('daftar_alat', $data2);
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Congratulation your account has been created. Please Login ! 
          </div>');
            redirect('authentification');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out! 
       </div>');
        redirect('authentification');
    }

    public function block()
    {
        $this->load->view('auth/blocked');
    }

    // public function registration()
    // {
    // $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[daftar_alat.email]', [
    //     'is_unique' => 'this email has already regitered'
    // ]);
    // $this->form_validation->set_rules('jinstansi', 'Jinstansi', 'trim|required');
    // $this->form_validation->set_rules('country_selector', 'Negara', 'trim|required');
    // $this->form_validation->set_rules('telp', 'Telphone', 'trim|required');
    // $this->form_validation->set_rules('hp', 'Handphone', 'trim|required');
    // $this->form_validation->set_rules('instansi', 'instansi', 'trim|required');
    // $this->form_validation->set_rules('username', 'Username', 'trim|required');
    // $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
    // $this->form_validation->set_rules('foto', 'Foto', 'trim|required');
    // $this->form_validation->set_rules('alamat_lengkap', 'Alamat', 'trim|required');
    // $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
    // if ($this->form_validation->run() == TRUE) {


    // $data = [
    //     'penaggung_jawab' => $this->input->post('nama'),
    //     'email' => $this->input->post('email'),
    //     'Jenis_instansi' => $this->input->post('jinstansi'),
    //     'negara' => $this->input->post('country_selector'),
    //     'telephone' => $this->input->post('telp'),
    //     'hp' => $this->input->post('hp'),
    //     'nama_instansi' => $this->input->post('instansi'),
    //     'username' => $this->input->post('username'),
    //     'alamat' => $this->input->post('alamat_lengkap'),
    //     'kota' => $this->input->post('kota'),
    //     'foto' => 'avatar.png',
    //     'longitude' => $this->input->post('long'),
    //     'latitude' => $this->input->post('lat'),
    // ];
    // $this->db->insert('daftar_alat', $data);
    // redirect("authentification/registration");
    // } else {
    //     $data['instansi'] = $this->db->get("instansi")->result_array();
    //     $data['title'] = "Ragistration";
    //     $this->load->view('auth/auth_header', $data);
    //     $this->load->view('auth/daftar', $data);
    //     $this->load->view('auth/auth_footer');
    // }
    // }

}
