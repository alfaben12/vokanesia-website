$(document).on('submit', '#xs-login-form', function (event) {
  event.preventDefault();
  var xs_login_email = $('#xs-login-email'),
  xs_login_password = $('#xs-login-password'),
  xs_login_submit = $('#xs-login-submit'),
  xs_login_error = !1;
  if ($("#url").length != 0) {
    var xs_login_url = $("#url").val()
  } else {
    var xs_login_url = null
  }
  $('.xpeedStudion_success_message').remove();

  if(xs_login_email.val().trim() === ''){
    xs_login_email.addClass('invalid');
    xs_login_error = !0;
    xs_login_email.focus();
    return !1;
  }else{
    xs_login_email.removeClass('invalid');
  }

  if(xs_login_password.val().trim() === ''){
    xs_login_password.addClass('invalid');
    xs_login_error = !0;
    xs_login_password.focus();
    return !1;
  }else{
    xs_login_password.removeClass('invalid');
  }

  if (xs_login_error === !1) {
    xs_login_submit.prop("disabled", true).html("Loading");
    xs_login_submit.before().hide().fadeIn();
    $.ajax({
      type: "POST",
      url: "/auth/login/do",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        'email': xs_login_email.val(),
        'password': xs_login_password.val(),
        'url': xs_login_url,
      },
      success: function success(result) {
        xs_login_submit.prop("disabled", false).html("Masuk");
        if (result.message == "success") {
          xs_login_submit.html("Success");
          setTimeout(function () {
            $(".xpeedStudio_success_message").fadeOut(1000, function () {
              $(this).remove();
            });
          }, 5000);
          $('#xs-login-form')[0].reset();
          $("#alertMessageLabel").html("Login Success");
          $("#modalDismiss").hide();
          $('#alertMessage').modal({backdrop: 'static', keyboard: false});
          if (result.url != null) {
            $("#message").html("Login success<br>You will redirected back");
            $("#loginMessage").modal("toggle");
            setTimeout(function () {
              window.location.replace(result.url);
            }, 3000);
          } else {
            $("#message").html("Login success<br>You will redirected to dashboard page");
            setTimeout(function () {
              window.location.replace('/customers/dashboard');
            }, 3000);
          }
        }
        else {
          $('#alertMessage').modal('show');
          $("#message").html(result.message);
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        xs_login_submit.prop("disabled", false).html("Daftar");
        $('#alertMessage').modal('show');
        $("#message").html("Whoops something went wrong on our servers<br>Please try again later");
      }
    });
  }
});

$(document).on('submit', '#xs-register-form', function (event) {
  event.preventDefault();
  var xs_register_f_name = $('#xs-register-f_name'),
  xs_register_l_name = $('#xs-register-l_name'),
  xs_register_email = $('#xs-register-email'),
  xs_register_password = $('#xs-register-password'),
  xs_register_c_password = $('#xs-register-c_password'),
  xs_register_no_hp = $('#xs-register-no_hp'),
  xs_register_submit = $('#xs-register-submit'),
  xs_register_error = !1,
  xs_register_form = $("#xs-register-form");
  $('.xpeedStudion_success_message').remove();

  if(xs_register_f_name.val().trim() === ''){
    xs_register_form.addClass("has-error");
    xs_register_f_name.addClass('is-invalid');
    xs_register_error = !0;
    xs_register_f_name.focus();
    return !1;
  }else{
    xs_register_form.removeClass("has-error");
    xs_register_f_name.removeClass('is-invalid');
  }

  if(xs_register_l_name.val().trim() === ''){
    xs_register_form.addClass("has-error");
    xs_register_l_name.addClass('is-invalid');
    xs_register_error = !0;
    xs_register_l_name.focus();
    return !1;
  }else{
    xs_register_form.removeClass("has-error");
    xs_register_l_name.removeClass('is-invalid');
  }

  if(xs_register_email.val().trim() === ''){
    xs_register_form.addClass("has-error");
    xs_register_email.addClass('invalid');
    xs_register_error = !0;
    xs_register_email.focus();
    return !1;
  }else{
    xs_register_form.removeClass("has-error");
    xs_register_email.removeClass('invalid');
  }

  if(xs_register_password.val().trim() === ''){
    xs_register_form.addClass("has-error");
    xs_register_password.addClass('invalid');
    xs_register_error = !0;
    xs_register_password.focus();
    return !1;
  }else{
    xs_register_form.removeClass("has-error");
    xs_register_password.removeClass('invalid');
  }

  if(xs_register_c_password.val().trim() === ''){
    xs_register_form.addClass("has-error");
    xs_register_c_password.addClass('invalid');
    xs_register_error = !0;
    xs_register_c_password.focus();
    return !1;
  }else{
    xs_register_form.removeClass("has-error");
    xs_register_c_password.removeClass('invalid');
  }

  if(xs_register_no_hp.val().trim() === ''){
    xs_register_form.addClass("has-error");
    xs_register_no_hp.addClass('invalid');
    xs_register_error = !0;
    xs_register_no_hp.focus();
    return !1;
  }else{
    xs_register_form.removeClass("has-error");
    xs_register_no_hp.removeClass('invalid');
  }

  if (xs_register_error === !1) {
    xs_register_submit.prop("disabled", true).html("Loading");
    xs_register_submit.before().hide().fadeIn();
    $.ajax({
      type: "POST",
      url: "/auth/register/do",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        'f_name' : xs_register_f_name.val(),
        'l_name' : xs_register_l_name.val(),
        'email': xs_register_email.val(),
        'password': xs_register_password.val(),
        'c_password' : xs_register_c_password.val(),
        'no_hp' : xs_register_no_hp.val()
      },
      success: function success(result) {
        xs_register_submit.prop("disabled", false).html("Daftar");
        if (result.status == "success") {
          xs_register_submit.html("Success");
          // xs_register_submit.after('<p class="xpeedStudio_success_message">' + result.message + '</p>').hide().fadeIn();
          setTimeout(function () {
            $(".xpeedStudio_success_message").fadeOut(1000, function () {
              $(this).remove();
            });
          }, 5000);
          $('#xs-login-form').trigger("reset");
          $("#alertMessageLabel").html("Register Success");
          $("#modalDismiss").hide();
          $('#alertMessage').modal('show');
          $("#message").html("Registration success<br>You will redirected to login page");
          setTimeout(function () {
            window.location.replace('/auth/login');
          }, 3000);
        }
        else {
          $('#alertMessage').modal('show');
          $("#message").html(result.message);
          // xs_register_submit.after('<p class="xpeedStudio_success_message">' + result.message + '</p>').fadeIn();
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest.responseText);
        xs_register_submit.prop("disabled", false).html("Daftar");
        $('#alertMessage').modal('show');
        $("#message").html("Whoops something went wrong on our servers<br>Please try again later");
      }
    });
  }
})
