<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Zeus - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css">
  <link href="<?php echo base_url(); ?>assets/img/favicon.ico" rel="icon" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alert.js"></script>



</head>

<body>

  <div>
    <div style="margin-left: 48px; padding-top: 48px;">
      <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="">
    </div>
    <div class="center-flex">
      <div class="panel-body" style="padding: 16px; width: 390px">
        <div class="text-center" style="margin-bottom: 48px;">
          <h4>Faça seu login</h4>
        </div>
        <form class="form" id="formLogin" method="post" action="<?php echo base_url() ?>zeus/verificarLogin">
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
                <a href="#" style="color:#7012c5;font-size: 0.8rem;margin-top: 12px;">Esqueci minha senha</a>
              </div>
            </div>
            <button class="btn-primary-outline btn btn-block" style="padding: 12px; margin-top: 48px" type="submit"
              id="login-button">Continuar</button><br>
            <a style="color: #fff;" href="/home">Voltar ao Site</a>
          </div>
        </form>
        <div class="text-center">
          <a href="#" style="color:#7012c5; font-size: 0.8rem;">Ainda não sou cliente</a>
        </div>
      </div>

    </div>


  </div>


  <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/validate.js"></script>




  <script type="text/javascript">

    function handleView(event) {
      let input = $('#password')

      if (event.target.className === "ri-eye-line") {
        event.target.className = "ri-eye-off-line"
        input[0].type = 'text'
      } else {
        event.target.className = "ri-eye-line"
        input[0].type = 'password'
      }


    }

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
          var dados = $(form).serialize();

          const buttons = form.querySelectorAll('button');
          buttons.forEach((button) => {
            button.disabled = true;
            button.textContent = 'Aguarde...';
          });

          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>zeus/verificarLogin?ajax=true",
            data: dados,
            dataType: 'json',
            success: function (data) {
              if (data.result == true) {
                window.location.href = "<?php echo base_url(); ?>zeus";
              }

              else {
                buttons.forEach((button) => {
                  button.disabled = false;
                  button.textContent = 'Salvar';
                });
                showAlert('Opps :( Algo nao se saiu bem', 'Email e/ou senha inválidos')
              }
            }
          });
          return true;
        },
      });
    });

  </script>
</body>

</html>