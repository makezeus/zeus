<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zeus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ZeusModel', '', TRUE);
        $this->load->helper(array('form', 'codegen_helper'));
    }

    public function index()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        $this->data['billedProducts'] = $this->ZeusModel->getBilledProducts();
        $this->data['orderOfService'] = $this->ZeusModel->getOs();
        $this->data['os'] = $this->ZeusModel->getOsEstatisticas();
        $this->data['financialStatistics'] = $this->ZeusModel->getEstatisticasFinanceiro();
        $this->data['pageName'] = 'Dashboard';
        $this->data['view'] = 'zeus/dashboard';
        $this->data['saluteMessage'] = $this->getSaluteMessage();
        $this->data['dashItems'] = [
            [
                'title' => 'Receita do mês',
                'value' => 'R$ ' . number_format($this->data['financialStatistics']->total_receita - $this->data['financialStatistics']->total_despesa, 2, ',', '.'),
                'shortcut' => '',
                'icon' => '<i class="ri-line-chart-line"></i>',
                'color' => '#9333EA'
            ],
            [
                'title' => 'clientes',
                'value' => $this->ZeusModel->count('clientes'),
                'shortcut' => 'F1',
                'icon' => '<i class="ri-team-line"></i>',
                'color' => 'black'
            ],
            [
                'title' => 'Produtos',
                'value' => $this->ZeusModel->count('produtos'),
                'shortcut' => 'F2',
                'icon' => '<i class="ri-shopping-cart-line"></i>',
                'color' => 'black'
            ],
            [
                'title' => 'Serviços',
                'value' => $this->ZeusModel->count('servicos'),
                'shortcut' => 'F3',
                'icon' => '<i class="ri-customer-service-line"></i>',
                'color' => 'black'
            ],
            [
                'title' => 'Ordens de Serviço',
                'value' => $this->ZeusModel->count('os'),
                'shortcut' => 'F4',
                'icon' => '<i class="ri-file-line"></i>',
                'color' => 'black'
            ],
        ];

        if (getMobileRequest()) {
            array_shift($this->data['dashItems']);
        }
        ;

        $this->load->view('tema/topo', $this->data);
    }

    function getSaluteMessage()
    {
        $hr = date("H");
        $resp = ($hr >= 12 && $hr < 18) ? "Boa tarde!" : (($hr >= 0 && $hr < 12) ? "Bom dia!" : "Boa noite!");
        $primeiroNome = explode(" ", $this->session->userdata('nome'));
        return $resp . '&nbsp' . $primeiroNome[0];
    }

    public function minhaConta()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        $this->data['usuario'] = $this->ZeusModel->getById($this->session->userdata('id'));
        $this->data['view'] = 'zeus/minhaConta';
        $this->load->view('tema/topo', $this->data);
    }

    public function changePassword()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        $this->load->library('encryption');
        $this->encryption->initialize(array('driver' => 'mcrypt'));

        $oldPassword = $this->input->post('oldPassword');
        $senha = $this->input->post('newPassword');
        $result = $this->ZeusModel->changePassword($senha, $oldPassword, $this->session->userdata('id'));
        if ($result) {
            $this->session->set_flashdata('success', 'Senha Alterada com sucesso!');
            redirect(base_url() . 'zeus/minhaConta');
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar a senha!');
            redirect(base_url() . 'zeus/minhaConta');
        }
    }

    public function pesquisar()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        $termo = $this->input->get('termo');

        $data['results'] = $this->ZeusModel->pesquisar($termo);
        $this->data['produtos'] = $data['results']['produtos'];
        $this->data['servicos'] = $data['results']['servicos'];
        $this->data['os'] = $data['results']['os'];
        $this->data['clientes'] = $data['results']['clientes'];
        $this->data['view'] = 'zeus/pesquisa';
        $this->load->view('tema/topo', $this->data);
    }


    public function sair()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function backup()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cBackup')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para efetuar backup.');
            redirect(base_url());
        }



        $this->load->dbutil();
        $prefs = array(
            'format' => 'zip',
            'foreign_key_checks' => false,
            'filename' => 'backup' . date('d-m-Y') . '.sql'
        );

        $backup = $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file(base_url() . 'backup/backup.zip', $backup);

        $this->load->helper('download');
        force_download('backup' . date('d-m-Y H:m:s') . '.zip', $backup);
    }

    public function emitente()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar emitente.');
            redirect(base_url());
        }

        $data['menuConfiguracoes'] = 'Configuracoes';
        $data['dados'] = $this->ZeusModel->getEmitente();
        $data['view'] = 'zeus/emitente';
        $this->load->view('tema/topo', $data);
        $this->load->view('tema/rodape');
    }

    function do_upload()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar emitente.');
            redirect(base_url());
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path' => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size' => 2048,
            'remove_space' => TRUE,
            'encrypt_name' => TRUE,
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


    public function cadastrarEmitente()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar emitente.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Razão Social', 'required|trim');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'required|trim');
        $this->form_validation->set_rules('ie', 'IE', 'required|trim');
        $this->form_validation->set_rules('logradouro', 'Logradouro', 'required|trim');
        $this->form_validation->set_rules('numero', 'Número', 'required|trim');
        $this->form_validation->set_rules('bairro', 'Bairro', 'required|trim');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim');
        $this->form_validation->set_rules('uf', 'UF', 'required|trim');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required|trim');
        $this->form_validation->set_rules('email', 'E-mail', 'required|trim');




        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('error', 'Campos obrigatórios não foram preenchidos.');
            redirect(base_url() . 'zeus/emitente');
        } else {

            $nome = $this->input->post('nome');
            $cnpj = $this->input->post('cnpj');
            $ie = $this->input->post('ie');
            $logradouro = $this->input->post('logradouro');
            $numero = $this->input->post('numero');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('uf');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            $image = $this->do_upload();
            $logo = base_url() . 'assets/uploads/' . $image;


            $retorno = $this->ZeusModel->addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf, $telefone, $email, $logo);
            if ($retorno) {

                $this->session->set_flashdata('success', 'As informações foram inseridas com sucesso.');
                redirect(base_url() . 'zeus/emitente');
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar inserir as informações.');
                redirect(base_url() . 'zeus/emitente');
            }
        }
    }


    public function editCompany()
    {
        try {
            if ((!session_id()) || (!$this->session->userdata('logado'))) {
                redirect('auth/login');
            }

            if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) {
                $this->session->set_flashdata('error', 'Você não tem permissão para configurar emitente.');
                redirect(base_url());
            }

            $image_upload_folder = FCPATH . 'assets/company/logo';

            if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
            }

            $config['upload_path'] = $image_upload_folder;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';

            $this->load->library('form_validation');
            $this->form_validation->set_rules('nome', 'Razão Social', 'required|trim');
            $this->form_validation->set_rules('cnpj', 'CNPJ', 'required|trim');
            $this->form_validation->set_rules('ie', 'IE', 'required|trim');
            $this->form_validation->set_rules('logradouro', 'Logradouro', 'required|trim');
            $this->form_validation->set_rules('numero', 'Número', 'required|trim');
            $this->form_validation->set_rules('bairro', 'Bairro', 'required|trim');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim');
            $this->form_validation->set_rules('uf', 'UF', 'required|trim');
            $this->form_validation->set_rules('telefone', 'Telefone', 'required|trim');
            $this->form_validation->set_rules('email', 'E-mail', 'required|trim');

            if ($this->form_validation->run() == false) {
                throw new Exception('Campos obrigatórios não foram preenchidos.');
            }

            $nome = $this->input->post('nome');
            $cnpj = $this->input->post('cnpj');
            $ie = $this->input->post('ie');
            $logradouro = $this->input->post('logradouro');
            $numero = $this->input->post('numero');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('uf');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            $id = $this->session->userdata('company')[0]->id;

            $userdataCompany = $this->session->userdata('company');

            $fieldsToUpdate = ['nome', 'cnpj', 'ie', 'logradouro', 'numero', 'bairro', 'cidade', 'uf', 'telefone', 'email'];

            $retorno = $this->ZeusModel->updateCompany($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf, $telefone, $email);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload()) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $logo = base_url() . 'assets/company/logo/' . $file_name;
                $this->ZeusModel->editLogo($id, $logo);
                $userdataCompany[0]->url_logo = $logo;
                $response = ['success' => true, 'image_url' => $logo];
            }

            foreach ($fieldsToUpdate as $field) {
                $value = $this->input->post($field);
                if ($value !== null) {
                    $userdataCompany[0]->$field = $value;
                }
            }

            $this->session->set_userdata('company', $userdataCompany);
            $response = ['success' => true, 'result' => $retorno];

            echo json_encode($response);
        } catch (\Throwable $th) {
            http_response_code(500);
            $response = ['status' => 'error', 'message' => $th->getMessage()];
            echo json_encode($response);
        }
    }



    public function editarLogo()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar emitente.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar a logomarca.');
            redirect(base_url() . 'zeus/emitente');
        }
        $this->load->helper('file');
        delete_files(FCPATH . 'assets/uploads/');

        $image = $this->do_upload();
        $logo = base_url() . 'assets/uploads/' . $image;

        $retorno = $this->ZeusModel->editLogo($id, $logo);
        if ($retorno) {

            $this->session->set_flashdata('success', 'As informações foram alteradas com sucesso.');
            redirect(base_url() . 'zeus/emitente');
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar as informações.');
            redirect(base_url() . 'zeus/emitente');
        }
    }


    public function configuration()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('auth/login');
        }

        if (getMobileRequest()) {
            $data['view'] = 'zeus/configuration/mobile';
            $data['hiddenMobileMenu'] = true;
        } else {
            $data['view'] = 'zeus/configuration/desktop';
        }
        $data['changeProfile'] = 'components/profile';
        $data['changePassword'] = 'components/changePassword';
        $data['company'] = 'components/company';
        $this->load->view('tema/topo', $data);
    }
}
