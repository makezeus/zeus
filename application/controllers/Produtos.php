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

        $this->load->library('pagination');
        $this->load->library('table_generator');
    }

    function index()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar esta pagina.');
            redirect(base_url());
        }

        $this->data['pageData'] = [
            'title' => 'Produtos',
            'searchPlaceholder' => 'Buscar produtos'
        ];
        $this->data['tableName'] = 'produtos';
        $this->data['pageUrl'] = 'produtos';
        $this->data['table'] = $this->generateTable();

        if ($this->input->is_ajax_request()) {
            echo $this->data['table'];
        } else {
            $this->loadView('produtos/produtos');
        }
    }

    private function generateTable()
    {

        $fields = [
            ["field" => 'descricao', "formatter" => 'ucwords'],
            ["field" => 'precoVenda', "formatter" => 'formatMoney'],
            ["field" => 'precoCompra', "formatter" => 'formatMoney'],
            ["field" => 'lucro', "formatter" => 'formatMoney'],
            ["field" => 'idProdutos', "formatter" => ''],
        ];

        $customFields = [];
        $columns = [];

        if (getMobileRequest()) {
            $customFields[] = [
                "field" => "price",
                "value" => '<div style="display: flex; flex-direction:column; align-items: flex-end;">
                            <span>$$precoVenda$$</span>
                            <span style="font-size: 0.75rem; color: #6B7280">$$precoCompra$$</span>
                        </div>',
            ];
            $columns = [
                'Produto' => 'porductsInformation',
                'Preço de Venda' => 'price'
            ];
        } else {
            $customFields[] = [
                "field" => "actions",
                "value" => '<a href="' . base_url() . 'produtos/visualizar/$$idProdutos$$" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes">Visualizar</a>',
            ];
            $columns = [
                'Produto' => 'porductsInformation',
                'Preço de Custo' => 'precoCompra',
                'Preço de Venda' => 'precoVenda',
                '' => 'actions',
            ];
        }

        $customFields[] = [
            "field" => "porductsInformation",
            "value" => '
            <div style="display: flex; flex-direction:column; align-items: flex-start;">
            <span class="cutText">
                <a href="' . base_url() . 'produtos/visualizar/$$idProdutos$$">
                $$descricao$$
                </a>
            </span>
            <span style="font-size: 0.75rem; color: green;">
                Lucro: $$lucro$$
            </span>
        </div>',
        ];

        return $this->table_generator->_generate(
            'produtos',
            $fields,
            'descricao',
            'idProdutos',
            $columns,
            $customFields
        );

    }

    private function loadView($view)
    {
        $this->data['view'] = $view;
        $this->load->view('tema/topo', $this->data);
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

            $costPrice = formatMoneyDB($this->input->post('precoCompra'));
            $salePrice = formatMoneyDB($this->input->post('precoVenda'));
            $profit = formatMoneyDB($this->input->post('lucro'));


            $data = array(
                'descricao' => set_value('descricao'),
                'unidade' => set_value('unidade'),
                'precoCompra' => $costPrice,
                'precoVenda' => $salePrice,
                'lucro' => $profit,
                'estoque' => 9999999,
                'estoqueMinimo' => 0,
                'saida' => 1,
                'entrada' => 1,
            );

            if ($this->produtos_model->add('produtos', $data) == true) {
                $this->session->set_flashdata(
                    'alert',
                    array(
                        'title' => 'Seu Produto foi cadastrado!!',
                        'message' => 'Agora você pode adiciona-lo as ordens de serviço.'
                    )
                );
                redirect(base_url() . 'produtos');
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

