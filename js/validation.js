$(function() {
  var $registration=$("#registration");
  if($registration.length){
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
              $registration.validate({
                // Specify validation rules
                rules: {
                        // The key name on the left side is the name attribute
                        // of an input field. Validation rules are defined
                        // on the right side
                        fname: "required",
                        lname: "required",

                        email: {
                          required: true,
                          // Specify that email should be validated
                          // by the built-in "email" rule
                          email: true
                        },
                        pass: {
                          required: true,
                          minlength: 5
                        },
                      
                      pass1: {
                        required: true,
                        minlength: 5
                      },
                      gender: "required",
                      education: "required",
                      address: "required",
                      dob: "required",
              },
                // Specify validation error messages
                messages: {
                            fname: "Please enter your firstname",
                            lname: "Please enter your lastname",
                         
                            pass: {
                              required: "Please provide a password",
                              minlength: "Your password must be at least 5 characters long"
                            },
                            pass1: {
                              required: "Please provide a password",
                              minlength: "Your password must be at least 5 characters long"
                            },
                            email: "Please enter a valid email address",
                            gender: "Please select the gender",
                            education: "Please select education",
                            address: "Please enter address",
                            dob:"Please select date of birth",
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                
              })
            }
});