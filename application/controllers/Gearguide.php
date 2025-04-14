<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gearguide extends MY_Controller {

	public function index()
	{
		$data["content"] = "dashboard/gear-guide/gear-guide";
		$this->load->view('_layout', $data);
	}
	public function pricing($id)
	{
		$plan_id = $id;
		
        $data['price_details'] = $this->db->where('id', $plan_id)->get('pricing')->row();

		$data["content"] = "dashboard/gear-guide/gear-guide-plan";
		$this->load->view('_layout', $data);
	}

	public function addToCart()
	{
		// pr($this->input->post());die;

		$items = json_decode($this->input->post('items'), true);
		$userId = userData()->id;

		
		// pr($userId);die;

		if (!$items || !$userId) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
			return;
		}

		foreach ($items as $item) {
			$this->db->insert('cart', [
				'u_id' => $userId,
				'item' => $item['title'],
				'price' => $item['price']
			]);
		}
		echo json_encode(['status' => 'success']);
	}
}