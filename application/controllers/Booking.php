<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	public function addBooking(){

		pr('wvgg');die;
		
		if (!empty($this->input->post())) {
			$userId = userData()->id;

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('l_name', 'Last Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('street', 'Street', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('zip', 'ZIP code', 'required');
			$this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
			$this->form_validation->set_rules('billing_address', 'Billing Address', 'required');

			if($this->form_validation->run() == false){
				$data["content"] = "dashboard/user/edit_profile";
				$this->load->view('dashboard/_layout', $data);
			}else{
				$data = array(
					'phone'  => $this->input->post('phone'),
					'name'   => $this->input->post('name'),
					'l_name' => $this->input->post('l_name')
				);

				$insertUser = $this->db->where('id', $userId)->update('users', $data);

				if ($insertUser) {
					$userData = array(
						'street'            => $this->input->post('street'),
						'city'              => $this->input->post('city'),
						'state'             => $this->input->post('state'),
						'country'           => $this->input->post('country'),
						'zip'               => $this->input->post('zip'),
						'permanent_address' => $this->input->post('permanent_address'),
						'billing_address'   => $this->input->post('billing_address')
					);
					$insertUserDetails = $this->db->where('user_id', $userId)->update('user_details', $userData);
				}

				if ($insertUserDetails) {
					set_message("success", "User has been updated");
				}else{
					set_message("error", "Something went wrong");
				}
				redirect(base_url('profile'));
			}
		}else{
			$data["content"] = "dashboard/user/edit_profile";
			$this->load->view('dashboard/_layout', $data);
		}
	}

}