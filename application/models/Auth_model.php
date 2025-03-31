<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public $_table = "user";

	public function login($email, $password){
		$data = $this->db->where("email", $email)->get($this->_table)->row();
		if(app_hasher()->CheckPassword($password, $data->password)){
			return $data;
		}else{
			return 0;
		}
	}

	public function reigster($f_name, $email, $password)
	{
		$password = app_hasher()->HashPassword($password);

		// pr($password);die;
		
		$userData = array(
			"f_name"    => $f_name,
			"email"    => $email,
			"password" => $password
		);
		$this->db->insert("user", $userData);

		$verifyPath  = base_url('verifyEmail/').base64_encode($email);
		$subject     = 'Registration Successful';
		$template    = $this->load->view('emailtemplates/register','',true);
		$template    = str_replace(array("{{verifyPath}}", "{{f_name}}"), array($verifyPath, $f_name), $template);

		$this->mail($email, $template, $subject);
		if($this->db->insert_id() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	// public function forgetpassword($email = null)
	// {
	// 	if($this->checkuser($email)){
	// 		$generateToken = get_token(40);
	// 		$this->db->set("password_reset_token", $generateToken)->where("email", $email)->update("user");

	// 		$this->mail($email, "<h1>Welcome to CampMate,<h1><br><h3> Your password reset link is as below. Please click on the link and reset your passwrd</h3><br><p> Click here: <a href='".base_url('resetpassword/'.$generateToken)."'>Reset Password</a><p>", "Forgot Password");
	// 		return $generateToken;
	// 	}else{
	// 		return 0;
	// 	}
	// }

	// public function resetpassword($fp_token = null, $password = null)
	// {
	// 	if($password != null && $fp_token != null){
	// 		$password = app_hasher()->HashPassword($password);
	// 		$temp_data = $this->db->where("password_reset_token", $fp_token)->get("user")->num_rows();
	// 		if($temp_data == 1){
	// 			$this->db->set("password", $password)->set("password_reset_token", null)->where("password_reset_token", $fp_token)->update("user");
	// 		}
	// 		// $this->mail($email, "<h1>Welcome to CampMate.<h1><br><h3> Your password has beed rest successfully.</h3><br><p> Click here: <a href='".base_url('forget-password/'.$temp_data)."'>Reset Password</a><p>", "Reset Password");
	// 		return 1;
	// 	}else{
	// 		return 0;
	// 	}
	// }

	// public function checkuser($email = null)		
	// {
	// 	if($email == null){
	// 		return false;
	// 	}else{
	// 		$data = $this->db->where('email', $email)->get($this->_table)->num_rows();
	// 		if($data == 1){
	// 			return true;
	// 		}else{
	// 			return false;
	// 		}
	// 	}
	// }

	public function mail($email = NULL, $content = NULL, $subject = NULL)
	{
		$this->load->library('phpmailer_lib');

		$mail = $this->phpmailer_lib->load();

		$mail->addAddress($email);

		$mail->Subject = 'CampMate :: '.$subject;

		$mail->isHTML(true);

		$mailContent = $content;
		$mail->Body = $mailContent;

		if(!$mail->send()){
			$response = "error";
			$msg = 'Message could not be sent.';
		}else{
			$response = "success";
			$msg = 'Message has been sent';
		}
		return $msg;
	}
}