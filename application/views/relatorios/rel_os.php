<div class="row-fluid" style="margin-top: 0">

<div class="visible-phone" id="headermobile">Relatório OS</div>
<div class="visible-phone" style="margin-top: 60px"></div>

<div class="row-fluid" style="margin-top: 0">

<div class="col-md-12 visible-desktop"> <h2 class="dash" style="font-weight: 400; font-family: 'Open Sans'; margin-bottom: 30px;">Relatório OS</h2></div>

    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                                  
                              <h5> <i class="fas fa-list-alt"></i>Relatórios Rápidos</h5>
            </div>
            <div class="panel-body">
                <ul class="site-stats">
                    <li><a target="_blank" href="<?php echo base_url()?>relatorios/osRapid"><i class="fas fa-tags"></i> <small>Todas as OS</small></a></li>
                    
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel">
            <div class="panel-heading">
                <h5><i class="fas fa-list-alt"></i> | Relatórios Customizáveis</h5>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <form target="_blank" action="<?php echo base_url() ?>relatorios/osCustom" method="get">
                        <div class="span12">
                            <div class="span6">
                                <label for="">Data de:</label>
                                <input type="date" name="dataInicial" class="span12" />
                            </div>
                            <div class="span6">
                                <label for="">até:</label>
                                <input type="date"  name="dataFinal" class="span12" />
                            </div>
                        </div>
                        <div class="span12" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Cliente:</label>
                                <input type="text"  id="cliente" class="span12" />
                                <input type="hidden" name="cliente" id="clienteHide" />

                            </div>
                            <div class="span6">
                                <label for="">Responsável:</label>
                                <input type="text" id="tecnico"   class="span12" required />
                                <input type="hidden" name="responsavel" id="responsavelHide" />
                            </div>
                        </div>
                        <div class="span12" style="margin-left: 0; margin-bottom: 20px;">
                            <div class="span6">
                                <label for="">Status:</label>
                                <select name="status" id="" class="span12">
                                    <option value=""></option>
                                    <option value="Orçamento">Orçamento</option>
                                    <option value="Aberto">Aberto</option>
                                    <option value="Em Andamento">Em Andamento</option>
                                    <option value="Finalizado">Finalizado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>

                            </div>

                        </div>

                        <div class="col-md-12" style="text-align: center">
                            <input type="reset" class="btn" value="Limpar" />
                            <button class="btn btn-inverse"><i class="icon-print icon-white"></i>Imprimir</button>
                        </div>
                    </form>
                </div>
                .
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();
        
        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteCliente",
            minLength: 2,
            select: function( event, ui ) {

                 $("#clienteHide").val(ui.item.id);


            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {

                 $("#responsavelHide").val(ui.item.id);


            }
      });

    });
</script>