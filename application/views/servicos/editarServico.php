
    <div class="visible-phone" style="font-size: 15px;color: #111;margin-top: 80px;">
        <div id="headermobile">Editar Serviço</div></div>


<div class="row-fluid" style="margin-top:0">
                              
                                    <div class="panel">
                                          <div class="panel-heading visible-desktop">
            
                                                <h5><i class="fas fa-align-justify"></i> | Editar Serviço</h5>
                                          </div>
                                          <div class="panel-body nopadding">
                                            <div class="col-md-12">
                                                <?php echo $custom_error; ?>
                                                <form action="<?php echo current_url(); ?>" id="formServico" method="post">
                                                    <?php echo form_hidden('idServicos',$result->idServicos) ?>
                                                    <div class="form-group">
                                                            <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                                                            <div class="controls">
                                                                  <input id="nome" type="text" name="nome" class="form-control" value="<?php echo $result->nome ?>"  />
                                                            </div>
                                                      </div>
                                                      <div class="form-group">
                                                            <label for="preco" class="control-label"><span class="required">Preço*</span></label>
                                                            <div class="controls">
                                                                <input id="preco" class="money form-control" type="text" name="preco" value="<?php echo $result->preco ?>"  />
                                                            </div>
                                                      </div>
                                                      <div class="form-group">
                                                            <label for="descricao" class="control-label">Descrição</label>
                                                            <div class="controls">
                                                                  <input id="descricao" type="text" name="descricao"  class="form-control" value="<?php echo $result->descricao ?>"  />
                                                            </div>
                                                      </div>

                                                      <div class="form-group">
                                                      <div class="col-md-12" style="margin-bottom: 20px;">
                                                            <div class="span4 offset4">
                                                            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                                            <a href="<?php echo base_url()?>servicos" id="btnAdicionar" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a>
                                                            <?php 

            if($this->permission->checkPermission($this->session->userdata('permissao'),'dServico')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" servico="'.$result->idServicos.'" class="btn btn-danger tip-top" title="Excluir Serviço"><i class="icon-remove icon-white"></i> Excluir</a>  '; 
            }    
                      
     

 ?>
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



<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>servicos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Serviço</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idServico" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este serviço?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var servico = $(this).attr('servico');
        $('#idServico').val(servico);

    });

});

</script>