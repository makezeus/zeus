<form class="form" id="forgotPassword" method="post">
  <div class="control-group">
    <div class="form-group">
      <input class="form-control" type="text" id="email" name="email" placeholder="Email">
    </div>
    <button class="btn-primary-outline btn btn-block" style="padding: 12px; margin-top: 48px" type="submit"
      id="login-button">Continuar</button><br>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function () {
    $("#forgotPassword").validate({
      rules: {
        email: { required: true, email: true },
      },
      messages: {
        email: { required: 'Campo obrigatório.', email: 'Insira Email válido' },
      },

      submitHandler: function (form) {
        let data = $(form).serialize();

        const buttons = form.querySelectorAll('button');
        handleButtonBlock(buttons, true, 'Aguarde...')

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>auth/resetPassword?ajax=true",
          data,
          dataType: 'json',
          success: function (data) {
            localStorage.setItem("email", data.email);
            window.location.replace("<?= base_url(); ?>auth/otpVerify");
          },
          error: function (xhr, status, error) {
            if (error.responseJSON && error.responseJSON.status === "error") {
              var errorMessage = error.responseJSON.message;
              showAlert("Opps :( Algo não saiu bem", errorMessage);
            }
            handleButtonBlock(buttons, false, 'Continuar');
          },
        });
        return true;
      },
    });
  });

</script>