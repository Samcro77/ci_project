<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    const PER_PAGE = 3;

   public function index()
   {
       $this->load->model('users_model');
       $users =$this->users_model->getUsers();

       $this->load->library('pagination');

       $config['base_url'] = site_url('users/index/page');
       $config['total_rows'] = count($users);
       $config['per_page'] = self::PER_PAGE;

       $this->pagination->initialize($config);

       $pageId = (int)$this->uri->segment(4);
       $users =$this->users_model->getUsers(self::PER_PAGE, $pageId);

       $data['users'] = $users;

       $this->load->view('users/index', $data);
   }

    public function get_users()
    {
        $this->load->model('users_model');
        $users = $this->users_model->getUsers();

        $data['users'] = $users;

        $this->load->view('users/users', $data);
    }

    public function get_user()
    {
        $this->load->model('users_model');
        $users = $this->users_model->getUser(2);

        $data['users'] = $users;

        $this->load->view('users/user', $data);
    }

    public function delete()
    {
        $id = (int)$this->uri->segment(3);

        if(empty($id)){
            throw new Exception('User id is absent');
        }

        $this->load->model('users_model');
        $this->users_model->deleteUser($id);

        redirect('users');
    }

    public function edit()
    {
        $firstname = $this->input->post('first_name', true);
        $lastname = $this->input->post('last_name', true);
        $email = $this->input->post('email', true);
        $id = (int)$this->uri->segment(3);

        if(empty($id)){
            throw new Exception('User id is absent');
        }

        $this->load->model('users_model');

        if(empty($firstname) || empty($lastname) || empty($email)){
            $data['user'] = $this->users_model->getUser($id);

            $this->load->view('users/edit_user', $data);
        }else{
            $userData = [
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'created_at' => (new DateTime())->format('Y-m-d H:i:s')
            ];

            $this->users_model->updateUser($id, $userData);

            redirect('users');
        }


    }

    public function add()
    {
        $firstname = $this->input->post('first_name', true);
        $lastname = $this->input->post('last_name', true);
        $email = $this->input->post('email', true);

        if(empty($firstname) || empty($lastname) || empty($email)){
            $this->load->view('users/new_user');
        }else{
            $userData = [
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'created_at' => (new DateTime())->format('Y-m-d H:i:s')
            ];
            $this->load->model('users_model');
            $this->users_model->saveUser($userData);

            redirect('users');
        }
    }
}