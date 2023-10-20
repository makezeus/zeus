   <link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                <div class="visible-phone" style="font-size: 15px;color: #111;margin-top: 80px;">
        <div id="headermobile">Editar Recibo</div></div>
<div class="row-fluid">
    <div class="panel">
     <div class="panel-heading visible-desktop">
        <h5>  <i class="fas fa-receipt"></i> | Editar Recibo</h5>
     </div>

  <div class="panel-body">
    <div class="col-md-12"> 
       <?php echo $custom_error; ?>
  <form action="<?php echo current_url(); ?>" method="post" id="formRecibos">
 <?php echo form_hidden('idRecibo',$result->idRecibo) ?>

<div class="form-group col-md-12">
      <div class="input-group">
        <span class="input-group-addon">Nome Cliente</span>
         <input id="cliente" class="form-control" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>"  />                             
     </div>
  </div>
  <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>"  />


<div class="form-group col-md-6">
      <div class="input-group">
        <span class="input-group-addon">Data</span>
       <input id="dataRecibo" type="date" class="form-control" name="dataRecibo" value="<?php echo $result->dataRecibo ?>"  />
     </div>
</div> 

<div class="form-group col-md-6">
      <div class="input-group">
        <span class="input-group-addon">Valor Recibo</span>
        <input type="text" class="form-control" id="valorRecibo" name="valorRecibo" aria-describedby="inputGroupSuccess4Status" value="<?php echo $result->valorRecibo ?>">
     </div> 
</div>

<div class="form-group col-md-12">
        <div class="input-group">
        <span class="input-group-addon">Referente</span>
        <textarea class="form-control" id="referente" name="referente" rows="3"><?php echo $result->referente ?></textarea>
     </div>
</div>

<div class="form-group col-md-12">
  <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i>Alterar</button>
                                <a href="<?php echo base_url() ?>recibos" id="" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a></div>
 
</form>

 </div>
</div></div>  </div>
<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
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
          $(".money").maskMoney();
           $('#formRecibos').validate({
            rules :{
                  cliente:{ required: true},
                  valorRecibo:{ required: true}
            },
            messages:{
                  cliente :{ required: 'Campo Requerido.'},
                  valorRecibo :{ required: 'Campo Requerido.'}
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
      });

</script>

