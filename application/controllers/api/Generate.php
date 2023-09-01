<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Generate extends REST_Controller
{

public function updateSeminarSchedule()
	{
		// Check if the request is an AJAX request
		if ($this->input->is_ajax_request()) {
			// Get the value of 'generate' parameter

			// Call the stored procedure using the 'generate' parameter
			$this->db->query("CALL UpdateSeminarSchedule()");

			// Send a response back to the AJAX request
			$response = array('status' => 'success', 'message' => 'Stored procedure executed successfully.');
			echo $response; // Send response without echoing JSON
		} else {
			// If not an AJAX request, show an error message or redirect
			$response = array('status' => 'error', 'message' => 'Invalid request.');
			// $this->response($response, 400); // Send response without echoing JSON
			echo $response;
		}
	}
}