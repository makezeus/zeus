<?php
$this->load->helper('codegen_helper');
$hr = date("H");
$resp = ($hr >= 12 && $hr < 18) ? "Boa tarde!" : (($hr >= 0 && $hr < 12) ? "Bom dia!" : "Boa noite!");

$id = $this->session->userdata('id');
$userQuery = $this->db->get_where('usuarios', array('idUsuarios' => $id));
$userdata = $userQuery->row_array();

$primeiroNome = explode(" ", $userdata['nome']);

$dashItems = [

  [
    'title' => 'Receita do mês',
    'value' => 'R$ ' . number_format($estatisticas_financeiro->total_receita - $estatisticas_financeiro->total_despesa, 2, ',', '.'),
    'shortcut' => '',
    'icon' => '<i class="ri-line-chart-line"></i>',
    'color' => '#9333EA'
  ],
  [
    'title' => 'clientes',
    'value' => $this->db->count_all('clientes'),
    'shortcut' => 'F1',
    'icon' => '<i class="ri-team-line"></i>',
    'color' => 'black'
  ],
  [
    'title' => 'Produtos',
    'value' => $this->db->count_all('produtos'),
    'shortcut' => 'F2',
    'icon' => '<i class="ri-shopping-cart-line"></i>',
    'color' => 'black'
  ],
  [
    'title' => 'Serviços',
    'value' => $this->db->count_all('servicos'),
    'shortcut' => 'F3',
    'icon' => '<i class="ri-customer-service-line"></i>',
    'color' => 'black'
  ],
  [
    'title' => 'Ordens de Serviço',
    'value' => $this->db->count_all('os'),
    'shortcut' => 'F4',
    'icon' => '<i class="ri-file-line"></i>',
    'color' => 'black'
  ],

];


if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT'])) {
  array_shift($dashItems);
}
;

$osQuery = $this->db->query("SELECT * FROM os");
$osStatusCounts = [];
$statuses = ['Aberto', 'Em Andamento', 'Finalizado', 'Faturado', 'Cancelado'];
foreach ($statuses as $status) {
  $osStatusCounts[$status] = $this->db->query("SELECT COUNT(*) AS count, SUM(valorTotal) AS total FROM os WHERE status = '$status'")->row_array();
}

?>


<div class="col-md-4 hidden-xs">
  <h2 style="font-weight: 400;">Dashboard <br>
    <small style="font-weight: 300">
      <?= $resp . '&nbsp' . $primeiroNome[0]; ?>
    </small>
  </h2>
</div>

<div class="row-fluid" style="margin-top: 0">
  <div class="row-fluid" style="margin-bottom: 24px">
    <div class="row-fluid" style="display: flex;flex-wrap: wrap;">
      <?php foreach ($dashItems as $item) { ?>
        <div style="flex: 1; margin: 10px;" class="dashboardCard">
          <div class="panel-body" style="padding: 12px; display: flex; ">
            <div style="display: flex; position: relative; flex-direction: column; width: 100%;">
              <h3 style="color: <?= $item['color'] ?>;">
                <?= $item['value'] ?>
              </h3>
              <span style="text-transform:uppercase; font-size: 0.8rem; color: #6B7280">
                <?= $item['title'] ?>
              </span>
            </div>
            <div
              style="display: flex; justify-content: space-between; align-items: center; position: relative;  opacity: 0.4">
              <span style="float: inline-end; position: absolute; right: 0; top:0">
                <?= $item['shortcut'] ?>
              </span>
              <span style="font-size:2.5rem; color: <?= $item['color'] ?>; padding: 1rem;">
                <?= $item['icon'] ?>
              </span>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row-fluid" style=" display: flex; align-items: stretch; margin-bottom: 1rem;">
      <div class="col-md-6">
        <div class="panel-body no-padding" style="height: 100%;">
          <div class="panel-heading" style="display: flex; justify-content:space-between;">
            <h4>Ordens Recentes</h4>
            <a href="os" class="btn btn-link">Ver Lista</a>
          </div>
          <table class="table ">
            <thead>
              <th>Cliente</th>
              <th>Data</th>
              <th>Status</th>
              <th>Valor</th>
            </thead>
            <tbody>
              <?php if (!empty($oos)): ?>
                <?php foreach ($oos as $ocs): ?>
                  <?php
                  $dateFormatted = strftime('%d %b, %Y', strtotime($ocs->dataFinal));
                  $valueFormatted = 'R$ ' . number_format($ocs->valorTotal, 2, ',', '.');
                  ?>
                  <tr>
                    <td>
                      <?= $ocs->nomeCliente ?>
                    </td>
                    <td>
                      <?= $dateFormatted ?>
                    </td>
                    <td>
                      <?= statusMapperBudget($ocs->status) ?>
                    </td>
                    <td>
                      <?= $valueFormatted ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3">Nenhuma OS em aberto.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel-body no-padding" style="height: 100%;">
          <div class="panel-heading" style="display: flex; justify-content:space-between;">
            <h4>Produtos Faturados</h4>
            <!-- <a href="produtos" class="btn btn-link">Ver Lista</a> -->
          </div>
          <table class="table ">
            <thead>
              <th>Descrição</th>
              <th>Total</th>
            </thead>

            <?php if (!empty($oos)): ?>
              <?php foreach ($billedProducts as $product): ?>
                <tr>
                  <td>
                    <?= $product->descricao ?>
                  </td>
                  <td>
                    <?= $product->total ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3">Nenhum Produto Encontrado.</td>
              </tr>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>


    <div class="span12" style="margin-left: 0; clear: both">
      <div class="col-md-12">
        <div class="panel-body no-padding">
          <div class="panel-heading">
            <h4>Ordens de Serviço</h4>
          </div>
          <table class="table ">
            <tbody>
              <?php
              foreach ($osStatusCounts as $status => $count) { ?>
                <tr>
                  <td>
                    <?= $status ?>
                  </td>
                  <td>
                    <?= $count['count'] ?>
                  </td>
                  <td>R$
                    <?= number_format($count['total'], 2, ',', '.') ?>
                  </td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>