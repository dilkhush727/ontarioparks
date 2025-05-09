jQuery(document).ready(function () {
	// click on next button
	jQuery('.form-wizard-next-btn').click(function () {
		var parentFieldset = jQuery(this).parents('.wizard-fieldset');
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		var next = jQuery(this);
		var nextWizardStep = true;

		parentFieldset.find('.wizard-required').each(function () {
			var thisValue = jQuery(this).val();
			if (thisValue == "") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
				nextWizardStep = false;
			} else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});

		if (nextWizardStep) {
			parentFieldset.removeClass("show", "400");
			currentActiveStep.removeClass('active').addClass('activated');

			// Skip fieldsets with .in-active
			let nextFieldset = parentFieldset.nextAll('.wizard-fieldset').not('.in-active').first();
			nextFieldset.addClass("show", "400");

			// Update step indicator
			jQuery(document).find('.wizard-fieldset').each(function () {
				if (jQuery(this).hasClass('show')) {
					var formAttr = jQuery(this).attr('data-tab-content');
					jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
						if (jQuery(this).attr('data-attr') == formAttr) {
							jQuery(this).addClass('active');
							var innerWidth = jQuery(this).innerWidth();
							var position = jQuery(this).position();
							jQuery(document).find('.form-wizard-step-move').css({ "left": position.left, "width": innerWidth });
						} else {
							jQuery(this).removeClass('active');
						}
					});
				}
			});
		}
	});

	// click on previous button
	jQuery('.form-wizard-previous-btn').click(function () {
		var prev = jQuery(this);
		var parentFieldset = prev.parents('.wizard-fieldset');
		var currentActiveStep = prev.parents('.form-wizard').find('.form-wizard-steps .active');

		parentFieldset.removeClass("show", "400");

		// Skip fieldsets with .in-active
		let prevFieldset = parentFieldset.prevAll('.wizard-fieldset').not('.in-active').first();
		prevFieldset.addClass("show", "400");

		currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active', "400");

		// Update step indicator
		jQuery(document).find('.wizard-fieldset').each(function () {
			if (jQuery(this).hasClass('show')) {
				var formAttr = jQuery(this).attr('data-tab-content');
				jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
					if (jQuery(this).attr('data-attr') == formAttr) {
						jQuery(this).addClass('active');
						var innerWidth = jQuery(this).innerWidth();
						var position = jQuery(this).position();
						jQuery(document).find('.form-wizard-step-move').css({ "left": position.left, "width": innerWidth });
					} else {
						jQuery(this).removeClass('active');
					}
				});
			}
		});
	});

	// click on form submit button
	jQuery(document).on("click", ".form-wizard .form-wizard-submit", function () {
		var parentFieldset = jQuery(this).parents('.wizard-fieldset');
		parentFieldset.find('.wizard-required').each(function () {
			var thisValue = jQuery(this).val();
			if (thisValue == "") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
			} else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});
	});

	// focus on input field check empty or not
	jQuery(".form-control").on('focus', function () {
		var tmpThis = jQuery(this).val();
		if (tmpThis == '') {
			jQuery(this).parent().addClass("focus-input");
		}
		else if (tmpThis != '') {
			jQuery(this).parent().addClass("focus-input");
		}
	}).on('blur', function () {
		var tmpThis = jQuery(this).val();
		if (tmpThis == '') {
			jQuery(this).parent().removeClass("focus-input");
			jQuery(this).siblings('.wizard-form-error').slideDown("3000");
		}
		else if (tmpThis != '') {
			jQuery(this).parent().addClass("focus-input");
			jQuery(this).siblings('.wizard-form-error').slideUp("3000");
		}
	});
});