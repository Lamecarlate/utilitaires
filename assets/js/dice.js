;(function(){

	"use strict";

	jQuery(document).ready(function(){

		jQuery('#throw-dice').on('submit', function(event) {
			if (event.preventDefault) {
				event.preventDefault();
			}
			event.returnValue = false;

			jQuery('#dice-img').css({'opacity': 0});

			throw_dice();

		});

	});


	function throw_dice() {

		var inputs = jQuery(".dice"),
			chosen = jQuery('.dice:checked').val(),
			sent_data = {'dice_type' : chosen};

		jQuery.ajax({
			url: 'dice',
			data: sent_data,
			dataType: 'json',
			success: function(data){
				change_img(chosen, data.result);
			},
			error: function() {
				alert("error");
			}

		});

	}

	function change_img(dice_type, dice_result) {
		var dice_img = 'assets/img/utils/dice/d' + dice_type + '_' + dice_result + '.png';
		jQuery('#dice-img')
			.attr('src', dice_img)
			.attr('alt', dice_result)
			.attr('title', dice_result)
			.data('dice_type', dice_type)
			.data('dice_result', dice_result)
			.parent().removeClass('wait');

		jQuery('#dice-img').css({'opacity': 1});
	}




})();