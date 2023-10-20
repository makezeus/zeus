<div class="visible-phone" id="headermobile">Relatório Clientes</div>
<div class="visible-phone" style="margin-top: 60px"></div>

<div class="row-fluid" style="margin-top: 0">

<div class="col-md-12 visible-desktop">	<h2 class="dash" style="font-weight: 400; font-family: 'Open Sans'; margin-bottom: 30px;">Relatório Clientes</h2></div>


    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                  <h4><i class="fas fa-list-alt"></i> | Relatórios Rápidos</h4>
            </div>
            <div class="panel-body">
                <ul class="site-stats">
                    <li><a href="<?php echo base_url()?>relatorios/clientesRapid" target="_blank"><i class="fas fa-users"></i> <small>Todos os Clientes</small></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel">
            <div class="panel-heading">                                 
                <h4> <i class="fas fa-list-alt"></i> | Relatórios Customizáveis</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form target="_blank" action="<?php echo base_url()?>relatorios/clientesCustom" method="get">
                    <div class="span6">
                        <label for="">Cadastrado de:</label>
                        <input type="date" name="dataInicial" class="span12" />
                    </div>
                    <div class="span6">
                        <label for="">até:</label>
                        <input type="date" name="dataFinal" class="span12" />
                    </div>
                    <div class="">
                        <button class="btn btn-inverse span12"><i class="fas fa-print icon-white"></i> Imprimir</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>