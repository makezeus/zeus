
 <div  class="visible-phone" id="headermobile">Principal</div>
 <div class="visible-phone" style="margin-top: 80px"></div>


<div class="col-md-12"><h2 class="dash" style="font-weight: 400; font-family: 'Open Sans'">Dashboard <br> <small style="font-weight: 300; font-family: 'Open Sans'">Eu encontrei os Seguintes Resultados...</small> </h2></div>
<br><br>



<div class="span12" style="margin-left: 0; margin-top: 0">

    <div class="span12" style="margin-left: 0; margin-top: 0">
    <!--Produtoss-->
    <div class="span6" style="margin-left: 0; margin-top: 0">
        <div class="panel" style="min-height: 200px">
            <div class="panel-heading">
              
                  
            
                <h5><i class="fas fa-barcode"></i> | Produtos</h5>

            </div>

            <div class="panel-body nopadding">

               
                <table class="table ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($produtos == null){
                            echo '<tr><td colspan="4">Nenhum produto foi encontrado.</td></tr>';
                        }
                        foreach ($produtos as $r) {
                            echo '<tr>';
                            echo '<td>' . $r->idProdutos . '</td>';
                            echo '<td>' . $r->descricao . '</td>';
                            echo '<td>' . $r->precoVenda . '</td>';

                            echo '<td>';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'vProduto')){
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'produtos/visualizar/' . $r->idProdutos . '" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>'; 
                            }
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eProduto')){
                                echo '<a href="' . base_url() . 'produtos/editar/' . $r->idProdutos . '" class="btn btn-info tip-top" title="Editar Produto"><i class="icon-pencil icon-white"></i></a>'; 
                            } 
                            
                            echo '</td>';
                            echo '</tr>';
                        } ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--Clientes-->
    <div class="span6">
        <div class="panel" style="min-height: 200px">
            <div class="panel-heading">
               
                    
           
                <h5><i class="fas fa-user"></i> | Clientes</h5>

            </div>

            <div class="panel-body nopadding">


                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF/CNPJ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($clientes == null){
                            echo '<tr><td colspan="4">Nenhum cliente foi encontrado.</td></tr>';
                        }
                        foreach ($clientes as $r) {
                            echo '<tr>';
                            echo '<td>' . $r->idClientes . '</td>';
                            echo '<td>' . $r->nomeCliente . '</td>';
                            echo '<td>' . $r->documento . '</td>';
                            echo '<td>';

                            if($this->permission->checkPermission($this->session->userdata('permissao'),'vCliente')){
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'clientes/visualizar/' . $r->idClientes . '" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>'; 
                            } 
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eCliente')){
                                echo '<a href="' . base_url() . 'clientes/editar/' . $r->idClientes . '" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
                            } 
                            
                            
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>
    
    <!--Serviços-->
    <div class="span6" style="margin-left: 0">
        <div class="panel" style="min-height: 200px">
            <div class="panel-heading">
             
                   
                
                <h5><i class="fas fa-wrench"></i> | Serviços</h5>

            </div>

            <div class="panel-body nopadding">


                <table class="table ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($servicos == null){
                            echo '<tr><td colspan="4">Nenhum serviço foi encontrado.</td></tr>';
                        }
                        foreach ($servicos as $r) {
                            echo '<tr>';
                            echo '<td>' . $r->idServicos . '</td>';
                            echo '<td>' . $r->nome . '</td>';
                            echo '<td>' . $r->preco . '</td>';
                            echo '<td>';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eServico')){
                                echo '<a href="' . base_url() . 'servicos/editar/' . $r->idServicos . '" class="btn btn-info tip-top" title="Editar Serviço"><i class="icon-pencil icon-white"></i></a>'; 
                            } 
                                
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--Ordens de Serviço-->
    <div class="span6">
         <div class="panel" style="min-height: 200px">
            <div class="panel-heading">
               
                   
                
                <h5><i class="fas fa-tags"></i> | Ordens de Serviço</h5>

            </div>

            <div class="panel-body nopadding">


                <table class="table ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Data Inicial</th>
                            <th>Defeito</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($os == null){
                            echo '<tr><td colspan="4">Nenhuma os foi encontrado.</td></tr>';
                        }
                        foreach ($os as $r) {
                            $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));
                            $dataFinal = date(('d/m/Y'), strtotime($r->dataFinal));
                            echo '<tr>';
                            echo '<td>' . $r->idOs . '</td>';
                            echo '<td>' . $dataInicial . '</td>';
                            echo '<td>' . $r->nomeCliente . '</td>';

                            echo '<td>';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'vOs')){
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'os/visualizar/' . $r->idOs . '" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>'; 
                            } 
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eOs')){
                                echo '<a href="' . base_url() . 'os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>'; 
                            }  
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>

