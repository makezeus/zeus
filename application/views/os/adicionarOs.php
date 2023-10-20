<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<style>
    
@media (max-width: 480px){
    .pesquisa{
        width: 100%;
    }
.modal {
    top: 10%;
    right: 0px;
    left: 0px;
}


.modal.fade.in {
    bottom: 0px;
    top:auto;
}


}

.modal.fade {
    top: -10000px;
}

.opcao li{
    line-height: 45px;
}

.widget-title h5 {
    float: none;
}
}
</style>
<div class="visible-phone" style="font-size: 15px;color: #111;margin-top: 80px;">
<div id="headermobile">Adicionar OS</div></div>


                <div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="panel">
            <div class="panel-heading  visible-desktop">
                
                    
              
                <h5><i class="fas fa-tags"></i> | Cadastro de OS</h5>
            </div>
            <div class="panel-body nopadding">
                

                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs visible-desktop">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da OS</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                <?php if($custom_error == true){ ?>
                                <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e responsável.</div>
                                <?php } ?>
                                <form action="<?php echo current_url(); ?>" method="post" id="formOs">

                                    <div class="span12" style="padding: 1%">


<div class="form-group span6">
    <label class="" for="cliente">Cliente<span class="required">*</span></label>
    <div class="input-group">
      <input type="text" class="form-control" id="cliente" name="cliente" placeholder="">
       <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value=""  />
      <div class="input-group-addon"><a href="#" data-toggle="modal" data-target="#myModal">+</a></div>
    </div>
  </div>



                          <div class="span6">
                                            <label for="tecnico">Técnico / Responsável<span class="required">*</span></label>
                                            <input id="tecnico" class="span12 form-control" type="text" name="tecnico" value=""  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value=""  />
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3">
                                            <label for="status">Status<span class="required">*</span></label>
                                            <select class="span12" name="status" id="status" value="">
                                                <option value="Orçamento">Orçamento</option>
                                                <option value="Aberto">Aberto</option>
                                                <option value="Em Andamento">Em Andamento</option>
                                                <option value="Finalizado">Finalizado</option>
                                                <option value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>
                                        <div class="span3">
                                            <label for="dataInicial">Data Inicial<span class="required">*</span></label>
                                            <input id="dataInicial" class="span12 datepicker" type="text" name="dataInicial" value="<?php echo date('d/m/Y'); ?>"  />
                                        </div>
                                        <div class="span3">
                                            <label for="dataFinal">Data Final</label>
                                            <input id="dataFinal" class="span12 datepicker" type="text" name="dataFinal" value="" autocomplete="off" />
                                        </div>

                                        <div class="span3">
                                            <label for="garantia">Garantia</label>
                                            <input id="garantia" type="text" class="span12" name="garantia" value=""  />
                                        </div>
                                    </div>

                                    <div class="span12" style="padding: 1%; margin-left: 0">

                                        <div class="span6">
                                            <label for="descricaoProduto">Descrição Produto/Serviço</label>
                                            <textarea class="span12" name="descricaoProduto" id="descricaoProduto" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="span6">
                                            <label for="defeito">Defeito</label>
                                            <textarea class="span12" name="defeito" id="defeito" cols="30" rows="5"></textarea>
                                        </div>

                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6">
                                            <label for="observacoes">Observações</label>
                                            <textarea class="span12" name="observacoes" id="observacoes" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="span6">
                                            <label for="laudoTecnico">Laudo Técnico</label>
                                            <textarea class="span12" name="laudoTecnico" id="laudoTecnico" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <button class="btn btny btn-success" data-loading-text="Espere..." id="btnContinuar"><i class="icon-share-alt icon-white "></i> Continuar</button>
                                            
                                            <a href="<?php echo base_url() ?>os" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a>
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                
.
             
        </div>
        
    </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Cliente</h4>
      </div>
      <div class="modal-body">
          
                 <div class="col-md-12">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?></div>
                        <form action="/os/adicionarCliente" id="formCliente" method="post">
                    
                    <div class="form-group col-md-6">
                        <label for="nomeCliente" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeCliente" class="form-control" type="text" name="nomeCliente" value="<?php echo set_value('nomeCliente'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="documento" class="control-label">CPF/CNPJ<span class="required">*</span></label>
                        <div class="controls">
                            <input id="documento"  class="form-control" type="text" name="documento" value="<?php echo set_value('documento'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="telefone" class="control-label">Telefone<span class="required">*</span></label>
                        <div class="controls">
                            <input id="telefone"  class="form-control" type="text" name="telefone" value="<?php echo set_value('telefone'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="celular" class="control-label">Celular</label>
                        <div class="controls">
                            <input id="celular"  class="form-control" type="text" name="celular" value="<?php echo set_value('celular'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email" class="control-label">Email<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email"  class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-5" class="control-label">
                        <label for="rua" class="control-label">Rua<span class="required">*</span></label>
                        <div class="controls">
                            <input id="rua" type="text"  class="form-control" name="rua" value="<?php echo set_value('rua'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numero" class="control-label">Número<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero" type="text"  class="form-control" name="numero" value="<?php echo set_value('numero'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="bairro" type="text"  class="form-control" name="bairro" value="<?php echo set_value('bairro'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cidade" type="text"  class="form-control" name="cidade" value="<?php echo set_value('cidade'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estado" type="text"  class="form-control" name="estado" value="<?php echo set_value('estado'); ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cep" class="control-label">CEP<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cep" type="text"  class="form-control" name="cep" value="<?php echo set_value('cep'); ?>"  />
                        </div>
                    </div>


                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button id="myButton" data-loading-text="Espere..." type="submit" class="btny btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
      </div></form>
    </div>
  </div>
</div>


<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
           $('#formCliente').validate({
            rules :{
                  nomeCliente:{ required: true},
                  documento:{ required: true},
                  telefone:{ required: true},
                  email:{ required: true},
                  rua:{ required: true},
                  numero:{ required: true},
                  bairro:{ required: true},
                  cidade:{ required: true},
                  estado:{ required: true},
                  cep:{ required: true}
            },
            messages:{
                  nomeCliente :{ required: 'Campo Requerido.'},
                  documento :{ required: 'Campo Requerido.'},
                  telefone:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                  rua:{ required: 'Campo Requerido.'},
                  numero:{ required: 'Campo Requerido.'},
                  bairro:{ required: 'Campo Requerido.'},
                  cidade:{ required: 'Campo Requerido.'},
                  estado:{ required: 'Campo Requerido.'},
                  cep:{ required: 'Campo Requerido.'}

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



<script type="text/javascript">
$(document).ready(function(){

      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteCliente",
            minLength: 1,
            select: function( event, ui ) {

                 $("#clientes_id").val(ui.item.id);
                

            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>os/autoCompleteUsuario",
            minLength: 1,
            select: function( event, ui ) {

                 $("#usuarios_id").val(ui.item.id);


            }
      });

      
      

      $("#formOs").validate({
          rules:{
             cliente: {required:true},
             tecnico: {required:true},
             dataInicial: {required:true}
          },
          messages:{
             cliente: {required: 'Campo Requerido.'},
             tecnico: {required: 'Campo Requerido.'},
             dataInicial: {required: 'Campo Requerido.'}
          },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
       });

    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
   
});

</script>


