<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<div class="hero-section p-2 rounded position-relative">
		<div class="row align-items-center">
			
			<div class="col-md-6 m-auto">
				
                <div class="container mb-5">

                <div class="d-flex align-items-center gap-3">
                    <a href="<?=base_url('gear-guide')?>" class="btn-theme-circle"><i class="fa fa-arrow-left"></i></a>
                    <div>
                        <h2 class="mb-1 text-center"><?=$price_details->name; ?> Gear Guide</h2>
                        <p class="text-center">Customize your pack</p>
                    </div>
                </div>

                    <form id="starterForm">
                        <div class="row plan-item-list">
                        <h2 class="mb-4"><?=$price_details->name; ?> Pack Items</h2>
                            <?php
                                $items = json_decode($price_details->items); // assuming $price_details comes from controller
                                foreach ($items as $index => $item): 
                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="plan-item">
                                    <label>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="checkbox" class="item-check" data-price="<?= $item->price ?>" name="items[]" value="<?= $item->title ?>">
                                            <strong><?= $item->title ?></strong>
                                        </div>
                                        <span><strong><?= $item->price ?> CAD</strong></span>
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center mt-4">
                        <h4>Total: $<span id="totalPrice">0</span></h4>
                        <button type="button" class="btn btn-theme mt-3 mb-5" id="checkoutBtn">Proceed to Checkout </button>
                        </div>
                    </form>
                </div>


			</div>
		
		</div>
	</div>
	
</div>

<script>
    $(document).ready(function() {
    $('.item-check').change(function() {
        let total = 0;
        $('.item-check:checked').each(function() {
        total += parseFloat($(this).data('price'));
        });
        $('#totalPrice').text(total.toFixed(2));
    });

    $('#checkoutBtn').click(function() {
        const selectedItems = $('.item-check:checked').map(function() {
        return { title: this.value, price: $(this).data('price') };
        }).get();

        if (selectedItems.length === 0) {
        alert("Please select at least one item.");
        return;
        }

        $.ajax({
        type: "POST",
        url: "<?= base_url('add-to-cart/'). $price_details->id; ?>",
        data: { items: JSON.stringify(selectedItems) },
        dataType: "json",
        success: function(response) {
            if (response.status === 'success') {
                window.location.href = "<?=base_url('checkout'); ?>";
            } else {
            alert(response.message);
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert("Something went wrong.");
        }
        });
    });
    });
</script>