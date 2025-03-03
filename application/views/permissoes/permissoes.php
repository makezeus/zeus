
<?php
if(!$results){?>

        <div class="panel">
        <div class="panel-heading">
            
                
            
            <h5><i class="fas fa-lock"></i> | Permissões</h5>

        </div>

        <div class="panel-body nopadding">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Data de Criação</th>
                        <th>Situação</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhuma Permissão foi cadastrada</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{
	

?>
        <div class="panel">
        <div class="panel-heading row">
            
                
            
            <h5 class="col-md-9"><i class="fas fa-lock"></i> | Permissões</h5><a href="<?php echo base_url();?>permissoes/adicionar" class="btn btn-success col-md-3"><i class="icon-plus icon-white"></i> Adicionar Permissão</a>

        </div>

        <div class="panel-body nopadding">


<table class="table ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Data de Criação</th>
            <th>Situação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            if($r->situacao == 1){$situacao = 'Ativo';}else{$situacao = 'Inativo';}
            echo '<tr>';
            echo '<td>'.$r->idPermissao.'</td>';
            echo '<td>'.$r->nome.'</td>';
            echo '<td>'.date('d/m/Y',strtotime($r->data)).'</td>';
            echo '<td>'.$situacao.'</td>';
            echo '<td>
                      <a href="'.base_url().'permissoes/editar/'.$r->idPermissao.'" class="btn btn-info tip-top" title="Editar Permissão"><i class="icon-pencil icon-white"></i></a>
                      <a href="#modal-excluir" role="button" data-toggle="modal" permissao="'.$r->idPermissao.'" class="btn btn-danger tip-top" title="Desativar Permissão"><i class="icon-remove icon-white"></i></a>
                  </td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>permissoes/desativar" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Desativar Permissão</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idPermissao" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente desativar esta permissão?</h5>
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
        
        var permissao = $(this).attr('permissao');
        $('#idPermissao').val(permissao);

    });

});

</script>

