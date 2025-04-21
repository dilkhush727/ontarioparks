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

	public function addToCart($planId)
	{
		// pr($this->input->post());die;

		$items = json_decode($this->input->post('items'), true);
		$userId = userData()->id;
		$plan_id = $planId;

		if (!$items || !$userId) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
			return;
		}

		$this->db->where('u_id', $userId)->delete('cart');

		foreach ($items as $item) {
			$this->db->insert('cart', [
				'u_id' => $userId,
				'plan_id' => $plan_id,
				'item' => $item['title'],
				'price' => $item['price']
			]);
		}
		echo json_encode(['status' => 'success']);
	}

	public function getParks()
	{
		$search = $this->input->get('search'); // Correct for CI3

		if (!empty($search)) {
			// Case-insensitive search using UPPER
			$encodedSearch = "where=upper(NAME)+like+%27%25" . strtoupper(urlencode($search)) . "%25%27";
		} else {
			$encodedSearch = "where=1%3D1"; // No filter
		}

		// Ontario Parks API endpoint
		$apiUrl = "https://geohub.lio.gov.on.ca/arcgis/rest/services/OpenData/ProvincialPark/MapServer/0/query?$encodedSearch&outFields=*&f=geojson";

		// Fetch API using cURL
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_URL => $apiUrl
		]);

		$response = curl_exec($curl);
		$data['error'] = '';
		$data['parks'] = [];

		if (curl_errno($curl)) {
			$data['error'] = 'cURL error: ' . curl_error($curl);
		} else {
			$json = json_decode($response, true);

			if (isset($json['features']) && is_array($json['features'])) {
				$data['parks'] = $json['features'];
			} else {
				$data['error'] = 'No data returned from API.';
			}
		}

		$data['search'] = $search;
		curl_close($curl);

		// Load view through your layout
		$data["content"] = "dashboard/gear-guide/parks";
		$this->load->view('_layout', $data);
	}

}