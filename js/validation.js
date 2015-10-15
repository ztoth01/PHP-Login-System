$(document).ready(function(){	
	
	$('#fullname').focus();

    var validCharactersRegex = /^[a-z]([-']?[a-z]+)*( [a-z]([-']?[a-z]+)*)+$/i;
    var fullname_valid = function(value) {
        return validCharactersRegex.test(value);
    }
    
    $.validator.addMethod("customFullname", function(value, element) {
        return fullname_valid(value);
    });
	                
                
	$('#signUpForm').validate({
		rules:{
			fname:{
				required:true,
				customFullname:true,
				},		
			email:{
				required:true,
				email:true
				},
			uname:{
				required:true,
				minlength:4
				},
			pword:{
				required:true,
				minlength:6
				}
			},//end rules
		messages:{
			fname:{
				required:'Please enter your full name',
				customFullname:'Your full name should be like: John Smith'
				},
			email: {
				required: "Please enter your e-mail address.",
				email: "This is not a valid email address"
				},
			uname:{
				required:'Please enter a username',
				minlength: 'Your username must be at least 4 characters long'
				},
			pword:{
				required:'You must enter a password',
				minlength: 'Password must be at least 6 characters long'
				}
			}//end of message
					
			
	});//end of validate

    //reset the form
    $('#signUpForm').each(function(){ 
    	this.reset();
    });//reset the form
    
    $('#signInForm').validate({
		rules:{
			username:{
				required:true,
				minlength:4
				},
			password:{
				required:true,
				minlength:6
				}
			},//end rules
		messages:{
			username:{
				required:'Please enter a username',
				minlength: 'Your username must be at least 4 characters long'
				},
			password:{
				required:'You must enter a password',
				minlength: 'Password must be at least 6 characters long'
				}
			}//end of message			
			
	});
    $('#signInForm').each(function(){ 
    	this.reset();
    });//reset the form
    

});//end of ready function