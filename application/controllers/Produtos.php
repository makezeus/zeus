<?php

class Produtos extends CI_Controller
{



    function __construct()
    {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('produtos_model', '', TRUE);
        $this->data['menuProdutos'] = 'Produtos';
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

        $this->data['pageName'] = 'Produtos';
        $this->data['termo'] = $this->input->post('termo');

        $this->setupPagination();
        $this->setupTableColumns();
        $this->setupTableData();
        $this->generateTable();

        if ($this->input->is_ajax_request()) {
            echo $this->data['table'];
        } else {

            $this->data['view'] = 'produtos/produtos';
            $this->load->view('tema/topo', $this->data);

        }

    }


    private function setupPagination()
    {
        $config['base_url'] = base_url() . '/pordutos/gerenciar/';
        $config['total_rows'] = $this->produtos_model->count('produtos', $this->data['termo']);
        $this->pagination->initialize($config);
    }

    private function setupTableData()
    {
        $this->data['results'] = $this->produtos_model->get('produtos', 'idProdutos,descricao,precoCompra,precoVenda, lucro', $this->data['termo'], 10, $this->uri->segment(3));

        foreach ($this->data['results'] as $row) {
            $row->products_information = '<div style="display: flex; flex-direction:column; align-items: flex-start;">
            <span class="cutText">
                <a href="' . base_url() . 'produtos/visualizar/' . $row->idProdutos . '">
                ' . ucwords($row->descricao) . '
                </a>
            </span>
            <span style="font-size: 0.75rem; color: ' . ($row->lucro > 0 ? "green" : "red") . '">
                Lucro: ' . formatMoney($row->lucro) . '
            </span>
        </div>';

            $row->actions = '<a href="' . base_url() . 'produtos/editar/' . $row->idProdutos . '" style="margin-right: 1%" class="btn tip-top" title="Editar">Editar</a>';
            $row->costPrice = formatMoney($row->precoCompra);
            $row->salePrice = formatMoney($row->precoVenda);
            $row->profit = formatMoney($row->lucro);
        }
    }

    private function setupTableColumns()
    {

        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT'])) {
            $this->data['hiddenHeader'] = true;
            $this->data['columns'] = [
                'Produto' => 'products_information',
                'Preço de Custo' => 'costPrice'
            ];
        } else {
            $this->data['hiddenHeader'] = false;
            $this->data['columns'] = [
                'Produto' => 'products_information',
                'Preço de Custo' => 'costPrice',
                'Preço de Venda' => 'salePrice',
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

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",", "", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);
            $lucro = $this->input->post('lucro');
            $lucro = str_replace(",", "", $lucro);
            $data = array(
                'descricao' => set_value('descricao'),
                'unidade' => set_value('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'lucro' => $lucro,
                'estoque' => set_value('estoque'),
                'estoqueMinimo' => set_value('estoqueMinimo'),
                'saida' => set_value('saida'),
                'entrada' => set_value('entrada'),
            );

            if ($this->produtos_model->add('produtos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
                redirect(base_url() . 'produtos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'produtos/adicionarProduto';
        $this->load->view('tema/topo', $this->data);

    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('zeus');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",", "", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);
            $data = array(
                'descricao' => $this->input->post('descricao'),
                'unidade' => $this->input->post('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => $this->input->post('estoque'),
                'estoqueMinimo' => $this->input->post('estoqueMinimo'),
                'saida' => set_value('saida'),
                'entrada' => set_value('entrada'),
            );

            if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $this->input->post('idProdutos')) == TRUE) {
                $this->session->set_flashdata('success', 'Produto editado com sucesso!');
                redirect(base_url() . 'produtos/editar/' . $this->input->post('idProdutos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'produtos/editarProduto';
        $this->load->view('tema/topo', $this->data);

    }


    function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('zeus');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto não encontrado.');
            redirect(base_url() . 'produtos/editar/' . $this->input->post('idProdutos'));
        }

        $this->data['view'] = 'produtos/visualizarProduto';
        $this->load->view('tema/topo', $this->data);

    }

    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
            redirect(base_url());
        }


        $id = $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
            redirect(base_url() . 'produtos/gerenciar/');
        }

        $this->db->where('produtos_id', $id);
        $this->db->delete('produtos_os');


        $this->db->where('produtos_id', $id);
        $this->db->delete('itens_de_vendas');

        $this->produtos_model->delete('produtos', 'idProdutos', $id);


        $this->session->set_flashdata('success', 'Produto excluido com sucesso!');
        redirect(base_url() . 'produtos/gerenciar/');
    }
}

