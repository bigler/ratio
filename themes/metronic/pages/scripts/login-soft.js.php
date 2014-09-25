Metronic.init(); // init metronic core components
Layout.init(); // init current layout

$('.login-form').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        username: { required: true },
        password: { required: true },
        remember: { required: false}
    },
    
    messages: {
        username: { required: "<?php __('Username is required.');?>" },
        password: { required: "<?php __('Password is required.');?>" }
    },

    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-danger', $('.login-form')).show();
    },
    
    highlight: function (element) { // hightlight error inputs
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    success: function (label) {
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {
        error.insertAfter(element.closest('.input-icon'));
    },

    submitHandler: function (form) {
        form.submit();
    }
});

$('.login-form input').keypress(function (e) {
    if (e.which === 13) {
        if ($('.login-form').validate().form()) {
            $('.login-form').submit();
        }
        return false;
    }
});

$.backstretch([
      "<?php echo THEMEHOME;?>/pages/media/bg/1.jpg",
      "<?php echo THEMEHOME;?>/pages/media/bg/2.jpg",
      "<?php echo THEMEHOME;?>/pages/media/bg/3.jpg",
      "<?php echo THEMEHOME;?>/pages/media/bg/4.jpg"
      ], {
        fade: 1000,
        duration: 8000
  }
  );
     // language choose
  $(".ln").hover(function() {
          lf = $(this).position();
          hr = $(this).attr('href');
          $('.rama').css({'left': lf.left - 2,'opacity':0.87});
          $('.rama').attr('href', hr);
          $('.lng_title').html($(this).attr('title'));
      });

