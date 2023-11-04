<?

class Auth extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('email');
    $this->load->driver('cache');
    $this->load->model('user_model', '', TRUE);
    $this->load->model('ZeusModel', '', TRUE);
    $this->load->helper(array('form', 'codegen_helper'));
    $this->load->library('encryption');
  }

  public function login()
  {
    if ($this->session->userdata('logado')) {
      redirect('zeus');
    }
    $data['formTitle'] = '<h4>Faça seu login</h4>';
    $data['formSubtitle'] = '';
    $data['content'] = 'organisms/login';
    $this->load_view('pages/auth', $data);
  }

  public function resetPassword()
  {
    if ($this->session->userdata('logado')) {
      redirect('zeus');
    }
    try {
      $email = $this->input->post('email', TRUE);
      $OTP = $this->generateOTP(6);
      $user = $this->user_model->getByEmail($email);

      if (!$user) {
        throw new ErrorException('Erro ao enviar email.');
      }

      $this->cache->file->save($OTP, $email, 3600);

      $this->email->from('victorazesc@gmail.com', 'Zeus');
      $this->email->to($email);
      $this->email->subject('Assunto do E-mail');
      $this->email->message('Seu codigo de recuperação de senha é:' . $OTP);

      $this->email->send();
      $response = ['status' => 'success', 'message' => "Email enviado", 'email' => $email];
      echo json_encode($response);
    } catch (\Throwable $th) {
      $response = ['status' => 'error', 'message' => $th->getMessage()];
      echo json_encode($response);
    }
  }

  public function forgotPassword()
  {
    if ($this->session->userdata('logado')) {
      redirect('zeus');
    }

    $data['formTitle'] = '<h4>Esqueceu sua senha?</h4>';
    $data['formSubtitle'] = '<p>Confirme seu e-mail de cadastro. Será enviado um código de 6 dígitos para a validação</p>';
    $data['content'] = 'organisms/forgotPassword';
    $this->load_view('pages/auth', $data);
  }

  public function otpVerify()
  {
    if ($this->session->userdata('logado')) {
      redirect('zeus');
    }
    $data['formTitle'] = '<h4>Verificação</h4>';
    $data['formSubtitle'] = '<p>Digite o código de 6 dígitos que você recebeu em seu e-mail.</p>';
    $data['content'] = 'organisms/otpVerify';
    $this->load_view('pages/auth', $data);
  }
  public function changePassword()
  {
    $otp = $this->input->get('otp');
    $cachedData = $this->cache->file->get($otp);
    if (!$cachedData || $this->session->userdata('logado')) {
      redirect('zeus');
    }

    if ($this->input->is_ajax_request()) {
      $password = $this->input->post('newPassword');
      $results = $this->user_model->changePassword($password, $cachedData);
      $user = $this->user_model->getByEmail($cachedData);
      $company = $this->ZeusModel->getEmitente();
      if ($results) {
        $session_data = array(
          'nome' => $user->nome,
          'email' => $user->email,
          'telefone' => $user->telefone,
          'id' => $user->idUsuarios,
          'permissao' => $user->permissoes_id,
          'permission_label' => $user->permissao,
          'logado' => TRUE,
          'perfil' => $user->perfil,
          'company' => $company,
        );

        $this->session->set_userdata($session_data);
        $json = array('result' => true);
        $this->cache->file->delete($otp);
        echo json_encode($json);
      } else {
        echo json_encode(array('result' => false, 'mesage' => 'Algo não saiu bem, tente novamente'));
      }
    } else {
      $data['formTitle'] = '<h4>Digite uma nova senha</h4>';
      $data['formSubtitle'] = '<p>Defina a nova senha para sua conta para que você possa fazer login e acessar todos os recursos.</p>';
      $data['content'] = 'organisms/changePassword';
      $this->load_view('pages/auth', $data);
    }
  }

  public function otp()
  {
    if ($this->session->userdata('logado')) {
      redirect('zeus');
    }
    try {
      $otp = $this->input->post('otp');

      $cachedData = $this->cache->file->get($otp);
      if ($cachedData) {
        $response = ['status' => 'success', 'email' => $cachedData, 'otp' => $otp];
        echo json_encode($response);
      } else {
        throw new Exception("O código informado é inválido!", 1);
      }
    } catch (\Throwable $th) {
      http_response_code(500);
      $response = ['status' => 'error', 'message' => $th->getMessage()];
      echo json_encode($response);
    }
  }

  private function generateOTP($length)
  {
    $characters = '0123456789';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
      $code .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $code;
  }

  public function verificarLogin()
  {
    $this->load->library('form_validation');
    $this->load->model('ZeusModel');

    $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
    $this->form_validation->set_rules('senha', 'Senha', 'required|trim');

    if ($this->form_validation->run() == false) {
      $json = array('result' => false, 'message' => validation_errors());
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('senha');
      $user = $this->ZeusModel->check_credentials($email);
      $this->load->library('encryption');
      $this->encryption->initialize(array('driver' => 'mcrypt'));
      if ($user) {
        $password_stored = $this->encryption->decrypt($user->senha);

        if ($password === $password_stored) {
          $session_data = array(
            'nome' => $user->nome,
            'email' => $user->email,
            'telefone' => $user->telefone,
            'id' => $user->idUsuarios,
            'permissao' => $user->permissoes_id,
            'permission_label' => $user->permissao,
            'logado' => TRUE,
            'perfil' => $user->perfil,
            'company' => $this->ZeusModel->getEmitente(),
          );

          $this->session->set_userdata($session_data);
          $json = array('result' => true);
        } else {
          $json = array('result' => false, 'message' => 'Credenciais inválidas.');
        }
      } else {
        $json = array('result' => false, 'message' => 'Credenciais inválidas.');
      }

    }
    echo json_encode($json);
  }

}