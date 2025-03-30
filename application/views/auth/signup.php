<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div class="col-md-6 text-center m-auto">
				
				<h1>Hi Camper!</h1>
				<p>Let's get to know you</p>

				<form method="post" class="auth-form" action="<?=base_url('auth/signup')?>">
					<div>
						<input type="text" name="f_name" placeholder="First Name" required>
					</div>
					
					<div>
						<input type="email" name="email" placeholder="Email" required>
					</div>
					<div>
						<input type="password" name="password" placeholder="Password" required>
					</div>
					<div>
						<input type="password" name="cpassword" placeholder="Confirm Password" required>
					</div>
					<div>
						<input type="phone" name="phone" placeholder="Phone" required>
					</div>
					<button type="submit" class="btn rounded-pill btn-team">Next</button>
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