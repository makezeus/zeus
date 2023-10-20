<div id="configuration"
  style="width: 100%; height: 100vh; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
  <div
    style="align-self: stretch; background: white; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
    <div
      style="align-self: stretch; padding: 12px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex">
      <div
        style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex;  font-size: 1.25rem; font-weight: 500; padding-top:6px; padding-bottom: 6px">
        <a href="#" onclick="window.history.back();">
          <i class="ri-arrow-left-s-line"></i>
        </a>
        <div style="text-align: right;">
          Configurações</div>
      </div>
      <div
        style="align-self: stretch; height: 117px; flex-direction: column; justify-content: center; align-items: center; display: flex">
        <div
          style="padding-top: 13px; padding-bottom: 13px; flex-direction: column; justify-content: center; align-items: center; gap: 12px; display: flex">
          <?= getProfileImage($this->session->userdata('nome'), $this->session->userdata('perfil'), 80) ?>
          <h5>
            <?= $this->session->userdata('nome') ?>
          </h5>
        </div>
      </div>
    </div>
  </div>

  <div
    style="align-self: stretch; flex: 1 1 0; background: #E5E7EB; box-shadow: 0px 0px 17px -17px rgba(0, 0, 0, 0.50); flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
    <div
      style="align-self: stretch; flex: 1 1 0; padding-top: 12px; padding-bottom: 12px; background: white; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
      <div
        style="align-self: stretch; height: 42px; padding-top: 12px; padding-left: 12px; padding-right: 12px; background: white; flex-direction: column; justify-content: center; align-items: flex-start; display: flex">
        <div
          style="align-self: stretch; padding-bottom: 6px; justify-content: space-between; align-items: center; display: inline-flex">

          <a style="height: 18.33px; color: black;" href="#home" onclick="openCity(event, 'profile')"> Editar Perfil</a>

          <div style="width: 24px; height: 24px; position: relative">
            <div>
              <i class="ri-arrow-right-s-line"></i>
            </div>
          </div>
        </div>
        <div style="width: 342px; height: 0px; border: 1px #F1F0F5 solid"></div>
      </div>
      <div
        style="align-self: stretch; height: 42px; padding-top: 12px; padding-left: 12px; padding-right: 12px; background: white; flex-direction: column; justify-content: center; align-items: flex-start; display: flex">
        <div
          style="align-self: stretch; padding-bottom: 6px; justify-content: space-between; align-items: center; display: inline-flex">
          <a style="height: 18.33px; color: black;" href="#home" onclick="openCity(event, 'changePassword')"> Trocar a
            Senha</a>
          <div>
            <i class="ri-arrow-right-s-line"></i>
          </div>
        </div>
        <div style="width: 342px; height: 0px; border: 1px #F1F0F5 solid"></div>
      </div>
      <div
        style="align-self: stretch; height: 42px; padding-top: 12px; padding-left: 12px; padding-right: 12px; background: white; flex-direction: column; justify-content: center; align-items: flex-start; display: flex">
        <div
          style="align-self: stretch; padding-bottom: 6px; justify-content: space-between; align-items: center; display: inline-flex">
          <a style="height: 18.33px; color: black;" href="#home" onclick="openCity(event, 'companyScreen')"> Editar
            empresa</a>
          <div>
            <i class="ri-arrow-right-s-line"></i>
          </div>
        </div>
        <div style="width: 342px; height: 0px; border: 1px #F1F0F5 solid"></div>
      </div>

    </div>
    <div
      style="align-self: stretch; height: 81.33px; padding-top: 12px; padding-bottom: 27px; padding-left: 12px; padding-right: 12px; background: white; flex-direction: column; justify-content: center; align-items: flex-start; display: flex">
      <div style="width: 100%;font-size: 0.75rem;">
        <div id="footer" class="span12 "> <a href="#" target="_blank">
            <?php echo date('Y'); ?> &copy; Zeus - Victor Azevedo
          </a></div>
      </div>

      <a class="btn btn-secondary btn-block btn-md" href="<?php echo site_url(); ?>/zeus/sair">Sair <i
          class="ri-logout-box-r-line"></i></a>
    </div>
  </div>
</div>
















<div class="tab-content">
  <div role="tabpanel" class="tabcontent tab-pane" id="profile"
    style="height: 100vh; position: fixed; top: 0; background: #fff; left: 0; padding: 15px; right: 0; padding-top: 0px;">
    <? $this->load->view($changeProfile) ?>
  </div>
  <div role="tabpanel" class="tabcontent tab-pane" id="changePassword"
    style="height: 100vh; position: fixed; top: 0; background: #fff; left: 0; padding: 15px; right: 0; padding-top: 0px;">
    <? $this->load->view($changePassword) ?>
  </div>
  <div role="tabpanel" class="tabcontent tab-pane" id="companyScreen"
    style="height: 100%; position: fixed; top: 0; background: #fff; left: 0; padding: 15px; right: 0; padding-top: 0px; overflow: auto;">
    <? $this->load->view($company) ?>
  </div>
</div>

<script>
  function openCity (event, tabId) {
    event.preventDefault();
    var tab = document.getElementById(tabId);
    // var configuration = document.getElementById('configuration');
    // configuration.style.display = "none";
    tab.classList.add('active');

  }

  function closeTab (event, tabId) {
    event.preventDefault();
    var londonTab = document.getElementById(tabId);
    londonTab.classList.remove('active');
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