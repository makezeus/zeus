<div class="row-fluid" style="margin-top: 0">

<div class="visible-phone" id="headermobile">Relatório Financeiro</div>
<div class="visible-phone" style="margin-top: 60px"></div>

<div class="row-fluid" style="margin-top: 0">

<div class="col-md-12 visible-desktop"> <h2 class="dash" style="font-weight: 400; font-family: 'Open Sans'; margin-bottom: 30px;">Relatório Fianceiro</h2></div>

    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
             
                   
              
                <h5> <i class="fas fa-list-alt"></i> | Relatórios Rápidos</h5>
            </div>
            <div class="panel-body">
                <ul class="site-stats">
                    <li><a target="_blank" href="<?php echo base_url()?>relatorios/financeiroRapid"><i class="fas fa-user"></i> <small>Relatório do mês</small></a></li>
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
                <form target="_blank" action="<?php echo base_url()?>relatorios/financeiroCustom" method="get">
                <div class="col-md-12">
                    
                    <div class="span6">
                        <label for="">Vencimento de:</label>
                        <input type="date" name="dataInicial" class="span12" />
                    </div>
                    <div class="span6">
                        <label for="">até:</label>
                        <input type="date" name="dataFinal" class="span12" />
                    </div>
                    
                </div>

                <div class="col-md-12" style="margin-left: 0; margin-bottom: 20px;">
                    <div class="span6">
                        <label for="">Tipo:</label>
                        <select name="tipo" class="span12">
                            <option value="todos">Todos</option>
                            <option value="receita">Receita</option>
                            <option value="despesa">Despesa</option>
                        </select>
                    </div>
                    <div class="span6">
                        <label for="">Situação:</label>
                        <select name="situacao" class="span12">
                            <option value="todos">Todos</option>
                            <option value="pago">Pago</option>
                            <option value="pendente">Pendente</option>
    
                        </select>
                    </div>

                </div>
                <div class="col-md-12" style="margin-left: 0; text-align: center">
                    <input type="reset" class="btn" value="Limpar" />
                    <button class="btn btn-inverse"><i class="fas fa-print icon-white"></i> Imprimir</button>
                </div>
                </form>
                &nbsp
            </div>
        </div>
    </div>
</div>