<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function pages()
	{
		$pageName = end($this->uri->segments);
		$data["content"] = 'pages/'.$pageName;
		$this->load->view('_layout', $data);
	}
}