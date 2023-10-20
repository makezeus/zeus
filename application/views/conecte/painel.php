
 <div  class="visible-phone" id="headermobile">Principal</div>
 <div class="visible-phone" style="margin-top: 100px"></div>

<?php
$hr = date(" H ");
if($hr >= 12 && $hr<18) {
$resp = "Boa tarde!";}
else if ($hr >= 0 && $hr <12 ){
$resp = "Bom dia!";}
else {
$resp = "Boa noite!";}

$id = $this->session->userdata('cliente_id'); 

$query = $this->db->get_where('clientes', array('idClientes' => $id));

foreach($query->result_array() as $row){
      $nomeCliente = $row['nomeCliente'];

}


$primeiroNome = explode(" ", $nomeCliente);
 



?>

<div class="col-md-4"><h2 class="dash" style="font-weight: 400; font-family: 'Open Sans'">Dashboard <br> <small style="font-weight: 300; font-family: 'Open Sans'"><?php echo $resp.'&nbsp'.$primeiroNome[0]; ?></small> </h2></div>
  <div class="col-md-3 col-md-offset-5" style="margin-bottom: 30px;">
    <h2 style="font-weight: 300; font-family: 'Open Sans'"><br>
      </h2>

      
    </div>
<br><br>

  <div class="quick-actions_homepage">
    <ul class="quick-actions">
      <li class="bg_lo span3"> <a href="<?php echo base_url()?>mine/os"> <i class="fas fa-2x fa-tags" style="display: block;     margin: 0 auto 5px;"></i> Ordens de Serviço</a> </li>
      <li class="bg_ls span3"> <a href="<?php echo base_url()?>mine/compras"><i class="fas fa-2x fa-shopping-cart" style="display: block;     margin: 0 auto 5px;"></i> Compras</a></li>
      <li class="bg_lg span3"> <a href="<?php echo base_url()?>mine/conta"><i class="fas fa-2x fa-star" style="display: block;     margin: 0 auto 5px;"></i> Minha Conta</a></li>
    </ul>
  </div>
 

  <div class="span12" style="margin-left: 0">
      
      <div class="panel">
          <div class="panel-heading"><h5><i class="fas fa-signal"></i> | Últimas Ordens de Serviço</h5></div>
          <div class="panel-body">
              <table class="table ">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Data Inicial</th>
                          <th>Data Final</th>
                          <th>Garantia</th>
                          <th>Status</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                      if($os != null){
                          foreach ($os as $o) {

                            
                              echo '<tr>';
                              echo '<td>'.$o->idOs.'</td>';
                              echo '<td>'.date('d/m/Y',strtotime($o->dataInicial)).'</td>';
                              echo '<td>'.date('d/m/Y',strtotime($o->dataFinal)).'</td>';
                              echo '<td>'.$o->garantia.'</td>';
                              echo '<td>'.$o->status.'</td>';
                              echo '<td> <a href="'.base_url().'mine/visualizarOs/'.$o->idOs.'" class="btn"> <i class="fas fa-eye" ></i> </a></td>';
                              echo '</tr>';
                          }
                      }
                      else{
                          echo '<tr><td colspan="3">Nenhum ordem de serviço encontrada.</td></tr>';
                      }    

                      ?>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="panel">
          <div class="panel-heading"><h5><i class="fas fa-signal"></i> | Últimas Compras</h5></div>
          <div class="panel-body">
              <table class="table ">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Data de Venda</th>
                          <th>Responsável</th>
                          <th>Faturado</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                      if($compras != null){
                          foreach ($compras as $p) {
                              if($p->faturado == 1){$faturado = 'Sim';} else{$faturado = 'Não';}
                              echo '<tr>';
                              echo '<td>'.$p->idVendas.'</td>';
                              echo '<td>'.date('d/m/Y',strtotime($p->dataVenda)).'</td>';
                              echo '<td>'.$p->nome.'</td>';
                              echo '<td>'.$faturado.'</td>';
                              echo '<td> <a href="'.base_url().'mine/visualizarCompra/'.$p->idVendas.'" class="btn"> <i class="fas fa-eyen" ></i> </a></td>';
                              echo '</tr>';
                          }
                      }
                      else{
                          echo '<tr><td colspan="5">Nenhum venda encontrada.</td></tr>';
                      }    

                      ?>
                  </tbody>
              </table>
          </div>
      </div>
    
  </div>
