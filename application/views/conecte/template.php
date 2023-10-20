
<!DOCTYPE html>
<html lang="pt-br" style="overflow: hidden;">
<head>
<title>Zeus</title>
<meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap3.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css"
  integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw"
  crossorigin="anonymous">
  <!-- or -->
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
  integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw"
  crossorigin="anonymous">


<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" /> 


<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
<style xmlns="http://www.w3.org/2000/svg" type="text/css">


.sistema .panel{
  padding: 10px;
}

.sistema strong {
    float: right;
    font-size: 25px;
    font-weight: lighter;
}

.sistema i {
  padding: 5px;
}

.color-success{
  color: #398439;
}
.color-important{
  color: #ac2925;
}
  .st0{fill:#000;}


body {
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 14px;
}

  #boxl{    display: block;
    background: #00000061;
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 9;
}

@media (min-width: 992px){
.col-md-8 {
   width: 61%;
}}



#top{
    background: black;
    color: white;
    font-size: 20px;
    padding: 15px;
    height: auto;
    text-align: left;
    margin-top: 10px;
}
#menumobile {
    position: fixed;
    top: 5px;
    left: 15px;
    z-index: 9;
}
#menumobile a {
    color: #222;
    font-size: 25px;
}
#mySidenav>#header {
    width: 100px;
    border-radius: 100%;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
  .widget-box{padding: 10px;}




}
@media screen and (max-width: 450px) {
  .widget-box{padding: 10px;}
  .sistema{

padding-left: 0px;

}
.sistema .col-md-3 {
    width: 50% !important;
    float: left;
    /* border-radius: 0px; */
    padding: 0px;
    /* margin: 2px; */
    /* width: 23%; */
}
.dash{
  text-align: center;
}
.sistema .os{
  letter-spacing: -1px;
}

.sistema i{
   font-size: 25px;
}

}
.span13 {
    position: fixed;
    bottom: 20px;
    z-index: 991;
    color: #fff;
    right: 20px;
    padding-top: 19px;
    font-size: 30px;
    text-align: center;
    width: 40px !important;
}

#headermobile {
    position: fixed;
    top: 0px;
    z-index:8;
    width: 100%;
    background: #fff;
    color: #222;
    padding-top: 10px;
    height: 50px;
    font-size: 20px;
    padding-left: 80px;
        box-shadow: 0px 0px 5px #999;
}

#header-sroll {
    position:fixed;
    height: 100px;
    background:#ccc;
    left:0;
    top:0;
    float:left;
    width:100%;
    -ms-transition:     all 0.3s ease-out;
    -moz-transition:    all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    -o-transition:      all 0.3s ease-out;
    transition:         all 0.3s ease-out;
}
#header-sroll h1 {
    font-size: 30px;
    font-family: Arial;
    text-align: center;
    line-height: 50px;
     -ms-transition:    all 0.3s ease-out;
    -moz-transition:    all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    -o-transition:      all 0.3s ease-out;
    transition:         all 0.3s ease-out;
}

button.bottom-search {
    background: transparent;
    border: 0;
}

.input-group-addon.search {
    background: transparent;
    border: none;
    color: #111;
}


input.pesquisa:focus{
    box-shadow: none !important;
}

.pesquisar{
    float: right;
padding: 10px;
}

.funcoes button{
    background: transparent;
border:none;
color: #111;}

#header {
    margin-top: -10px;
}

#content-header {
    position: abslute;
    width: 100%;
    margin-top: 0px
    z-index: 20;
}

  #header{
    height: 65px;
  }
  #header div{
    width: 90px
  }


.navbar:after{
  clear: none;
}
.form-control[disabled], fieldset[disabled] .form-control {
    cursor: not-allowed;
}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #eee;
    opacity: 1;
}

.titulo {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    padding: 10px 0 25px;
}

</style>
</head>
 

<?php 

$id = $this->session->userdata('idClientes'); 

$query = $this->db->get_where('clientes', array('idClientes' => $id));

foreach($query->result_array() as $row){

    $nomecliente = $row['nomeCliente'];

}

?>


<div id="boxl" style="display:none"></div>

<body class="body">

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow visible-desktop" style="
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    z-index: 17;
        background: #f9f9f9;">
      <a class="navbar-brand mr-0" href="#" style="width: 220px; background: #f9f9f9;">
        
<div id="header">
<div>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Camada_1" x="0px" y="0px" viewBox="0 0 183.5 148" style="enable-background:new 0 0 183.5 148;" xml:space="preserve">
<style type="text/css">
  .st0{fill:#000;}
</style>
<g>
  <path class="st0" d="M93.7,83.6l89.8-42.1L82.5,79L52.8,22L0,127L93.7,83.6L93.7,83.6z M36,93.5l16-38.4L66.3,82L36,93.5z"/>
  <polygon class="st0" points="79.1,115.4 101,115.2 101,115.2 94.8,103.7 78.8,111.8  "/>
</g>
</svg>
</div>
</div>
      </a>
<div class="funcoes" style="
    background: #fff;
">
   <a href="<?php echo base_url()?>mine/sair" style="
    float: right;
    margin: 17px 50px;
"><i class="fas fa-door-open"></i> <span>Sair</span></a>
    
</div>


    </nav>
<div id="menumobile" class="visible-phone">
<a href="javascript:void(0)"" class="pull-left tip-bottom animated rubberBand"  onclick="openNav()"><i class="fas fa-bars"></i></a>
</div>



<!--mobile-!-->


    <div id="sidebar" style="overflow-y: auto;" data-spy="affix" data-offset-top="10">
<div class="boxl"></div>
      <ul>
        <li class="<?php if(isset($menuPainel)){echo 'active';};?>"><a href="<?php echo base_url()?>mine/painel"><i class="fas fa-home"></i> <span>Painel</span></a></li>
        <li class="<?php if(isset($menuConta)){echo 'active';};?>"><a href="<?php echo base_url()?>mine/conta"><i class="fas fa-star"></i> <span>Minha Conta</span></a></li>
        <li class="<?php if(isset($menuOs)){echo 'active';};?>"><a href="<?php echo base_url()?>mine/os"><i class="fas fa-tags"></i> <span>Ordens de Serviço</span></a></li>
        <li class="<?php if(isset($menuVendas)){echo 'active';};?>"><a href="<?php echo base_url()?>mine/compras"><i class="fas fa-shopping-cart"></i> <span>Compras</span></a></li>
       
        
      </ul>
    </div>


   
    <div id="content" style="margin-top: 55px;">
      <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url(); ?>mine/painel" title="Painel" class="tip-bottom"><i class="icon-home"></i> Painel</a></div>
      </div>
 
      <div class="container-fluid">
        <div class="row-fluid">
          
          <div class="span12">
            <?php if($this->session->flashdata('error') != null){?>
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('error');?>
              </div>
            <?php }?>

            <?php if($this->session->flashdata('success') != null){?>
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php }?>

              <?php if(isset($output)){ $this->load->view($output);} ?>            
            
          </div>
        </div>
      
      </div>
    </div>
   <!--Footer-part-->
<div class="row-fluid"> 

 <div id="footer" class="span12"> <a href="#" target="_blank"><?php echo date('Y'); ?> &copy; Zeus - Victor Azevedo </a></div></div>
<!--end-Footer-part-->


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js">

</script>


<script>
var $j = jQuery.noConflict();
function openNav() {
    document.getElementById("sidebar").style.display = "block";
    document.getElementById("boxl").style.display = "block";
}


$j(document).ready(function(){
    $j(".enxuta").toggle(

        function(){

        $j("#sidebar > ul").css({"width": "43px"});
        $j("#header > div").css({"width": "43px"});
        $j("#header > div").css({"padding": "17px 0px 0px 10px"});
        $j("#header > div").css({"position": "static"});
        $j("#sidebar ul li a span").css({"display": "none"}); 
        $j("#sidebar").css({"width": "43px"});
        $j(".navbar-brand").css({"width": "43px"});
        document.getElementById("flecha").classList.add("fa-angle-right");
        $j("#content").css({"margin-left": "43px"});},

        function(){

        $j("#sidebar > ul").css({"width": "220px"});
        $j("#header > div").css({"width": "90px"});
        $j(".navbar-brand").css({"width": "220px"});
        $j("#header > div").css({"padding": "15px"});
        $j("#header > div").css({"position": "relative"});
        $j("#sidebar ul li a span").css({"display": "inline-block"}); 
        $j("#sidebar").css({"width": "220px"}); 
        document.getElementById("flecha").classList.remove("fa-angle-right");
        $j("#content").css({"margin-left": "220px"});},

        );
});


$(document).mouseup(function(e) 
{
    var scre = $("body").width();
    var container = $("#sidebar");



    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        if (scre <= 500) {

    document.getElementById("sidebar").style.display = "none";
document.getElementById("boxl").style.display = "none";
 $("#sidebar").addClass("blc");

    
}
        
    }
});

</script>

 


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 
<script>

var j = jQuery.noConflict();


j(document).ready(function(){
    j(".btny").click(function(){
        j(this).button("loading").delay(2000).queue(function(){
            j(this).button("reset");
            j(this).dequeue();
        }); 
    });   
});
</script>

<script>
  $(".alert").delay(4000).fadeOut(200, function() {
    $(this).alert('close');
 });
</script>

</body>
</html>