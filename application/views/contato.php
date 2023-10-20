
<?php if(isset($email_enviado)) { ?>
<div id="mensagem_enviada" class="alert alert-success" role="alert">
  <?php echo $email_enviado ?>!
</div>
   
<?php } ?>
<div>
<img width="100%" src="<?php base_url()?>assets/img/contato.jpg" alt="">
</div>
<div style="background: #f9f9f9">
<div class="container"  >
  <section class="g-py-100" style="
    margin-bottom: 0px !important;
    padding-bottom: 20px !important;
}">

<h1>Contate-nos</h1>

<div class="row">

<div class="col-md-6" class="text-center">
   <img width="85%" src="<?php base_url()?>assets/img/contato.png" alt="">
   <br><br>
<p align="center">
  Se ainda existe dúvidas referente aos nossos serviços, deixe que um dos nossos consultores lhe ajude. Nosso time é treinado para oferecer todas as informações que você precisa.
</p>
<br> <br>
 <img width="85%" src="<?php base_url()?>assets/img/numeros.png" alt="">

</div>

 <div class=" col-md-6">  

<form id="form_contato" action="<?php echo $action ?>" method="post" class="form">

<!-- Text input name-->
<div class="form-group">
  
  <div class=" ">
  <input name="nome" id="nome" placeholder="Digitar nome completo" class="form-control input-md" required="" type="text">
  </div>
</div>

<!-- Text input empresa-->
<div class="form-group">
  
  <div class=" ">
  <input name="empresa" id="empresa" placeholder="Você é de alguma empresa?" class="form-control input-md" type="text"> 
  </div>
</div>

<!-- Text input cpfcnpj-->
<div class="form-group">

  <div class=" ">
  <input name="cpfcnpj" id="cpfcnpj" placeholder="Qual é seu CPF/CNPJ?" class="form-control input-md" type="text"> 
  </div>
</div>

<!-- Text input email-->
<div class="form-group">
 
  <div class=" ">
  <input name="email" id="email" placeholder="Qual seu E-mail" class="form-control input-md" required="" type="text"> 
  </div>
</div>
       
<!-- Text input Telefone-->
<div class="form-group">
 
  <div class=" ">
  <input name="telefone" id="telefone" placeholder="Qual seu Telefone/Whatsapp" class="form-control input-md" required="" type="text"> 
  </div>
</div>
       
<!-- Text input rua-->
<div class="form-group">

  <div class=" ">
  <input name="rua" id="rua" placeholder="Onde você está?" class="form-control input-md" required="" type="text"> 
  </div>
</div>

<!-- Text input cidade-->
<div class="form-group">

  <div class=" ">
  <input name="cidade" id="cidade" placeholder="Em qual Cidade?" class="form-control input-md" required="" type="text"> 
  </div>
</div>
           
<!-- Text input estado-->
<div class="form-group">
 
  <div class=" ">
  <input name="estado" id="estado" placeholder="qual seu Estado?" class="form-control input-md" required="" type="text"> 
  </div>
</div>
      
<!-- Text input assunto-->
<div class="form-group">
 
  <div class=" ">
  <input name="assunto" id="assunto" placeholder="Você quer falar sobre??" class="form-control input-md" required="" type="text"> 
  </div>
</div>    

<!-- Textarea -->
<div class="form-group">

  <div class=" ">                     
    <textarea class="form-control" id="mensagem" name="mensagem" rows="5">digite aqui sua mensagem</textarea>
  </div>
</div>
    <hr>
<!-- Button -->
<div class="form-group">
  <div class=" ">
    <button id="enviar" name="enviar" class="btn btn-dark">enviar</button>
  </div>
</div>
           

        </form>
        </div>
         </div>
       </section>
        </div>
</div>