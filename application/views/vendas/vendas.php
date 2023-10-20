<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aVenda')){ ?>
    <a href="<?php echo base_url()?>vendas/adicionar" class="span13"><svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_1_" x1="256" x2="256" y1="512" y2="-9.094947e-013"><stop offset="0" style="stop-color:#76B852"/><stop offset="1" style="stop-color:#8DC26F"/></linearGradient><circle cx="256" cy="256" fill="#4CAF50" r="256"/><path d="M381.7,244.2H267.8V130.3c0-6.5-5.3-11.8-11.8-11.8c-6.5,0-11.8,5.3-11.8,11.8v113.9H130.3  c-6.5,0-11.8,5.3-11.8,11.8s5.3,11.8,11.8,11.8h113.9v113.9c0,6.5,5.3,11.8,11.8,11.8c6.5,0,11.8-5.3,11.8-11.8V267.8h113.9  c6.5,0,11.8-5.3,11.8-11.8S388.2,244.2,381.7,244.2z" fill="#FFFFFF"/></svg></a>
<?php } ?>

<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Vendas</h5>

     </div>

<div class="widget-content nopadding">


<table class="table ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data da Venda</th>
            <th>Cliente</th>
            <th>Faturado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6">Nenhuma venda Cadastrada</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php } else{?>


<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Vendas</h5>

     </div>

<div class="widget-content nopadding">


<table class="table ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data da Venda</th>
            <th>Cliente</th>
            <th>Faturado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            $dataVenda = date(('d/m/Y'),strtotime($r->dataVenda));
            if($r->faturado == 1){$faturado = 'Sim';} else{ $faturado = 'Não';}           
            echo '<tr>';
            echo '<td>'.$r->idVendas.'</td>';
            echo '<td>'.$dataVenda.'</td>';
            echo '<td><a href="'.base_url().'clientes/visualizar/'.$r->idClientes.'">'.$r->nomeCliente.'</a></td>';
            echo '<td>'.$faturado.'</td>';
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vVenda')){
                echo '<a style="margin-right: 1%" href="'.base_url().'vendas/visualizar/'.$r->idVendas.'" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                echo '<a style="margin-right: 1%" href="'.base_url().'vendas/imprimir/'.$r->idVendas.'" target="_blank" class="btn btn-inverse tip-top" title="Imprimir"><i class="icon-print"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eVenda')){
                echo '<a style="margin-right: 1%" href="'.base_url().'vendas/editar/'.$r->idVendas.'" class="btn btn-info tip-top" title="Editar venda"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dVenda')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" venda="'.$r->idVendas.'" class="btn btn-danger tip-top" title="Excluir Venda"><i class="icon-remove icon-white"></i></a>'; 
            }

            echo '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
<?php echo $this->pagination->create_links();}?>


<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>vendas/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Venda</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idVenda" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esta Venda?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var venda = $(this).attr('venda');
        $('#idVenda').val(venda);

    });

});

</script>