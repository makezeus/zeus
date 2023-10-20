<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recibos_model extends CI_Model {



	function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields.', clientes.nomeCliente, clientes.idClientes');
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        $this->db->order_by('idRecibo','desc');
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
	    $this->db->select('recibos.*, clientes.*');
        $this->db->from('recibos');
        $this->db->join('clientes','clientes.idClientes = recibos.clientes_id');
        $this->db->where('recibos.idRecibo',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    
    function getRecibo($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){

        $lista_clientes = array();
        if($where){

            if(array_key_exists('pesquisa',$where)){
                $this->db->select('idClientes');
                $this->db->like('nomeCliente',$where['pesquisa']);
                $this->db->limit(5);
                $clientes = $this->db->get('clientes')->result();

                foreach ($clientes as $c) {
                    array_push($lista_clientes,$c->idClientes);
                }

            }
        }

        $this->db->select($fields.',clientes.nomeCliente');
        $this->db->from($table);
        $this->db->join('clientes','clientes.idClientes = recibos.clientes_id');

        // condicionais da pesquisa

        // condicional de clientes
        if(array_key_exists('pesquisa',$where)){
            if($lista_clientes != null){
                $this->db->where_in('recibos.clientes_id',$lista_clientes);
            }
        }

        // condicional data inicial
        if(array_key_exists('de',$where)){
            $this->db->where('dataRecibo >=' ,$where['de']);
        }
              
        $this->db->limit($perpage,$start);


        $this->db->order_by('recibos.idRecibo','desc');
        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function add($table,$data,$returnId = false){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
                        if($returnId == true){
                            return $this->db->insert_id($table);
                        }
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }   

    function count($table){
	return $this->db->count_all($table);
    }

    public function autoCompleteCliente($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nomeCliente', $q);
        $query = $this->db->get('clientes');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nomeCliente'].' | Telefone: '.$row['telefoneCliente'],'id'=>$row['idClientes']);
            }
            echo json_encode($row_set);
        }
    }




}

/* End of file recibos_model.php */
/* Location: ./application/models/recibos_model.php */