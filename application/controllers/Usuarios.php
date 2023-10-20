<?php

class Usuarios extends CI_Controller
{




    function __construct()
    {

        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cUsuario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar os usuários.');
            redirect(base_url());
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('usuarios_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Usuários';
        $this->data['menuConfiguracoes'] = 'Configurações';
    }

    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {

        $this->load->library('pagination');


        $config['base_url'] = base_url() . 'usuarios/gerenciar/';
        $config['total_rows'] = $this->usuarios_model->count('usuarios');
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

        $this->data['results'] = $this->usuarios_model->get($config['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'usuarios/usuarios';
        $this->load->view('tema/topo', $this->data);
    }


    function do_upload()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size'      => 2048,
            'remove_space'  => TRUE,
            'encrypt_name'  => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }
    }

    function adicionar()
    {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('usuarios') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : false);
        } else {

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));
            $image = $this->do_upload();
            $logo = base_url() . 'assets/uploads/' . $image;
            $data = array(
                'nome' => set_value('nome'),
                'rg' => set_value('rg'),
                'cpf' => set_value('cpf'),
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'email' => set_value('email'),
                'senha' => $this->encryption->encrypt($this->input->post('senha')),
                'telefone' => set_value('telefone'),
                'celular' => set_value('celular'),
                'situacao' => set_value('situacao'),
                'permissoes_id' => $this->input->post('permissoes_id'),
                'dataCadastro' => date('Y-m-d'),
                'perfil' =>  $logo

            );

            if ($this->usuarios_model->add('usuarios', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Usuário cadastrado com sucesso!');
                redirect(base_url() . 'usuarios/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes', 'permissoes.idPermissao,permissoes.nome');
        $this->data['view'] = 'usuarios/adicionarUsuario';
        $this->load->view('tema/topo', $this->data);
    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('zeus');
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('rg', 'RG', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
        $this->form_validation->set_rules('rua', 'Rua', 'trim|required');
        $this->form_validation->set_rules('numero', 'Número', 'trim|required');
        $this->form_validation->set_rules('bairro', 'Bairro', 'trim|required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|required');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
        $this->form_validation->set_rules('situacao', 'Situação', 'trim|required');
        $this->form_validation->set_rules('permissoes_id', 'Permissão', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            if ($this->input->post('idUsuarios') == 1 && $this->input->post('situacao') == 0) {
                $this->session->set_flashdata('error', 'O usuário super admin não pode ser desativado!');
                redirect(base_url() . 'usuarios/editar/' . $this->input->post('idUsuarios'));
            }

            $senha = $this->input->post('senha');
            if ($senha != null) {

                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt'));

                $senha = $this->encryption->encrypt($senha);

                $data = array(
                    'nome' => $this->input->post('nome'),
                    'rg' => $this->input->post('rg'),
                    'cpf' => $this->input->post('cpf'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'email' => $this->input->post('email'),
                    'senha' => $senha,
                    'telefone' => $this->input->post('telefone'),
                    'celular' => $this->input->post('celular'),
                    'situacao' => $this->input->post('situacao'),
                    'permissoes_id' => $this->input->post('permissoes_id')
                );
            } else {

                $data = array(
                    'nome' => $this->input->post('nome'),
                    'rg' => $this->input->post('rg'),
                    'cpf' => $this->input->post('cpf'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'email' => $this->input->post('email'),
                    'telefone' => $this->input->post('telefone'),
                    'celular' => $this->input->post('celular'),
                    'situacao' => $this->input->post('situacao'),
                    'permissoes_id' => $this->input->post('permissoes_id')
                );
            }


            if ($this->usuarios_model->edit('usuarios', $data, 'idUsuarios', $this->input->post('idUsuarios')) == TRUE) {
                $this->session->set_flashdata('success', 'Usuário editado com sucesso!');
                redirect(base_url() . 'usuarios/editar/' . $this->input->post('idUsuarios'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes', 'permissoes.idPermissao,permissoes.nome');

        $this->data['view'] = 'usuarios/editarUsuario';
        $this->load->view('tema/topo', $this->data);
    }

    public function excluir()
    {

        $ID =  $this->uri->segment(3);
        $this->usuarios_model->delete('usuarios', 'idUsuarios', $ID);
        redirect(base_url() . 'usuarios/gerenciar/');
    }
}
