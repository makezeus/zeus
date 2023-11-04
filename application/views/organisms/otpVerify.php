<form class="form" id="otpVerify" method="post" action="<?php echo base_url() ?>auth/resetPassword">
  <div class="control-group">
    <div class="input-otp">
      <input class="form-control" type="text" maxlength="1" id="otp1" name="otp1" placeholder="0"
        oninput="moveToNextField(this, 'otp2')">
      <input class="form-control" type="text" maxlength="1" id="otp2" name="otp2" placeholder="0"
        oninput="moveToNextField(this, 'otp3')">
      <input class="form-control" type="text" maxlength="1" id="otp3" name="otp3" placeholder="0"
        oninput="moveToNextField(this, 'otp4')">
      <input class="form-control" type="text" maxlength="1" id="otp4" name="otp4" placeholder="0"
        oninput="moveToNextField(this, 'otp5')">
      <input class="form-control" type="text" maxlength="1" id="otp5" name="otp5" placeholder="0"
        oninput="moveToNextField(this, 'otp6')">
      <input class="form-control" type="text" maxlength="1" id="otp6" name="otp6" placeholder="0">
    </div>
    <p id="error-message">Campo obrigatório</p>
    <div id="timer">1:00</div>
    <span id="resendOtp" style="display: none;">Se você não recebeu o código! <a href="#"
        onclick="updateCounter(), resendOtp()">Reenviar</a></span>
    <button class="btn-primary-outline btn btn-block" style="padding: 12px; margin-top: 48px" type="submit"
      id="login-button">Continuar</button><br>
  </div>
</form>

<script type="text/javascript">
  function updateCounter() {
    var elementCounter = document.getElementById("timer");
    var resendOtp = document.getElementById("resendOtp");
    var timeLeft = 60;
    resendOtp.style.display = "none";
    function update() {
      var minutes = Math.floor(timeLeft / 60);
      var seconds = timeLeft % 60;
      var text = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
      elementCounter.innerText = text;

      if (timeLeft === 0) {
        resendOtp.style.display = "block";
      } else {
        timeLeft--;
        setTimeout(update, 1000);
      }
    }

    update();
  }

  window.onload = updateCounter;

  function moveToNextField(input, nextFieldId) {
    if (input.value.length >= input.maxLength) {
      var nextField = document.getElementById(nextFieldId);
      if (nextField) {
        nextField.focus();
      }
    }
  }

  function resendOtp() {
    const data = { email: localStorage.getItem('email') };

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>auth/resetPassword?ajax=true",
      data: data,
      dataType: 'json',
      success: function (data) {
      },
      error: function (xhr, status, error) {
      },
    });
    return true;
  }


  $(document).ready(function () {
    $("#otpVerify").validate({
      submitHandler: function (form) {

        let data = $(form).serializeArray();

        var compressedOtp = '';
        data.forEach((data) => compressedOtp = compressedOtp + data.value)
        var otpVerifyForm = document.getElementById('otpVerify');
        var div = otpVerifyForm.querySelector('div');

        if (compressedOtp.length < 6) {
          div.classList.add('otp-error');
          return
        } else {
          div.classList.remove('otp-error');
        }
        data = { otp: compressedOtp }

        const buttons = form.querySelectorAll('button');
        handleButtonBlock(buttons, true, 'Aguarde...')


        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>auth/otp?ajax=true",
          data: data,
          dataType: 'json',
          success: function (data) {
            localStorage.setItem("email", data.email);
            localStorage.setItem("otp", data.otp);

            window.location.replace(`<?= base_url(); ?>auth/changePassword?otp=${data.otp}`);
            handleButtonBlock(buttons, false, 'Continuar')
          },
          error: function (error) {
            if (error.responseJSON && error.responseJSON.status === "error") {
              var errorMessage = error.responseJSON.message;
              showAlert("Opps :( Algo não saiu bem", errorMessage);
            }
            handleButtonBlock(buttons, false, 'Continuar');
          },
        })
        return true;
      },
    });
  });

</script>