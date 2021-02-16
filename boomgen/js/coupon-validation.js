(function($) {
  'use strict';
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });
  $(function() {
    // validate the comment form when it is submitted
    $("#commentForm").validate({
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('f  orm-control-danger')
      }
    });
    // validate signup form on keyup and submit
    $("#signupForm").validate({
      rules: {
        
        logoupload: {
          required: true,
          minlength: 5
        },
        title: {
          required: true,
          minlength: 5
        },
        description: {
          required: true,
          minlength: 5,
          
        },
        percentageoff: {
          required: true,
          minlength: 10,
        },
        expirydate: {
          required: true,
          minlength:  12
        },
        amount: {
          required: true,
          minlength:  100
        },
        address2: {
          required: true,
          minlength:  100
        },
        state: {
          required: true,
          minlength:  100
        },
        topic: {
          required: "#newsletter:checked",
          minlength: 2
        },
        agree: "required"
      },
      messages: {
      
        logoupload: {
          required: "Please upload a file",
          minlength: "your title must consist of characters"
        },
        title: {
          required: "Please provide a title",
          minlength: "your title must consist of characters"
        },
        description: {
          required: "Please provide a description",
          minlength: "your description title must consist of charaters ",
        },
        percentageoff: {
          required: "Please provide a percentageoff",
          minlength: "Your phonenumber must be at least 12 characters long",
        },
        expirydate: {
          required: "Please provide a expirydate",
          minlength: "Your address1 must be at characters long",
        },
        amount: {
          required: "Please provide a amount",
          minlength: "Your address1 must be at least characters long",
        },
        
       
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#username").focus(function() {
      var firstname = $("#firstname").val();
      var lastname = $("#lastname").val();
      if (firstname && lastname && !this.value) {
        this.value = firstname + "." + lastname;

      }
    });
    //code to hide topic selection, disable for demo
    var newsletter = $("#newsletter");
    // newsletter topics are optional, hide at first
    var inital = newsletter.is(":checked");
    var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
    var topicInputs = topics.find("input").attr("disabled", !inital);
    // show when newsletter is checked
    newsletter.on("click", function() {
      topics[this.checked ? "removeClass" : "addClass"]("gray");
      topicInputs.attr("disabled", !this.checked);
    });
  });
})(jQuery);