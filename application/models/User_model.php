<?

class User_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function getByEmail($email)
  {
    $this->db->where('email', $email);
    $this->db->select('usuarios.*, permissoes.nome as permissao');
    $this->db->where('usuarios.situacao', 1);
    $this->db->join('permissoes', 'permissoes.idPermissao = usuarios.permissoes_id', 'left');
    $this->db->limit(1);
    return $this->db->get('usuarios')->row();
  }

  public function changePassword($password, $email)
  {
    $this->db->set('senha', $this->encryption->encrypt($password));
    $this->db->where('email', $email);
    return $this->db->update('usuarios');
  }

}