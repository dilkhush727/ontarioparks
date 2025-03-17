<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public $_table = "users";

	// public function login($email, $password){
	// 	$data = $this->db->where("email", $email)->get($this->_table)->row();
	// 	if(app_hasher()->CheckPassword($password, $data->password)){
	// 		return $data;
	// 	}else{
	// 		return 0;
	// 	}
	// }

	public function reigster($name, $email, $password)
	{
		$password = app_hasher()->HashPassword($password);
		$userData = array(
			"name"    => $name,
			"email"    => $email,
			"password" => $password
		);
		$this->db->insert("users", $userData);

		$verifyPath  = base_url('verifyEmail/').base64_encode($email);
		$subject     = 'Registration Successful';
		$template    = $this->load->view('emailtemplates/register','',true);
		$template    = str_replace(array("{{verifyPath}}", "{{name}}"), array($verifyPath, $name), $template);

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
	// 		$this->db->set("password_reset_token", $generateToken)->where("email", $email)->update("users");

	// 		$this->mail($email, "<h1>Welcome to Eazedesk,<h1><br><h3> Your password reset link is as below. Please click on the link and reset your passwrd</h3><br><p> Click here: <a href='".base_url('resetpassword/'.$generateToken)."'>Reset Password</a><p>", "Forgot Password");
	// 		return $generateToken;
	// 	}else{
	// 		return 0;
	// 	}
	// }

	// public function resetpassword($fp_token = null, $password = null)
	// {
	// 	if($password != null && $fp_token != null){
	// 		$password = app_hasher()->HashPassword($password);
	// 		$temp_data = $this->db->where("password_reset_token", $fp_token)->get("users")->num_rows();
	// 		if($temp_data == 1){
	// 			$this->db->set("password", $password)->set("password_reset_token", null)->where("password_reset_token", $fp_token)->update("users");
	// 		}
	// 		// $this->mail($email, "<h1>Welcome to Eazedesk.<h1><br><h3> Your password has beed rest successfully.</h3><br><p> Click here: <a href='".base_url('forget-password/'.$temp_data)."'>Reset Password</a><p>", "Reset Password");
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

	// public function mail($email = NULL, $content = NULL, $subject = NULL)
	// {
	// 	$this->load->library('phpmailer_lib');

	// 	$mail = $this->phpmailer_lib->load();

	// 	$mail->addAddress($email);

	// 	$mail->Subject = 'Eazedesk :: '.$subject;

	// 	$mail->isHTML(true);

	// 	$mailContent = '<!doctype html><html><head><meta name="viewport" content="width=device-width" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body {background-color: #f6f6f6;font-family: sans-serif;-webkit-font-smoothing: antialiased;font-size: 14px;line-height: 1.4;margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;}table {border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;}table td {font-family: sans-serif;font-size: 14px;vertical-align: top;}/* -------------------------------------BODY & CONTAINER------------------------------------- */.body {background-color: #f6f6f6;width: 100%;}/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will alsoshrink down on a phone or something */.container {display: block;margin: 0 auto !important;/* makes it centered */max-width: 680px;padding: 10px;width: 680px;}/* This should also be a block element, so that it will fill 100% of the .container */.content {box-sizing: border-box;display: block;margin: 0 auto;max-width: 680px;padding: 10px;}/* -------------------------------------HEADER, FOOTER, MAIN------------------------------------- */.main {background: #fff;border-radius: 3px;width: 100%;}.wrapper {box-sizing: border-box;padding: 20px;}.footer {clear: both;padding-top: 10px;text-align: center;width: 100%;}.footer td,.footer p,.footer span,.footer a {color: #999999;font-size: 12px;text-align: center;}hr {border: 0;border-bottom: 1px solid #f6f6f6;margin: 20px 0;}/* -------------------------------------RESPONSIVE AND MOBILE FRIENDLY STYLES------------------------------------- */@media only screen and (max-width: 620px) {table[class=body] .content {padding: 0 !important;}table[class=body] .container {padding: 0 !important;width: 100% !important;}table[class=body] .main {border-left-width: 0 !important;border-radius: 0 !important;border-right-width: 0 !important;}}</style></head><body class=""><table border="0" cellpadding="0" cellspacing="0" class="body"><tr><td>&nbsp;</td><td class="container"><div class="content"><!-- START CENTERED WHITE CONTAINER --><table class="main"><!-- START MAIN CONTENT AREA --><tr><td class="wrapper"><table border="0" cellpadding="0" cellspacing="0"><tr><td>'.$content.'</td></tr></table></td></tr><!-- END MAIN CONTENT AREA --></table><!-- START FOOTER --><div class="footer"><table border="0" cellpadding="0" cellspacing="0"><tr><td class="content-block"><span>Eazedesk</span></td></tr></table></div><!-- END FOOTER --><!-- END CENTERED WHITE CONTAINER --></div></td><td>&nbsp;</td></tr></table></body></html>';
	// 	$mail->Body = $mailContent;

	// 	if(!$mail->send()){
	// 		$response = "error";
	// 		$msg = 'Message could not be sent.';
	// 	}else{
	// 		$response = "success";
	// 		$msg = 'Message has been sent';
	// 	}
	// 	return $msg;
	// }
}