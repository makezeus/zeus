<form class="form" id="formLogin" method="post">
  <div class="control-group">
    <div class="form-group">
      <input class="form-control" type="text" id="email" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <div class="button-right-input">
        <input class="form-control" id="password" type="password" name="senha" placeholder="Senha">
        <div id="handle-password-view" class="input-btn" onclick="handleView(event)">
          <i class="ri-eye-line"></i>
        </div>
      </div>
      <div style="margin-top: 12px;">
        <a href="/auth/forgotPassword" style="color:#7012c5;font-size: 0.8rem;margin-top: 12px;">Esqueci minha
          senha</a>
      </div>
    </div>
    <button class="btn-primary-outline btn btn-block" style="padding: 12px; margin-top: 48px" type="submit"
      id="login-button">Continuar</button><br>
    <a style="color: #fff;" href="/home">Voltar ao Site</a>
  </div>
</form>


<script type="text/javascript">
  $(document).ready(function () {
    $('#email').focus();
    $("#formLogin").validate({
      rules: {
        email: { required: true, email: true },
        senha: { required: true }
      },
      messages: {
        email: { required: 'Campo Requerido.', email: 'Insira Email válido' },
        senha: { required: 'Campo Requerido.' }
      },
      submitHandler: function (form) {
        var data = $(form).serialize();

        const buttons = form.querySelectorAll('button');
        handleButtonBlock(buttons, true, 'Aguarde...')

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>auth/verificarLogin?ajax=true",
          data,
          dataType: 'json',
          success: function (data) {
            if (data.result == true) {
              window.location.href = "<?php echo base_url(); ?>zeus";
            }
            else {
              handleButtonBlock(buttons, false, 'Continuar')
              showAlert('Opps :( Algo nao se saiu bem', 'Email e/ou senha inválidos')
            }
          }
        });
        return true;
      },
    });
  });

</script>