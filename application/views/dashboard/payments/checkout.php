<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">

    <section class="wizard-section mb-80">
		<div class="row no-gutters">
			<div class="col-lg-6 col-md-6">
				<div class="wizard-content-left d-flex justify-content-center align-items-center">
					<h1>Checkout</h1>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-wizard">
					<form action="<?=base_url('checkout')?>" method="post" role="form">
						<div class="form-wizard-header">
							<ul class="list-unstyled form-wizard-steps clearfix">
								<li class="active"><span>1</span></li>
								<li><span>2</span></li>
								<li><span>3</span></li>
								<li><span>4</span></li>
							</ul>
						</div>
                        <input type="hidden" name="payment_method" value="credit_card">

						<fieldset class="wizard-fieldset show">

                            <div class="row">
                                <div class="col-md-4 mb-3 ">
                                    <div class="plan-items theme-card">
                                        <h2 class="mb-4"><?=getCart()['pricing']['name']; ?> Pack</h2>

                                        <?php if (!empty(getCart()['items'])) { foreach (getCart()['items'] as $cart) { ?>
                                            <ul class="p-0">
                                                <li class="d-flex align-items-center justify-content-between gap-2">
                                                    <strong><?=$cart->item; ?></strong>
                                                    <span><?=round($cart->price); ?> CAD</span>
                                                </li>
                                            </ul>
                                        <?php }} ?>

                                        <div class="text-center">
                                            <label class="label-light d-flex align-items-center justify-content-between">
                                                <span>Total Cost</span>    
                                                <span><?=getCart()['total']; ?> CAD</span>                                        
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="form-group mb-3 clearfix">
								<a href="javascript:;" class="btn-theme-border float-right" onclick="window.history.back();">Edit your Pack</a>
							</div>
							<div class="form-group mt-0 mb-5 pb-5 clearfix">
								<a href="javascript:;" class="form-wizard-next-btn btn-theme float-right">Continue to Payment</a>
							</div>
						</fieldset>	

						<fieldset class="wizard-fieldset">
							<h5>Delivery Details</h5>
							<div class="form-group mb-2">
								<input type="text" name="address" class="form-control wizard-required" id="address">
								<label for="address" class="wizard-form-text-label">Address*</label>
								<div class="wizard-form-error"></div>
							</div>

                            <div class="d-flex gap-2">
                                <div class="form-group my-3">
                                    <input type="text" name="postalcode" class="form-control wizard-required" id="postalcode">
                                    <label for="postalcode" class="wizard-form-text-label">Postal Code*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group my-3">
                                    <input type="text" name="city" class="form-control wizard-required" id="city">
                                    <label for="city" class="wizard-form-text-label">City*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                            </div>
                            
                            <div class="form-group my-3">
                                <select class="form-select form-control" id="province" name="province" required>
                                    <option value="" disabled selected>Province</option>

                                    <!-- Provinces -->
                                    <option value="AB">Alberta</option>
                                    <option value="BC">British Columbia</option>
                                    <option value="MB">Manitoba</option>
                                    <option value="NB">New Brunswick</option>
                                    <option value="NL">Newfoundland and Labrador</option>
                                    <option value="NS">Nova Scotia</option>
                                    <option value="ON">Ontario</option>
                                    <option value="PE">Prince Edward Island</option>
                                    <option value="QC">Quebec</option>
                                    <option value="SK">Saskatchewan</option>

                                    <!-- Territories -->
                                    <option value="NT">Northwest Territories</option>
                                    <option value="NU">Nunavut</option>
                                    <option value="YT">Yukon</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <label class="label-light d-flex align-items-center justify-content-between">
                                    <span>Total Cost</span>    
                                    <span><?=getCart()['total']; ?> CAD</span>                                        
                                </label>
                            </div>

							<div class="form-group clearfix">
								<a href="javascript:;" class="form-wizard-previous-btn btn-theme-border mb-3 float-left">Previous</a>
								<a href="javascript:;" class="form-wizard-next-btn btn-theme float-right">Continue</a>
							</div>
						</fieldset>
                        
						<fieldset class="wizard-fieldset">
							<h5>Payment Details</h5>
                            
                            <div class="form-group">
                                <input type="text" class="form-control wizard-required" id="cardnumber">
                                <label for="cardnumber" class="wizard-form-text-label">Card Number*</label>
                                <div class="wizard-form-error"></div>
                            </div>

							<div class="form-group mb-0">
								<input type="text" class="form-control wizard-required" id="nameoncard">
								<label for="nameoncard" class="wizard-form-text-label">Name on Card*</label>
								<div class="wizard-form-error"></div>
							</div>
                            
							<div class="d-flex gap-2">
                                <div class="form-group focus-input">
                                    <label for="expirydate"class="wizard-form-text-label">Expiry Date</label>
                                    <input type="text" class="form-control wizard-required" id="expirydate" placeholder="MM/YY" maxlength="5" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Format: MM/YY">
                                </div>
                            
                                <div class="form-group">
                                    <label for="cvc"class="wizard-form-text-label">CVC*</label>
                                    <input type="text" class="form-control wizard-required" id="cvc">
                                    <div class="wizard-form-error"></div>
                                </div>
							</div>

                            <div class="text-center">
                                <label class="label-light d-flex align-items-center justify-content-between">
                                    <span>Total Cost</span>    
                                    <span><?=getCart()['total']; ?> CAD</span>                                        
                                </label>
                            </div>

							<div class="form-group clearfix mb-5 pb-5">
								<a href="javascript:;" class="form-wizard-previous-btn btn-theme-border mb-3 float-left">Previous</a>
								<a href="javascript:;" class="form-wizard-next-btn btn-theme float-right">Continue</a>
							</div>
						</fieldset>	

						<fieldset class="wizard-fieldset">
							<h5>Review & Pay</h5>
                            
                            <div class="plan-items theme-card">
                                <h2 class="mb-4"><?=getCart()['pricing']['name']; ?> Pack</h2>

                                <?php if (!empty(getCart()['items'])) { foreach (getCart()['items'] as $cart) { ?>
                                    <ul class="p-0">
                                        <li class="d-flex align-items-center justify-content-between gap-2">
                                            <strong><?=$cart->item; ?></strong>
                                            <span><?=round($cart->price); ?> CAD</span>
                                        </li>
                                    </ul>
                                <?php }} ?>

                                <div class="text-center">
                                    <label class="label-light d-flex align-items-center justify-content-between">
                                        <span>Total Cost</span>    
                                        <span><?=getCart()['total']; ?> CAD</span>                                        
                                    </label>
                                </div>
                            </div>

                            <div class="review-address mt-4">
                                    <strong>Shipping Address</strong><br>
                                    <small class="mb-3 d-block">
                                        <span id="r_address"></span><br>
                                        <span id="r_postalcode"></span> <span id="r_city"></span>, <span id="r_province"></span><br>
                                        <span><?=userData()->f_name; ?></span><br>
                                    </small>
                                    
                                    <strong>Payment</strong><br>
                                    <small class="mb-3 d-block">
                                        <span id="r_cardnumber"></span><br>
                                        <span id="r_cardname"></span><br>
                                        <span id="r_cardexpiry"></span><br>
                                        <span id="r_cardcvv"></span>
                                    </small>
                            </div>

							<div class="form-group mb-5 pb-5 clearfix">
								<a href="javascript:;" class="form-wizard-previous-btn btn-theme-border mb-3 float-left">Previous</a>
								<a href="javascript:;" class="form-wizard-submit btn-theme float-right">Pay</a>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</section>
	
</div>

<script>
    const expiryInput = document.getElementById('expirydate');
    expiryInput.addEventListener('input', (e) => {
    let val = e.target.value.replace(/\D/g, '');
    if (val.length >= 2) val = val.slice(0, 2) + '/' + val.slice(2, 4);
        e.target.value = val.slice(0, 5);
    });

    $(document).ready(function() {
        $('.form-wizard-submit').on('click', function(e) {
            e.preventDefault();
            $('form').submit();
        });
    });
</script>

<script>
  // Generic live update function with optional formatter
  function bindLiveUpdate(inputId, displayId, formatter = null) {
    const input = document.getElementById(inputId);
    const display = document.getElementById(displayId);

    if (input && display) {
      input.addEventListener('input', () => {
        let value = input.value;
        if (formatter) {
          value = formatter(value);
        }
        display.textContent = value;
      });
    }
  }

  // Formatter: Mask all but last 4 digits of card number
  function maskCard(val) {
    if (!val) return '';
    const cleanVal = val.replace(/\D/g, ''); // remove spaces or dashes
    return cleanVal.length >= 4 ? `•••• •••• •••• ${cleanVal.slice(-4)}` : cleanVal;
  }

  // Formatter: Mask all CVV digits except the last one
  function maskCVV(val) {
    if (!val) return '';
    const length = val.length;
    return length > 1 ? '*'.repeat(length - 1) + val.slice(-1) : val;
  }

  // Bind all live-updating fields
  document.addEventListener('DOMContentLoaded', () => {
    bindLiveUpdate('address', 'r_address');
    bindLiveUpdate('postalcode', 'r_postalcode');
    bindLiveUpdate('city', 'r_city');
    bindLiveUpdate('province', 'r_province');
    bindLiveUpdate('nameoncard', 'r_cardname');
    bindLiveUpdate('expirydate', 'r_cardexpiry');
    bindLiveUpdate('cardnumber', 'r_cardnumber', maskCard);
    bindLiveUpdate('cvc', 'r_cardcvv', maskCVV);
  });
</script>
<script src="<?=base_url()?>assets/js/form-checkout.js"></script>