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
			redirect(base_url('admin'));
		}
		$data["content"] = "auth/signin";
		$this->load->view('_layout-plain', $data);
	}

	public function signin()
	{
		if (userData()) {
			redirect(base_url('admin'));
		}
		
		$data['content'] = 'auth/signin';
		$this->load->view('_layout-plain', $data);
	}
	
	public function login()
	{

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == false){
			$data["content"] = "auth/signin";
			$this->load->view('_layout_header', $data);
		}else{

			$email = $this->input->post("email");
			$data = $this->db->where('email',$email)->get("user")->row();

			// pr($data);die;

			if(empty($data)){
				set_message("error", "Your account is invalid");
				redirect(base_url('signin'));
			}
			$check = $data->verified_at;
			
			// pr($check);die;
			
			if(empty($check)){
				set_message("error", "Your account has not been verified yet.");
				redirect(base_url('signin'));
			}

			$data = $this->auth_model->login($email, $this->input->post("password"));

			
			// pr($data);die;

			if($data === 0){
				set_message("error", "Login failed");
				redirect(base_url('signin'));
			}else{
				$sessionData = array(
					'id'          => $data->id,
					'f_name'      => $data->f_name,
					'email'       => $data->email,
					'verified_at' => $data->verified_at,
					'created_at'  => $data->created_at,
				);

				$this->session->set_userdata("login_user", $sessionData);
				redirect(base_url('admin'));
			}
		}
	}

	public function signup()
	{
		if (userData()) {
			redirect(base_url('admin'));
		}

		if ($this->input->post('email')) {

			
			$this->form_validation->set_rules('f_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[40]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');


			// pr('qwef');die;
			if($this->form_validation->run() == false)
			{
				
			// echo "OK";die;
				$data["content"] = "auth/signup";
				$this->load->view('_layout-plain', $data);
			}else{
				// pr('qwef');die;
				
			// echo "No";die;
				$f_name     = $this->input->post('f_name');
				$l_name     = $this->input->post('l_name');
				$email    = $this->input->post('email');
				$password = $this->input->post('password');

				$temp_data = $this->auth_model->reigster($f_name,$l_name,$email,$password);

				if($temp_data == 0){
					set_message("error", "Something went wrong");
					redirect(base_url('auth/signup'));
				}else{
					$insertedId = $this->db->insert_id();
					
					// Create User Details
					// $userDetailsData = array('user_id' => $insertedId,'ip' => $this->input->ip_address());
					// $this->db->insert("user_details", $userDetailsData);
					
					set_message("success", "Account Created");
					redirect(base_url('registerd'));
				}
			}

		}else{
			$data['content'] = 'auth/signup';
			$this->load->view('_layout-plain', $data);
		}
	}

	public function verification($useremail){

		$email = base64_decode($useremail);
		// pr($email);die;
		$verified_at = date('Y-m-d H:i:s');
		$update = $this->db->set('verified_at', $verified_at)->where('email', $email)->update('user');

		if($update){
			set_message("success", "Your account has been verified");
			redirect(base_url('signin'));
		}else{
			set_message("error", "Something went wrong");
			redirect(base_url('registerd'));
		}
	}

	// public function forgotPassword(){
	// 	$data["content"] = "biz/auth/forgot-password";
	// 	$this->load->view('biz/_layout_header', $data);
	// }

	// public function requestToForgot(){
	// 	$requestedEmail    = $this->input->post('email');
	// 	$sentToForgetModel = $this->auth_model->forgetpassword($requestedEmail);

	// 	if($sentToForgetModel === 0){
	// 		$dataResult = array(
	// 			'status' => false,
	// 			'msg'    => 'Email does not exist'
	// 		);
	// 	}else{
	// 		$dataResult = array(
	// 			'status' => true,
	// 			'msg'    => 'A reset password link has been sent to your email <u>'.$requestedEmail.'</u> Please verify it and reset your password.'
	// 		);
	// 	}
	// 	echo json_encode($dataResult);
	// }

	// public function resetPassword($token=null){
	// 	if (!empty($token)) {
	// 		$validateToken = $this->db->where('password_reset_token',$token)->get('users')->row();

	// 		if (empty($validateToken)) {
	// 			redirect(base_url('error-404'));
	// 		}

	// 		$data["password_reset_token"] = $token;
	// 		$data["content"] = "biz/auth/reset-password";
	// 		$this->load->view('biz/_layout_header', $data);
	// 	}else{
	// 		redirect(base_url('error-404'));
	// 	}
	// }

	// public function requestToReset($token=null){
	// 	$newPassword = $this->input->post('password');
	// 	$cPassword   = $this->input->post('cpassword');
	// 	$error_msg   = '';

	// 	if (($newPassword != $cPassword)) {
	// 		$error_msg = 'Password and confirm password do not match';
	// 	}elseif ((strlen($newPassword)<8)) {
	// 		$error_msg = 'Passwords should be a minimum of eight characters in length';
	// 	}elseif ($newPassword=='') {
	// 		$error_msg = 'Passwords is a required field';
	// 	}

	// 	if ($error_msg != '') {
	// 		$dataResult = array(
	// 			'status' => false,
	// 			'msg'    => $error_msg
	// 		);
	// 	}else{
	// 		$sentToResetModel = $this->auth_model->resetpassword($token, $newPassword);
	// 		if($sentToResetModel === 0){
	// 			$dataResult = array(
	// 				'status' => false,
	// 				'msg'    => 'Something went wrong. Please try again later.'
	// 			);
	// 		}else{
	// 			$dataResult = array(
	// 				'status' => true,
	// 				'msg'    => 'Your password has been reset.</br><u><a href="'.base_url('signin').'">Click here</a></u> to sign in.'
	// 			);
	// 		}
	// 	}
	// 	echo json_encode($dataResult);
	// }

	public function logout(){
		$this->session->unset_userdata("login_user");
		redirect(base_url('signin'));
	}
}
