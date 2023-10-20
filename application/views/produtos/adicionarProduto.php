    <div class="visible-phone" style="font-size: 15px;color: #111;margin-top: 80px;">
        <div id="headermobile">Adicionar Produto</div></div>


<style>
/* Hiding the checkbox, but allowing it to be focused */
.badgebox
{
    opacity: 0;
}

.badgebox + .badge
{
    /* Move the check mark away when unchecked */
    text-indent: -999999px;
    /* Makes the badge's width stay the same checked and unchecked */
	width: 27px;
}

.badgebox:focus + .badge
{
    /* Set something to make the badge looks focused */
    /* This really depends on the application, in my case it was: */
    
    /* Adding a light border */
    box-shadow: inset 0px 0px 5px;
    /* Taking the difference out of the padding */
}

.badgebox:checked + .badge
{
    /* Move the check mark back when checked */
	text-indent: 0;
}
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="panel">
            <div class="panel-heading visible-desktop">
               
                    
               
                <h5><i class="fas fa-align-justify"></i> | Cadastro de Produto</h5>
            </div>
            <div class="panel-body nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" >
                     <div class="form-group col-md-6">
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao'); ?>"  />
                        </div>
                    </div>


          
                                <input type="hidden" id="entrada" name="entrada" class="badgebox" value="1" checked>

                                <input type="hidden" id="saida" name="saida" class="badgebox" value="1" checked>
     
                    <div class="form-group col-md-6">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoCompra" class="money form-control"  type="text" name="precoCompra" value="<?php echo set_value('precoCompra'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoVenda" class="money form-control" type="text" name="precoVenda" value="<?php echo set_value('precoVenda'); ?>" onblur="calcular()" />
                        </div>
                    </div>


<script>function calcular() {
  var n1 = Number(document.getElementById('precoCompra').value, 10);
  var n2 = Number(document.getElementById('precoVenda').value, 10);
  
  var resultado = n2 - n1;
  


  var conta = n2 - n1;
  var arredondado = parseFloat(conta.toFixed(2));

  document.getElementById('lucro') .value = arredondado;
}
</script>





                    <div class="form-group col-md-6">
                        <label for="lucro" class="control-label">Lucro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="lucro" class="money form-control" type="text" name="lucro" value=""  />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                    <div class="controls">
                        <!--<input id="unidade" type="text" name="unidade" value="<?php echo set_value('unidade'); ?>"  />-->
                        <select id="unidade" class="form-control" name="unidade">
                            <option value="UN">Unidade</option>
                            <option value="KG">Kilograma</option>
                            <option value="LT">Litro</option>
                            <option value="CX">Caixa</option>
                        </select>
                    </div>
                    </div>                     

                    <div class="form-group col-md-6">
                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" class="form-control" value="<?php echo set_value('estoque'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <div class="span4 offset4">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>produtos" id="" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>

                    
                </form>
            </div>

         </div>
     </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();

        $('#formProduto').validate({
            rules :{
                  descricao: { required: true},
                  unidade: { required: true},
                  precoCompra: { required: true},
                  precoVenda: { required: true},
                  estoque: { required: true}
            },
            messages:{
                  descricao: { required: 'Campo Requerido.'},
                  unidade: {required: 'Campo Requerido.'},
                  precoCompra: { required: 'Campo Requerido.'},
                  precoVenda: { required: 'Campo Requerido.'},
                  estoque: { required: 'Campo Requerido.'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('error');
                $(element).parents('.form-group').addClass('success');
            }
           });
    });
</script>



