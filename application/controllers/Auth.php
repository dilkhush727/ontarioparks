<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("auth_model");	
		$this->load->library('session');
       	// require_once(APPPATH.'libraries/recaptcha.php');
	}

	public function index()
	{
		if (userData()) {
			redirect(base_url('dashboard'));
		}
		$data["content"] = "auth/signin";
		$this->load->view('_layout-plain', $data);
	}

	public function signup()
	{
		if (userData()) {
			redirect(base_url('dashboard'));
		}
		$data["content"] = "auth/signup";
		$this->load->view('_layout-plain', $data);
	}

	public function signin()
	{
		$data['content'] = 'signin';
		$this->load->view('biz/_layout-plain', $data);
	}

	

	// public function signup()
	// {
	// 	$data['content'] = 'signup';
	// 	$this->load->view('biz/_layout-plain', $data);
	// }

	public function signup_request()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[40]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

		if($this->form_validation->run() == false)
		{
			$data["content"] = "signup";
			$this->load->view('biz/_layout-plain', $data);
		}else{
			$name     = $this->input->post('name');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			$temp_data = $this->auth_model->reigster($name,$email,$password);

			if($temp_data == 0){
				set_message("error", "Something went wrong");
				redirect(base_url('signup'));
			}else{
				$insertedId = $this->db->insert_id();
				
				// Create User Details
				$userDetailsData = array('user_id' => $insertedId,'ip' => $this->input->ip_address());
				$this->db->insert("user_details", $userDetailsData);
				
				set_message("success", "Account Created");
				redirect(base_url('registerd'));
			}
		}
	}
}
