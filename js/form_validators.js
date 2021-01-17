$('document').ready(function() { 

         var value = $("#password").val();

		$.validator.addMethod("checklower", function(value) {
		  return /[a-z]/.test(value);
		});
		$.validator.addMethod("checkupper", function(value) {
		  return /[A-Z]/.test(value);
		});
		$.validator.addMethod("checkdigit", function(value) {
		  return /[0-9]/.test(value);
		});
		$.validator.addMethod("pwcheck", function(value) {
		  return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[A-Z]/.test(value);
		});



		  /* handle form validation */  
		  $("#registration").validate({
                   
			   rules: {
								
								firstname: "required",
								lastname: "required",

								email: {
								  required: true,
								  // Specify that email should be validated
								  // by the built-in "email" rule
								  email: true
								},
								password: {
								  required: true,
								  minlength: 5,
								  // pwcheck: true,
								  // checklower: true,
								  // checkupper: true,
								  // checkdigit: true
								},
							  
							  password1: {
								required: true,
								minlength: 5,
								//equalTo: "#password"
							  },
							  gender: "required",
							   education: { 
								   required:  function () {
                                     return ($("#education option:selected").val() == "select");
								   }
							   },
							  address: "required",
							  dob: "required",
							  
					  },
					  
						// Specify validation error messages
						messages: {
									firstname: "Please enter your firstname",
									lastname: "Please enter your lastname",
								 
									password: {
									  required: "Please provide a password",
									  minlength: "Your password must be at least 5 characters long",
									  // pwcheck: "Password is not strong enough",
									  // checklower: "Need atleast 1 lowercase alphabet",
									  // checkupper: "Need atleast 1 uppercase alphabet",
									  // checkdigit: "Need atleast 1 digit"

									},
									password1: {
									  required: "Please provide a password",
									  minlength: "Your password must be at least 5 characters long",									  
									 equalTo: "Please enter the same passwords "
									},
									email: "Please enter a valid email address",
									gender: "Please select the gender",
									education: "Please select education",
									address: "Please enter address",
									dob:"Please select date of birth",
						},
						// a wrapper around the error message
				
				   errorPlacement: function(error, element) {
					   if (element.attr("name") == "gender" ) {
						 error.insertAfter("#requestgender");
					  } else {
						 error.appendTo(element.next('.errormessagewrapper').children());
					  }
					  
					  			
							},
							
							 
				submitHandler: function(form) {
//form.submit();
					$.ajax({
						
						url: 'registeration.php',
						type: "POST",
						data: $(form).serialize(),
						
						success: function(data) {

						if (data == 1) {
						   $(".message").addClass('alert alert-success').html('<i class="fa fa-fw fa-check-circle"></i><strong> Success ! </strong> Data saved successfully.');
						$(".alert-success").fadeOut(3000);
						//$('.login').html('<i class="fa fa fa-check-circle"></i> Done');
						setTimeout('window.location.href = "loginpage.php"; ',5000);
						} else if(data == 2) {
						   $(".message").addClass('alert alert-danger').html('<i class="fa fa-fw fa-times-circle"></i><strong> Note !</strong> Email already exist.');
						   $(".alert-danger").fadeOut(3000);
						$('.btn_submit').html('Create Account').attr("disabled",false);
						}
						else {
						   $(".message").addClass('alert alert-danger').html('<i class="fa fa-fw fa-times-circle"></i><strong> Note !</strong> Data saving failed.');
						   $(".alert-danger").fadeOut(3000);
						$('.btn_submit').html('Create Account').attr("disabled",false);
						}
					}
									
					});
					return false;
					
				}
			
			});
 /*  $(document).on('click', '.btn-submit', function(ev){
	ev.preventDefault();
	var btn_button = $(this);
	if($("#registration").valid() == true){
		var data = $("#registration").serialize();
		btn_button.html(' <i class="fa fa-spinner fa-spin"></i> Processing...');
		
		btn_button.attr("disabled",true).css('cursor','no-drop');
		
		 $.ajax({  
            url:"registeration.php",
            type: "post",  
            data: $(this).serialize(),
            error:function(XMLHttpRequest, textStatus, errorThrown){
                $(".alert-danger").hide();
				$(".alert-success").fadeIn(300);
				btn_button.html('Create Account').attr("disabled",false);
            },
            success: function(data) {
                if (data == "1") {
                   $(".alert-danger").hide();
				
				$(".alert-success").fadeIn(800);
				btn_button.html('<i class="fa fa fa-check-circle"></i> Done');
				setTimeout(function(){  location.loginpage.php; }, 500);
                } else {
                   $(".alert-success").hide();
				$(".alert-danger").fadeIn(300);
				btn_button.html('Create Account').attr("disabled",false);
                }
            }
        });
        return false; 
	}	
  
});
 */

				
		$("#login").validate({
                   
			         rules: {
								email: {
								  required: true,
								  
								},
								password: {
								  required: true,
								  minlength: 5
								}
							  
							 
							},
						// Specify validation error messages
						messages: {
									
								 
									password: {
									  required: "Please provide a password",
									  minlength: "Your password must be at least 5 characters long"

									},
									
									email: "Please enter a valid email address or user id",
							
							},
							
							submitHandler:function(form) {

					$.ajax({
						url: 'login.php',
						type: "POST",
						data: $(form).serialize(),
										
						success: function(data) {

						if (data == 1 ) {
							$('h2').css({'font-family': 'Raleway, sans-serif','letter-spacing':'3px','color':'Green'});
						   $(".message").addClass('alert alert-success').html('<i class="fa fa-fw fa-check-circle"></i><strong> Success ! </strong> Logged in successfully. ');
						$(".alert-success").fadeOut(4000);
						$("form").trigger("reset");
						setTimeout('window.location.href = "dashboard.php"; ',4000);
						} else {
							$('h2').css({'font-family': 'Raleway, sans-serif','letter-spacing':'3px','color':'red'});
						   $(".message").addClass('alert alert-danger').html('<i class="fa fa-fw fa-times-circle"></i><strong> Note !</strong> Invalid credencials .');
						$('.btn-submit').removeClass('btn-outline-success').addClass('btn-outline-danger')
						$(".alert-danger").fadeOut(5000);
						}
					}
									
					});
					return false;
					
				}
							
			   
			   }); 
			   
	}); 	
		