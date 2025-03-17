<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div style="text-align: center;" class="col-md-6 justify-content-center ">
			<!-- http://localhost/IXD-5105-0NC/ontarioparks/index.php/auth/signup -->
				<h1>Hi Camper!</h1>
				<p>Let’s get to know you</p>
				<form class="auth-form" action="">
				<input type="text" id="fname" name="fname" placeholder="First Name"><br><br>
				<input type="email" id="email" name="email" placeholder="Email"><br><br>
			    <input type="phone" id="phone" name="phone" placeholder="Phone"><br><br>
				</form>
				<button type="submit" class="btn rounded-pill btn-team">Next</button>
				<p>or</p>
				<div class="d-flex flex-row align-items-center justify-content-center " >
				<span>sign in with</span>&nbsp;<img src="<?=base_url(); ?>assets/images/google.png" alt=""> </div>
				<p>or</p>
				<p>Continue as Guest</p>
				<img src="<?=base_url(); ?>assets/images/arrow.png" alt="">
				
				<i class="fa fa-arrow-right icon-circle"></i>
				
			</div>
		
		</div>
		<img src="<?=base_url(); ?>assets/images/sloth.png" alt="">
	</div>
	
</div>