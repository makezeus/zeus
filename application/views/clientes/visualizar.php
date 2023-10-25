<div>
    <div class="panel-heading">
        <? $this->load->view('components/breadcrumb'); ?>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; flex-direction:column">
                <h4>
                    <?= ucwords($result->nomeCliente) ?>
                </h4>
                <span style="color: #6B7280">
                    <?= formatarDocumento($result->documento) ?>
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
                                <?= formatPhone($result->telefoneCliente) ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">TELEFONE AUXILIAR</h6>
                            <div>
                                <?= formatPhone($result->celular) ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">EMAIL</h6>
                            <div>
                                <?= $result->emailCliente ?>
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
                                <?= $result->rua ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">NÚMERO</h6>
                            <div>
                                <?= $result->numero ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">BAIRRO</h6>
                            <div>
                                <?= $result->bairro ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">CIDADE</h6>
                            <div>
                                <?= $result->cidade ?>
                            </div>
                        </div>
                        <div
                            style="flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                            <h6 style="color: #9CA3AF;">CEP</h6>
                            <div>
                                <?= $result->cep ?>
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
            <table class="table">
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
                    <?php } else { ?>
                        <?php foreach ($results as $r) {
                            $dataInicial = formatDate($r->dataInicial);
                            $dataFinal = formatDate($r->dataFinal);
                            ?>
                            <tr>
                                <td>
                                    <?= formatDate($r->dataInicial); ?>
                                </td>
                                <td>
                                    <?= formatDate($r->dataFinal); ?>
                                </td>
                                <td>
                                    <?= statusMapperBudget($r->status); ?>
                                </td>
                                <td>
                                    <?= $r->descricaoProduto; ?>
                                </td>
                                <td style="display: flex; gap: 8px;">
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) { ?>
                                        <a href="<?= base_url() ?>os/visualizar/<?= $r->idOs ?>" style="margin-right: 1%"
                                            class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>
                                    <?php } ?>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) { ?>
                                        <a href="<?= base_url() ?>os/editar/<?= $r->idOs ?>" class="btn btn-info tip-top"
                                            title="Editar OS"><i class="icon-pencil icon-white"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>