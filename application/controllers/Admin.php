<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function index()
	{
		$data["content"] = "admin/dashboard";
		$this->load->view('_layout', $data);
	}
}