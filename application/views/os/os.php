<style>
    @media (max-width: 480px) {
        .pesquisa {
            width: 100%;
        }

        .modal {
            top: 10%;
            right: 0px;
            left: 0px;
        }


        .modal.fade.in {
            bottom: 0px;
            top: auto;
        }


        .modal.fade {
            top: -10000px;
        }
    }

    .opcao li {
        line-height: 45px;
    }

    .widget-title h5 {
        float: none;
    }
</style>


<?php

if (!$results) { ?>



    <div class="panel">
        <div class="panel-heading">
            <h5><i class="fas fa-tags"></i> | Ordens de Serviço</h5>
        </div>

        <div class="panel-body nopadding ">


            <table class="table ">
                <thead>
                    <tr style="backgroud-color: #2D335B">
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Data Inicial</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="6">Nenhuma OS Cadastrada</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php } else { ?>



    <div class="panel-heading">
        <? $this->load->view('components/breadcrumb'); ?>

        <h4 class="visible-desktop">Ordens de Serviço</h4>

        <form method="get" style="display: flex; justify-content:space-between"
            action="<?php echo base_url(); ?>/os/gerenciar">

            <div class="form-group" style="">
                <input type="text" name="pesquisa" style="margin-bottom: 0px" id="pesquisa" placeholder="Nome do Cliente"
                    class="form-control" value="">
            </div>

            <div style="display:flex; gap: 8px">
                <div class="form-group" style="">
                    <select name="status" id="status" class="form-control">
                        <option value=""> status</option>
                        <option value="Aberto">Aberto</option>
                        <option value="Faturado">Faturado</option>
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Orçamento">Orçamento</option>
                        <option value="Finalizado">Finalizado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </div>

                <div class="form-group" style="">
                    <input type="text" name="data" id="data" placeholder="Data Inicial" style="margin-bottom: 0px"
                        class="form-control" value="">
                </div>

                <div class="form-group" style="">
                    <input type="text" name="data2" id="data2" placeholder="Data Final" style="margin-bottom: 0px"
                        class="form-control" value="">
                </div>
                <div>
                    <button class="btn btn-primary"> <i class="fas fa-search"></i> </button>
                </div>
            </div>
            <div>
                <button class="btn btn-primary"><i class="ri-add-line"></i> Adicionar </button>
            </div>
        </form>
    </div>

    <div class="panel-body nopadding">

        <table class="table ">
            <thead>
                <tr style="backgroud-color: #2D335B">
                    <th>Cliente / Responsável</th>
                    <th>Data Inicial</th>
                    <th>Data Final</th>
                    <th>Status</th>
                    <th>Total OS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $r) {

                    $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));

                    switch ($r->status) {
                        case 'Aberto':
                            $cor = '#86EFAC';
                            break;
                        case 'Em Andamento':
                            $cor = '#5D5FEF';
                            break;
                        case 'Orçamento':
                            $cor = '#FFE57C';
                            break;
                        case 'Cancelado':
                            $cor = '#F88888';
                            break;
                        case 'Finalizado':
                            $cor = '#E5E7EB';
                            break;
                        case 'Faturado':
                            $cor = '#EF5DA8';
                            break;
                        default:
                            $cor = '#9333EA';
                            break;
                    }

                    ?>





                    <tr>
                        <td>
                            <div style="display: flex; flex-direction:column">
                                <span>
                                    <? echo $r->nomeCliente ?>
                                </span>
                                <span style="font-size: 0.75rem; color: #6B7280">
                                    <? echo $r->nome ?>
                                </span>
                            </div>
                        </td>

                        <td>
                            <? echo date("d/m/Y", strtotime($r->dataInicial)); ?>
                        </td>
                        <td>
                            <? echo date("d/m/Y", strtotime($r->dataFinal)); ?>
                        </td>

                        <td class="hidden-xs">
                            <? echo statusMapperBudget($r->status) ?>
                        </td>

                        <td>R$
                            <? echo number_format($r->valorTotal, 2, ',', '.') ?>
                        </td>
                        <td class="hidden-xs" style="display:flex; gap:8px; justify-content: flex-end;">
                            <?

                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'os/visualizar/' . $r->idOs . '" class="btn hidden-xs" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>';
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'os/imprimir/' . $r->idOs . '" target="_blank" class="btn btn-inverse tip-top" title="Imprimir"><i class="fas fa-print"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>';
                            }
                            ?>
                        </td>

                    </tr>

                <?php } ?>



            </tbody>
        </table>
    </div>


    <div class="" style="clear: both;">
        <?php echo $this->pagination->create_links();
} ?>
</div>



<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <form action="<?php echo base_url() ?>/os/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir OS</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idOs" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir esta OS?</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function () {


        $(document).on('click', 'a', function (event) {

            var os = $(this).attr('os');
            $('#idOs').val(os);

        });

        $(document).on('click', '#excluir-notificacao', function (event) {
            event.preventDefault();

            $.ajax({
                url: '<?php echo site_url() ?>/os/excluir_notificacao',
                type: 'GET',
                dataType: 'json',
            })
                .done(function (data) {
                    if (data.result == true) {
                        alert('Notificação excluída com sucesso');
                        location.reload();
                    } else {
                        alert('Ocorreu um problema ao tentar exlcuir notificação.');
                    }


                });


        });

        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });

    });
</script>