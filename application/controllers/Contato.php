<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Formulário de contato do website
 *
 * @author William Rufino
 * @version 1.0
 * @category model
 * @access public
 */

class Contato extends Ci_Controller {

    /*
     * Construtor da classe
     * @author William Rufino
     * @version 1.0
     */
    public function __construct() {
         parent::__construct();
    }
    
    /*
     * Método Index, página inicial do formulário de contato
     *
     * @author William Rufino
     * @version 1.0
     * @access public
     */
    public function index() {
     
        $data['action'] = site_url('contato/enviaEmail');
        $this->template->load('template','contato', $data);
        
    }

    /*
     * Método enviaEmail, onde será realmente enviado nosso formulário.
     *
     * @author William Rufino
     * @version 1.0
     * @access public
     */
    public function enviaEmail() {
        $this->load->library('email');

        $email = $this->input->post('email', TRUE);
        $nome = $this->input->post('nome', TRUE);
        $telefone = $this->input->post('telefone', TRUE);
        $cidade = $this->input->post('cidade', TRUE);
        $estado = $this->input->post('estado', TRUE);
        $mensagem = $this->input->post('mensagem', TRUE);
        $assunto = $this->input->post('assunto', TRUE);

        $this->email->from($email, $nome);
        $this->email->to('azevedoseg@hotmail.com');

        $this->email->subject($assunto);
        $this->email->message('


         
   
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META content="MSHTML 6.00.2900.3020" name=GENERATOR>
<STYLE></STYLE>
</HEAD>
<BODY bgColor=#ffffff>

<DIV style="text-align:center"> 

<a href="http://www.imasters.com.br" title="Este link abre o site do iMasters em uma janela de seu navegador">
<img src="http://us.f13.yahoofs.com/bc/45b0d469_114f2/bc/convite.gif?bfflPsFBmgNmhbLi" alt="Visite o iMasters!">
</a>

</DIV>
  Nome:       ' . $nome . ' <br />
            E-mail:     ' . $email . ' <br />
            Telefone:   ' . $telefone . ' <br />
            Cidade:     ' . $cidade . ' <br />
            Estado:     ' . $estado . ' <br />
            Assunto:    ' . $assunto . ' <br />
            Mensagem:   ' . $mensagem . ' <br />
</BODY></HTML>
          
           ');

        $em = $this->email->send();
        if ($em) {
            $data['email_enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
        } else {
            $data['email_enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para azevedoseg@hotmail.com';
        }
         $data['action'] = site_url('contato/enviaEmail');
        $this->load->view('contato',$data);
    }

}
/* End of file contato.php */
/* Location: ./system/application/controllers/contato.php */
