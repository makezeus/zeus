<div class="row-fluid">

    <div class="panel-heading hidden-xs">
        <? $this->load->view('components/breadcrumb'); ?>
        <div style="display: flex; justify-content: space-between">
            <h4>Visualizar Produto</h4>
        </div>
    </div>

    <div class="panel-body">
        <table class="table ">
            <tbody>
                <tr>
                    <td style="text-align: right; width: 30%"><strong>Descrição</strong></td>
                    <td>
                        <?= $result->descricao ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right"><strong>Unidade</strong></td>
                    <td>
                        <?= $result->unidade ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right"><strong>Preço de Compra</strong></td>
                    <td>R$
                        <?= $result->precoCompra; ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right"><strong>Preço de Venda</strong></td>
                    <td>R$
                        <?= $result->precoVenda; ?>
                    </td>
                </tr>
                <?php
                $venda = $result->precoVenda;
                $compra = $result->precoCompra;
                $lucro = $venda - $compra;
                ?>

                <tr>
                    <td style="text-align: right"><strong>Lucro</strong></td>
                    <td>R$
                        <?= $lucro ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right"><strong>Estoque</strong></td>
                    <td>
                        <?= $result->estoque; ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right"><strong>Estoque Mínimo</strong></td>
                    <td>
                        <?= $result->estoqueMinimo; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>