//var base_url = $('#base_url').val();
var ajax_url = 'http://localhost/coreProj/admin/ajaxHandlers';

$(document).ready(function(){
	validateLogin();
	
	
	$('#users').click(function(){
		$('.users-child').toggle('slow');
	});
	$('#settings').click(function(){
		$('.settings-child').toggle('slow');
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
