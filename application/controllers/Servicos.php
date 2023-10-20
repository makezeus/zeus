<?php

class Servicos extends CI_Controller
{




    function __construct()
    {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('servicos_model', '', TRUE);
        $this->data['menuServicos'] = 'Serviços';
    }

    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar serviços.');
            redirect(base_url());
        }

        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->library('table_generator');

        $this->data['pageName'] = 'Serviços';
        $this->data['termo'] = $this->input->post('termo');

        $this->setupPagination();
        $this->setupTableColumns();
        $this->setupTableData();
        $this->generateTable();

        if ($this->input->is_ajax_request()) {
            echo $this->data['table'];
        } else {

            $this->data['view'] = 'servicos/servicos';
            $this->load->view('tema/topo', $this->data);

        }

    }

    private function setupPagination()
    {
        $config['base_url'] = base_url() . '/servicos/gerenciar/';
        $config['total_rows'] = $this->servicos_model->count('servicos', $this->data['termo']);
        $this->pagination->initialize($config);
    }

    private function setupTableData()
    {
        $this->data['results'] = $this->servicos_model->get('servicos', 'idServicos,nome,descricao,preco', $this->data['termo'], 10, $this->uri->segment(3));

        foreach ($this->data['results'] as $row) {
            $row->service_information = '<div style="display: flex; flex-direction:column; align-items: flex-start;">
                                                <span class="cutText">
                                                <a href="' . base_url() . 'servicos/visualizar/' . $row->idServicos . '">
                                                ' . ucwords($row->nome) . '</span>
                                                </a>
                                                <span style="font-size: 0.75rem; color: #6B7280">' . $row->descricao . '</span>
                                            </div>';
            $row->actions = '<a href="' . base_url() . 'servicos/editar/' . $row->idServicos . '" style="margin-right: 1%" class="btn tip-top" title="Editar">Editar</a>';
            $row->preco = formatMoney($row->preco);
        }
    }

    private function setupTableColumns()
    {

        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT'])) {
            $this->data['hiddenHeader'] = true;
            $this->data['columns'] = [
                'Serviço' => 'service_information',
                'Preço' => 'preco'
            ];
        } else {
            $this->data['hiddenHeader'] = false;
            $this->data['columns'] = [
                'Serviço' => 'service_information',
                'Preço' => 'preco',
                '' => 'actions',
            ];
        }

    }

    private function generateTable()
    {
        $this->data['table'] = $this->table_generator->generate($this->data['columns'], $this->data['results'], $this->data['hiddenHeader']);
    }


    function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar serviços.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('servicos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",", "", $preco);

            $data = array(
                'nome' => set_value('nome'),
                'descricao' => set_value('descricao'),
                'preco' => $preco
            );

            if ($this->servicos_model->add('servicos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Serviço adicionado com sucesso!');
                redirect(base_url() . 'servicos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'servicos/adicionarServico';
        $this->load->view('tema/topo', $this->data);

    }

    function editar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar serviços.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('servicos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",", "", $preco);
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'preco' => $preco
            );

            if ($this->servicos_model->edit('servicos', $data, 'idServicos', $this->input->post('idServicos')) == TRUE) {
                $this->session->set_flashdata('success', 'Serviço editado com sucesso!');
                redirect(base_url() . 'servicos/editar/' . $this->input->post('idServicos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->servicos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'servicos/editarServico';
        $this->load->view('tema/topo', $this->data);

    }

    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir serviços.');
            redirect(base_url());
        }


        $id = $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir serviço.');
            redirect(base_url() . 'servicos/gerenciar/');
        }

        $this->db->where('servicos_id', $id);
        $this->db->delete('servicos_os');

        $this->servicos_model->delete('servicos', 'idServicos', $id);


        $this->session->set_flashdata('success', 'Serviço excluido com sucesso!');
        redirect(base_url() . 'servicos/gerenciar/');
    }
}

