<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		$data['content'] = 'biz/home';
		$this->load->view('biz/_layout-plain', $data);
	}
}
