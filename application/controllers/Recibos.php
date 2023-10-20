<?php

class Recibos extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('zeus/login');
        }
		
		$this->load->helper(array('form','codegen_helper'));
		$this->load->model('recibos_model','',TRUE);
		$this->data['menuRecibos'] = 'Recibos';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        $this->load->library('pagination');
        
        $where_array = array();

        $pesquisa = $this->input->get('pesquisa');

        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa){
           $where_array['pesquisa'] = $pesquisa;
        }
        if($de){

            $de = explode('/', $de);
            $de = $de[2].'-'.$de[1].'-'.$de[0];

            $where_array['de'] = $de;
        }
        if($ate){
            $ate = explode('/', $ate);
            $ate = $ate[2].'-'.$ate[1].'-'.$ate[0];

            $where_array['ate'] = $ate;
        }
        
        $config['base_url'] = base_url().'recibos/gerenciar/';
        $config['total_rows'] = $this->recibos_model->count('recibos');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
            
        $this->pagination->initialize($config);     

        $this->data['results'] = $this->recibos_model->getRecibo('recibos','idRecibo,dataRecibo,referente,valorRecibo,clientes_id,dataext',$where_array,$config['per_page'],$this->uri->segment(3));
       
        $this->data['view'] = 'recibos/recibos';
        $this->load->view('tema/topo',$this->data);
      


     }
	
    function adicionar(){


        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('recibos') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
            $dataext = $this->input->post('dataRecibo');
            $dataexte = strftime("%d de %B de %Y", strtotime($dataext));
             $valorRecibos = $this->input->post('valorRecibo');
             $valorRecibo = str_replace(",",".",$valorRecibos);

                $data = array(
                'dataRecibo' => $this->input->post('dataRecibo'),
                'dataext' => $dataexte,
                'clientes_id' => $this->input->post('clientes_id'),
                'valorRecibo' => $valorRecibo,
                'referente' =>  $this->input->post('referente')
            );
 if ($this->recibos_model->add('recibos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Recibo adicionado com sucesso!');
                redirect(base_url() . 'recibos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
         
        $this->data['view'] = 'recibos/adicionarRecibos';
        $this->load->view('tema/topo', $this->data);
    }
    
 function editar(){


        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('recibos') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
  $dataext = $this->input->post('dataRecibo');
            $dataexte = strftime("%d de %B de %Y", strtotime($dataext));

                $data = array(
                'dataRecibo' => $this->input->post('dataRecibo'),
                'dataext' => $dataexte,
                'clientes_id' => $this->input->post('clientes_id'),
                'valorRecibo' => $this->input->post('valorRecibo'),
                'referente' =>  $this->input->post('referente')
            );
if ($this->recibos_model->edit('recibos', $data, 'idRecibo', $this->input->post('idRecibo')) == TRUE) {
                $this->session->set_flashdata('success', 'Recibo editado com sucesso!');
                redirect(base_url() . 'recibos/editar/'.$this->input->post('idRecibo'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }
        $this->data['result'] = $this->recibos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'recibos/editarRecibos';
        $this->load->view('tema/topo', $this->data);
    }
    


       public function imprimir(){

        $this->data['custom_error'] = '';
        $this->load->model('ZeusModel');
        $this->data['result'] = $this->recibos_model->getById($this->uri->segment(3));
        $this->data['emitente'] = $this->ZeusModel->getEmitente();
        
        $this->load->view('recibos/imprimirRecibo', $this->data);
    }


    function excluir(){

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir recibo.');            
            redirect(base_url().'recibos/gerenciar/');
        }

       $this->db->where('idRecibo', $id);
        $this->db->delete('recibos');

        $this->recibos_model->delete('recibos','idRecibo',$id);    
        $this->session->set_flashdata('success','Recibo excluída com sucesso!');            
        redirect(base_url().'recibos/gerenciar/');

    }

    public function autoCompleteCliente(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->recibos_model->autoCompleteCliente($q);
        }

    }

}

