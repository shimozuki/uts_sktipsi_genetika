<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kompetensi_model extends CI_Model
{
    protected $table = "kompetensi";
    public function kopetensi()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $kopetensi = $this->db->get()->result_array();

        if ($kopetensi) {
            $hasil['error'] = false;
            $hasil['message'] = "Data berhasil ditemukan";
            $hasil['data'] = $kopetensi;
        } else {
            $hasil['error'] = true;
            $hasil['message'] = "Data tidak tersedia";
            $hasil['data'] = [];
        }

        header('Content-Type: application/json');
        echo json_encode($hasil);
    }
}