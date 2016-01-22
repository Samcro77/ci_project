<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe extends CI_Controller{

    public function index()
    {

        $this->load->model('sub_model');
        $subs = $this->sub_model->getSubscribers();


        $data['subs'] = $subs;
        $this->load->view('subscribe/index', $data);




    }

    public function add()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() == false){
            $this->load->view('subscribe/error');

        }else{
            $email = $this->input->post('email');

            $data = [
                'email' => $email];
            $this->load->model('sub_model');

            $this->sub_model->setSubscriber($data);
            $this->sub_model->saveSubs();
              redirect('subscribe/index');


        }


//        $email = $this->input->post('email', true);
//
//        $userData = [
//            'email' => $email];
//        $this->load->model('sub_model');
//
//        $this->sub_model->setSubscriber($userData);
//        $data =$this->sub_model->saveSubs();


//      redirect('subscribe/index');

    }

}