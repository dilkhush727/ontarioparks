<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div class="col-md-6 m-auto">

				<div class="text-center">
					<h1>Hi Camper!</h1>
					<p>Let's get to know you</p>
				</div>

				<form method="post" class="auth-form" action="<?= base_url('auth/signup') ?>">
					<div>
						<input type="text" name="f_name" placeholder="First Name" value="<?= set_value('f_name'); ?>" required>
						<?= form_error('f_name', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>

					<div>
						<input type="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>" required>
						<?= form_error('email', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>

					<div>
						<input type="password" name="password" placeholder="Password" required>
						<?= form_error('password', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>

					<div>
						<input type="password" name="cpassword" placeholder="Confirm Password" required>
						<?= form_error('cpassword', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>

					<div>
						<input type="text" name="phone" placeholder="Phone" value="<?= set_value('phone'); ?>" required>
						<?= form_error('phone', '<div class="mb-2"><span class="text-danger">', '</span></div>'); ?>
					</div>

					<div class="text-center m-2">
						<button type="submit" class="btn rounded-pill btn-theme mb-3">Next</button>
					</div>
				</form>


				<div class="">
					<p>Already have an account?
						<a href="<?=base_url('auth/signin')?>"><u>Sign In</u></a>
					</p>
				</div>
				<!-- <p>or</p> -->

				<!-- <div class="d-flex flex-row align-items-center justify-content-center " >
					<span>sign in with</span>&nbsp;<img src="<?=base_url(); ?>assets/images/google.png" alt="">
				</div>
				<p>or</p>
				<p>Continue as Guest</p>
				<img src="<?=base_url(); ?>assets/images/arrow.png" alt="">
				
				<i class="fa fa-arrow-right icon-circle"></i> -->
				
			</div>
		
		</div>
		<img src="<?=base_url(); ?>assets/images/sloth.png" alt="">
	</div>
	
</div>