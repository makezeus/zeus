<form id="resetPasswordForm" method="post">
  <div class="form-group">
    <input type="password" id="newPassword" name="newPassword" placeholder="Nova senha" class="form-control">
  </div>
  <div class="form-group">
    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirme a nova senha"
      class="form-control">
  </div>
  <button class="btn-primary-outline btn btn-block" style="padding: 12px; margin-top: 48px" type="submit"
    id="login-button">Continuar</button><br>
</form>


<script type="text/javascript">

  $(document).ready(function () {
    $("#resetPasswordForm").validate({
      rules: {
        newPassword: { required: true },
        confirmPassword: { equalTo: "#newPassword" }
      },
      messages: {
        newPassword: { required: 'Campo Requerido.' },
        confirmPassword: { equalTo: 'As senhas não combinam.' }
      },
      submitHandler: function (form) {
        let data = $(form).serialize();
        let email = localStorage.getItem('email')
        let otp = localStorage.getItem('otp')

        const buttons = form.querySelectorAll('button');
        buttons.forEach((button) => {
          button.disabled = true;
          button.textContent = 'Aguarde...';
        });

        $.ajax({
          type: "POST",
          url: `<?php echo base_url(); ?>auth/changePassword?ajax=true&otp=${otp}`,
          data,
          dataType: 'json',
          success: function (data) {
            if (data.result == true) {
              localStorage.clear();
              window.location.href = "<?php echo base_url(); ?>zeus";
            }
            buttons.forEach((button) => {
              button.disabled = false;
              button.textContent = 'Continuar';
            });
          },
          error: function (xhr, status, error) {
            buttons.forEach((button) => {
              button.disabled = false;
              button.textContent = 'Continuar';
            });
            console.error(status, error);
            showAlert('Desculpe, ocorreu um problema ao enviar o email', 'Verifique os detalhes do destinatário e tente novamente. Obrigado pela compreensão.')
          },
        });
        return true;
      },
    });
  });

</script>