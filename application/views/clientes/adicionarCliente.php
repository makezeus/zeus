<div class="row-fluid">

    <div class="panel-heading visible-desktop">
        <? $this->load->view('components/breadcrumb'); ?>
        <h4>Cadastro de Cliente</h4>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <?php if ($custom_error != '') {
                echo '<div class="alert alert-danger">' . $custom_error . '</div>';
            } ?>
            <form action="<?php echo current_url(); ?>" id="formCliente" method="post">
                <div class="form-group col-md-6">
                    <label for="nomeCliente" class="control-label">Nome<span class="required">*</span></label>
                    <div class="controls">
                        <input id="nomeCliente" class="form-control" type="text" name="nomeCliente"
                            value="<?php echo set_value('nomeCliente'); ?>" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="documento" class="control-label">CPF/CNPJ<span class="required">*</span></label>
                    <div class="controls">
                        <input id="documento" class="form-control" type="text" name="documento"
                            value="<?php echo set_value('documento'); ?>" />
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefone" class="control-label">Telefone<span class="required">*</span></label>
                    <div class="controls">
                        <input id="telefone" class="form-control" type="text" name="telefone"
                            value="<?php echo set_value('telefone'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="celular" class="control-label">Celular</label>
                    <div class="controls">
                        <input id="celular" class="form-control" type="text" name="celular"
                            value="<?php echo set_value('celular'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="email" class="control-label">Email<span class="required">*</span></label>
                    <div class="controls">
                        <input id="email" class="form-control" type="text" name="email"
                            value="<?php echo set_value('email'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-3" class="control-label">
                    <label for="rua" class="control-label">Rua<span class="required">*</span></label>
                    <div class="controls">
                        <input id="rua" type="text" class="form-control" name="rua"
                            value="<?php echo set_value('rua'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-1">
                    <label for="numero" class="control-label">Número<span class="required">*</span></label>
                    <div class="controls">
                        <input id="numero" type="text" class="form-control" name="numero"
                            value="<?php echo set_value('numero'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                    <div class="controls">
                        <input id="bairro" type="text" class="form-control" name="bairro"
                            value="<?php echo set_value('bairro'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                    <div class="controls">
                        <input id="cidade" type="text" class="form-control" name="cidade"
                            value="<?php echo set_value('cidade'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                    <div class="controls">
                        <input id="estado" type="text" class="form-control" name="estado"
                            value="<?php echo set_value('estado'); ?>" />
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="cep" class="control-label">CEP<span class="required">*</span></label>
                    <div class="controls">
                        <input id="cep" type="text" class="form-control" name="cep"
                            value="<?php echo set_value('cep'); ?>" />
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-12" style="margin-bottom: 30px; margin-top: 30px">
                        <div style="display:flex; justify-content: space-between">
                            <a href="<?php echo base_url() ?>clientes" id="" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i> Voltar</a>
                            <button id="myButton" data-loading-text="Espere..." type="submit"
                                class="btny btn btn-primary"><i class="icon-plus icon-white"></i> Adicionar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#documento').inputmask(['999.999.999-99', '99.999.999/9999-99']);
        $('#telefone').inputmask(['(99) 9999-9999', '(99) 9 9999-9999']);
        $('#celular').inputmask(['(99) 9999-9999', '(99) 9 9999-9999']);
        $('#cep').inputmask(['99999-999']);

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