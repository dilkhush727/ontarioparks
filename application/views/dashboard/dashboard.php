<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2">
		<div class="row align-items-center">
			<div class="col-md-12">
				<?php
					// pr(getMyFriends());
				?>

				<div class="booking-card mb-3">
					<?php if(!empty(getNextBooking())){ ?>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<div>
								<i class="fa fa-calendar"></i>
							</div>
							
							<div>
								<?= (new DateTime(getNextBooking()->date . ' ' . getNextBooking()->time))->format('l, F jS') . '<br>at ' . (new DateTime(getNextBooking()->date . ' ' . getNextBooking()->time))->format('g:i A'); ?>
							</div>
						</div>

						<div>
							<h2><?=getNextBooking()->park . '<br>in ' .getNextBooking()->time_remaining; ?></h2>
						</div>
					<?php }else{ ?>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<div>
								<i class="fa fa-calendar"></i>
							</div>
						</div>

						<div>
							<h2>No upcoming bookings</h2>
						</div>
					<?php } ?>
				</div>

				<div class="friends-card">
						
				<?php if(!empty(getMyFriends())){ foreach (getMyFriends() as $friends) {?>
					<div class="media-card" data-id="<?=$friends->id?>">
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
						<i class="fa fa-times-circle text-danger" onclick="removeFriend('<?=$friends->id; ?>')"></i>
					</div>

					<?php }}else{ ?>
						<div class="media-card">
							<div class="media-card-content">
								<div class="media-right">
									<p class="mb-2">No camping buddies yet — why not invite a few?</p>
								</div>
							</div>
						</div>
					<?php }  ?>
					<div class="text-center mt-4">
						<a href="<?= base_url('add-friends') ?>" class="btn-theme">
							<i class="fas fa-plus"></i>
						</a>
					</div>
				
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	function removeFriend(friendId) {
		if (!confirm('Are you sure you want to remove this friend?')) {
			return;
		}

		$.ajax({
			type: "POST",
			url: "<?= base_url('removefriend') ?>",
			data: { friend_id: friendId },
			dataType: "json",
			cache: false,

			success: function(response) {
				if (response.status === 'success') {
					const card = $('[data-id=' + friendId + ']');
					
					// Animate and remove the friend card
					card.slideUp(300, function() {
						card.remove();
					});
					
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