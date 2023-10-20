
<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

 <div  class="visible-phone" id="headermobile">Editar Os</div>
 <div class="visible-phone"></div>

<style>

.modal.fade {
    top: -1000%;}

@media (max-width: 480px){

.btn-mobile-x {
    position: fixed;
    top: 12px;
    right: 20px;
    color: white;
    background: transparent;
    border: 0px;
    font-size: 20px;
    padding: 0px;
    z-index: 9;
}


.btn-mobile-c {
    position: fixed;
    top: 12px;
    left: 20px;
    color: white;
    background: transparent;
    border: 0px;
    font-size: 20px;
    z-index: 9;
    padding: 0px;
}

.btn-excluir {
    position: fixed;
    top: 12px;
    right: 75px;
    color: white;
    background: transparent;
    border: 0px;
    font-size: 20px;
    padding: 0px;
    z-index: 9;
}

.btn-mobile-c a:hover{
    background: transparent;
}

#menumobile{
    display: none;
}

}

   
@media (max-width: 480px){
.modal {
    top: 10%;
    right: 0px;
    left: 0px;
}

.alert {
    margin-top: 62px;
    margin-bottom: -56px;
}

.modal.fade.in {
    bottom: 0px;
    top:auto;
}


.modal.fade {
    top: -10000px;
}


.tab-pane {
    margin-top: 79px;
}

}

.opcao li{
    line-height: 45px;
}

.widget-title h5 {
    float: none;
}

ul.nav.nav-tabs.visible-phone {
    border: none;
    background: #111;
    margin-top: 50px;
    position: fixed;
    width: 100%;
    z-index: 9;
}

.nav-tabs.visible-phone>.active>a, .nav-tabs>.active>a:hover, .nav-tabs>.active>a:focus {
    color: #555;
    cursor: default;
    background-color: transparent;
    border: none;
    border-bottom-color: transparent;
    color: #fff;
}




</style>

<ul class="nav nav-tabs visible-phone">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Ordem</a></li>
                        <li id="tabProdutos"><a href="#tab2" data-toggle="tab">Produtos</a></li>
                        <li id="tabServicos"><a href="#tab3" data-toggle="tab">Serviços</a></li>
                        <li id="tabAnexos"><a href="#tab4" data-toggle="tab">Anexos</a></li>
</ul>

<div class="row-fluid" style="margin-top:0">
    
                   
        <div class="panel">

            <div class="visible-desktop panel-heading">
                <h5><i class="fas fa-tags"></i> | Editar OS</h5>
            </div>
            <div class="panel-body nopadding">
			
				<div class="col-md-12" style="padding-left: 5px; padding-right: 5px; ">
            
                <div class="" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs visible-desktop">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da OS</a></li>
                        <li id="tabProdutos"><a href="#tab2" data-toggle="tab">Produtos</a></li>
                        <li id="tabServicos"><a href="#tab3" data-toggle="tab">Serviços</a></li>
                        <li id="tabAnexos"><a href="#tab4" data-toggle="tab">Anexos</a></li>
                    </ul>
           
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                
                                <form action="<?php echo current_url(); ?>" method="post" id="formOs">
                                    <?php echo form_hidden('idOs',$result->idOs) ?>
                                    
                                    <div class="span12" style="margin-left: 0">
                                        
                                        <?php $total = 0; 

                                            $preco =0;
                                        ?> 

                                        <?php

                                        foreach ($produtos as $p) {

                                          $total = $total + $p->subTotal;

                                        }

                                                              foreach ($servicos as $s) {

                                           $preco += $s->subTotalSer;
                                                                                   }

                                         $valorTotal = $total + $preco ?>
                                         <br>
                                         <div class="col-md-12">
                                        <h4 class="pull-left">#OS: <?php echo $result->idOs ?></h4><h4 class="pull-right">R$ <?php echo number_format($valorTotal,2,',','.') ?></h4></div></br>
                                        <div class="row-fluid">

                                        <div class="form-group col-md-6" style="margin-left: 0; clear: both;">
                                            <label for="cliente">Cliente<span class="required">*</span></label>
                                            <input id="cliente" class="form-control" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>"  />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>"  />
                                            
                                            <input id="valorTotal" type="hidden" name="valorTotal" value="<?php echo $valorTotal ?>"  />
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="tecnico">Técnico / Responsável<span class="required">*</span></label>
                                            <input id="tecnico" class="form-control" type="text" name="tecnico" value="<?php echo $result->nome ?>"  />
                                            <input id="usuarios_id" class="form-control" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                        </div>
                                    
                                    <div class="form-group col-md-3" style=" margin-left: 0">
                                        
                                            <label for="status">Status<span class="required">*</span></label>
                                            <select class="form-control" name="status" id="status" value="">
                                                <option <?php if($result->status == 'Orçamento'){echo 'selected';} ?> value="Orçamento">Orçamento</option>
                                                <option <?php if($result->status == 'Ordem de Serviço'){echo 'selected';} ?> value="Ordem de Serviço">Ordem de Serviço</option>
                                                <option <?php if($result->status == 'Faturado'){echo 'selected';} ?> value="Faturado">Faturado</option>
                                                <option <?php if($result->status == 'Em Andamento'){echo 'selected';} ?> value="Em Andamento">Em Andamento</option>
                                                <option <?php if($result->status == 'Finalizado'){echo 'selected';} ?> value="Finalizado">Finalizado</option>
                                                <option <?php if($result->status == 'Cancelado'){echo 'selected';} ?> value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="dataInicial">Data Inicial<span class="required">*</span></label>
                                            <input id="dataInicial" class="form-control datepicker" type="text" name="dataInicial" value="<?php echo date('d/m/Y', strtotime($result->dataInicial)); ?>"  />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="dataFinal">Data Final</label>
                                            <input id="dataFinal" class="form-control datepicker" type="text" name="dataFinal" value="<?php echo date('d/m/Y', strtotime($result->dataFinal)); ?>"  />
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="garantia">Garantia</label>
                                            <input id="garantia" type="text" class="span12" name="garantia" value="<?php echo $result->garantia ?>"  />
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label for="descricaoProduto">Descrição Produto/Serviço</label>
                                            <textarea class="form-control" name="descricaoProduto" id="descricaoProduto" cols="30" rows="5"><?php echo $result->descricaoProduto?></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="defeito">Defeito</label>
                                            <textarea class="form-control" name="defeito" id="defeito" cols="30" rows="5"><?php echo $result->defeito?></textarea>
                                        </div>

                                                                      
                                        <div class="col-md-6 form-group">
                                            <label for="observacoes">Observações</label>
                                            <textarea class="span12" name="observacoes" id="observacoes" cols="30" rows="5"><?php echo $result->observacoes ?></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="laudoTecnico">Laudo Técnico</label>
                                            <textarea class="span12" name="laudoTecnico" id="laudoTecnico" cols="30" rows="5"><?php echo $result->laudoTecnico ?></textarea>
                                        </div>
                                    
                                    <div class="col-md-12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <?php if($result->faturado == 0){ ?>
                                                <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success"><i class="fas fa-file"></i> Faturar</a>
                                            <?php } ?>

                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            
                                            <a href="<?php echo base_url() ?>os" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a>

           <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'dOs')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" os="'.$result->idOs.'" class="hidden-xs btn btn-danger tip-top" title="Excluir OS"><i class="icon-remove icon-white"></i> Excluir</a>  '; 
            };?>

                     <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'dOs')){
                echo '<a style="margin-top: 5px; margin-left: 6px;" href="#modal-excluir" role="button" data-toggle="modal" os="'.$result->idOs.'" class="btn btn-danger hidden-lg" title="Excluir OS"><i class="icon-remove icon-white"></i> Excluir</a>  '; 
            };?>
                   
                                            </div>
                                    </div></div>
                                </form>
                            </div>
</div>
                                   
                        </div>


                        <!--Produtos-->

                        <div class="visible-phone" style="margin-top: 100px;"></div>
                        <div class="tab-pane" style="margin-top: 30px;" id="tab2">
                            <div class="span12 well" style="padding: 1%; margin-left: 0">
                                <form id="formProdutos" action="<?php echo base_url() ?>os/adicionarProduto" method="post">
                                   

                             

                                    <div class="span8 form-group">
                                        <input type="hidden" name="idProduto" id="idProduto" />
                                        <input type="hidden" name="idOsProduto" id="idOsProduto" value="<?php echo $result->idOs?>" />
                                        <input type="hidden" name="estoque" id="estoque" value=""/>
                                        <input type="hidden" name="preco" id="preco" value=""/>
                                        <label for="">Produto</label>
                                         <div class="input-group">
                                          <input type="text" class="form-control" name="produto" id="produto" placeholder="Digite o nome do produto" />
                                          <div class="input-group-addon"><a href="#" data-toggle="modal" data-target="#addptd">+</a></div>
                                        </div>
                                        
                                    </div>
                                    <div class="span2">
                                        <label for="">Quantidade</label>
                                        <input type="text" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" />
                                    </div>
                                    <div class="span2">
                                        <label class="hidden-xs" for="">.</label>
                                        <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="span12" id="divProdutos" style="margin-left: 0; ">
                                <table class="table " id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Qua.</th>
                                            <th>Sub-total</th>
                                            <th class="hidden-xs" >Total real</th>
                                            <th>Lucro</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $lucroT = 0;
                                        $total = 0;
                                        $totalR= 0;
                                        foreach ($produtos as $p) {
                                                  
                                            $total = $total + $p->subTotal;
                                            $totalr = $p->quantidade * $p->precoCompra;
                                            $totalR += $totalr;
                                            $lucro = $p->precoVenda - $p->precoCompra;
                                            $lucrot = $lucro * $p->quantidade;
                                            $lucroT += $lucrot;  

                                            echo '<tr>';
                                            echo '<td>'.$p->descricao.'</td>';
                                            echo '<td>'.$p->quantidade.'</td>';
                                            echo '<td>R$ '.number_format($p->subTotal,2,',','.').'</td>';
                                            echo '<td class="hidden-xs">R$ '.number_format($totalr,2,',','.').'</td>';
                                            echo '<td>R$ '.number_format($lucrot,2,',','.').'</td>';
                                                                                        echo '<td><a href="" idAcao="'.$p->idProdutos_os.'" prodAcao="'.$p->idProdutos.'" quantAcao="'.$p->quantidade.'" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';

                                            echo '</tr>';
                                        }?>
                                       
                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($total,2,',','.');?><input type="hidden" id="total-venda" value="<?php echo number_format($total,2); ?>"></strong></td>
                                            <td><strong>R$ <?php echo number_format($totalR,2,',','.');?><input type="hidden" id="total-venda" value="<?php echo number_format($total,2); ?>"></strong></td>
                                            <td><strong>R$ <?php echo number_format($lucroT,2,',','.');?><input type="hidden" id="total-venda" value="<?php echo number_format($total,2); ?>"></strong></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>


<!-- Modal -->
<div class="modal fade" id="addptd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Produto</h4>
      </div>
      <div class="modal-body">
          
                         <form  id="formPd" method="post">

                    <div class="form-group col-md-12">
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao'); ?>"  />
                        </div>
                    </div>


          
                                <input type="hidden" id="entrada" name="entrada" class="badgebox" value="1" checked>

                                <input type="hidden" id="saida" name="saida" class="badgebox" value="1" checked>
     
                    <div class="form-group col-md-6">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoCompra" class="money form-control"  type="text" name="precoCompra" value="<?php echo set_value('precoCompra'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoVenda" class="money form-control" type="text" name="precoVenda" value="<?php echo set_value('precoVenda'); ?>" onblur="calcular()" />
                        </div>
                    </div>


<script>function calcular() {
  var n1 = Number(document.getElementById('precoCompra').value, 10);
  var n2 = Number(document.getElementById('precoVenda').value, 10);
  
  var resultado = n2 - n1;
  


  var conta = n2 - n1;
  var arredondado = parseFloat(conta.toFixed(2));

  document.getElementById('lucro') .value = arredondado;
}
</script>





                    <div class="form-group col-md-6">
                        <label for="lucro" class="control-label">Lucro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="lucro" class="money form-control" type="text" name="lucro" value=""  />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                    <div class="controls">
                        <!--<input id="unidade" type="text" name="unidade" value="<?php echo set_value('unidade'); ?>"  />-->
                        <select id="unidade" class="form-control" name="unidade">
                            <option value="UN">Unidade</option>
                            <option value="KG">Kilograma</option>
                            <option value="LT">Litro</option>
                            <option value="CX">Caixa</option>
                        </select>
                    </div>
                    </div>                     

                            <input id="estoque" type="hidden" name="estoque" class="form-control" value="2147483647 <?php echo set_value('estoque'); ?>"  />
                 

                                              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button id="myButton" data-loading-text="Espere..." type="submit" class="btny btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
      </div></form>
    </div>
  </div>
</div>

                        </div>

                        <!--Serviços-->
                        <div class="tab-pane" id="tab3">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                    <form id="formServicos" action="<?php echo base_url() ?>os/adicionarServico" method="post">
                                    <div class="span8">
                                        <input type="hidden" name="idServico" id="idServico" />
                                        <input type="hidden" name="idOsServico" id="idOsServico" value="<?php echo $result->idOs?>" />
                                        <input type="hidden" name="precoServico" id="precoServico" value=""/>
                                        <label for="">Serviço</label>
                                          <div class="input-group">
                                          <input type="text" class="form-control" name="servico" id="servico" placeholder="Digite o nome do serviço" />
                                          <div class="input-group-addon"><a href="#" data-toggle="modal" data-target="#addser">+</a></div>
                                        </div>
                                        
                                    </div>
                                    <div class="span2">
                                        <label for="">Quantidade</label>
                                        <input type="text" placeholder="Quantidade" id="quantidadeser" name="quantidadeser" class="span12" />
                                    </div>

                                    <div class="span2">
                                        <label class="hidden-xs" for="">.</label>
                                        <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="span12" id="divServicos" style="margin-left: 0">
                                    <table class="table ">
                                         <thead>
                                        <tr>
                                            <th>Serviço</th>
                                            <th>Quant</th>
                                            <th>Sub-total</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                        <tbody>


                                            <?php
                                        $total = 0;
                                        foreach ($servicos as $s) {
                                            $total += $s->subTotalSer;
                                            echo '<tr>';
                                            echo '<td>'.$s->nome.'</td>';
                                            echo '<td>'.$s->quantidadeSer.'</td>';

                                            echo '<td>R$ '.number_format($s->subTotalSer,2,',','.').'</td>';
                                                                                        echo '<td><span idAcao="'.$s->idServicos_os.'" title="Excluir Serviço" class="btn btn-danger"><i class="icon-remove icon-white"></i></span></td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($total,2,',','.');?><input type="hidden" id="total-servico" value="<?php echo number_format($total,2); ?>"></strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

<!-- Modal -->
<div class="modal fade" id="addser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Serviço</h4>
      </div>
      <div class="modal-body">
          
                                     
                <form action="<?php echo current_url(); ?>" id="formServico" method="post" >
                    <div class="form-group">
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" class="form-control" type="text" name="nome" value="<?php echo set_value('nome'); ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="preco" class="control-label"><span class="required">Preço*</span></label>
                        <div class="controls">
                            <input id="preco" class="money form-control" type="text" name="preco" value="<?php echo set_value('preco'); ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <div class="controls">
                            <input id="descricao" type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao'); ?>"  />
                        </div>
                    </div>
                
                                              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button id="myButton" data-loading-text="Espere..." type="submit" class="btny btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
      </div></form>
    </div>
  </div>
</div>



                        </div>


                        <!--Anexos-->
                        <div class="tab-pane" id="tab4">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0" id="form-anexos">
                                    <form id="formAnexos" enctype="multipart/form-data" action="javascript:;" accept-charset="utf-8"s method="post">
                                    <div class="span10">
                                
                                        <input type="hidden" name="idOsServico" id="idOsServico" value="<?php echo $result->idOs?>" />
                                        <label for="">Anexo</label>
                                        <input type="file" class="span12" name="userfile[]" multiple="multiple" size="20" />
                                    </div>
                                    <div class="span2">
                                        <label class="hidden-xs" for="">.</label>
                                        <button class="btn btn-success span12"><i class="icon-white icon-plus"></i> Anexar</button>
                                    </div>
                                    </form>
                                </div>
                
                                <div class="span12" id="divAnexos" style="margin-left: 0">
                                    <?php 
                                    $cont = 1;
                                    $flag = 5;
                                    foreach ($anexos as $a) {

                                        if($a->thumb == null){
                                            $thumb = base_url().'assets/img/icon-file.png';
                                            $link = base_url().'assets/img/icon-file.png';
                                        }
                                        else{
                                            $thumb = base_url().'assets/anexos/thumbs/'.$a->thumb;
                                            $link = $a->url.$a->anexo;
                                        }

                                        if($cont == $flag){
                                           echo '<div style="margin-left: 0" class="span3"><a href="#modal-anexo" imagem="'.$a->idAnexos.'" link="'.$link.'" role="button" class="btn anexo" data-toggle="modal"><img src="'.$thumb.'" alt=""></a></div>'; 
                                           $flag += 4;
                                        }
                                        else{
                                           echo '<div class="span3"><a href="#modal-anexo" imagem="'.$a->idAnexos.'" link="'.$link.'" role="button" class="btn anexo" data-toggle="modal"><img src="'.$thumb.'" alt=""></a></div>'; 
                                        }
                                        $cont ++;
                                    } ?>
                                </div>

                            </div>
                        </div>
                


                    </div>

                </div>


.

        </div>

    </div>
</div>
</div>




 
<!-- Modal visualizar anexo -->
<div id="modal-anexo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Visualizar Anexo</h3>
  </div>
  <div class="modal-body">
    <div class="span12" id="div-visualizar-anexo" style="text-align: center">
        <div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <a href="" id-imagem="" class="btn btn-inverse" id="download">Download</a>
    <a href="" link="" class="btn btn-danger" id="excluir-anexo">Excluir Anexo</a>
  </div>
</div>





<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="formFaturar" action="<?php echo current_url() ?>" method="post">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3 id="myModalLabel">Faturar Venda</h3>
</div>
<div class="modal-body">
    
    <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    <div class="span12" style="margin-left: 0"> 
      <label for="descricao">Descrição</label>
      <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda - #<?php echo $result->idOs; ?> "  />
      
    </div>  
    <div class="span12" style="margin-left: 0"> 
      <div class="span12" style="margin-left: 0"> 
        <label for="cliente">Cliente*</label>
        <input class="span12" id="cliente" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
        <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
        <input type="hidden" name="os_id" id="os_id" value="<?php echo $result->idOs; ?>">
      </div>
      
      
    </div>
    <div class="span12" style="margin-left: 0"> 
      <div class="span4" style="margin-left: 0">  
        <label for="valor">Valor*</label>
        <input type="hidden" id="tipo" name="tipo" value="receita" /> 
        <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total,2); ?> "  />
      </div>
      <div class="span4" >
        <label for="vencimento">Data Vencimento*</label>
        <input class="span12 datepicker" id="vencimento" type="text" name="vencimento"  />
      </div>
      
    </div>
    
    <div class="span12" style="margin-left: 0"> 
      <div class="span4" style="margin-left: 0">
        <label for="recebido">Recebido?</label>
        &nbsp &nbsp &nbsp &nbsp <input  id="recebido" type="checkbox" name="recebido" value="1" /> 
      </div>
      <div id="divRecebimento" class="span8" style=" display: none">
        <div class="span6">
          <label for="recebimento">Data Recebimento</label>
          <input class="span12 datepicker" id="recebimento" type="text" name="recebimento" /> 
        </div>
        <div class="span6">
          <label for="formaPgto">Forma Pgto</label>
          <select name="formaPgto" id="formaPgto" class="span12">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Cheque">Cheque</option>
            <option value="Boleto">Boleto</option>
            <option value="Depósito">Depósito</option>
            <option value="Débito">Débito</option>        
          </select> 
      </div>
      
    </div>
    
    
</div>
<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
  <button class="btn btn-primary">Faturar</button>
</div>
</form>
</div>


<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
           $('#formCliente').validate({
            rules :{
                  nomeCliente:{ required: true},
                  documento:{ required: true},
                  telefone:{ required: true},
                  email:{ required: true},
                  rua:{ required: true},
                  numero:{ required: true},
                  bairro:{ required: true},
                  cidade:{ required: true},
                  estado:{ required: true},
                  cep:{ required: true}
            },
            messages:{
                  nomeCliente :{ required: 'Campo Requerido.'},
                  documento :{ required: 'Campo Requerido.'},
                  telefone:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                  rua:{ required: 'Campo Requerido.'},
                  numero:{ required: 'Campo Requerido.'},
                  bairro:{ required: 'Campo Requerido.'},
                  cidade:{ required: 'Campo Requerido.'},
                  estado:{ required: 'Campo Requerido.'},
                  cep:{ required: 'Campo Requerido.'}

            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('error');
                $(element).parents('.form-group').addClass('success');
            }
           });
      });
</script>




<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    
    $(".money").maskMoney(); 

     $('#recebido').click(function(event) {
        var flag = $(this).is(':checked');
        if(flag == true){
          $('#divRecebimento').show();
        }
        else{
          $('#divRecebimento').hide();
        }
     });

     $(document).on('click', '#btn-faturar', function(event) {
       event.preventDefault();
         valor = $('#total-venda').val();
         total_servico = $('#total-servico').val();
         valor = valor.replace(',', '' );
         total_servico = total_servico.replace(',', '' );
         total_servico = parseFloat(total_servico); 
         valor = parseFloat(valor);
         $('#valor').val(valor + total_servico);
     });
     
     $("#formFaturar").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          },
          submitHandler: function( form ){       
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>os/faturar",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar faturar OS.');
                    $('#progress-fatura').hide();
                }
              }
              });

              return false;
          }
     });

     $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteProduto",
            minLength: 2,
            select: function( event, ui ) {

                 $("#idProduto").val(ui.item.id);
                 $("#estoque").val(ui.item.estoque);
                 $("#preco").val(ui.item.preco);
                 $("#quantidade").focus();
                 

            }
      });

      $("#servico").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteServico",
            minLength: 2,
            select: function( event, ui ) {

                 $("#idServico").val(ui.item.id);
                 $("#precoServico").val(ui.item.preco);
                 

            }
      });


      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteCliente",
            minLength: 2,
            select: function( event, ui ) {

                 $("#clientes_id").val(ui.item.id);


            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {

                 $("#usuarios_id").val(ui.item.id);


            }
      });




      $("#formOs").validate({
          rules:{
             cliente: {required:true},
             tecnico: {required:true},
             dataInicial: {required:true}
          },
          messages:{
             cliente: {required: 'Campo Requerido.'},
             tecnico: {required: 'Campo Requerido.'},
             dataInicial: {required: 'Campo Requerido.'}
          },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
       });




      $("#formProdutos").validate({
          rules:{
             quantidade: {required:true}
          },
          messages:{
             quantidade: {required: 'Insira a quantidade'}
          },
          submitHandler: function( form ){
             var quantidade = parseInt($("#quantidade").val());
             var estoque = parseInt($("#estoque").val());
             if(estoque < quantidade){
                alert('Você não possui estoque suficiente.');
             }
             else{
                 var dados = $( form ).serialize();
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>os/adicionarProduto",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        $("#quantidade").val('');
                        $("#produto").val('').focus();
                    }
                    else{
                        alert('Ocorreu um erro ao tentar adicionar produto.');
                    }
                  }
                  });

                  return false;
                }

             }
             
       });

       $("#formServicos").validate({
          rules:{
             servico: {required:true}
          },
          messages:{
             servico: {required: 'Insira um serviço'}
          },
          submitHandler: function( form ){       
                 var dados = $( form ).serialize();
                 
                $("#divServicos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>os/adicionarServico",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divServicos" ).load("<?php echo current_url();?> #divServicos" );
                        $("#servico").val('').focus();
                    }
                    else{
                        alert('Ocorreu um erro ao tentar adicionar serviço.');
                    }
                  }
                  });

                  return false;
                }

       });


        $("#formAnexos").validate({
         
          submitHandler: function( form ){       
                //var dados = $( form ).serialize();
                var dados = new FormData(form); 
                $("#form-anexos").hide('1000');
                $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>os/anexar",
                  data: dados,
                  mimeType:"multipart/form-data",
                  contentType: false,
                  cache: false,
                  processData:false,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divAnexos" ).load("<?php echo current_url();?> #divAnexos" );
                        $("#userfile").val('');

                    }
                    else{
                        $("#divAnexos").html('<div class="alert fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> '+data.mensagem+'</div>');      
                    }
                  },
                  error : function() {
                      $("#divAnexos").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> Ocorreu um erro. Verifique se você anexou o(s) arquivo(s).</div>');      
                  }

                  });

                  $("#form-anexos").show('1000');
                  return false;
                }

        });

       $(document).on('click', 'a', function(event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            if((idProduto % 1) == 0){
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>os/excluirProduto",
                  data: "idProduto="+idProduto+"&quantidade="+quantidade+"&produto="+produto,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        
                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir produto.');
                    }
                  }
                  });
                  return false;
            }
            
       });



       $(document).on('click', 'span', function(event) {
            var idServico = $(this).attr('idAcao');
            if((idServico % 1) == 0){
                $("#divServicos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>os/excluirServico",
                  data: "idServico="+idServico,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divServicos").load("<?php echo current_url();?> #divServicos" );

                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir serviço.');
                    }
                  }
                  });
                  return false;
            }

       });


       $(document).on('click', '.anexo', function(event) {
           event.preventDefault();
           var link = $(this).attr('link');
           var id = $(this).attr('imagem');
           var url = '<?php echo base_url(); ?>os/excluirAnexo/';
           $("#div-visualizar-anexo").html('<img src="'+link+'" alt="">');
           $("#excluir-anexo").attr('link', url+id);

           $("#download").attr('href', "<?php echo base_url(); ?>os/downloadanexo/"+id);

       });

       $(document).on('click', '#excluir-anexo', function(event) {
           event.preventDefault();

           var link = $(this).attr('link'); 
           $('#modal-anexo').modal('hide');
           $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");

           $.ajax({
                  type: "POST",
                  url: link,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divAnexos" ).load("<?php echo current_url();?> #divAnexos" );
                    }
                    else{
                        alert(data.mensagem);
                    }
                  }
            });
       });



       $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });




});

</script>


       <script type="text/javascript">
        $(document).ready(function(){
            $("#formServico").submit(function(e){
                e.preventDefault(); 
                $.ajax({
                    url: "<?php echo base_url();?>servicos/adicionar?ajax=true",
                    type: "POST",
                    data: $("#formServico").serialize(),
                    success: function(){
                        alert("Produto adicionado com sucesso");
                    },
                    error: function(){
                        alert("Falha ao adicionar produto contate o Programador");
                    }

                });
            });
        });
    </script>


       <script type="text/javascript">
        $(document).ready(function(){
            $("#formPd").submit(function(e){
                e.preventDefault(); 
                $.ajax({
                    url: "<?php echo base_url();?>os/adicionarPd?ajax=true",
                    type: "POST",
                    data: $("#formPd").serialize(),
                    success: function(){
                        alert("Produto adicionado com sucesso");
                    },
                    error: function(){
                        alert("Falha ao adicionar produto contate o Programador");
                    }

                });
            });
        });
    </script>
