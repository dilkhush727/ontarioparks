<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gearguide extends MY_Controller {

	public function index()
	{
		$data["content"] = "admin/gear-guide";
		$this->load->view('_layout', $data);
	}
}