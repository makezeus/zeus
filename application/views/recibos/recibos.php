<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<style>
    
@media (max-width: 480px){
.modal {
    top: 10%;
    right: 0px;
    left: 0px;
}

.editar{
  margin-bottom: 5px;
}

.modal.fade.in {
    bottom: 0px;
    top:auto;
}


.modal.fade {
    top: -10000px;
}
}

.opcao li{
    line-height: 45px;
}

.widget-title h5 {
    float: none;
}
</style>

<a href="<?php echo base_url()?>recibos/adicionar" class="span13"><svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_1_" x1="256" x2="256" y1="512" y2="-9.094947e-013"><stop offset="0" style="stop-color:#76B852"/><stop offset="1" style="stop-color:#8DC26F"/></linearGradient><circle cx="256" cy="256" fill="#4CAF50" r="256"/><path d="M381.7,244.2H267.8V130.3c0-6.5-5.3-11.8-11.8-11.8c-6.5,0-11.8,5.3-11.8,11.8v113.9H130.3  c-6.5,0-11.8,5.3-11.8,11.8s5.3,11.8,11.8,11.8h113.9v113.9c0,6.5,5.3,11.8,11.8,11.8c6.5,0,11.8-5.3,11.8-11.8V267.8h113.9  c6.5,0,11.8-5.3,11.8-11.8S388.2,244.2,381.7,244.2z" fill="#FFFFFF"/></svg></a>


 <div  class="visible-phone" id="headermobile">Recibos</div>
 <div class="visible-phone" style="margin-top: 60px"></div>


<?php

if(!$results){?>

<div class="panel">
  <div class="panel-heading hidden-xs">
    <h4><i class="fas fa-receipt"></i> | Recibos</h4>
  </div>
  <div class="panel-body">


<table class="table ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="5">Nenhum Serviço Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>



<?php }
else{ ?>

<div class="panel">
  <div class="panel-heading hidden-xs">
    <h4><i class="fas fa-receipt"></i> | Recibos</h4>
          <form method="get" action="<?php echo base_url(); ?>recibos/gerenciar">
        

        <div class="span3">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Nome do cliente a pesquisar" class="span12" value="" >
        </div>

        <div class="span3">
            <input type="text" name="data"  id="data"  placeholder="Data" class="span12 datepicker" value="">
        
        </div>
        <div class="span1">
            <button class="span12 btn"> <i class="fas fa-search"></i> </button>
        </div>
    </form>
  </div>
  <div class="panel-body">


<table class="table ">
    <thead>
        <tr style="backgroud-color: #2D335B;">
            <th>#</th>
            <th>Nome cliente</th>
            <th>Valor</th>
            <th class="hidden-xs">Descrição</th>
            <th>Data</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->idRecibo.'</td>';
            echo '<td>'.$r->nomeCliente.'</td>';
            echo '<td>R$ '.number_format($r->valorRecibo,2,',','.').'</td>';
            echo '<td class="hidden-xs">'.$r->referente.'</td>';
             echo '<td>'. date('d/m/Y',strtotime($r->dataRecibo)).'</td>';
            echo '<td>';
         
          echo '<a style="margin-right: 1%;" href="'.base_url().'recibos/imprimir/'.$r->idRecibo.'" target="_blank" class="btn btn-inverse editar" title="Imprimir"><i class="fas fa-print"></i></a>'; 

                echo '<a style="margin-right: 1%;" href="'.base_url().'recibos/editar/'.$r->idRecibo.'" class="btn btn-info editar" title="Editar Recibo"><i class="icon-pencil icon-white"></i></a>'; 
          
            
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" recibos="'.$r->idRecibo.'" class="btn btn-danger" title="Excluir Recibo"><i class="icon-remove icon-white"></i></a>  '; 
            
                      
                      
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
  <form action="<?php echo base_url() ?>recibos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Recibo</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idRecibo" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este Recibo?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){

      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>recibos/autoCompleteCliente",
            minLength: 1,
            select: function( event, ui ) {

                 $("#clientes_id").val(ui.item.id);
                

            }
      });

     
    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
   
});


$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var recibos = $(this).attr('recibos');
        $('#idRecibo').val(recibos);

    });

});



</script>