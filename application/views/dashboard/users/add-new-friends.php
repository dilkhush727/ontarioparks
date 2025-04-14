<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="wizard-section">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-lg-12 col-md-12">
				<h1 class="my-3 text-center">Add Friends</h1>
				<?php if(!empty(getFriends())){ foreach (getFriends() as $friends) {?>

					<div class="media-card <?=($friends->is_friend == 1)?'is-friend':null; ?>" data-id="<?=$friends->id?>">
						<div class="media-card-content">
							<div class="media-left">
								<img src="<?=base_url('assets/images/user.png')?>">
							</div>
							<!-- <div class="media-right">
								<p class="mb-0"><strong><?=$friends->f_name.' '.$friends->l_name; ?></strong></p>
								<p class="mb-0"><?=($friends->status == 0)?'<span class="badge bg-warning">First time camper</span>':'<span class="badge bg-success">Experienced Camper</span>'; ?></p>
								<p class="mb-0">
									<?=(($friends->next_reservation != 0)?'Next Reservation: <span class="badge bg-secondary">'.date('d M, Y', strtotime($friends->next_reservation)).'</span>':'<label class="badge bg-danger">No reservation</label>'); ?>
							</p>
							</div> -->

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
			</div>
		</div>
	</div>
</section>

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