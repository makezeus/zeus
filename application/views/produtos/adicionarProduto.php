<div class="row-fluid">
    <div class="panel-heading hidden-xs">
        <? $this->load->view('components/breadcrumb'); ?>

        <div style="display: flex; justify-content: space-between">
            <h4>Cadastrar Produto</h4>
        </div>
    </div>
    <div class="panel-body">
        <?= $custom_error; ?>
        <form action="<?= current_url(); ?>" id="formProduto" method="post" style="display: flex;flex-wrap: wrap;">
            <div class="form-group col-md-6">
                <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                <div class="controls">
                    <input id="descricao" type="text" class="form-control" name="descricao" />
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                <div class="controls">
                    <input id="precoCompra" class="form-control" oninput="formatReal(this)" type="text"
                        name="precoCompra" />
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                <div class="controls">
                    <input id="precoVenda" class="form-control" type="text" name="precoVenda" oninput="formatReal(this)"
                        onchange="calculate()" />
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="lucro" class="control-label">Lucro<span class="required">*</span></label>
                <div class="controls">
                    <input id="lucro" oninput="formatReal(this)" readonly class="form-control" type="text" name="lucro"
                        value="" />
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                <div class="controls">
                    <select id="unidade" class="form-control" name="unidade">
                        <option value="UN">Unidade</option>
                        <option value="KG">Kilograma</option>
                        <option value="LT">Litro</option>
                        <option value="CX">Caixa</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="display: contents">
                <div class="col-md-12" style="margin-bottom: 30px; margin-top: 30px">
                    <div style="display:flex; justify-content: space-between">
                        <a href="<?php echo base_url() ?>produtos" id="" class="btn btn-secondary"><i
                                class="fas fa-arrow-left"></i> Voltar</a>
                        <button id="myButton" data-loading-text="Espere..." type="submit"
                            class="btny btn btn-primary"><i class="icon-plus icon-white"></i> Adicionar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="<?= base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?= base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".money").maskMoney();

        $('#formProduto').validate({
            rules: {
                descricao: { required: true },
                unidade: { required: true },
                precoCompra: { required: true },
                precoVenda: { required: true },
                estoque: { required: true }
            },
            messages: {
                descricao: { required: 'Campo Requerido.' },
                unidade: { required: 'Campo Requerido.' },
                precoCompra: { required: 'Campo Requerido.' },
                precoVenda: { required: 'Campo Requerido.' },
                estoque: { required: 'Campo Requerido.' }
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

    function calculate() {

        const costPrice = parseFloat(document.getElementById('precoCompra').value.replace(/\D/g, '')) / 100;
        const sailPrice = parseFloat(document.getElementById('precoVenda').value.replace(/\D/g, '')) / 100;

        let profit = sailPrice - costPrice;

        let fromatedPorfit = profit.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });

        document.getElementById('lucro').value = fromatedPorfit
    }
</script>