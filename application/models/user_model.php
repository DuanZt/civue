<?php
class User_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
  }

  public function get($id)
  {
    $this->db->where("id", $id);
    $this->db->where("active", 1);
    $query = $this->db->get("user");
    return $query->row_array();
  }

  public function add($data)
  {
    if ($this->db->insert('user', $data)) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }

  public function check($email, $pwd)
  {
    $this->db->where("email", $email);
    $this->db->where("active", 1);
    $row = $this->db->get("user")->row_array();
    if ($row) {
      $result = password_verify($pwd, $row['pwd']);
    } else {
      $result = false;
    }
    return $result ? $row['id'] : false;
  }

}