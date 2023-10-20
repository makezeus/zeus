<div>
  <div class="panel-heading">
    <? $this->load->view('components/breadcrumb'); ?>
    <h4 class="hidden-xs">Minha conta</h4>
  </div>
  <div>
    <div>
      <div style="display: flex; flex-direction: row; gap:12px;">
        <div style="display: flex; flex-direction: column; width: 100%">
          <div class="panel-body" style="height: 100%;">
            <div class="container-fluid">
              <h4>Editar Perfil</h4>
              <? $this->load->view($changeProfile) ?>
            </div>
          </div>
          <div class="panel-body" style="height: 100%;">
            <div class="container-fluid">
              <h4>Alterar Senha</h4>
              <? $this->load->view($changePassword) ?>
            </div>
          </div>
        </div>
        <div style="display: flex; flex-direction: column; width: 100%">
          <div class="panel-body">
            <div class="container-fluid">
              <h4>Empresa</h4>
              <? $this->load->view($company) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



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