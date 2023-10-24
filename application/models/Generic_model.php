<?
class Generic_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  function get(
    $table,
    $fields,
    $searchField,
    $search,
    $perpage = 0,
    $start = 0,
    $orderBy
  ) {

    $this->db->select($fields);
    $this->db->from($table);
    $this->db->order_by($orderBy, 'desc');
    if ($search) {
      $this->db->like($searchField, $search);
    }
    $this->db->limit($perpage, $start);

    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }


  function count($table, $where, $searchField)
  {
    $this->db->select('COUNT(*) as count');
    $this->db->from($table);
    
    if ($searchField && $where) {
      $this->db->like($searchField, $where);
    }

    $query = $this->db->get();
    $row = $query->row();

    $count = ($row) ? $row->count : 0;
    return $count;
  }
}
