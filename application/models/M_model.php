<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_model extends CI_Model
{
    public function getSubmenu()
    {
        $query = "SELECT  `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
        return $this->db->query($query)->result_array();
    }

    // public function cek_email($email)
    // {
    //     $this->db->where('email', $email);
    //     $query = $this->db->get('daftar_alat');
    //     if ($query->num_rows() > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
