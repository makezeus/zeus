<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Minhaconta extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        $this->load->model('minhaconta_model', '', TRUE);
        $this->load->helper(array('form', 'codegen_helper'));

    }


    public function index()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }

        $this->data['usuario'] = $this->minhaconta_model->getById($this->session->userdata('id'));
        $this->data['view'] = 'zeus/minhaConta';
        $this->load->view('tema/topo', $this->data);

    }


    public function changePassword()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }

        $this->load->library('encryption');
        $this->encryption->initialize(array('driver' => 'mcrypt'));

        $oldPassword = $this->input->post('oldPassword');
        $senha = $this->input->post('newPassword');
        $result = $this->zeus_model->changePassword($senha, $oldPassword, $this->session->userdata('id'));
        if ($result) {
            $this->session->set_flashdata('success', 'Senha Alterada com sucesso!');
            redirect(base_url() . 'zeus/minhaConta');
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar a senha!');
            redirect(base_url() . 'zeus/minhaConta');

        }
    }

    public function editarUsuario()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'nome', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required|trim');





        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('error', 'Campos obrigatórios não foram preenchidos.');
            redirect(base_url() . 'minhaconta');

        } else {

            $nome = $this->input->post('nome');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            $id = $this->input->post('id');


            $retorno = $this->minhaconta_model->editUsuarios($id, $nome, $telefone, $email);
            if ($retorno) {

                $this->session->set_flashdata('success', 'As informações foram alteradas com sucesso.');
                redirect(base_url() . 'zeus/minhaConta');
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar as informações.');
                redirect(base_url() . 'zeus/minhaConta');
            }

        }
    }

    function do_upload()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('zeus/login');
        }


        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/perfil';

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


    public function editarLogo()
    {
        try {
            if ((!session_id()) || (!$this->session->userdata('logado'))) {
                redirect('zeus/login');
            }

            $id = $this->input->post('id');
            if ($id == null || !is_numeric($id)) {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar a logomarca.');
                redirect(base_url() . 'minhaconta');
            }
            $this->load->helper('file');

            $image = $this->do_upload();

            $logo = base_url() . 'assets/perfil/' . $image;
            $retorno = $this->minhaconta_model->editLogo($id, $logo);
            $this->session->set_userdata('perfil', $logo);
            if ($retorno) {

                $this->session->set_flashdata('success', 'As informações foram alteradas com sucesso.');
                redirect(base_url() . 'minhaconta');
            } else {
                echo "oie";
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar as informações.');
                redirect(base_url() . 'minhaconta');
            }
        } catch (\Throwable $th) {
            throw $th;
        }


    }


    public function upload_image()
    {

        $image_upload_folder = FCPATH . 'assets/perfil';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $config['upload_path'] = $image_upload_folder;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';


        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $telefone = removeMask($this->input->post('telefone'));

        $result = $this->minhaconta_model->editUsuarios($this->session->userdata('id'), $nome, $telefone, $email);

        if ($result) {
            if ($nome)
                $this->session->set_userdata('nome', $nome);
            if ($email)
                $this->session->set_userdata('email', $email);
            if ($telefone)
                $this->session->set_userdata('telefone', $telefone);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            $logo = base_url() . 'assets/perfil/' . $file_name;
            $this->minhaconta_model->editLogo($this->session->userdata('id'), $logo);
            $this->session->set_userdata('perfil', $logo);

            echo json_encode(['success' => true, 'image_url' => $logo]);
        }
    }

}