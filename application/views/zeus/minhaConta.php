<div class="visible-phone" id="headermobile">Minha Conta</div>
<div class="visible-phone" style="margin-top: 60px"></div>

<style>
  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;

  }

  .avatar-wrapper .profile-pic:after {
    font-family: FontAwesome;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    font-size: 0px;
    background: url('<?php echo $usuario->perfil; ?>');
    background-size: 80px;
    color: #34495e;
    text-align: center;
  }
</style>

<?php

$id = $this->session->userdata('id');

$query = $this->db->get_where('usuarios', array('idUsuarios' => $id));

foreach ($query->result_array() as $row) {
  $perfil = $row['perfil'];
  $nomeusuario = $row['nome'];
  $email = $row['email'];
  $telefone = $row['telefone'];
  $situacao = $row['situacao'];

}

?>
<h4 class="titulo visible-desktop">Minha Conta</h4>
<div style="
    background: #fff;
    border-radius: 10px;
    padding: 20px 0;
">
  <div class="container">
    <div class="row">


      <div>

        <!-- Nav tabs -->
        <div class="col-md-4">
          <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation" class="active"><a href="#home" onclick="openCity(event, 'London')">Geral</a></li>
            <li role="presentation"><a href="#profile" onclick="openCity(event, 'Paris')">Trocar Senha</a></li>
            <li role="presentation"><a href="#messages" onclick="openCity(event, 'Tokyo')">Messages</a></li>
          </ul>
        </div>
        <hr class="visible-phone">
        <br class="visible-phone">
        <div class="col-md-8">
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tabcontent active" id="London">



              <div class="card-body media align-items-center">
                <div class="media-body ml-4">
                  <form action="<?php echo base_url(); ?>minhaconta/editarLogo" id="formLogo"
                    enctype="multipart/form-data" method="post" class="form-horizontal">
                    <div class="imgminhaconta">
                      <div class="avatar-wrapper">
                        <img class="profile-pic" src="" />
                        <div class="upload-button">


                          <svg class="feather feather-arrow-up-circle  fa-arrow-circle-up sc-dnqmqq jxshSx"
                            xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            aria-hidden="true" data-reactid="136">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="16 12 12 8 8 12"></polyline>
                            <line x1="12" y1="16" x2="12" y2="8"></line>
                          </svg>

                        </div><input class="file-upload" name="userfile" type="file" accept="image/*" />
                      </div>
                    </div>


                    <div class="enviar " style="
    margin: 0px 100px;
">
                      <input id="nome" type="hidden" name="id" value="<?php echo $id; ?>" />
                      <button type="submit" class="btn btn-default md-btn-flat" style="
    margin-bottom: 20px;
">Enviar foto</button>
                      <div class="text-light small mt-1">Somente JPG, GIF or PNG. Tamanho maximo de 800K</div>
                    </div>

                  </form>

                </div>

                <hr>

                <form action="<?php echo base_url(); ?>minhaconta/editarUsuario" id="formAlterar"
                  enctype="multipart/form-data" method="post">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="phone" class="form-control" id="nome" value="<?php echo $nomeusuario ?>">
                    <input id="nome" type="hidden" name="id" value="<?php echo $id; ?>" />
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="phone" class="form-control" id="email" value="<?php echo $usuario->email; ?>">
                  </div>
                  <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="phone" class="form-control" id="telefone" value="<?php echo $usuario->telefone; ?>">
                  </div>
                  <fieldset disabled>
                    <div class="form-group">
                      <label for="permissao">Permissão</label>
                      <input type="phone" id="permissao" class="form-control"
                        value="<?php echo $usuario->permissao; ?>">
                    </div>
                  </fieldset>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>




              </div>
            </div>
            <div role="tabpanel" class="tabcontent" id="Paris">

              <form id="formSenha" action="<?php echo base_url(); ?>zeus/changePassword" method="post">

                <div class="span12" style="margin-left: 0">
                  <label for="">Senha Atual</label>
                  <input type="password" id="oldPassword" name="oldPassword" class="span12" />
                </div>
                <div class="span12" style="margin-left: 0">
                  <label for="">Nova Senha</label>
                  <input type="password" id="newPassword" name="newPassword" class="span12" />
                </div>
                <div class="span12" style="margin-left: 0">
                  <label for="">Confirmar Senha</label>
                  <input type="password" name="confirmPassword" class="span12" />
                </div>
                <div class="span12" style="margin-left: 0; text-align: center">
                  <button class="btn btn-primary">Alterar Senha</button>
                </div>
              </form>


            </div>
            <div role="tabpanel" class="tabcontent" id="Tokyo">.4..</div>

          </div>
        </div>
      </div>
    </div>





    <script>
      function openCity (evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
    </script>



    <script src="<?php echo base_url() ?>assets/js/file.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {

        $('#formSenha').validate({
          rules: {
            oldPassword: { required: true },
            newPassword: { required: true },
            confirmPassword: { equalTo: "#newPassword" }
          },
          messages: {
            oldPassword: { required: 'Campo Requerido' },
            newPassword: { required: 'Campo Requerido.' },
            confirmPassword: { equalTo: 'As senhas não combinam.' }
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