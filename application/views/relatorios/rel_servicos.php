<div class="row-fluid" style="margin-top: 0">

<div class="visible-phone" id="headermobile">Relatório Serviços</div>
<div class="visible-phone" style="margin-top: 60px"></div>

<div class="row-fluid" style="margin-top: 0">

<div class="col-md-12 visible-desktop"> <h2 class="dash" style="font-weight: 400; font-family: 'Open Sans'; margin-bottom: 30px;">Relatório Serviços</h2></div>



    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">                
                <h5><i class="fas fa-list-alt"></i> | Relatórios Rápidos</h5>
            </div>
            <div class="panel-body">
                <ul class="site-stats">
                    <li><a target="_blank" href="<?php echo base_url()?>relatorios/servicosRapid"><i class="fas fa-wrench"></i> <small>Todos os Serviços</small></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel">
            <div class="panel-heading">
                <h5><i class="fas fa-list-alt"></i> | Relatórios Customizáveis</h5>
            </div>
            <div class="widget-body">
                <div class="col-md-12">
                    
                    <form target="_blank" action="<?php echo base_url() ?>relatorios/servicosCustom" method="get">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label for="">Preço de:</label>
                                <input type="text" name="precoInicial" class="span12 money" />
                            </div>
                            <div class="col-md-6">
                                <label for="">até:</label>
                                <input type="text"  name="precoFinal" class="span12 money" />
                            </div>
                        </div>
 
                        <div class="col-md-12" style="margin-left: 0; text-align: center">
                            <input type="reset" class="btn" value="Limpar" />
                            <button class="btn btn-inverse"><i class="icon-print icon-white"></i> Imprimir</button>
                        </div>
                    </form>
                </div>
                .
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();


    });
</script>