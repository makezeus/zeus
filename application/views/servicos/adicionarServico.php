    <div class="visible-phone" style="font-size: 15px;color: #111;margin-top: 80px;">
        <div id="headermobile">Cadastro de Serviço</div></div>

<div class="row-fluid" style="margin-top:0">
   
        <div class="panel">
            <div class="panel-heading visible-desktop">
                <h5><i class="fas fa-align-justify"></i> | Cadastro de Serviço</h5>
            </div>
            <div class="panel-body nopadding">
                 <div class="col-md-12">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formServico" method="post" >
                    <div class="form-group">
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" class="form-control" type="text" name="nome" value="<?php echo set_value('nome'); ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="preco" class="control-label"><span class="required">Preço*</span></label>
                        <div class="controls">
                            <input id="preco" class="money form-control" type="text" name="preco" value="<?php echo set_value('preco'); ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <div class="controls">
                            <input id="descricao" type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <div class="span4 offset4">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>servicos" id="btnAdicionar" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a>
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
           $('#formServico').validate({
            rules :{
                  nome:{ required: true},
                  preco:{ required: true}
            },
            messages:{
                  nome :{ required: 'Campo Requerido.'},
                  preco :{ required: 'Campo Requerido.'}
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




                                    
