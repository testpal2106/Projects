$(document).ready(function() {
	$('#login_form').validate({
		rules:{
			email:{
				required:true,
				email:true,
			},
			password:'required',
		},
		messages:{
			email:{
				required:'Please enter email address',
				email:'Please enter valid email address',
			},
			password:'Please enter password.',
		},
		errorElement:"div",
		errorClass:"login-error error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_pages').validate({
		ignore:[],
		debug: true,
		errorElement:'div',
		rules:{
			title:'required',
			'description':{
				required: function()
				{
					CKEDITOR.instances.description.updateElement();
				}
			},
		},
		messages:{
			title:'Please enter title.',
			'description':{
			   required: "Please enter content.",
			},
		},
		errorPlacement: function(error, element)
		{
			//console.log(element);
			if (element.attr("name") == "description") {
				error.appendTo(element.parents().find('.error_page'));
			} 
			else {
				error.appendTo(element.parents().find('.error-ms'));
			}
		},
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_plan').validate({
		ignore:[],
		debug: true,
		errorElement:'div',
		rules:{
			title:'required',
			//period:'required',
			'price':{
				required:true,
				//number:true,
			},
			'description':{
				required: function()
				{
					CKEDITOR.instances.description.updateElement();
				}
			},
		},
		messages:{
			title:'Please enter title.',
			//period:'Please select time period.',
			'price':{
			   required: "Please enter price.",
			  // number:'Please enter digits only.',
			},
			'description':{
			   required: "Please enter content.",
			},
		},
		errorPlacement: function(error, element)
		{
			//console.log(element);
			if (element.attr("name") == "description") {
				error.appendTo(element.parents().find('.error_page'));
			} 
			else {
				error.appendTo(element.parent().find('.error-ms'));
			}
		},
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#add_category_form').validate({
		rules:{
			cat_name:{
				required:true,
				remote:{
					url:admin_url+'categories/check_add_cat_name',
					type:'POST',
					data:{
						cat_name:function(){return $('#cat_name').val()},
						parent_id:function(){return $('#parent_id').val()},
					},
				},
			},
			userfile:{
				extension:'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',
			},
		},
		messages:{
			cat_name:{
				required:'Please enter category name.',
				remote:'Category already exists.',
			},
			userfile:{
				extension:'Please upload category image with .jpg, .jpeg, .png, .gif extensions.',
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_category_form').validate({
		rules:{
			cat_name:{
				required:true,
				remote:{
					url:admin_url+'categories/check_cat_name',
					type:'POST',
					data:{
						cat_name:function(){return $('#cat_name').val()},
						cat_id:function(){return $('#cat_id').val()},
					},
				},
			},
			userfile:{
				extension:'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',
			},
		},
		messages:{
			cat_name:{
				required:'Please enter category name.',
				remote:'Category already exists.',
			},
			userfile:{
				extension:'Please upload category image with .jpg, .jpeg, .png, .gif extensions.',
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_service_form').validate({
		rules:{
			serv_name:{
				required:true,
				remote:{
					url:admin_url+'categories/check_sub_cat_name',
					type:'POST',
					data:{
						serv_name:function(){return $('#serv_name').val()},
						cat_id:function(){return $('#category_id').val()},
						service_id:function(){return $('#service_id').val()},
					},
					
				},
			},
			userfile:{
				extension:'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',
			},
		},
		messages:{
			serv_name:{
				required:'Please enter sub-category name.',
				remote:'Sub-category already exists.',
			},
			userfile:{
				extension:'Please upload sub-category image with .jpg, .jpeg, .png, .gif extensions.',
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_tools_form').validate({
		rules:{
			tool_name:{
				required:true,
				remote:{
					url:admin_url+'categories/check_tool_name',
					type:'POST',
					data:{
						tool_name:function(){return $('#tool_name').val()},
						cat_id:function(){return $('#category_id').val()},
						tool_id:function(){return $('#tool_id').val()},
					},
				},
			},
			tool_price:{
				number:true,
			},
		},
		messages:{
			tool_name:{
				required:'Please enter tool name.',
				remote:'Tool already exists.',
			},
			tool_price:{
				number:'Please enter digits only.',
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#adin_change_pass').validate({
		rules:{
			old_password:{
				required:true,
				remote:{
					url:admin_url+'login/check_cur_password',
					type:'POST',
					data:{
						password:function(){return $('#old_password').val()},
					},
				},
			},
			new_password:{
				required:true,
			},
			con_password:{
				equalTo:'#new_password',
			},
		},
		messages:{
			old_password:{
				required:'Please enter current password.',
				remote:'Please enter correct current password.',
			},
			new_password:{
				required:'Please enter new password.',
			},
			con_password:{
				equalTo:'Passwords do not match.',
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_student_form').validate({
		rules:{
			stu_name:"required",
			clg_name:"required",
			status:"required",
			email:{
				required:true,
				email:true,
				remote:{
					url:admin_url+'students/check_stu_email',
					type: 'POST',
					data:{
						email:function() {return $('#email').val()},
						id:function() {return $('#stu_id').val()},
					},
				},
			},
			/*alone:"required",
			vehicle:"required",
			distance:{
				required:true,
				number:true,
			},
			categories:"required",*/
			userfile:{
				extension:'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',
			},
			/*resume:{
				extension:'txt',
			}, */
		},
		messages:{
			stu_name:"Please enter student name.",
			clg_name:"Please enter college name.",
			status:"Please select status.",
			email:{
				required:"Please enter email address.",
				email:"Please enter valid email address.",
				remote:"Email address already exists.",
			},
			/*alone:"Please select you want to work alone or not.",
			vehicle:"Please select vehicle.",
			distance:{
				required:"Please enter distance.",
				number:"Please enter digits only."
			},
			categories:"Please enter categories.",*/
			userfile:{
				extension:'Please upload profile image with .jpg, .jpeg, .png, .gif extensions.',
			},
			/*resume:{
				extension:'Please upload profile image with .txt extension.',
			}, */
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	/*$('#edit_owner_form').validate({
		rules:{
			stu_name:"required",
			clg_name:"required",
			status:"required",
			email:{
				required:true,
				email:true,
				remote:{
					url:admin_url+'owners/check_owner_email',
					type: 'POST',
					data:{
						email:function() {return $('#email').val()},
						id:function() {return $('#owner_id').val()},
					},
				},
			},
			alone:"required",
			vehicle:"required",
			distance:{
				required:true,
				number:true,
			},
			categories:"required",
			userfile:{
				extension:'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',
			},
			resume:{
				extension:'txt',
			},
		},
		messages:{
			stu_name:"Please enter student name.",
			clg_name:"Please select college name.",
			status:"Please select status.",
			email:{
				required:"Please enter email address.",
				email:"Please enter valid email address.",
				remote:"Email address already exists.",
			},
			alone:"Please select you want to work alone or not.",
			vehicle:"Please select vehicle.",
			distance:{
				required:"Please enter distance.",
				number:"Please enter digits only."
			},
			categories:"Please enter categories.",
			userfile:{
				extension:'Please upload profile image with .jpg, .jpeg, .png, .gif extensions.',
			},
			resume:{
				extension:'Please upload profile image with .txt extension.',
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});*/
	$('#edit_owner_form').validate({
		rules:{
			own_name:"required",
			status:"required",
			email:{
				required:true,
				email:true,
				remote:{
					url:admin_url+'owners/check_owner_email',
					type: 'POST',
					data:{
						email:function() {return $('#email').val()},
						id:function() {return $('#owner_id').val()},
					},
				},
			},
		},
		messages:{
			own_name:"Please enter owner name.",
			status:"Please select status.",
			email:{
				required:"Please enter email address.",
				email:"Please enter valid email address.",
				remote:"Email address already exists.",
			},
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	$('#edit_posted_job_form').validate({
		rules:{
			own_name:"required",
			email:{
				required:true,
				email:true,
				remote:{
					url:admin_url+'owners/check_owner_email',
					type: 'POST',
					data:{
						email:function() {return $('#email').val()},
						id:function() {return $('#owner_id').val()},
					},
				},
			},
			category:"required",
			need_help:"required",
			timeframe:{
				required:true,
			},
			helpers:"required",
			hours:"required",
			regular_work:"required",
			tool_yes_no:"required",
		},
		messages:{
			own_name:"Please enter owner name.",
			email:{
				required:"Please enter email address.",
				email:"Please enter valid email address.",
				remote:"Email address already exists.",
			},
			category:"Please select category.",
			need_help:"Please select when you need help.",
			timeframe:{
				required:"Please select timeframe.",
			},
			helpers:"Please select helpers.",
			regular_work:"Please select when you want your work to be done.",
			tool_yes_no:"Please select tools required or not.",
		},
		errorElement:"div",
		errorClass:"error-ms",
		submitHandler:function(form) {
			form.submit();
		}
	});
	
});
