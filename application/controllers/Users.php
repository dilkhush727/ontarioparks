<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	public function getStarted(){
		
		if (!empty(userData()->onboarding)) {
			redirect(base_url('dashboard'));die;
		}

		$data["content"] = "dashboard/get-started";
		$this->load->view('_layout', $data);
	}

	public function profile(){
		$data["content"] = "dashboard/user/profile";
		$this->load->view('dashboard/_layout', $data);
	}

	public function editProfile(){
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

	public function uploadUserImage(){
		$uploadPath = FCPATH.'/uploads/users/';
		$userImageCurrent = userData()->image;
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0777, TRUE);
		}

		$config['upload_path']   = $uploadPath; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
		$config['max_size']      = 1024;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors()); 
			$this->load->view('profile', $error); 
		}else {
			$uploadedImage = $this->upload->data();
			$this->resizeImage($uploadedImage['file_name']);

			$query = $this->db->where('id', userData()->id)->set('image', $uploadedImage['file_name'])->update('users');

			if (!empty($userImageCurrent)) {
				unlink($uploadPath.$userImageCurrent);
				unlink($uploadPath.'thumbnail/'.$userImageCurrent);
			}
			echo $uploadPath.userData()->image;die;
		}
	}

	public function resizeImage($filename)
	{
		$source_path = FCPATH.'/uploads/users/' . $filename;
		$target_path = FCPATH.'/uploads/users/thumbnail/';

		if (!is_dir($target_path)) {
			mkdir($target_path, 0777, TRUE);
		}

		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
			'width' => 150,
			'height' => 150
		);
		$this->load->library('image_lib', $config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
		$this->image_lib->clear();
	}

	public function onBoarding(){

		if (!empty($this->input->post())) {

			$userId = userData()->id;

			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('time', 'Time', 'required');
			$this->form_validation->set_rules('park', 'Park', 'required');

			if($this->form_validation->run() == false){
				$data["content"] = "dashboard/get-started";
				$this->load->view('_layout', $data);
			}else{

				$status = $this->input->post('onboarding');

				$userDataOnboarding = array(
					'status' => $status,
					'onboarding' => 1
				);

				

				// pr($status);

				// pr($userDataOnboarding);die;

				$insertOnboarding = $this->db->where('id', $userId)->update('user', $userDataOnboarding);



				// if(!empty($this->input->post('date') && $this->input->post('park') && $this->input->post('time'))){
				
					$dataBooking = array(
						'u_id'  => $userId,
						'date'  => $this->input->post('date'),
						'park'   => $this->input->post('park'),
						'time' => date("H:i:s", strtotime($this->input->post('time')))
					);

					// pr($dataBooking);die;

					$this->db->insert('booking', $dataBooking);

					// if ($insertBookingDetails) {
					// 	set_message("success", "User has been updated");
					// }else{
					// 	set_message("error", "Something went wrong");
					// }

				// }

				// pr($dataBooking);die;
				
				if ($insertOnboarding) {
					set_message("success", "Onboarding has been completed!");
				}else{
					set_message("error", "Something went wrong");
				}
					

				redirect(base_url('gear-guide'));
			}
		}else{
			$data["content"] = "get-started";
			$this->load->view('_layout', $data);
		}
	}

	public function addFriend() {
		$friendId = $this->input->post('friend_id');
		$userId = userData()->id;
	
		if (!$friendId || !$userId) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
			return;
		}
		
		$this->db->where('u_id', $userId);
		$this->db->where('f_id', $friendId);
		$query = $this->db->get('friend');
	
		if ($query->num_rows() > 0) {
			echo json_encode(['status' => 'error', 'message' => 'Friendship already exists']);
			return;
		}
		
		$insert = $this->db->insert('friend', [
			'u_id' => $userId,
			'f_id' => $friendId
		]);
	
		if ($insert) {
			echo json_encode(['status' => 'success', 'message' => 'Friend added successfully']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to add friend']);
		}
	}

	public function removeFriend() {
		// Get the friend ID from the request
		$friendId = $this->input->post('friend_id');
		$userId = userData()->id;
	
		if (!$friendId || !$userId) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
			return;
		}
	
		// Check if the friendship exists
		$this->db->where('u_id', $userId);
		$this->db->where('f_id', $friendId);
		$query = $this->db->get('friend');
	
		if ($query->num_rows() == 0) {
			echo json_encode(['status' => 'error', 'message' => 'Friendship does not exist']);
			return;
		}
	
		// Delete the friendship record
		$this->db->where('u_id', $userId);
		$this->db->where('f_id', $friendId);
		$delete = $this->db->delete('friend');
	
		if ($delete) {
			echo json_encode(['status' => 'success', 'message' => 'Friend removed successfully']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to remove friend']);
		}
	}

	public function addNewFriends(){
		$data["content"] = "dashboard/users/add-new-friends";
		$this->load->view('_layout', $data);
	}
	

}