<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div class="col-md-6 m-auto">

				<div class="text-center">
					<h1>Gear Guide</h1>
				</div>

				<?php if(!empty(getPricing())){ foreach (getPricing() as $price) { ?>
					<a href="<?=base_url('gear-guide-pricing/'). $price->id; ?>" class="text-decoration-none text-dark">
						<div class="media-card pricing-plan" data-id="<?=$price->id?>">
							<div class="media-card-content">
								<div class="media-right">
									<h4 class="mb-1"><strong><?=$price->name; ?></strong></h4>
									<h5 class="mb-3"><strong><?=$price->price_range; ?></strong></h5>
									<p class="mb-0 lh-1"><small><?=$price->details; ?></small></p>
								</div>
							</div>
							<i class="fa fa-arrow-right"></i>
						</div>
					</a>
				<?php }} ?>

				<!-- <div class="media-card">
					<div class="media-card-content">
						<div class="media-right">
							<p class="mb-0"><strong>Customise Your Pack</strong></p>
						</div>
						<i class="fa fa-arrow-right top-n"></i>
					</div>
				</div> -->
				
			</div>
		
		</div>
	</div>
	
</div>