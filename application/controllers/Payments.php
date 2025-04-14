<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

	public function checkout()
	{
		if(!empty($this->input->post())){
			// pr($this->input->post());die;

			$userId = userData()->id;

			// Get total from cart
			$cartData = getCart();
			$total = $cartData['total'];

			// Get form data
			$address         = $this->input->post('address');
			$postalcode      = $this->input->post('postalcode');
			$city            = $this->input->post('city');
			$province        = $this->input->post('province');
			$payment_method  = $this->input->post('payment_method');
			$payment_token   = get_token(16);

			// Validate
			if (!$address || !$postalcode || !$city || !$province || !$payment_method || $total <= 0) {
				$this->session->set_flashdata('error', 'Please complete all required fields.');
				redirect(base_url('checkout'));
				return;
			}


			$paymentData = array(
				'u_id'           => $userId,
				'payment_token'  => $payment_token,
				'address'        => $address,
				'postal_code'    => $postalcode,
				'city'           => $city,
				'province'       => $province,
				'payment_method' => $payment_method,
				'total'          => $total
			);

			// pr($paymentData);die;

			$this->db->insert('payment', $paymentData);

			$this->db->where('u_id', $userId)->delete('cart');

			$this->session->set_flashdata('success', 'Payment completed successfully.');
			redirect('payment-status/' . $payment_token);

			
		}else{
			$data["content"] = "dashboard/payments/checkout";
			$this->load->view('_layout', $data);
		}
	}

	public function success($token)
	{
		$data['paymentDetails'] = $this->db
			->where('payment_token', $token)
			->limit(1)
			->get('payment')
			->row();

		$data["content"] = "dashboard/payments/success";
		$this->load->view('_layout', $data);
	}

}