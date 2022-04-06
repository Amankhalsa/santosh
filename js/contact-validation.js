// Contact Page Form
$(function() {
  $("form[name='contact-form']").validate({
    // Specify validation rules
    rules: {
      name: { required: true },
      mobile:{ required:true },
      email: { required:true, email:true },
      message: { required: true }
    },
    
    // Specify validation error messages
    messages: {
      name: { required: "Please provide name" },
      mobile: { required: "Please provide mobile no" },
      email:{ email: "Please enter a valid email address" },
      message: { required : "Please provide your message" }
    },
   
    submitHandler: function(form) {
      form.submit();
    }
  });
});

// Enquiry Popup Page Form
$(function() {
  $("form[name='contact-form-popup']").validate({
    // Specify validation rules
    rules: {
      name: { required: true },
      mobile:{ required:true },
      email: { required:true, email:true },
      message: { required: true }
    },
    
    // Specify validation error messages
    messages: {
      name: { required: "Please provide name" },
      mobile: { required: "Please provide mobile no" },
      email:{ email: "Please enter a valid email address" },
      message: { required : "Please provide your message" }
    },
   
    submitHandler: function(form) {
      form.submit();
    }
  });
});
