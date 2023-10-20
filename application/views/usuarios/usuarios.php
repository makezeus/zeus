

 <div  class="visible-phone" id="headermobile">Usuários</div>
 <div class="visible-phone" style="margin-top: 60px"></div>

<div class="row-fluid">

<?php
if(!$results){?>
        <div class="panel">
     <div class="panel-heading">
        
            
      
        <h5 class="col-md-9 hidden-xs"><i class="fas fa-user"></i> | Usuários</h5><a href="<?php echo base_url()?>usuarios/adicionar" class="btn btn-success col-md-6"><i class="icon-plus icon-white"></i> Adicionar Usuário</a>

     </div>

<div class="panel-body nopadding">


<table class="table ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th class="hidden-xs">#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Nível</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhum Usuário Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>


<?php } else{?>

<div class="panel">
     <div class="panel-heading col-md-12">
      
        <h5 class="col-md-9 hidden-xs"><i class="fas fa-user"></i> | Usuários</h5><a href="<?php echo base_url()?>usuarios/adicionar" class="btn btn-success col-md-3"><i class="icon-plus icon-white"></i> Adicionar Usuário</a>

     </div>

<div class="panel-body nopadding">


<table class="table ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th class="hidden-xs">#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Nível</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td class="hidden-xs">'.$r->idUsuarios.'</td>';
            echo '<td>'.$r->nome.'</td>';
            echo '<td>'.$r->cpf.'</td>';
            echo '<td>'.$r->permissao.'</td>';
            echo '<td>
                      <a href="'.base_url().'usuarios/editar/'.$r->idUsuarios.'" class="btn btn-info tip-top" title="Editar Usuário"><i class="icon-pencil icon-white"></i></a>
                  </td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
</div>
	
<?php echo $this->pagination->create_links();}?>
