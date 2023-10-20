<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<style>
    
@media (max-width: 480px){
.modal {
    top: 10%;
    right: 0px;
    left: 0px;
}


.modal.fade.in {
    bottom: 0px;
    top:auto;
}


.modal.fade {
    top: -10000px;
}
}

.opcao li{
    line-height: 45px;
}

</style>
<div class="visible-phone">
<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aArquivo')){ ?>
            <a href="<?php echo base_url()?>arquivos/adicionar" class="span13"><svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_1_" x1="256" x2="256" y1="512" y2="-9.094947e-013"><stop offset="0" style="stop-color:#76B852"/><stop offset="1" style="stop-color:#8DC26F"/></linearGradient><circle cx="256" cy="256" fill="#4CAF50" r="256"/><path d="M381.7,244.2H267.8V130.3c0-6.5-5.3-11.8-11.8-11.8c-6.5,0-11.8,5.3-11.8,11.8v113.9H130.3  c-6.5,0-11.8,5.3-11.8,11.8s5.3,11.8,11.8,11.8h113.9v113.9c0,6.5,5.3,11.8,11.8,11.8c6.5,0,11.8-5.3,11.8-11.8V267.8h113.9  c6.5,0,11.8-5.3,11.8-11.8S388.2,244.2,381.7,244.2z" fill="#FFFFFF"/></svg></a>  
        <?php } ?>
</div>
<div class="span12 visible-desktop" style="margin-left: 0" >
    <form method="get" action="<?php echo current_url(); ?>">
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aArquivo')){ ?>
             <div class="span3">
                <a href="<?php echo base_url();?>arquivos/adicionar" class="btn btn-success span12"><i class="icon-plus icon-white"></i> Adicionar Arquivo</a>
            </div>  
        <?php } ?>
        
        <div class="span5">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Digite o nome do documento para pesquisar" class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
        </div>
        <div class="span3">
            <input type="text" name="data"  id="data"  placeholder="Data de" class="span6 datepicker" value="<?php echo $this->input->get('data'); ?>">
            <input type="text" name="data2"  id="data2"  placeholder="Data até" class="span6 datepicker" value="<?php echo $this->input->get('data2'); ?>" >                
        </div>
        <div class="span1">
            <button class="span12 btn"> <i class="fas fa-search"></i> </button>
        </div>
    </form>
</div>

<?php
if(!$results){?>

<div class="span12 visible-desktop" style="margin-left: 0">
        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
            </span>
            <h5>Arquivos</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Data</th>
                        <th>Tamanho</th>
                        <th>Extensão</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Arquivo Encontrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php }else{ ?>

<div class="span12" style="margin-left: 0">
  

    <div class="widget-content nopadding">
 <div id="headermobile">Serviços</div>
 <div class="visible-phone" style="margin-top: 70px"></div>

<?php 

$arquivos = $this->db->query("SELECT * FROM documentos ");

$tarquivos = $arquivos->num_rows();


 ?>





 <ul style="list-style:none; margin: 0px; font-size:15px; padding: 15px">



<li><p><?php echo $tarquivos; ?> arquivos</p></li>
<br>

            <?php foreach ($results as $r) {




//<!-- Modal -->
echo '<div class="modal fade" id="'.$r->idDocumentos.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">';

      echo '<ul class="opcao" style="list-style:none; margin: 0px; font-size:15px;">';

      echo '<li>';
echo "<div>";

$tipo = $r->tipo;

if ($tipo === ".docx") {
     echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/word.png); background-size: cover; background-position: fixed;"></div>';
} elseif($tipo === ".pdf"){

echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/pdf.png); background-size: cover; background-position: fixed;"></div>';

}elseif($tipo === ".xlsx"){

echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/excel.png); background-size: cover; background-position: fixed;"></div>';

}

elseif($tipo === ".ppt"){

echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/pp.png); background-size: cover; background-position: fixed;"></div>';

}


 else {
    echo '<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.$r->url.'); background-size: cover; background-position: fixed;"></div>';
}


                echo'<div style=" padding: 0px 75px;">';
                echo'
                <h5>'.$r->documento.$r->tipo.'<br>
                <small>'.$r->tamanho.' KB</small></h5>
                ';
                echo'</div>';

                echo'</div>';

      echo '</li>';
      echo '<hr>';

      if($this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){
                        echo '<li><a href="'.base_url().'arquivos/download/'.$r->idDocumentos.'"><i class="fas fa-download"></i>&nbsp;&nbsp; Download</a>'; 
                    }

  
if($this->permission->checkPermission($this->session->userdata('permissao'),'eArquivo')){ 
                        echo  '<li><a href="'.base_url().'arquivos/editar/'.$r->idDocumentos.'"><i class="fas fa-edit"></i>&nbsp;&nbsp;Editar Arquivo</a></li>';
                    }

      if($this->permission->checkPermission($this->session->userdata('permissao'),'dArquivo')){
                echo '<li><a href="#modal-excluir" role="button" data-toggle="modal" arquivo="'.$r->idDocumentos.'"><i class="fas fa-trash"></i>&nbsp;&nbsp; Excluir arquivo</a></li>  '; 
            }
echo'
</ul>
';
          
            
          

      echo' </div>

    </div>
  </div>
</div>';




 



      echo '<li>';
echo "<div>";
      
if ($tipo === ".docx") {
     echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/word.png); background-size: cover; background-position: fixed;"></div>';
} elseif($tipo === ".pdf"){

echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/pdf.png); background-size: cover; background-position: fixed;"></div>';

}elseif($tipo === ".xlsx"){

echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/excel.png); background-size: cover; background-position: fixed;"></div>';

}

elseif($tipo === ".ppt"){

echo'<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.base_url().'/assets/img/pp.png); background-size: cover; background-position: fixed;"></div>';

}


 else {
    echo '<div style="float:left; padding: 10px; width: 35px; height: 35px; background: url('.$r->url.'); background-size: cover; background-position: fixed;"></div>';
}
       


                echo'<div style=" padding: 0px 0px 0px 75px;">';
                //<!-- Button trigger modal -->
echo '<a href="#" class="pull-right" data-toggle="modal" data-target="#'.$r->idDocumentos.'" style="
    padding-top: 15px;
">
  <i class="fas fa-ellipsis-v"></i>
</a>';
                echo'
                <h5>'.$r->documento.$r->tipo.'<br>
                <small>'.$r->tamanho.' KB</small></h5>
                ';
                echo'</div>';

            echo'</div>';

      echo '</li>';
      echo '<hr>';



                   

            }?>
</ul>
    </div>





<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>arquivos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Arquivo</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idDocumento" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este arquivo?</h5>
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
        
        var arquivo = $(this).attr('arquivo');
        $('#idDocumento').val(arquivo);

   });

   $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});

</script>


