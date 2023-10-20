<style>
    .padding{
        padding: 10px;
    }
</style>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="panel">
            <div class="panel-heading">
                
                    
               
                <h5><i class="fas fa-user"></i> | Editar Usuário</h5>
            </div>
            <div class="panel-body padding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" encclass="form-control" type="multipart/form-data" method="post" >
                    
                    <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo form_hidden('idUsuarios',$result->idUsuarios) ?>
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" class="form-control" type="text" name="nome" value="<?php echo $result->nome; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="rg" class="control-label">RG<span class="required">*</span></label>
                        <div class="controls">
                            <input id="rg" class="form-control" type="text" name="rg" value="<?php echo $result->rg; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="cpf" class="control-label">CPF<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cpf" class="form-control" type="text" name="cpf" value="<?php echo $result->cpf; ?>"  />
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                        <label for="rua" class="control-label">Rua<span class="required">*</span></label>
                        <div class="controls">
                            <input id="rua" class="form-control" type="text" name="rua" value="<?php echo $result->rua; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numero" class="control-label">Numero<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero" class="form-control" type="text" name="numero" value="<?php echo $result->numero; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="bairro" class="form-control" type="text" name="bairro" value="<?php echo $result->bairro; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cidade" class="form-control" type="text" name="cidade" value="<?php echo $result->cidade; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estado" class="form-control" type="text" name="estado" value="<?php echo $result->estado; ?>"  />
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-3">
                        <label for="email" class="control-label">Email<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email" class="form-control" type="text" name="email" value="<?php echo $result->email; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="senha" class="control-label">Senha</label>
                        <div class="controls">
                            <input id="senha" class="form-control" type="password" name="senha" value=""  placeholder="Não preencha se não quiser alterar."  />
                            <i class="icon-exclamation-sign tip-top" title="Se não quiser alterar a senha, não preencha esse campo."></i>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="telefone" class="control-label">Telefone<span class="required">*</span></label>
                        <div class="controls">
                            <input id="telefone" class="form-control" type="text" name="telefone" value="<?php echo $result->telefone; ?>"  />
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="celular" class="control-label">Celular</label>
                        <div class="controls">
                            <input id="celular" class="form-control" type="text" name="celular" value="<?php echo $result->celular; ?>"  />
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-md-6">
                        <label  class="control-label">Situação*</label>
                        <div class="controls">
                            <select class="form-control" name="situacao" id="situacao">
                                <?php if($result->situacao == 1){$ativo = 'selected'; $inativo = '';} else{$ativo = ''; $inativo = 'selected';} ?>
                                <option value="1" <?php echo $ativo; ?>>Ativo</option>
                                <option value="0" <?php echo $inativo; ?>>Inativo</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <label  class="control-label">Permissões<span class="required">*</span></label>
                        <div class="controls">
                            <select name="permissoes_id" class="form-control" id="permissoes_id">
                                  <?php foreach ($permissoes as $p) {
                                     if($p->idPermissao == $result->permissoes_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$p->idPermissao.'"'.$selected.'>'.$p->nome.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                   <div class="form-group">
                        <div class="col-md-12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>usuarios" id="" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
</div>

                </form>
            </div>
        </div>
    </div>
</div>




<script  src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
      $(document).ready(function(){

           $('#formUsuario').validate({
            rules : {
                  nome:{ required: true},
                  rg:{ required: true},
                  cpf:{ required: true},
                  telefone:{ required: true},
                  email:{ required: true},
                  rua:{ required: true},
                  numero:{ required: true},
                  bairro:{ required: true},
                  cidade:{ required: true},
                  estado:{ required: true},
                  cep:{ required: true}
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  rg:{ required: 'Campo Requerido.'},
                  cpf:{ required: 'Campo Requerido.'},
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


