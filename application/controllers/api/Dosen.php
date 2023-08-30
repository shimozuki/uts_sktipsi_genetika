<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Dosen extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dosen_model', 'model');
    }

    public function get_byid_post()
    {
        $response = $this->model->getById();
        echo json_encode($response);
    }

    public function index_post()
    {
        $response = $this->model->get();
        return $this->response($response);
    }

    public function create_post()
    {
        $response = $this->model->create($this->input->post());
        return $this->response($response);
    }

    public function update_post($id = null)
    {
        $response = $this->model->update($this->input->post(), $id);
        return $this->response($response);
    }

    public function destroy_post($id = null)
    {
        $response = $this->model->destroy($id);
        return $this->response($response);
    }

    public function details_post($id = null)
    {
        $response = $this->model->details($id);
        return $this->response($response);
    }

    public function generateseminar()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            // Get the value of 'generate' parameter
            $generate = $this->input->post('generate');

            // Call the stored procedure using the 'generate' parameter
            $this->db->query("CALL UpdateSeminarSchedule($generate)");

            // Send a response back to the AJAX request
            $response = array('status' => 'success', 'message' => 'Stored procedure executed successfully.');
            echo json_encode($response);
        } else {
            // If not an AJAX request, show an error message or redirect
            $response = array('status' => 'error', 'message' => 'Invalid request.');
            echo json_encode($response);
        }
    }
}

/* End of file Dosen.php */
