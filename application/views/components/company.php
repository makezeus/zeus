<div
  style="align-self: stretch; padding: 12px 0px 12px 0px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex; position: fixed; top: 0; left: 15px; right: 15px; background: #fff;"
  class="visible-xs">
  <div
    style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex;  font-size: 1.25rem; font-weight: 500; padding-top:6px; padding-bottom: 6px; width: 100%; justify-content: space-between;">
    <a href="#home" onclick="closeTab(event, 'companyScreen')">
      <i class="ri-arrow-left-s-line"></i>
    </a>
    <div style="text-align: right;">
      Editar Empresa</div>
  </div>
</div>

<form id="company" action="/zeus/editCompany" method="post" enctype="multipart/form-data"  style="margin-top: 80px;">
  <div>
    <div
      style="width: 100%; justify-content: flex-start; align-items: center; gap: 12px; display: inline-flex; padding-bottom:12px">
      <label style="color: #830AD1; font-size: 0.8rem; font-weight:500; display: flex; align-items: center;"
        for="logoInput">
        <picture id="logoPreview"
          style="width:80px; margin-left: 12px; margin-right: 12px; height: 80px; display: flex; background: #fff; border-radius: 100%; box-shadow: 0px 0px 15px #00000017;
    background-size: cover; background-position: center; justify-content: center; align-content: center; align-items: center; font-size: 1.25rem; font-weight: 500; color: #000;background-image: url(<?= $this->session->userdata('company')[0]->url_logo; ?>)">
        </picture>
        <span>Adicionar
          logo +</span>
      </label>
      <input type="file" name="userfile" id="logoInput" accept="image/*" style="display: none;">
    </div>

    <div class="form-group">
      <label for="nome">Razão Social<span class="required">*</span></label>
      <input id="nome" type="text" name="nome" class="form-control"
        value="<?= $this->session->userdata('company')[0]->nome; ?>" />

    </div>
    <div class="form-group">
      <label for="cnpj">CNPJ<span class="required">*</span></label>
      <input type="text" name="cnpj" id="companyCnpj" class="form-control"
        value="<?= $this->session->userdata('company')[0]->cnpj; ?>" />
    </div>

    <div class="form-group">
      <label for="descricao"><span class="required">IE*</span></label>
      <input type="text" name="ie" class="form-control" value="<?= $this->session->userdata('company')[0]->ie; ?>" />
    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">Logradouro*</span></label>
      <input type="text" name="logradouro" class="form-control"
        value="<?= $this->session->userdata('company')[0]->rua; ?>" />

    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">Número*</span></label>
      <input type="text" name="numero" class="form-control"
        value="<?= $this->session->userdata('company')[0]->numero; ?>" />

    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">Bairro*</span></label>
      <input type="text" name="bairro" class="form-control"
        value="<?= $this->session->userdata('company')[0]->bairro; ?>" />

    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">Cidade*</span></label>
      <input type="text" name="cidade" class="form-control"
        value="<?= $this->session->userdata('company')[0]->cidade; ?>" />

    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">UF*</span></label>
      <input type="text" name="uf" class="form-control" value="<?= $this->session->userdata('company')[0]->uf; ?>" />

    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">Telefone*</span></label>
      <input type="text" name="telefone" id="companyPhone" class="form-control"
        value="<?= $this->session->userdata('company')[0]->telefone; ?>" />

    </div>
    <div class="form-group">
      <label for="descricao"><span class="required">E-mail*</span></label>
      <input type="text" name="email" class="form-control"
        value="<?= $this->session->userdata('company')[0]->email; ?>" />
    </div>

    <div style="display:flex; justify-content: flex-end">
      <button class="btn btn-primary <?= getMobileRequest() ? 'btn-block' : '' ?> " type="submit">Salvar</button>
    </div>
  </div>
</form>


<script src="<?php echo base_url() ?>assets/js/file.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">

  $(document).ready(function () {
    $('#companyCnpj').inputmask(['99.999.999/9999-99', '999.999.999-99']);
    $('#companyPhone').inputmask(['(99) 9999-9999', '(99) 9 9999-9999']);

    $("#company").validate(
      {
        rules: {
          userfile: { required: true },
          nome: { required: true },
          cnpj: { required: true },
          ie: { required: true },
          logradouro: { required: true },
          numero: { required: true },
          bairro: { required: true },
          cidade: { required: true },
          uf: { required: true },
          telefone: { required: true },
          email: { required: true }
        },
        messages: {
          userfile: { required: 'Campo Requerido.' },
          nome: { required: 'Campo Requerido.' },
          cnpj: { required: 'Campo Requerido.' },
          ie: { required: 'Campo Requerido.' },
          logradouro: { required: 'Campo Requerido.' },
          numero: { required: 'Campo Requerido.' },
          bairro: { required: 'Campo Requerido.' },
          cidade: { required: 'Campo Requerido.' },
          uf: { required: 'Campo Requerido.' },
          telefone: { required: 'Campo Requerido.' },
          email: { required: 'Campo Requerido.' }
        },

        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
          $(element).parents('.form-group').addClass('error');
          $(element).parents('.form-group').removeClass('success');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).parents('.form-group').removeClass('error');
          $(element).parents('.form-group').addClass('success');
        }
      }
    );


    const form = document.getElementById("company");
    const logoInput = document.getElementById("logoInput");
    const logoPreview = document.getElementById("logoPreview");

    logoInput.addEventListener("change", function () {
      const file = logoInput.files[0];
      const reader = new FileReader();

      reader.onload = function (e) {
        const imageUrl = e.target.result;

        logoPreview.style.backgroundImage = `url(${imageUrl})`;
        logoPreview.style.display = "block";
      };

      if (file) {
        reader.readAsDataURL(file);
      } else {
        logoPreview.style.backgroundImage = "none";
        logoPreview.style.display = "none";
      }
    });



    form.addEventListener("submit", function (event) {
      event.preventDefault();

      if ($("#company").validate().errorList.length === 0) {
        const buttons = form.querySelectorAll('button');
        buttons.forEach((button) => {
          button.disabled = true;
          button.textContent = 'Aguarde...';
        });

        const formData = new FormData(form);
        const file = logoInput.files[0];

        if (file) {
          formData.append("image", file);
        }
        $.ajax({
          url: "/zeus/editCompany",
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            buttons.forEach((button) => {
              button.disabled = false;
              button.textContent = 'Salvar';
            });
            showAlert('Dados atualizados', 'Seus dados foram atualizados e estarão visiveis em todos os documentos.')

            closeTab(event, 'company')
          },
          error: function (xhr, status, error) {
            buttons.forEach((button) => {
              button.disabled = false;
              button.textContent = 'Salvar';
            });
            console.error(status, error);
            showAlert('Opps :( Algo nao se saiu bem', 'Não conseguimos atualizar os dados, tente novamente mais tarde!')
          },
        });
      }
    });
  });

</script>

<style>
  .mostra {
    display: block !important;
  }
</style>