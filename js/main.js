$(document).ready(function() {
    //  Onepage Nav Elements
    $('.singlepage-nav').singlePageNav({
        offset: 0,
        filter: ':not(.external)',
        updateHash: true,
        currentClass: 'current',
        easing: 'swing',
        speed: 750,
        beforeStart: function () {
            if ($(window).width() < 991) {
                $('.singlepage-nav > ul').hide();
            };
        },
        onComplete: function () {
            console.log('done scrolling');
        }
    });

    $('#step_1').hide();
    $('#step_2').hide();
	
	var form_html = $('.checkout2').html();
	var pre_id;

	$("body").delegate("a[data-toggle='collapse']","click",function() {
        $('#step_1').show();
        $('#step_2').show();
		// console.log($(this).attr("id"));
		if ($(window).width() < 1024) {
			if ( pre_id != "" && pre_id == $(this).attr("id") ){
				$("div#collapseOne").slideUp();
				$("div#collapseTwo").slideUp(function(){
					$("html, body").scrollTop($('span[data-id="'+pre_id+'"]').offset().top-120);
					pre_id = "";
				});
			 } else {
                //console.log('here we go');
				//$(".checkout2, .checkout").html('');
			 	//pre_id = $(this).attr("id");
				//$('span[data-id="'+$(this).attr("id")+'"]').html('<div class="panel-group checkout">'+form_html+'</div>');	
				$("div#collapseOne").slideDown(function() {
					$("html, body").scrollTop($("div[id='collapseOne']").offset().top-120);
				}); 
			}
		}
        // scroll to shipping info on "Buy Now" click
        window.scrollTo(0,document.body.scrollHeight);
        $("div#collapseTwo").show().css("visibility","visible").slideDown();
	});

    $('#formID').validate({
        errorPlacement: function(error, element) {
            error.insertBefore(element);
            error.addClass('valid_error');
        },
        rules: {
            fields_fname: {
                required: true,
                lettersonly: true
            },
            fields_lname: {
                required: true,
                lettersonly: true
            },
            fields_email: {
                required: true,
                email: true
            },
            fields_address1: {
                required: true,
                maxlength: 150
            },
            state: {
                required: true
            },
            fields_phone: {
                required: true,
                phoneUS: true,
                maxlength: 10,
                minlength: 10,
                digits: true
            },
            fields_zip: {
                required: true,
                maxlength: 6,
                minlength: 5,
                digits: true
            },
            fields_city: {
                required: true,
                minlength: 2
            },
            cc_type: {
                required: true
            },
            cc_number: {
                required: true,
                digits: true
            },
            fields_expmonth: {
                required: true
            },
            fields_expyear: {
                required: true
            },
            cc_cvv: {
                required: true,
                digits: true
            }
        },
        messages: {
            fields_fname: {
                required: 'Please enter your First Name',
                lettersonly: 'First Name must be letters only'
            },
            fields_lname: {
                required: 'Please enter your Last Name',
                lettersonly: 'Last Name must be letters only'
            },
            fields_city: {
                required: 'Please enter your City',
                minlength: 'Your City name can\'t be less than 2 letters'
            },
            fields_zip: {
                required: 'Please enter your ZIP code',
                minlength: 'Your ZIP code can\'t be less than 5 characters',
                maxlength: 'Your ZIP code can\'t be more than 5 characters',
                digits: 'Your ZIP code must use digits only'
            },
            fields_address1: {
                required: 'Please enter your address',
                maxlength: 'Your address can\'t be more than 150 characters'
            },
            state: {
                required: 'Please select your state'  
            },
            fields_email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address'
            },
            fields_phone: {
                required: 'Please enter a valid US phone!',
                maxlength: 'A valid US phone number can\'t be more than 10 digits',
                minlength: 'A valid US phone number can\'t be less than 10 digits',
                digits: 'Please digits only'
            },
            cc_type: {
                required: 'Please select your Card Type' 
            },
            cc_number: {
                required: 'Please enter your Card Number',
                digits: 'Please numbers only'
            },
            fields_expmonth: {
                required: 'Please select your Expiration Month'
            },
            fields_expyear: {
                required: 'Please select your Expiration Year'
            },
            cc_cvv: {
                required: 'Please enter your CVV code',
                digits: 'Please numbers only'
            }
        },
        onkeyup: false,
        highlight : function (element) {
            $(element).addClass('input_error');
        },
        unhighlight : function (element) {
            $(element).removeClass('input_error');
        }
    });

    //$('#formID').on('submit', function(e) {
    $('#btnorder_sub').click(function(e) {
        e.preventDefault();
        // All checking passed
        if ($('#formID').valid() && $('#cc_number').val()) {
            // ShowExitPopup = false;
            //  internal = 1;
            //  isExit=false;
           
            $('#loading-indicator').fadeIn(500);

            var page_ajax = 'submit_order_limelight.php?cc_type=' + 
                $('#cc_type').val() + 
                '&cc_number=' + 
                $('#cc_number').val() + 
                '&cc_cvv=' + 
                $('#cc_cvv').val() + 
                '&fields_expmonth=' + 
                $('#fields_expmonth').val() + 
                '&fields_expyear=' + 
                $('#fields_expyear').val();

            $.ajax({
                type:'POST', 
                url: 'includes/' + page_ajax,
                data: $('#formID').serialize(),
                success: function(response) {
                    var res = response.split("|");
                    if (res[0] == 'decline') {
                        // Decline Page Error
                        alert('=>'+response);
                    } else if (res[0] == 'ok') {
                        //<?= $campaign_path.$folder_name; ?>
                        window.location.href = 'thankyou.php' + res[1];
                    } else if ( res[0] == 'okprepaid' ) {
                        //<?=$campaign_path.$folder_name; ?>
                        window.location.href = 'thankyou.php' + res[1];
                    } else {
                        $('#loading-indicator').hide();
                        var li = '';
                        li += '<li>' + res[0] + '</li>';
                        var html = '';
                        html += '<div id="error_handler_overlay">';
                        html += '<div class="error_handler_body"><a href="javascript:void(0);" id="error_handler_overlay_close">X</a><ul>' + li + '</ul></div>';
                        html += '</div>';
                        
                        //return html;
                        $('body').append(html);
                        $('#error_handler_overlay').fadeIn(500);
                    }
                }
            });
        }   
    });
});

function packagechange(product, shipping) {
    $('#custom_product').val(product);
    $('#shipping').val(shipping);
}

$(function() {
	$(window).keydown(function(e) {
		if (e.which === 27 && $('#error_handler_overlay').length) {
			$('#error_handler_overlay').remove();
		}
	});

	$(document).off('click', '#error_handler_overlay');
	$(document).on('click', '#error_handler_overlay', function() {
		$(this).remove();
	});

	$(document).off('click', '#error_handler_overlay_close');
	$(document).on('click', '#error_handler_overlay_close', function() {
		$('#error_handler_overlay').remove();
	});
	

	$(document).on('click', '#app_common_modal_close', function() {
		//     alert('close');
		$('#app_common_modal').remove(); 
	});	
	
	$(document).on('click', '.btn2', function() {
		//     alert('close');
		//$('#app_common_modal').remove();
		$('.btn2').removeClass('btn-gray');
		$('.btn2').addClass('btn-black');
		$(this).removeClass('btn-black');
		$(this).addClass('btn-gray');
	});
});