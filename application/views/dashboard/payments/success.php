<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">

    <section class="wizard-section">
		<div class="row no-gutters">
			<div class="col-lg-6 col-md-6">
                <div class="order-success text-center">

                <?php if(!empty($paymentDetails)){ ?>
                    <h1 class="mt-5">You placed order successfully</h1>

                    <i class="fa fa-check-circle my-5 text-theme"></i>

                    <h6 class="mb-2"><strong>Your order number: <?=$paymentDetails->payment_token; ?></strong></h6>
                    <small>You will receive a confirmation <br>e-mail in a few minutes.</small>
                <?php }else{
                    echo '<h1 class="mt-5">Oops!<br>404 Not Found</h1>';
                } ?>
                    <a href="<?=base_url('dashboard')?>" class="btn-theme mt-5 d-inline-block">Go to Home</a>
                </div>
			</div>
		</div>
	</section>
	
</div>