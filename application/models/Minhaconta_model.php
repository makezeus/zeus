<?php
class Minhaconta_model extends CI_Model
{



    function __construct()
    {
        parent::__construct();
    }



    function getUser($perpage = 0, $start = 0, $one = false)
    {

        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissao');
        $this->db->limit($perpage, $start);
        $this->db->join('permissoes', 'usuarios.permissoes_id = permissoes.idPermissao', 'left');

        $query = $this->db->get();

        $result = !$one ? $query->result() : $query->row();
        return $result;
    }

    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        $result = !$one ? $query->result() : $query->row();
        return $result;
    }

    function getById($id)
    {
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissao');
        $this->db->join('permissoes', 'permissoes.idPermissao = usuarios.permissoes_id', 'left');
        $this->db->where('idUsuarios', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function changePassword($newSenha, $oldPassword, $id)
    {

        $this->db->where('idUsuarios', $id);
        $this->db->limit(1);
        $usuario = $this->db->get('usuarios')->row();

        $senha = $this->encryption->decrypt($usuario->senha);

        if ($senha != $oldPassword) {
            return false;
        } else {
            $this->db->set('senha', $this->encryption->encrypt($newSenha));
            $this->db->where('idUsuarios', $id);
            return $this->db->update('usuarios');
        }


    }

    public function editLogo($id, $logo)
    {

        $this->db->set('perfil', $logo);
        $this->db->where('idUsuarios', $id);
        return $this->db->update('usuarios');

    }


    public function editUsuarios($id, $nome, $telefone, $email)
    {
        if ($nome)
            $this->db->set('nome', $nome);
        if ($telefone)
            $this->db->set('telefone', $telefone);
        if ($email)
            $this->db->set('email', $email);
        $this->db->where('idUsuarios', $id);
        return $this->db->update('usuarios');
    }

    function count($table)
    {
        return $this->db->count_all($table);
    }

}