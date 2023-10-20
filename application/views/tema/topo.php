<!DOCTYPE html>
<html lang="pt-br" style="overflow: hidden;">

<head>
  <title>Zeus</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap3.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css"
    integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
    integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css" />

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alert.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9-beta.33/jquery.inputmask.min.js"
    integrity="sha512-+I5rQOmV+kNI/jqK4PtFNSnsgKb/pXyN6pBLpPq4zAj2GkQ4i3NTKVAH9X2dbqay7DQP1unkqaR3b9vIjeuJ0w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600&display=swap');
  </style>
</head>


<?php
$partesNome = explode(" ", $this->session->userdata('nome'));
$sql = "SELECT 
SUM(CASE WHEN baixado = 1 AND tipo = 'receita' THEN valor END) as total_receita, 
SUM(CASE WHEN baixado = 1 AND tipo = 'despesa' THEN valor END) as total_despesa,
SUM(CASE WHEN baixado = 0 AND tipo = 'receita' THEN valor END) as total_receita_pendente,
SUM(CASE WHEN baixado = 0 AND tipo = 'despesa' THEN valor END) as total_despesa_pendente 
FROM lancamentos
WHERE MONTH(data_pagamento) = MONTH(CURDATE()) AND YEAR(data_pagamento) = YEAR(CURDATE());
";
$estatisticas_financeiro = $this->db->query($sql)->row();
$hasImagem = !empty($this->session->userdata('perfil'));
?>

<div id="boxl" style="display: none;"></div>

<body class="body">
  <div class="main">
    <div id="sidebar" style="overflow-y: auto;" data-spy="affix" data-offset-top="10">
      <div class="logo">

        <svg width="37" height="45" viewBox="0 0 37 45" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M35.5664 29.3478H28.2125C27.5439 29.3478 27.0091 29.9592 27.0091 30.4484V36.4402C27.0091 37.0516 26.3405 37.5408 25.8057 37.5408H14.3068C13.2371 37.5408 12.7023 36.4402 13.3708 35.7065L36.3687 9.04891C36.5024 8.92663 36.6361 8.55978 36.6361 8.31522V1.10054C36.7698 0.611413 36.1012 0 35.4327 0H1.20337C0.668542 0 0 0.611413 0 1.10054V13.9402C0 14.5516 0.668542 15.0408 1.20337 15.0408H8.55733C9.22588 15.0408 9.76071 14.4293 9.76071 13.9402V8.55978C9.76071 7.94837 10.4292 7.45924 10.9641 7.45924H22.1956C23.2653 7.45924 23.8001 8.55978 23.1315 9.29348L0.267417 35.8288C0.133708 35.9511 0 36.3179 0 36.5625V43.8995C0 44.5109 0.668542 45 1.20337 45H35.5664C36.235 45 36.7698 44.3886 36.7698 43.8995V30.4484C37.0372 29.7147 36.3687 29.3478 35.5664 29.3478ZM22.463 12.2283L18.7192 19.8098L25.0035 20.4212L16.5798 30.0815L20.8585 22.2554L14.5742 21.3995L22.463 12.2283Z"
            fill="#9333EA" />
        </svg>

      </div>
      <ul>

        <div class="funcoes visible-xs" style=" background: #fff; height: 52px;">
          <form style="padding: 2px; overflow: hidden;" class="form-inline"
            action="<?php echo base_url() ?>zeus/pesquisar">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon search">
                  <button type="submit" class="bottom-search" title="Pesquisar"><i class="fas fa-search"></i></button>
                </div>
                <input class="pesquisa" type="text" name="termo" placeholder="Pesquisar..."
                  style="border: none;height: 50px;">
              </div>
            </div>
          </form>

        </div>

        <li class="<?php if (isset($menuPainel)) {
          echo 'active';
        }
        ; ?>"><a href="<?php echo base_url() ?>zeus"><i class="fas fa-home"></i></i>
            <span>Dashboard</span></a></li>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
          <li class="<?php if (isset($menuClientes)) {
            echo 'active';
          }
          ; ?>"><a href="<?php echo base_url() ?>clientes"><i class="fas fa-users"></i></i>
              <span>Clientes</span></a></li>
        <?php } ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) { ?>
          <li class="<?php if (isset($menuProdutos)) {
            echo 'active';
          }
          ; ?>"><a href="<?php echo base_url() ?>produtos"><i class="fas fa-barcode"></i>
              <span>Produtos</span></a></li>
        <?php } ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vServico')) { ?>
          <li class="<?php if (isset($menuServicos)) {
            echo 'active';
          }
          ; ?>"><a href="<?php echo base_url() ?>servicos"><i class="fas fa-wrench"></i>
              <span>Serviços</span></a></li>
        <?php } ?>



        <li class="<?php if (isset($menuRecibos)) {
          echo 'active';
        }
        ; ?>"><a href="<?php echo base_url() ?>recibos"><i class="fas fa-receipt"></i> <span>
              Recibos</span></a></li>

        <li class=""><a href="https://tributario.sef.sc.gov.br/tax.NET/Sat.NFe.Web/Avulsa/ValidacaoEmitenteNFA.aspx"
            target="_blank">
            <i class="fas fa-file-invoice"></i> <span>NF-e</span></a></li>
        <li class=""><a href="https://nfse.itajai.sc.gov.br/controlador.jsp" target="_blank">
            <i class="fas fa-file-invoice"></i> <span>NFS-e</span></a></li>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) { ?>
          <li class="<?php if (isset($menuOs)) {
            echo 'active';
          }
          ; ?>"><a href="<?php echo base_url() ?>os"><i class="fas fa-file-contract"></i><span>Ordens de
                Serviço</span></a></li>
        <?php } ?>


        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vArquivo')) { ?>
          <li class="<?php if (isset($menuArquivos)) {
            echo 'active';
          }
          ; ?>"><a href="<?php echo base_url() ?>arquivos"><i class="fas fa-hdd"></i>
              <span>Arquivos</span></a></li>
        <?php } ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vLancamento')) { ?>
          <li class="submenu <?php if (isset($menuFinanceiro)) {
            echo 'active open';
          }
          ; ?>">
            <a href="#"><i class="fas fa-money-check-alt"></i> <span>Financeiro</span> <span class="label"><i
                  class="fas fa-chevron-down"></i> </span></a>
            <ul style="display: none !important;">
              <li><a href="<?php echo base_url() ?>financeiro/lancamentos">Lançamentos</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rCliente') || $this->permission->checkPermission($this->session->userdata('permissao'), 'rProduto') || $this->permission->checkPermission($this->session->userdata('permissao'), 'rServico') || $this->permission->checkPermission($this->session->userdata('permissao'), 'rOs') || $this->permission->checkPermission($this->session->userdata('permissao'), 'rFinanceiro') || $this->permission->checkPermission($this->session->userdata('permissao'), 'rVenda')) { ?>

          <li class="submenu <?php if (isset($menuRelatorios)) {
            echo 'active open';
          }
          ; ?>">
            <a href="#"><i class="fas fa-list-ul"></i> <span>Relatórios</span> <span class="label"><i
                  class="fas fa-chevron-down"></i></span></a>
            <ul style="display: none;">

              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rCliente')) { ?>
                <li><a href="<?php echo base_url() ?>relatorios/clientes">Clientes</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rProduto')) { ?>
                <li><a href="<?php echo base_url() ?>relatorios/produtos">Produtos</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rServico')) { ?>
                <li><a href="<?php echo base_url() ?>relatorios/servicos">Serviços</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rOs')) { ?>
                <li><a href="<?php echo base_url() ?>relatorios/os">Ordens de Serviço</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rFinanceiro')) { ?>
                <li><a href="<?php echo base_url() ?>relatorios/financeiro">Financeiro</a></li>
              <?php } ?>

            </ul>
          </li>

        <?php } ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'cUsuario') || $this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente') || $this->permission->checkPermission($this->session->userdata('permissao'), 'cPermissao') || $this->permission->checkPermission($this->session->userdata('permissao'), 'cBackup')) { ?>
          <li class="submenu <?php if (isset($menuConfiguracoes)) {
            echo 'active open';
          }
          ; ?>">
            <a href="#"><i class="fas fa-cog"></i> <span>Configurações</span> <span class="label"><i
                  class="fas fa-chevron-down"></i></span></a>
            <ul>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'cUsuario')) { ?>
                <li><a href="<?php echo base_url() ?>usuarios">Usuários</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) { ?>
                <li><a href="<?php echo base_url() ?>zeus/emitente">Emitente</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'cPermissao')) { ?>
                <li><a href="<?php echo base_url() ?>permissoes">Permissões</a></li>
              <?php } ?>
              <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'cBackup')) { ?>
                <li><a href="<?php echo base_url() ?>zeus/backup">Backup</a></li>
              <?php } ?>

            </ul>
          </li>
        <?php } ?>

        <li class="nav-item active">
          <a class="nav-link text-center enxuta" id="sidenavToggler" style="background: none !important;">
            <i id="flecha" class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>

      </ul>
    </div>


    <nav class="navbar hidden-xs">
      <div
        style="display: flex; justify-content: space-between; align-items: center; flex-direction: row; height:inherit">
        <form style="padding: 2px;" class="form-inline" action="<?php echo base_url() ?>zeus/pesquisar">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon search">
                <button type="submit" class="bottom-search" title="Pesquisar"><i class="fas fa-search"></i></button>
              </div>
              <input class="pesquisa" type="text" name="termo" placeholder="Pesquisar..."
                style="border: none;height: 50px; background: transparent">
            </div>
          </div>
        </form>

        <div style="padding-left: 12px; padding-right: 12px">
          <div class="dropdown">
            <a href="#" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
              style="display: flex; flex-direction: row; align-items: center;">

              <?= getProfileImage($this->session->userdata('nome'), $this->session->userdata('perfil'), 40) ?>

              <span style="font-size: 15px;padding: 5px;position: relative;top: 2px;"><i
                  class="fas fa-chevron-down"></i></span>
            </a>

            <ul style="border: none;border-radius:5px;right: 25px;position: fixed;top: 55px;left: auto;"
              class="dropdown-menu" aria-labelledby="dLabel">
              <li class=""><a style="padding: 10px" title="" href="<?php echo site_url(); ?>zeus/configuration"><i
                    class="fas fa-user-cog"></i> <span class="text">Minha Conta</span></a></li>
              <li><a style="padding: 10px" href="<?php echo site_url(); ?>/mine"><i class="fas fa-users-cog"></i> <span
                    class="text">Área do Cliente</span></a></li>
              <li><a style="padding: 10px" href="<?php echo site_url(); ?>/home" target="_blank"><i
                    class="fas fa-external-link-alt"></i> <span class="text">Ir ao Site</span></a></li>
              <li><a style="padding: 10px" title="" href="<?php echo site_url(); ?>/zeus/sair"><i
                    class="fas fa-door-open"></i> <span class="text">Sair do Sistema</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <? if (!isset($hiddenMobileMenu)) { ?>
      <div id="menumobile" class="visible-xs">
        <div>
          <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
            <span style="font-size: 1.25rem; padding-bottom: 14px; font-weight: 500;">
              <?= $pageName ?? 'pagina' ?>
            </span>
            <div style="display: flex; gap: 14px; padding-bottom: 14px;">
              <a href="javascript:void(0)"" class=" pull-left tip-bottom animated rubberBand" onclick="openNav()"><i
                  class="ri-menu-2-line"></i></a>
              <div class="dropdown">
                <a href="/zeus/configuration" style="display: flex; flex-direction: row; align-items: center;">
                  <i class="ri-settings-3-line"></i>
                </a>
              </div>
            </div>
          </div>
          <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
            <div style="display: flex; align-items: center;">
              <?= getProfileImage($this->session->userdata('nome'), $this->session->userdata('perfil'), 35) ?>
              <span style='font-size: 1.rem; font-weight: 500'>Olá,
                <?= $partesNome[0] ?>
              </span>
            </div>
            <div style="display: flex;flex-direction: column;align-items: flex-end;">
              <span style="font-weight: 500; font-size: 1.25rem; color: #9333EA">
                R$
                <?= number_format($estatisticas_financeiro->total_receita - $estatisticas_financeiro->total_despesa, 2, ',', '.') ?>
              </span>
              <span style="font-size: 12px; opacity: 0.5">RECEITA MENSAL</span>
            </div>
          </div>
        </div>
      </div>

    <? } ?>


    <div id="content" style="<?= isset($hiddenMobileMenu) ? 'margin-top: 0px !important' : ''; ?>">

      <div class="container-fluid">
        <div class="row-fluid">
          <div class="span12">
            <?php if ($this->session->flashdata('error') != null) { ?>
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('error'); ?>
              </div>
            <?php } ?>

            <?php if ($this->session->flashdata('alert') != null) { ?>
              <script>
                $(document).ready(function () {
                  showAlert('<?= $this->session->flashdata('alert')['title'] ?>', '<?= $this->session->flashdata('alert')['message'] ?>')
                });
              </script>
            <?php } ?>

            <?php if ($this->session->flashdata('success') != null) { ?>
              <script>
                $(document).ready(function () {
                  showAlert('Sucesso!!', $this -> session -> flashdata('success'))
                });
              </script>
            <?php } ?>

            <?php if (isset($view)) {
              echo $this->load->view($view, null, true);
            } ?>
          </div>
        </div>
      </div>
      <!--Footer-part-->
      <div class="row-fluid hidden-xs">

        <div id="footer" class="span12 "> <a href="#" target="_blank">
            <?php echo date('Y'); ?> &copy; Zeus - Victor Azevedo
          </a></div>
      </div>
      <!--end-Footer-part-->


    </div>
  </div>


  <div style="margin-top: 53px;" class="visible-desktop"></div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js">
  </script>


  <script>
    var $j = jQuery.noConflict();

    function openNav () {
      document.getElementById("sidebar").style.display = "block";
      document.getElementById("boxl").style.display = "block";
    }


    $j(document).ready(function () {
      $j(".enxuta").toggle(

        function () {

          $j("#sidebar > ul").css({
            "width": "43px"
          });
          $j("#header > div").css({
            "width": "43px"
          });
          $j("#header > div").css({
            "padding": "17px 0px 0px 10px"
          });
          $j("#header > div").css({
            "position": "static"
          });
          $j("#sidebar ul li a span").css({
            "display": "none"
          });
          $j("#sidebar").css({
            "width": "43px"
          });
          $j(".navbar-brand").css({
            "width": "43px"
          });
          document.getElementById("flecha").classList.add("fa-angle-right");
          $j("#content").css({
            "margin-left": "43px"
          });
        },

        function () {

          $j("#sidebar > ul").css({
            "width": "220px"
          });
          $j("#header > div").css({
            "width": "90px"
          });
          $j(".navbar-brand").css({
            "width": "220px"
          });
          $j("#header > div").css({
            "padding": "15px"
          });
          $j("#header > div").css({
            "position": "relative"
          });
          $j("#sidebar ul li a span").css({
            "display": "inline-block"
          });
          $j("#sidebar").css({
            "width": "220px"
          });
          document.getElementById("flecha").classList.remove("fa-angle-right");
          $j("#content").css({
            "margin-left": "220px"
          });
        },

      );
    });


    $(document).mouseup(function (e) {
      var scre = $("body").width();
      var container = $("#sidebar");



      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if (scre <= 770) {

          document.getElementById("sidebar").style.display = "none";
          document.getElementById("boxl").style.display = "none";
          $("#sidebar").addClass("blc");


        }

      }
    });
  </script>




  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/matrix.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/helpers/loading-generated-table.js"></script>
  <script>
    var j = jQuery.noConflict();


    j(document).ready(function () {
      j(".btny").click(function () {
        j(this).button("loading").delay(2000).queue(function () {
          j(this).button("reset");
          j(this).dequeue();
        });
      });
    });
  </script>

  <script>
    $(".alert").delay(4000).fadeOut(200, function () { });
  </script>

</body>

</html>