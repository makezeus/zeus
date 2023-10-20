<div
  style="align-self: stretch; padding: 12px 0px 12px 0px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex; position: fixed; top: 0; left: 15px; right: 15px; background: #fff;"
  class="visible-xs">
  <div
    style="align-self: stretch; width: 100%; justify-content: space-between; align-items: center; display: inline-flex;  font-size: 1.25rem; font-weight: 500; padding-top:6px; padding-bottom: 6px;">
    <a href="#home" onclick="closeTab(event, 'changePassword')">
      <i class="ri-arrow-left-s-line"></i>
    </a>
    <div style="text-align: right;">
      Alterar Senha</div>
  </div>
</div>

<div class="card-body align-items-center" style="margin-top: 80px;">
  <div class="media-body ml-4">
    <form id="formSenha" action="<?php echo base_url(); ?>zeus/changePassword" method="post">
      <div style="<?= getMobileRequest() ? 'height: calc(100vh - 130px);' : '' ?>">
        <div class="form-group">
          <label for="oldPassword">SENHA ANTIGA</label>
          <input type="password" id="oldPassword" name="oldPassword" class="form-control">
        </div>
        <div class="form-group">
          <label for="newPassword">NOVA SENHA</label>
          <input type="password" id="newPassword" name="newPassword" class="form-control">
        </div>
        <div class="form-group">
          <label for="confirmPassword">CONFIRME A SENHA</label>
          <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
        </div>
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

    const form = document.getElementById("myForm");
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

          if (response) {
            var parse = JSON.parse(response)
            var novaImagem = parse.image_url;
            console.log(novaImagem)
            $('#profileImage').css('background-image', 'url(' + novaImagem + ')');
          }

          closeTab(event, 'profile')

        },
        error: function (xhr, status, error) {
          console.error(status, error);
        },
      });

    });
  });
</script>