<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function signup()
	{
		$data['content'] = 'signup';
		$this->load->view('biz/_layout', $data);
	}
}
