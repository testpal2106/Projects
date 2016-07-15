//var base_url = $('#base_url').val();
var ajax_url = 'http://localhost/gitProjects/coreProj/admin/ajaxHandlers';

$(document).ready(function(){
	validateLogin();
	validateAddUser();
	
	
	$('#users').click(function(){
		$('.users-child').toggle('slow');
	});
	$('#settings').click(function(){
		$('.settings-child').toggle('slow');
	});
	
	$('#country').change(function(){
		var country_id = $(this).val();

		var data = {country_id:country_id}
		sendAjaxRequest(data, 'get_states');
		
	});
	
});

var validateLogin = function(){
	
	$('#login_form').validate({
		
		errorClass:'login-error',
		errorElement:'span',
	
		rules:{
			'email':{
				required:true,
				email:true,
				
			 },
			'password':{required:true}
			
		},
		messages:{
			'email':{
				required:'Please enter email address',
				email:'Please enter valid email.',
				
			 },
			'password':{required:'Please enter password.'}
			
		},
		submitHandler:function(form){
			form.submit();
		}
		
	});
	
}

var validateAddUser = function(){
	
	
	$('#add_user').validate({
		
		errorClass:'error-ms',
		errorElement:'span',
	
		rules:{
			'username':{required:true},
			'firstname':{required:true},
			'lastname':{required:true},
			'email':{
				required:true,
				email:true,
				
			 },
			'password':{required:true},
			'confirm_password':{required:true, equalTo:'#password'},
			'phone':{
				required:true,
				number:true,				
			 },
			'address':{required:true},
			'city':{required:true},
			'country':{required:true},
			'state':{required:true},
			
		},
		messages:{
			'username':{required:'Please enter username.'},
			'firstname':{required:'Please enter firstname.'},
			'lastname':{required: 'Please enter lastname.'},
			'email':{
				required:'Please enter email address',
				email:'Please enter valid email.',
				
			 },
			'password':{required:'Please enter password.'},
			'confirm_password':{required:'Please confirm your password.', equalTo:'Both passwords do not match.'},
			'phone':{
				required:'Please enter phone number.',
				number:'Please enter digits only.',				
			 },
			'address':{required:'Please enter address.'},
			'city':{required:'Please enter city.'},
			'country':{required:'Please select your country.'},
			'state':{required:'Please select state.'},
			
		},
		submitHandler:function(form){
			form.submit();
		}
		
	});
}

var validateEditUser = function(){
	$('#edit_user').validate({
		errorClass:'error-ms',
		errorElement:'span',
		rules:{
			'username':{required:true},
			'firstname':{required:true},
			'lastname':{required:true},
			'email':{
				required:true,
				email:true,
				
			 },
			
			'phone':{
				required:true,
				number:true,				
			 },
			'address':{required:true},
			'city':{required:true},
			'country':{required:true},
			'state':{required:true},
			
		},
		messages:{
			'username':{required:'Please enter username.'},
			'firstname':{required:'Please enter firstname.'},
			'lastname':{required: 'Please enter lastname.'},
			'email':{
				required:'Please enter email address',
				email:'Please enter valid email.',
				
			 },
			'phone':{
				required:'Please enter phone number.',
				number:'Please enter digits only.',				
			 },
			'address':{required:'Please enter address.'},
			'city':{required:'Please enter city.'},
			'country':{required:'Please select your country.'},
			'state':{required:'Please select state.'},
			
		},
		submitHandler:function(form){
			form.submit();
		}
		
	});
}

function sendAjaxRequest(data, action){
		var current_request = 
		$.ajax({
			url: ajax_url+'/get_states.php',
			method:'post',
			data: data,
			beforeSend: function() {
				$('#loader').show();
			},
			success: function(response){
				if(data != '' && data != null && typeof data != 'undefined'){
					resp = response;						
				}else{
					resp = 0;
				}
				
				if(action == 'get_states'){
					getStatesResponse(response);
				}
				
					
			},
			complete: function(){
				$('#loader').hide();
			},
			error:function(){
				
			}
		});
	}
	
	function getStatesResponse(response){
		if(response != '' && response != null ){				
			var resObj = $.parseJSON(response);	
			var option_string = '<option value="">Select State</option>';
			$.each(resObj, function(key, obj){
				option_string += '<option value="'+obj.state_id+'">'+obj.state_name+'</option>';
			});
			$('#state').html(option_string);
		}
	}
	
	function alertDeletion(){
		if(confirm('Are you sure, you want to delete this record?')){
			return true;
		}
		return false;
	}
	
