<?php

/**
* Description of MY_Controller
*
* @author DilkhushYadav
*/
class MY_Controller extends CI_Controller
{
	function __construct(){	

		parent::__construct();

		if (empty(userData())) {
			$this->session->sess_destroy();
		}

		$arr_url=strtok($_SERVER['REQUEST_URI'],'?');
		$arr_url=explode('/', $arr_url);

		if(!$this->session->userdata('login_user')  && current_url() != base_url() && !in_array('login',$arr_url)){
			redirect(base_url());
		}

		if (end($this->uri->segments) != 'get-started' && end($this->uri->segments) != 'onboarding') {

			pr('wfff');die;
			
			if (empty(userData()->onboarding)) {
				redirect(base_url('get-started'));die;
			}
		}
	}
}
