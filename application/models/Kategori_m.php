<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('kategori_partner');
        if ($id != null) {
            $this->db->where('id_partner', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
