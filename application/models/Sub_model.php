<?php
class Sub_model extends CI_Model{

    public function setId($id)
    {
        $this->db->set('subscriber_id',$id);
        $this->db->insert('subscription');
    }

    public function getId()
    {
        $this->db->select('subscriber_id');
        $query = $this->db->get('subscription');
        return $query->result_array();
    }

    public function setEmail($email)
    {
        $this->db->set('email',$email);
        $this->db->insert('subscriber');
    }

    public function getEmail()
    {
        $this->db->select('email');
        $query = $this->db->get('subscriber');
        return $query->result_array();
    }

    public function getSubscribers()
    {
        $this->db->select('*');
        $this->db->from('subscription');
        $this->db->join('subscriber', 'subscriber.id = subscriber_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSubscriber($id)
    {

        $query = $this->db->get_where('subscriber', array('id' => $id));
        return $query->row_array();
    }

    public function setSubscriber($data)
    {
        $this->db->insert('subscriber', $data);

    }


    public function saveSubs()
    {
        $data = $this->db->insert_id();
        $this->db->set('subscriber_id',$data);
        $this->db->insert('subscription');

    }
}