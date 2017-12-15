/*!
 *  Contact form validation
 *  Author: MUUteam / Lukasz Florczak
 */

function checkForm() {
	checkName();
	checkMessage();
	checkEmail();
};

function checkName() {
	var name = document.getElementById('inputName');

    if (name.value.length < 2) {
	    inputName = '';
	} else {
	    inputName = name.value;
	}

   	return inputName;
};

function checkMessage() {
	var message = document.getElementById('inputMessage');

	if (message.value.length < 3) {
	    inputMessage = '';
	} else {
		inputMessage = message.value;
	}

    return inputMessage;
};

function checkEmail() {
	var email = document.getElementById('inputEmail');
	var emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,14})/;

	if (email.value == '') {
		inputEmail = '';
	} else {
	    if (!emailFilter.test(email.value)) {
	    	inputEmail = '';
		} else {
	    	inputEmail = email.value;
	    }
	}

    return inputEmail;
};

function check() {
	name = checkName();
	message = checkMessage();
	email = checkEmail();

	if (name != '' && message != '' && email != '') {
		$('#send').html('<i class="fa fa-envelope fa-2x"></i>');
	} else {
		$('#send').html('<i class="fa fa-envelope-o fa-2x"></i>');
	}
}

function mail() {
	name = checkName();
	message = checkMessage();
	email = checkEmail();

	var placeholderColor = $('[placeholder]').css('color');
	var inputColor = $('.form-control').css('color');

	if (name != '' && message != '' && email != '') {
		$.post('php/mail.php', {name: name, message: message, email: email},
			function(response) {
				$('#send').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
				$('.form-control').css('color', placeholderColor);
				setTimeout(function() {
					if (response == 1) {
						$('#send').html('<i class="fa fa-check fa-2x"></i>');
						$('.form-control').val('');
						setTimeout(function() {
							$('#send').html('<i class="fa fa-envelope-o fa-2x"></i>');
						}, 5000);
					} else {
						$('#send').html('<i class="fa fa-exclamation fa-2x"></i>');
					}
				}, 1000);
			}
		);
	} else if (name == '') {
		$('#inputName').parent().effect('shake');
	} else if (email == '') {
		$('#inputEmail').parent().effect('shake');
	} else if (message == '') {
		$('#inputMessage').parent().effect('shake');
	}
}