<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{

    public function getData($table)
    {
        $data = $this->db->get_where($table, array('mahasiswa_id' => $this->input->post('mahasiswa_id')))->result();
        echo json_encode($data);
    }

    public function getAllData($table)
    {
        $data = $this->db->get_where($table)->result();
        echo json_encode($data);
    }

    public function updateSeminarSchedule()
	{
		// Check if the request is an AJAX request
		if ($this->input->is_ajax_request()) {

			// Call the stored procedure using the 'generate' parameter
			$this->db->query("CALL UpdateSeminarSchedule()");

			// Send a response back to the AJAX request
			$response = array('status' => 'success', 'message' => 'Stored procedure executed successfully.');
			echo json_encode($response);
		} else {
			// If not an AJAX request, show an error message or redirect
			$response = array('status' => 'error', 'message' => 'Invalid request.');
			// $this->response($response, 400); // Send response without echoing JSON
			echo json_encode($response);
		}
	}
	public function updateSkripsi()
	{
		// Check if the request is an AJAX request
		if ($this->input->is_ajax_request()) {

			// Call the stored procedure using the 'generate' parameter
			$this->db->query("CALL ScheduleSkripsi()");

			// Send a response back to the AJAX request
			$response = array('status' => 'success', 'message' => 'Stored procedure executed successfully.');
			echo json_encode($response);
		} else {
			// If not an AJAX request, show an error message or redirect
			$response = array('status' => 'error', 'message' => 'Invalid request.');
			// $this->response($response, 400); // Send response without echoing JSON
			echo json_encode($response);
		}
	}
	
}


/* End of file Crud.php */
