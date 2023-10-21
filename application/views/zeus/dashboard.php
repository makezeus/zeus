<div class="col-md-4 hidden-xs">
  <h2 style="font-weight: 400;">Dashboard <br>
    <small style="font-weight: 300">
      <?= $saluteMessage; ?>
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
            <div style="display: flex; justify-content: space-between; align-items: center; position: relative;  opacity: 0.4">
              <span style="float: inline-end; position: absolute; right: 0; top:0">
                <?= $item['shortcut'] ?>
              </span>
              <span style="font-size:2.3rem; color: <?= $item['color'] ?>; padding: 1rem;">
                <?= $item['icon'] ?>
              </span>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row-fluid" style="<?= getMobileRequest() ? '' : 'display: flex;' ?> align-items: stretch; margin-bottom: 1rem;">
      <div class="col-md-6">
        <div class="panel-body no-padding" style="height: 100%;">
          <div class="panel-heading" style="display: flex; justify-content:space-between;">
            <h4>Ordens Recentes</h4>
            <a href="os" class="btn btn-link">Ver Lista</a>
          </div>
          <table class="table ">
            <thead>
              <? if (getMobileRequest()) { ?>
                <th></th>
              <? }; ?>
              <th>Cliente</th>
              <? if (!getMobileRequest()) { ?>
                <th>Data</th>
                <th>Status</th>
              <? }; ?>
              <th>Valor</th>
            </thead>
            <tbody>
              <?php if (!empty($orderOfService)) : ?>
                <?php foreach ($orderOfService as $order) : ?>
                  <?php
                  $dateFormatted = strftime('%d %b, %Y', strtotime($order->dataFinal));
                  $valueFormatted = 'R$ ' . number_format($order->valorTotal, 2, ',', '.');
                  ?>
                  <tr>
                    <? if (getMobileRequest()) { ?>
                      <td>
                        <?= statusMapperBudget($order->status) ?>
                      </td>
                    <? }; ?>
                    <td>
                      <?= $order->nomeCliente ?>
                    </td>
                    <? if (!getMobileRequest()) { ?>
                      <td>
                        <?= date("d/m/Y", strtotime($order->dataFinal)); ?>
                      </td>
                      <td>
                        <?= statusMapperBudget($order->status) ?>
                      </td>
                    <? }; ?>
                    <td style="text-wrap: nowrap;">
                      <?= $valueFormatted ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
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
          </div>
          <table class="table ">
            <thead>
              <th>Descrição</th>
              <th>Total</th>
            </thead>

            <?php if (!empty($billedProducts)) : ?>
              <?php foreach ($billedProducts as $product) : ?>
                <tr>
                  <td>
                    <?= $product->descricao ?>
                  </td>
                  <td>
                    <?= $product->total ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="3">Nenhum Produto Encontrado.</td>
              </tr>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>