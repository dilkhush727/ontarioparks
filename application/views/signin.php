<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid ">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			<div class="col-md-6">
				<img src="<?=base_url()?>assets/images/Algonquin-Park-Backcountry-Camping.jpg" class="img-fluid mb-5">
			</div>
			<div class="col-md-6">
			<!-- http://localhost/IXD-5105-0NC/ontarioparks/index.php/auth -->
				<h1>Sign in</h1>
				<form action="">
				<label for="Email">Email</label>
				<br>
				<input type="email" id="email" name="email" placeholder="Email"><br><br>
				<label for="password">Password</label>
				<br>
			    <input type="text" id="password" name="password" placeholder=""><br><br>
				<button type="submit"> Sign in </button>
				</form>
				<p>or</p>
				<p>sign in with</p> <a href="https://accounts.google.com/signin" target="_blank"><img src="../assets/images/google.png" alt="Google Logo"></a>
				<p>or</p>
				<p>Continue as Guest</p>
				
			</div>
		</div>
	</div>
</div>