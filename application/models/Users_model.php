<?php
class Users_model extends CI_Model{

    public function getUsers($limit = 0, $offset = 0)
    {
      $this->db->limit($limit, $offset);
      $query =  $this->db->get('users');

        return $query->result_array();
    }

    public function getUser($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function saveUser($data)
    {
        $this->db->insert('users', $data);
    }

    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function deleteUser($id)
    {
        $this->db->delete('users' ,['id' => $id]);
    }


}