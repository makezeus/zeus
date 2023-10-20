<div
  style="align-self: stretch; padding: 12px 0px 12px 0px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex; position: fixed; top: 0; left: 15px; right: 15px; background: #fff;"
  class="visible-xs">
  <div
    style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex;  font-size: 1.25rem; font-weight: 500; padding-top:6px; padding-bottom: 6px; width: 100%; justify-content: space-between;">
    <a href="#home" onclick="closeTab(event, 'profile')">
      <i class="ri-arrow-left-s-line"></i>
    </a>
    <div style="text-align: right;">
      Editar Perfil</div>
  </div>
</div>

<div class="card-body align-items-center" style="margin-top: 80px;">
  <div class="media-body ml-4">
    <form id="profileForm" action="/minhaconta/upload_image" method="post" enctype="multipart/form-data">
      <div style="<?= getMobileRequest() ? 'height: calc(100vh - 130px);' : '' ?>">
        <div
          style="width: 100%; justify-content: flex-start; align-items: center; gap: 12px; display: inline-flex; padding-bottom:12px">
          <label style="color: #830AD1; font-size: 0.8rem; font-weight:500; display: flex; align-items: center;"
            for="imageInput">
            <picture id="imagePreview"
              style="width:80px; margin-left: 12px; margin-right: 12px; height: 80px; display: flex; background: #fff; border-radius: 100%; box-shadow: 0px 0px 15px #00000017;
    background-size: cover; background-position: center; justify-content: center; align-content: center; align-items: center; font-size: 1.25rem; font-weight: 500; color: #000;background-image: url(<?= $this->session->userdata('perfil') ?>)">
            </picture>
            <span>Adicionar
              foto +</span>
          </label>
          <input type="file" name="userfile" id="imageInput" accept="image/*" style="display: none;">
        </div>
        <div class="form-group">
          <label for="nome">NOME</label>
          <input type="text" name="nome" id="nome" class="form-control" value="<?= $this->session->userdata('nome') ?>">
        </div>
        <div class="form-group">
          <label for="EMAIL">EMAIL</label>
          <input type="email" name="email" id="email" class="form-control"
            value="<?= $this->session->userdata('email') ?>">
        </div>
        <div class="form-group">
          <label for="TELEFONE">TELEFONE</label>
          <input type="tel" name="telefone" id="telefone" class="form-control"
            value="<?= formatPhone($this->session->userdata('telefone')) ?>">
        </div>
        <fieldset disabled>
          <div class="form-group">
            <label for="permissao">PERMISSÃO</label>
            <input type="text" id="permissao" class="form-control"
              value="<?= $this->session->userdata('permission_label') ?>">
          </div>
        </fieldset>
      </div>
      <div style="display:flex; justify-content: flex-end">
        <button class="btn btn-primary <?= getMobileRequest() ? 'btn-block' : '' ?> " type="submit">Salvar</button>
      </div>

    </form>
  </div>
</div>




<script type="text/javascript">

  $(document).ready(function () {

    $('#telefone').inputmask(['(99) 9999-9999', '(99) 9 9999-9999']);

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

    const form = document.getElementById("profileForm");
    const imageInput = document.getElementById("imageInput");
    const imagePreview = document.getElementById("imagePreview");

    imageInput.addEventListener("change", function () {
      const file = imageInput.files[0];
      const reader = new FileReader();

      reader.onload = function (e) {
        const imageUrl = e.target.result;

        imagePreview.style.backgroundImage = `url(${imageUrl})`;
        imagePreview.style.display = "block";
      };

      if (file) {
        reader.readAsDataURL(file);
      } else {
        imagePreview.style.backgroundImage = "none";
        imagePreview.style.display = "none";
      }
    });


    form.addEventListener("submit", function (event) {
      event.preventDefault();
      const buttons = form.querySelectorAll('button');
      buttons.forEach((button) => {
        button.disabled = true;
        button.textContent = 'Aguarde...';
      });
      const formData = new FormData(form);
      const file = imageInput.files[0];

      if (file) {
        formData.append("image", file);
      }
      $.ajax({
        url: "/minhaconta/upload_image",
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

          if (response) {
            var parse = JSON.parse(response)
            var novaImagem = parse.image_url;
            $('#profileImage').css('background-image', 'url(' + novaImagem + ')');
          }

          closeTab(event, 'profile')

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

    });
  });
</script>