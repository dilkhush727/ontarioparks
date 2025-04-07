<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- <div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div class="col-md-6 m-auto">

				<div class="text-center mt-5">
					<h1>Is this Your First Time Camping?</h1>
				</div>

				<form method="post" class="auth-form" action="<?= base_url('auth/login') ?>">
					<div>
						<input type="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>" required>
						<?= form_error('email', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>

					<div>
						<input type="password" name="password" placeholder="Password" required>
						<?= form_error('password', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>
					
					<div class="text-center m-2">
						<button type="submit" class="btn rounded-pill btn-theme mb-3">Sign In</button>
					</div>
				</form>


				<div class="">
					<p>Don`t have an account?
						<a href="<?=base_url('auth/signup')?>"><u>Sign Up</u></a>
					</p>
				</div>
			</div>
		
		</div>
		<img src="<?=base_url(); ?>assets/images/sloth.png" alt="">
	</div>
</div> -->

<section class="wizard-section">
	<div class="container">
		<div class="row no-gutters">
			<!-- <div class="col-lg-6 col-md-6">
				<div class="wizard-content-left d-flex justify-content-center align-items-center">
					<h1>Is this Your First Time Camping?</h1>
				</div>
			</div> -->
			<div class="col-lg-12 col-md-12">
				<div class="form-wizard">
					<form action="<?=base_url('onboarding')?>" method="post" role="form" id="bookingForm">
						<!-- <div class="form-wizard-header">
							<ul class="list-unstyled form-wizard-steps clearfix">
								<li class="active"><span>1</span></li>
								<li><span>2</span></li>
								<li><span>3</span></li>
								<li><span>4</span></li>
							</ul>
						</div> -->
						<fieldset class="wizard-fieldset mt-5 show">
							<h2 class="text-center">Is this Your First Time Camping?</h2>
							<div class="form-group radio-flex">
								<div>
									<img src="<?=base_url(); ?>assets/images/first-time-bear.png" width="200">
								</div>
								<div>
									<div class="wizard-form-radio mb-3">
										<input name="onboarding" id="radio1" type="radio" value="1" checked>
										<label for="radio1">Yes</label>
									</div>
									<div class="wizard-form-radio">
										<input name="onboarding" id="radio2" type="radio" value="0">
										<label for="radio2">No</label>
									</div>
								</div>
							</div>
							<div class="form-group clearfix d-flex justify-content-center">
								<a href="javascript:;" class="form-wizard-next-btn float-right"><i class="fa fa-arrow-right"></i></a>
							</div>
						</fieldset>	
						<fieldset class="wizard-fieldset mt-5">
							<h2 class="text-center">Add Your Reservation Details</h2>
							<div class="form-group">
								<input type="date" class="form-control wizard-required" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
								<label for="date" class="wizard-form-text-label label-clicked">Date</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group">
								<input type="text" name="park" class="form-control wizard-required" id="park">
								<label for="park" class="wizard-form-text-label">Park</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group">
								<input type="time" name="time" class="form-control wizard-required" id="time" value="<?php echo date('h:i'); ?>">
								<label for="time" class="wizard-form-text-label label-clicked">Time</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group clearfix d-flex justify-content-center gap-3">
								<a href="javascript:;" class="form-wizard-previous-btn float-left"><i class="fa fa-arrow-left"></i></a>
								<a href="javascript:;" class="form-wizard-submit float-right" id="submitBooking"><i class="fa fa-check"></i></a>
							</div>
						</fieldset>	
						<!-- <fieldset class="wizard-fieldset">
							<h5>Bank Information</h5>
							<div class="form-group">
								<input type="text" class="form-control wizard-required" id="bname">
								<label for="bname" class="wizard-form-text-label">Bank Name*</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control wizard-required" id="brname">
								<label for="brname" class="wizard-form-text-label">Branch Name*</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control wizard-required" id="acname">
								<label for="acname" class="wizard-form-text-label">Account Name*</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control wizard-required" id="acon">
								<label for="acon" class="wizard-form-text-label">Account Number*</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group clearfix">
								<a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
								<a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
							</div>
						</fieldset>	
						<fieldset class="wizard-fieldset">
							<h5>Payment Information</h5>
							<div class="form-group">
								Payment Type
								<div class="wizard-form-radio">
									<input name="radio-name" id="mastercard" type="radio">
									<label for="mastercard">Master Card</label>
								</div>
								<div class="wizard-form-radio">
									<input name="radio-name" id="visacard" type="radio">
									<label for="visacard">Visa Card</label>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control wizard-required" id="honame">
								<label for="honame" class="wizard-form-text-label">Holder Name*</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<input type="text" class="form-control wizard-required" id="cardname">
										<label for="cardname" class="wizard-form-text-label">Card Number*</label>
										<div class="wizard-form-error"></div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<input type="text" class="form-control wizard-required" id="cvc">
										<label for="cvc" class="wizard-form-text-label">CVC*</label>
										<div class="wizard-form-error"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">Expiry Date</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<select class="form-control">
											<option value="">Date</option>
											<option value="">1</option>
											<option value="">2</option>
											<option value="">3</option>
											<option value="">4</option>
											<option value="">5</option>
											<option value="">6</option>
											<option value="">7</option>
											<option value="">8</option>
											<option value="">9</option>
											<option value="">10</option>
											<option value="">11</option>
											<option value="">12</option>
											<option value="">13</option>
											<option value="">14</option>
											<option value="">15</option>
											<option value="">16</option>
											<option value="">17</option>
											<option value="">18</option>
											<option value="">19</option>
											<option value="">20</option>
											<option value="">21</option>
											<option value="">22</option>
											<option value="">23</option>
											<option value="">24</option>
											<option value="">25</option>
											<option value="">26</option>
											<option value="">27</option>
											<option value="">28</option>
											<option value="">29</option>
											<option value="">30</option>
											<option value="">31</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<select class="form-control">
											<option value="">Month</option>
											<option value="">jan</option>
											<option value="">Feb</option>
											<option value="">March</option>
											<option value="">April</option>
											<option value="">May</option>
											<option value="">June</option>
											<option value="">Jully</option>
											<option value="">August</option>
											<option value="">Sept</option>
											<option value="">Oct</option>
											<option value="">Nov</option>
											<option value="">Dec</option>	
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<select class="form-control">
											<option value="">Years</option>
											<option value="">2019</option>
											<option value="">2020</option>
											<option value="">2021</option>
											<option value="">2022</option>
											<option value="">2023</option>
											<option value="">2024</option>
											<option value="">2025</option>
											<option value="">2026</option>
											<option value="">2027</option>
											<option value="">2028</option>
											<option value="">2029</option>
											<option value="">2030</option>
											<option value="">2031</option>
											<option value="">2032</option>
											<option value="">2033</option>
											<option value="">2034</option>
											<option value="">2035</option>
											<option value="">2036</option>
											<option value="">2037</option>
											<option value="">2038</option>
											<option value="">2039</option>
											<option value="">2040</option>	
										</select>
									</div>
								</div>
							</div>
							<div class="form-group clearfix">
								<a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
								<a href="javascript:;" class="form-wizard-submit float-right">Submit</a>
							</div>
						</fieldset>	 -->
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){
		$("#submitBooking").on("click", function(){
			$("#bookingForm").submit();
		});
	});
</script>