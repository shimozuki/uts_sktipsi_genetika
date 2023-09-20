<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KompetensiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getKompetensi() {
        $this->db->select('*');
        $this->db->from('kompetensi');
        $query = $this->db->get();
        $result = $query->result();
        
        echo json_encode($result);
    }
}
