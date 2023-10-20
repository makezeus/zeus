<?php

class Clientes extends CI_Controller
{



    function __construct()
    {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }
        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('clientes_model', '', TRUE);
        $this->data['menuClientes'] = 'clientes';
    }

    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->library('table_generator');

        $this->data['pageName'] = 'Clientes';
        $this->data['termo'] = $this->input->post('termo');

        $this->setupPagination();
        $this->setupTableColumns();
        $this->setupTableData();
        $this->generateTable();

        if ($this->input->is_ajax_request()) {
            echo $this->data['table'];
        } else {
            $this->loadView('clientes/clientes');
        }
    }

    private function setupPagination()
    {
        $config['base_url'] = base_url() . '/clientes/gerenciar/';
        $config['total_rows'] = $this->clientes_model->count('clientes', $this->data['termo']);
        $this->pagination->initialize($config);
    }

    private function setupTableColumns()
    {

        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT'])) {
            $this->data['hiddenHeader'] = true;
            $this->data['columns'] = [
                'Cliente' => 'customer_information',
                'Contato' => 'contact'
            ];
        } else {
            $this->data['hiddenHeader'] = false;
            $this->data['columns'] = [
                'Cliente' => 'customer_information',
                'Telefone' => 'telefoneCliente',
                'Email' => 'emailCliente',
                '' => 'actions',
            ];
        }

    }

    private function setupTableData()
    {
        $this->data['results'] = $this->clientes_model->get('clientes', 'idClientes,nomeCliente,documento,telefoneCliente,celular,emailCliente,rua,numero,bairro,cidade,estado,cep', $this->data['termo'], 10, $this->uri->segment(3));

        foreach ($this->data['results'] as $row) {
            $row->customer_information = '<div style="display: flex; flex-direction:column; align-items: flex-start;">
                                                <span class="cutText">
                                                <a href="' . base_url() . 'clientes/visualizar/' . $row->idClientes . '">
                                                ' . ucwords($row->nomeCliente) . '</span>
                                                </a>
                                                <span style="font-size: 0.75rem; color: #6B7280">' . formatarDocumento($row->documento) . '</span>
                                            </div>';
            $row->actions = '<a href="' . base_url() . 'clientes/visualizar/' . $row->idClientes . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes">Visualizar</a>';
            $row->telefoneCliente = formatPhone($row->telefoneCliente);
            $row->contact = '<div style="display: flex; flex-direction:column; align-items: flex-end;">
            <span>' . formatPhone($row->telefoneCliente) . '</span>
            <span style="font-size: 0.75rem; color: #6B7280">' . $row->emailCliente . '</span>
        </div>';


        }
    }

    private function generateTable()
    {
        $this->data['table'] = $this->table_generator->generate($this->data['columns'], $this->data['results'], $this->data['hiddenHeader']);
    }

    private function loadView($view)
    {
        $this->data['view'] = $view;
        $this->load->view('tema/topo', $this->data);
    }

    function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $this->data['pageName'] = 'Adicionar cliente';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeCliente' => set_value('nomeCliente'),
                'documento' => set_value('documento'),
                'telefoneCliente' => set_value('telefone'),
                'celular' => $this->input->post('celular'),
                'emailCliente' => set_value('email'),
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->clientes_model->add('clientes', $data) == TRUE) {
                $this->session->set_flashdata(
                    'alert',
                    array(
                        'title' => 'Seu Cliente foi adicionado!!',
                        'message' => 'Agora você pode gerar ordens de serviço.'
                    )
                );
                redirect(base_url() . 'clientes');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'clientes/adicionarCliente';
        $this->load->view('tema/topo', $this->data);
    }


    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('zeus');
        }


        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeCliente' => $this->input->post('nomeCliente'),
                'documento' => $this->input->post('documento'),
                'telefoneCliente' => $this->input->post('telefone'),
                'celular' => $this->input->post('celular'),
                'emailcliente' => $this->input->post('email'),
                'rua' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'bairro' => $this->input->post('bairro'),
                'cidade' => $this->input->post('cidade'),
                'estado' => $this->input->post('estado'),
                'cep' => $this->input->post('cep')
            );

            if ($this->clientes_model->edit('clientes', $data, 'idClientes', $this->input->post('idClientes')) == TRUE) {
                $this->session->set_flashdata('success', 'Cliente editado com sucesso!');
                redirect(base_url() . 'clientes/editar/' . $this->input->post('idClientes'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['view'] = 'clientes/editarCliente';
        $this->data['pageName'] = 'Editar Cliente';
        $this->load->view('tema/topo', $this->data);
    }

    public function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('zeus');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['view'] = 'clientes/visualizar';
        $this->data['pageName'] = 'Ver Cliente';
        $this->load->view('tema/topo', $this->data);
    }

    public function excluir()
    {


        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir clientes.');
            redirect(base_url());
        }


        $id = $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir cliente.');
            redirect(base_url() . 'clientes/gerenciar/');
        }

        //$id = 2;
        // excluindo OSs vinculadas ao cliente
        $this->db->where('clientes_id', $id);
        $os = $this->db->get('os')->result();

        if ($os != null) {

            foreach ($os as $o) {
                $this->db->where('os_id', $o->idOs);
                $this->db->delete('servicos_os');

                $this->db->where('os_id', $o->idOs);
                $this->db->delete('produtos_os');


                $this->db->where('idOs', $o->idOs);
                $this->db->delete('os');
            }
        }

        // excluindo Vendas vinculadas ao cliente
        $this->db->where('clientes_id', $id);
        $vendas = $this->db->get('vendas')->result();

        if ($vendas != null) {

            foreach ($vendas as $v) {
                $this->db->where('vendas_id', $v->idVendas);
                $this->db->delete('itens_de_vendas');


                $this->db->where('idVendas', $v->idVendas);
                $this->db->delete('vendas');
            }
        }

        //excluindo receitas vinculadas ao cliente
        $this->db->where('clientes_id', $id);
        $this->db->delete('lancamentos');



        $this->clientes_model->delete('clientes', 'idClientes', $id);

        $this->session->set_flashdata('success', 'Cliente excluido com sucesso!');
        redirect(base_url() . 'clientes/gerenciar/');
    }
}