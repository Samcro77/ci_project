<?php

class Gallery_model extends CI_Model
{

    public function getGalleries()
    {
        $this->db
            ->select('id, file_name , file_ext')
            ->from('gallery');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getGallery($id)
    {
        $this->db
            ->select('user_id, file_name , file_ext')
            ->where('user_id',$id)
            ->from('gallery');
        $query = $this->db->get();

        return $query->result_array();

    }

    public function saveGallery($data)
    {
        $this->db->insert('gallery', $data);
    }


    public function deleteGallery($filename)
    {
        $this->db->delete('gallery', ['file_name' => $filename,]);
    }


}