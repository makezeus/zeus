<div class="row-fluid">

    <div class="panel">
        
            <div class="panel-heading">
               
                   <h5> <i class="fas fa-list"></i> | Dados do Produto</h5>
              
            </div>
       
      
            <div class="panel-body">
                <table class="table ">
                    <tbody>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Descrição</strong></td>
                            <td><?php echo $result->descricao ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Unidade</strong></td>
                            <td><?php echo $result->unidade ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Compra</strong></td>
                            <td>R$ <?php echo $result->precoCompra; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Venda</strong></td>
                            <td>R$ <?php echo $result->precoVenda; ?></td>
                        </tr>
                            <?php 
                            $venda =  $result->precoVenda;
                            $compra = $result->precoCompra;
                            $lucro = $venda - $compra;
                             ?>

                                                <tr>
                            <td style="text-align: right"><strong>Lucro</strong></td>
                            <td>R$ <?php echo $lucro ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque</strong></td>
                            <td><?php echo $result->estoque; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque Mínimo</strong></td>
                            <td><?php echo $result->estoqueMinimo; ?></td>
                        </tr>
                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

