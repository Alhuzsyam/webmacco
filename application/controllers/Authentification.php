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
            $email = $this->input->post('email', true);
            $data = [
                'name'      =>  htmlspecialchars($this->input->post('name', true)),
                'email'     =>  htmlspecialchars($email),
                'image'     => 'default.svg',
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'   => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            $data2 = [
                'penaggung_jawab'      =>  htmlspecialchars($this->input->post('name', true)),
                'email'     =>  htmlspecialchars($email),
                'Jenis_instansi' => '-',
                'negara' => '-',
                'telephone' => '-',
                'hp' => '-',
                'nama_instansi' => '-',
                'username' => '-',
                'alamat' => '-',
                'kota' => '-',
                'foto' => 'defaultgedung.svg',
                'longitude' => '-',
                'latitude' => '-',
            ];

            $length = 32;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $token = $randomString;
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date' => time()
            ];
            $this->db->insert('daftar_alat', $data2);
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Congratulation your account has been created. Check Your email to Activate ! 
          </div>');
            redirect('authentification');
        }
    }
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            //'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_host' => 'smtp.gmail.com',
            // 'smtp_user' => 'Maccomask@gmail.com',
            // 'smtp_pass' => 'Alhamdulillah12345678',
            'smtp_user' => 'alhuzwirialfi@gmail.com',
            'smtp_pass' => '@alhuzwirifi12345678',
            'smtp_port' => '587',
            'smtp_crypto' => 'tls',
            'smtp_timeout' => '30',
            'charset' => 'iso-8859-1',
            'newline' => "\r\n",
            'wordwrap' => TRUE,
            'mailtype' => 'html'
        ];
        // $mail = $this->load->view('email/activation');
        $this->email->initialize($config);
        $this->email->from('Maccomask@gmail.com', 'Macco Masker');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Aktivasi Akun Macco Member');
            $this->email->message('Click this link to verify this account <a href="' . base_url('Authentification/verify?email=') . $this->input->post('email') . '&' . 'token=' . $token . '">Activate</a> ');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            // $this->email->message($mail);
            $this->email->message('Click this link to reset your password <a href="' . base_url('Authentification/resetpassword?email=') . $this->input->post('email') . '&' . 'token=' . $token . '">Reset Password</a> ');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
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
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    ' . $email . 'Has Activated' . 'Please Login' . ' 
                   </div>');
                    redirect('authentification');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Activation Failed Token expired! 
                   </div>');
                    redirect('authentification');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Activation Failed Wrong Token! 
           </div>');
                redirect('authentification');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Activation Failed Wrong Email! 
           </div>');
            redirect('authentification');
        }
    }
    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Forgot Password";
            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('auth/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $length = 32;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $token = $randomString;
                $data = [
                    'email' => $email,
                    'token' =>  $token,
                    'date'  =>  time()
                ];
                $this->db->insert('user_token', $data);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Check Your email to reset your password! 
                   </div>');
                redirect('authentification/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email is not registered or Activated! 
                   </div>');
                redirect('authentification/forgotpassword');
            }
        }
    }
    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset Password Failed, Wrong Token! 
           </div>');
                redirect('authentification');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset Password Failed, Wrong Email! 
           </div>');
            redirect('authentification');
        }
    }
    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('authentification');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Change Password";
            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('auth/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pasword has ben change, Pleae login! 
           </div>');
            redirect('authentification');
        }
    }
}
