<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Zeus - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css">
  <link href="<?php echo base_url(); ?>assets/img/favicon.ico" rel="icon" type="image/x-icon" />



</head>

<body>

  <div class="wrapper">
    <div class="container">
      <div class="control-group normal_text">
        <h1>
          <div>


            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
              id="Camada_1" x="0px" y="0px" viewBox="0 0 183.5 148"
              style="enable-background:new 0 0 183.5 148;width: 100px;position: relative;left: 20px;"
              xml:space="preserve">
              <style type="text/css">
                .st0 {
                  fill: #fff;
                }
              </style>
              <g>
                <path class="st0"
                  d="M93.7,83.6l89.8-42.1L82.5,79L52.8,22L0,127L93.7,83.6L93.7,83.6z M36,93.5l16-38.4L66.3,82L36,93.5z">
                </path>
                <polygon class="st0" points="79.1,115.4 101,115.2 101,115.2 94.8,103.7 78.8,111.8  "></polygon>
              </g>
            </svg>
          </div>
        </h1>


      </div>
      <form class="form" id="formLogin" method="post" action="<?php echo base_url() ?>zeus/verificarLogin">
        <div class="control-group">

          <div id="alerta" class="alert animated rubberBand alert-danger" style="display:none ;opacity: 1;">
            Email ou Senha invalidos! </div>


          <input type="text" id="email" name="email" placeholder="Usuário">
          <input type="password" name="senha" placeholder="Senha">
          <button type="submit" id="login-button">Login</button><br><br>
          <a style="color: #fff;" href="/home">Voltar ao Site</a>
        </div>
      </form>
    </div>

    <ul class="bg-bubbles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>


  <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/validate.js"></script>




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
          var dados = $(form).serialize();
          $('#btn-acessar').addClass('disabled');
          $('#progress-acessar').removeClass('hide');
          console.log(dados)
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>zeus/verificarLogin?ajax=true",
            data: dados,
            dataType: 'json',
            success: function (data) {
              console.log(data)
              if (data.result == true) {
                $('form').fadeOut(200);
                $('.wrapper').addClass('form-success');
                window.location.href = "<?php echo base_url(); ?>zeus";
              }
              else {


                $('#btn-acessar').removeClass('disabled');
                $('#progress-acessar').addClass('hide');

                $('#alerta').addClass('mostra');

                $(".alert").delay(4000).fadeOut(200, function () {
                  $(this).removeClass('mostra');
                });
              }


            }
          });

          return true;
        },

        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
          $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).parents('.control-group').removeClass('error');
          $(element).parents('.control-group').addClass('success');
        }
      });

    });

  </script>


</body>

</html>