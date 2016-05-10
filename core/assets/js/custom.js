$(document).ready(function(){
	signupValidate();
	
	var credit_card = '';
	var credit_card_pseudo = '';
	var credit_card_actual = '';
	
	$('#credit_card').keyup(function(e){
		
		var credit_card_key = String.fromCharCode( e.which );
		
		credit_card += credit_card_key;				
			
		if(credit_card.length <= 12){
			credit_card_pseudo += credit_card_key.replace(/\d/, 'x');
			credit_card_actual += credit_card_key;
		}else if(credit_card.length <= 16){
			credit_card_pseudo += credit_card_key;
			credit_card_actual += credit_card_key;
		}
	
		$('#credit_card').val(credit_card_pseudo);
		$('#credit_card_actual').val(credit_card_actual);
			
	});
});

/*
var cardFormat = function(card){
	return card.replace(/\d{12}(\d{4})/, "xxxx xxxx xxxx $1");
}*/
var validateEmail = function (email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
var signupValidate = function(){
	
jQuery.validator.addMethod("validateEmail", function(value, element) {						
	var status = validateEmail(value);
	return status; 
}, "Please enter valid email address.");
	
$("#signup_form").validate({
		'errorClass': 'error_input',
		'errorElement': 'span',
		errorPlacement: function(error, element) {				
			var common_error = '<div class="alert alert-danger text-font"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-close icon-spce"></i><span> Fields marked in red are mandatory.</span></div>';
			error.insertAfter($(element)); 
		},
		rules: {
			user_login: {required:true,rangelength:[2,6],
			  remote: {
				url: "ajaxHandlers/check-username.php",
				type: "post",
				data: {
				  user_login: function() {
					return $( "#user_login" ).val();
				  }
				}
			  }

			},				
			first_name: "required",				
			last_name: "required",				
			password: {required:true,rangelength:[2,6] },				
			confirm_password: {required:true, equalTo:'#password'},				
			user_email: {required:true, validateEmail:true},				
			phone_no: {required:true, digits:true},				
		},
		messages: {
			user_login: {required:'',rangelength:'Please enter username in the range of 2-6 characters.',
			remote: 'This username already exists. Please try another.'
			},	
			first_name: "",
			last_name: "",
			password: {required:'',rangelength:'Please enter password in the range of 2-6 characters.'},
			confirm_password: {required:'', equalTo:'Both passwords do not match.'},
			user_email: {required:'', digits:'Please enter a valid email.'},	
			phone_no: {required:'', digits:'Please enter digits only.'},	
			
			
		},
		submitHandler: function(form){
			form.submit();
		}
	});


}
/*
$(document).on('click', '.login-btn', function(){
	signupValidate();
});
*/
