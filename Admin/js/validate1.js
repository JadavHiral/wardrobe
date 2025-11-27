   $(document).ready(function() {
       $("#loginForm").validate({
           rules: {
               username: {
                   required: true,
                   email: true
               },
               password: {
                   required: true,
                   minlength: 6
               }
           },
           messages: {
               username: {
                   required: "Please enter your email",
                   email: "Please enter a valid email address"
               },
               password: {
                   required: "Please enter your password",
                   minlength: "Password must be at least 6 characters"
               }
           }
       });
   });
   