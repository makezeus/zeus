<html lang="en"><head>
  <meta charset="UTF-8">
  <title>Azevedo Segurança & Tecnologia</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php base_url() ?>assets/img/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="<?php base_url() ?>assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">
  
</head>
<body class="">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="background: url(assets/img/logo.svg);background-repeat:  no-repeat;background-position: right;padding: 30px;">azevedo</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse ">
        <ul class="nav navbar-nav navbar-right menu-two">
          <li><a href="home">Home</a></li>
          <li><a href="sobre">Sobre</a></li>
          <li><a href="contato">Contato</a></li>
          <li class="visible-lg"><a href="mine" data-balloon="Area do Cliente!" data-balloon-pos="down"><i class="fas fa-user"></i></a></li>
          <li class="visible-xs text-center"><a href="mine"><i class="fas fa-user"></i></a></li>
        </ul>
      </div>
    </div>
    <!--/.nav-collapse -->
  </nav><div><?php echo $contents; ?></div>

<footer class="text-center "  style="background: #fff; color: #333; margin: 0px;">

<br><br>
<div>
<div class="container">
  <p>Acompanhe-nos nas redes sociais:</p>
<br>
<p class="social">
<a href="https://www.facebook.com/azevedoseguranca/" target="_blank" title="Curta nossa fanpage"><i class="fab fa-facebook-square fa-3x" aria-hidden="true"></i></a>

<a href="http://api.whatsapp.com/send?1=pt_BR&phone=5547988194473 " target="_blank" title="LinkedIn"><i class="fab fa-whatsapp-square fa-3x" aria-hidden="true"></i></a>

<a href="https://www.instagram.com/azevedoseg/" target="_blank" title="YouTube"><i class="fab fa-instagram fa-3x" aria-hidden="true"></i></a>
</p>
<br>
<span style="font-size: 11px;">© Azevedo Seg. Todos os direitos reservados. Desenvolvido por <a href="http://vhatecnologia.com" target="_blank">VHA Tecnologia</a> </span>
<p><a href="zeus">Restrito</a></p>
</div>
</div>
</footer>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src='https://rawgit.com/lukejacksonn/Actuate/v1.0.0/actuate-animate.min.js'></script>
<script>
  $(function () {
  
  var $container = $('.destaque')
  
  $('<span class="center-block" style="font-size: 50px; padding-top: 30px;">VOCÊ</span>')
  .actuate('tada', function(x) {
  
            
      $('<H1>MAIS TECNOLOGICO</H1>')
      .actuate('fadeIn', function(y) {
        y.actuate('fadeOut', function (){
          y.remove();

  $('<h1>MAIS</h1>')
      .actuate('fadeIn', function(j) {
        j.actuate('fadeOut', function (){
          j.remove();


          $('<div  class="center-block seguro">SEGURO</div>')
          .actuate('slideInUp', function(z) {
            z.actuate('pulse infinite', function() {
                            
            }, 10000);
          },0).appendTo($container); 

        });

      }, 0).appendTo($container);
   });
  }, 0).appendTo($container);
  }, 0).appendTo($container);
  
});
</script>
</body></html>