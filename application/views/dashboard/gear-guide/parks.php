<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div class="col-md-6 m-auto">

				<div class="text-center">
					<h2>Find a Park</h2>
				</div>

				<form method="get" action="<?= current_url() ?>" class="form-inline mb-3">
					<div class="form-group d-flex gap-2 mb-2">
						<input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Search park..." />
						<button type="submit" class="btn-theme">Search</button>
					</div>
					
				</form>

				<!-- <?php if (!empty($error)): ?>
					<div class="alert alert-danger"><?= $error ?></div>
				<?php endif; ?> -->

				<?php if (!empty($parks)): ?>
					<ul>
						<?php foreach ($parks as $park): ?>
							<li><?= htmlspecialchars($park['properties']['NAME']) ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<p>No parks found.</p>
				<?php endif; ?>


			</div>
		
		</div>
	</div>
	
</div>