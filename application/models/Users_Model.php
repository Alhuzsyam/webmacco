<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users_Model extends CI_Model
{
    public function get_all_user($id = null)
    {
        if ($id == null) {
            return $this->db->get('masker_user')->result_array();
        } else {
            return $this->db->get_where('masker_user', ['id_user' => $id])->result_array();
        }
    }

    public function cek_nik($nik)
    {
        return $this->db->get_where('masker_user', ['nik' => $nik])->result_array();
    }

    public function cek_email($email)
    {
        return $this->db->get_where('masker_user', ['email' => $email])->result_array();
    }

    public function tambah_user($data1)
    {
        return $this->db->insert('masker_user', $data1);
    }
    public function check_tags($tag)
    {
        return $this->db->get_where('scanner_machine', ['tag' => $tag])->result_array();
    }
    public function check_id($id)
    {
        return $this->db->get_where('scanner_machine', ['id_reader' => $id])->result_array();
    }
    public function tambah_tag($data)
    {
        return $this->db->insert('scanner_machine', $data);
    }
    public function check_mask($tag)
    {
        return $this->db->get_where('masker', ['tag' => $tag])->row_array();
    }
    public function tambah_mreader($read)
    {
        return $this->db->insert('masker_raders', $read);
    }
    public function get_masker($id_masker)
    {
        return $this->db->select('*')->get_where("masker", ['id_masker' => $id_masker])->row_array();
    }
    public function daftar_masker($id_user, $id_masker)
    {
        return $this->db->set(['id_user' => $id_user])->where(['id_masker' => $id_masker])->update('masker');
    }
    public function get_location()
    {
        return $this->db->get_where('daftar_alat')->result_array();
    }
    public function set_loc($base_location, $id)
    {
        return  $this->db->update('masker_user', $base_location, array('id_user' => $id));
    }
}
