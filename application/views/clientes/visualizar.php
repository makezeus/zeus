<div>
    <div class="panel-heading">
        <? $this->load->view('components/breadcrumb'); ?>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; flex-direction:column">
                <h4>
                    <? echo ucwords($result->nomeCliente) ?>
                </h4>
                <span style="color: #6B7280">
                    <? echo formatarDocumento($result->documento) ?>
                </span>
            </div>
            <div>
                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                    echo '<a title="Icon Title" class="btn btn-mini btn-primary" href="' . base_url() . 'clientes/editar/' . $result->idClientes . '"><i class="icon-pencil icon-white"></i> Editar Cliente</a>';
                } ?>

            </div>
        </div>
    </div>

    <div class="panel-body">
        <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
            <div
                style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 12px; display: flex">
                <div
                    style="align-self: stretch; padding: 12px; flex-direction: column; justify-content: center; align-items: flex-start; display: flex;">
                    <h4>Contato</h4>
                    <div
                        style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 2rem; display: inline-flex; flex-wrap: wrap;">
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">TELEFONE</h6>
                            <div>
                                <? echo formatPhone($result->telefoneCliente) ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">TELEFONE AUXILIAR</h6>
                            <div>
                                <? echo formatPhone($result->celular) ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">EMAIL</h6>
                            <div>
                                <? echo $result->emailCliente ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    style="align-self: stretch; padding: 12px; flex-direction: column; justify-content: center; align-items: flex-start; display: flex">
                    <h4>Endereço</h4>
                    <div
                        style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 2rem; display: inline-flex; flex-wrap: wrap;">
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">RUA</h6>
                            <div>
                                <? echo $result->rua ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">NÚMERO</h6>
                            <div>
                                <? echo $result->numero ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">BAIRRO</h6>
                            <div>
                                <? echo $result->bairro ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">CIDADE</h6>
                            <div>
                                <? echo $result->cidade ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">CEP</h6>
                            <div>
                                <? echo $result->cep ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body" style="min-height: 300px">

        <div class="col-md-12">
            <h4>Ordens de Serviço</h4>
        </div>

        <div class="col-md-12">
            <table class="table ">
                <thead>
                    <tr style="backgroud-color: #2D335B">

                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Descrição</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!$results) { ?>
                        <tr>
                            <td colspan="6">Nenhuma OS Cadastrada</td>
                        </tr>
                    <? } else { ?>
                        <?php
                        foreach ($results as $r) {
                            $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));
                            $dataFinal = date(('d/m/Y'), strtotime($r->dataFinal));
                            echo '<tr>';

                            echo '<td>' . $dataInicial . '</td>';
                            echo '<td>' . $dataFinal . '</td>';
                            echo '<td>' . statusMapperBudget($r->status) . '</td>';
                            echo '<td>' . $r->descricaoProduto . '</td>';
                            echo '<td style="display: flex; gap: 8px;">';
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
                                echo '<a href="' . base_url() . 'os/visualizar/' . $r->idOs . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                                echo '<a href="' . base_url() . 'os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>';
                            }

                            echo '</td>';
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    $("a").click(function () {
        $("div").removeClass('in');
    });
</script>