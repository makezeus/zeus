<div class="row-fluid">
    <div class="panel-heading hidden-xs">
        <? $this->load->view('components/breadcrumb'); ?>

        <div style="display: flex; justify-content: space-between">
            <h4>Editar Cliente</h4>

            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="' . $result->idClientes . '"class="btn btn-danger" title="Excluir Cliente">Exluir</a>';
            } ?>

        </div>
    </div>
    <div class="panel-body" style="padding-top: 30px">
        <?php if ($custom_error != '') {
            echo '<div class="alert alert-danger">' . $custom_error . '</div>';
        } ?>
        <div class="col-md-12">
            <form action="<?php echo current_url(); ?>" id="formCliente" class="" method="post">

                <div class="form-group col-md-6">
                    <?php echo form_hidden('idClientes', $result->idClientes) ?>
                    <label for="nomeCliente" class="control-label">Nome<span class="required">*</span></label>
                    <div class="controls">
                        <input id="nomeCliente" class="form-control" type="text" name="nomeCliente"
                            value="<?php echo $result->nomeCliente; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="documento" class="control-label">CPF/CNPJ<span class="required">*</span></label>
                    <div class="controls">
                        <input id="documento" class="form-control" type="text" name="documento"
                            value="<?php echo $result->documento; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="telefone" class="control-label">Telefone<span class="required">*</span></label>
                    <div class="controls">
                        <input id="telefone" class="form-control" type="text" name="telefone"
                            value="<?php echo $result->telefoneCliente; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="celular" class="control-label">Celular</label>
                    <div class="controls">
                        <input id="celular" class="form-control" type="text" name="celular"
                            value="<?php echo $result->celular; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="email" class="control-label">Email<span class="required">*</span></label>
                    <div class="controls">
                        <input id="email" class="form-control" type="text" name="email"
                            value="<?php echo $result->emailCliente; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="rua" class="control-label">Rua<span class="required">*</span></label>
                    <div class="controls">
                        <input id="rua" class="form-control" type="text" name="rua"
                            value="<?php echo $result->rua; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-1">
                    <label for="numero" class="control-label">Número<span class="required">*</span></label>
                    <div class="controls">
                        <input id="numero" class="form-control" type="text" name="numero"
                            value="<?php echo $result->numero; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                    <div class="controls">
                        <input id="bairro" class="form-control" type="text" name="bairro"
                            value="<?php echo $result->bairro; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                    <div class="controls">
                        <input id="cidade" class="form-control" type="text" name="cidade"
                            value="<?php echo $result->cidade; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                    <div class="controls">
                        <input id="estado" class="form-control" type="text" name="estado"
                            value="<?php echo $result->estado; ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="cep" class="control-label">CEP<span class="required">*</span></label>
                    <div class="controls">
                        <input id="cep" class="form-control" type="text" name="cep"
                            value="<?php echo $result->cep; ?>" />
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-12"
                        style="margin-bottom: 20px; display: flex; justify-content: flex-end; align-items: center; gap: 8px;">
                        <button type="submit" class="btn btn-success"><i class="icon-ok icon-white"></i>
                            Salvar</button>



                    </div>
                </div>

            </form>
        </div>
    </div>
</div>



<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#formCliente').validate({
            rules: {
                nomeCliente: {
                    required: true
                },
                documento: {
                    required: true
                },
                telefone: {
                    required: true
                },
                email: {
                    required: true
                },
                rua: {
                    required: true
                },
                numero: {
                    required: true
                },
                bairro: {
                    required: true
                },
                cidade: {
                    required: true
                },
                estado: {
                    required: true
                },
                cep: {
                    required: true
                }
            },
            messages: {
                nomeCliente: {
                    required: 'Campo Requerido.'
                },
                documento: {
                    required: 'Campo Requerido.'
                },
                telefone: {
                    required: 'Campo Requerido.'
                },
                email: {
                    required: 'Campo Requerido.'
                },
                rua: {
                    required: 'Campo Requerido.'
                },
                numero: {
                    required: 'Campo Requerido.'
                },
                bairro: {
                    required: 'Campo Requerido.'
                },
                cidade: {
                    required: 'Campo Requerido.'
                },
                estado: {
                    required: 'Campo Requerido.'
                },
                cep: {
                    required: 'Campo Requerido.'
                }

            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('error');
                $(element).parents('.form-group').addClass('success');
            }
        });
    });
</script>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <form action="<?php echo base_url() ?>clientes/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Cliente</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idCliente" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele (OS,
                Vendas, Receitas)?</h5>
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

            var cliente = $(this).attr('cliente');
            $('#idCliente').val(cliente);

        });

    });
</script>