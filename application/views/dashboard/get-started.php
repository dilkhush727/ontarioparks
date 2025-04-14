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
						<fieldset class="wizard-fieldset mt-5 show">
							<h2 class="text-center mb-3">Is this Your First Time Camping?</h2>
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
							<h2 class="text-center mb-5">Add Your Reservation Details</h2>
							<div class="form-group">
								<input type="date" class="form-control wizard-required" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
								<label for="date" class="wizard-form-text-label label-clicked">Date</label>
								<div class="wizard-form-error"></div>
							</div>
							<div class="form-group">
								<input type="text" name="park" class="form-control wizard-required" id="park" required>
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
								<a href="javascript:;" class="form-wizard-next-btn float-right"><i class="fa fa-arrow-right"></i></a>
							</div>
						</fieldset>	
						<fieldset class="wizard-fieldset mt-5">
							<h2 class="text-center mb-3">Lets Help You Get Started!</h2>

							<div class="wizard-title">
								<i class="fa fa-user-plus"></i>
							</div>

							<?php
								if(!empty(getFriends())){
									foreach (getFriends() as $friends) {?>

								<div class="media-card <?=($friends->is_friend == 1)?'is-friend':null; ?>" data-id="<?=$friends->id?>">
									<div class="media-card-content">
										<div class="media-left">
											<img src="<?=base_url('assets/images/user.png')?>">
										</div>
										<div class="media-right">
											<div class="mb-2">
												<p class="mb-0 lh-16"><strong><?=$friends->f_name.' '.$friends->l_name; ?></strong></p>
												<?=($friends->status == 0)?'<small>Rookie Camper</small>':'<small>Confident Camper</small>'; ?>
											</div>

											<div>
												<p class="mb-0 lh-16">Reservation:</p>
												<?=(($friends->next_reservation != 0)?'<small class="badge bg-secondary">'.date('d M, Y', strtotime($friends->next_reservation)).'</small>':'<small>No reservation</small>'); ?>
											</div>
											
										</div>
									</div>
									<?php
										if($friends->is_friend == 1){
											echo '<i class="fa fa-check-circle text-success" onclick="removeFriend('. $friends->id .')"></i>';
										}else{
											echo '<i class="fa fa-plus-circle" onclick="addFriend('. $friends->id .')"></i>';
										}
									?>
									
								</div>

							<?php }} ?>
							
							<div class="form-group clearfix d-flex justify-content-center gap-3">
								<a href="javascript:;" class="form-wizard-previous-btn float-left"><i class="fa fa-arrow-left"></i></a>
								<a href="javascript:;" class="form-wizard-next-btn float-right"><i class="fa fa-arrow-right"></i></a>
							</div>
						</fieldset>	
						<fieldset class="wizard-fieldset mt-5 text-center wizard-equipped">
							<h2 class="text-center mb-5">Lets Get you Equipped!!</h2>

							<img src="<?=base_url('assets/images/owl.png'); ?>">

							<i class="fa fa-compass"></i>

							<div class="wizard-newline">
									<span>Explore our</span>
									<span class="color-theme">Gear Guide</span>
									<span>to pre-order</span>
									<span>anything you need!</span>
							</div>
							
							<div class="form-group clearfix d-flex justify-content-center gap-3">
								<a href="javascript:;" class="form-wizard-previous-btn float-left"><i class="fa fa-arrow-left"></i></a>
								<a href="javascript:;" class="form-wizard-submit float-right" id="submitBooking"><i class="fa fa-check"></i></a>
							</div>
						</fieldset>
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

<script>
	function addFriend(friendId) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('addfriend') ?>",
			data: { friend_id: friendId },
			dataType: "json",
			cache: false,

			success: function(response) {
				if (response.status === 'success') {
					$('[data-id='+friendId+']').addClass('is-friend');
					$('[data-id='+friendId+'] i').removeClass('fa-plus-circle').addClass('fa-check-circle text-success').attr('onclick', 'removeFriend('+friendId+')');
				} else {
					alert(response.message || 'Failed to add friend.');
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX error:", error);
				console.log("XHR:", xhr.responseText);
				alert('An error occurred while adding the friend.');
			}
		});
	}
	
	function removeFriend(friendId) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('removefriend') ?>",
			data: { friend_id: friendId },
			dataType: "json",
			cache: false,

			success: function(response) {
				if (response.status === 'success') {
					$('[data-id=' + friendId + ']').removeClass('is-friend');
					$('[data-id=' + friendId + ']').find('i')
						.removeClass('fa-check-circle text-success')
						.addClass('fa-plus-circle')
						.attr('onclick', 'addFriend(' + friendId + ')');
				} else {
					alert(response.message || 'Failed to remove friend.');
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX error:", error);
				console.log("XHR:", xhr.responseText);
				alert('An error occurred while removing the friend.');
			}
		});
	}
</script>