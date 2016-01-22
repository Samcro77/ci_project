<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 16.01.2016
 * Time: 11:20
 */
class Gallery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('gallery_model');
        $this->load->model('users_model');
    }

//    protected function microtime_float()
//    {
//        list($usec ,$sec) = explode(" ",microtime());
//        return intval((float)$usec + (float)$sec);
//    }
    private function upload()
    {
        $data = array(
            'success' => null,
            'message' => ''
        );
        $config = array(
            'upload_path' => dirname(BASEPATH) . '/files/',
            'allowed_types' => 'jpeg|jpg|gif|bmp|png',
            'max_size' => 50000000,
            'encrypt_name' => true
        );
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755);
        }
        $this->load->library('upload', $config);

        $fieldname = array_keys($_FILES)[0];
        if (!$this->upload->do_upload($fieldname)) {
            $data['success'] = false;
            $data['message'] = $this->upload->display_errors();
        } else {
            $data['success'] = true;
            $data['message'] = 'Files is upload';
            $data['upload_data'] = $this->upload->data();
        }

        return $data;
    }

    private function resize($source_image)
    {
        $config['image_library'] = 'gd2'; // выбираем библиотеку
        $config['source_image'] = $source_image;
        $config['thumb_marker'] ='_thumb';
        $config['create_thumb'] = TRUE; // ставим флаг создания эскиза
        $config['maintain_ratio'] = TRUE; // сохранять пропорции
        $config['width'] = 75; // и задаем размеры
        $config['height'] = 50;

        $this->image_lib->initialize($config);
        $this->image_lib->resize(); // и вызываем функцию
    }

    private function watermark($source_image)
    {
        $config['source_image'] = $source_image;
        $config['wm_text'] = 'Copyright 2016';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size'] = '16';
        $config['wm_font_color'] = '000000';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'center';
//        $config['wm_padding'] = '20';

        $this->image_lib->initialize($config);

        $this->image_lib->watermark();
    }

    public function index()
    {
        $data['galleries'] = $this->gallery_model->getGalleries();
        $this->load->view('gallery/index', $data);
    }

    public function user()
    {

        $id = (int)$this->uri->segment(3);
        $user['user'] = $this->users_model->getUser($id);
        $data['galleries'] = $this->gallery_model->getGallery($id);
        $this->load->view('gallery/user', $data);
    }

    public function add()
    {
        $data = array();

        $id = (int)$this->uri->segment(3);
        $user['user'] = $this->users_model->getUser($id);
        if (!empty($_FILES)) {

            $data = $this->upload();

//            echo "<pre>";
//                var_dump( $id );
//            echo "</pre>";   exit;
            if ($data['success']) {
//                $newFileName = $this->microtime_float();
//                if(file_exists($data['full_path'])){
//                    rename($data['full_path'], "files/". $newFileName. $data['file_ext']);
//                    $data['upload_data']['raw_name'] = $newFileName;
//                }
                $this->load->library('image_lib'); // загружаем библиотеку
                if($this->input->post('watermark')) {
                    $this->watermark($data['upload_data']['full_path']);
                }
                if($this->input->post('resize')) {
                    $this->resize($data['upload_data']['full_path']);
                }
                $this->gallery_model->saveGallery(
                    array(
                        'file_name' => $data['upload_data']['raw_name'],
                        'file_ext' => $data['upload_data']['file_ext'],
                        'user_id' => $id
                    )

                );

//                redirect('gallery/index');
                redirect("gallery/user/$id");
            }
        }
        $this->load->view('gallery/add',$user, $data);
    }

    public function delete($filename)
    {
        $this->gallery_model->deleteGallery(preg_replace('/\.\w+$/', '', "$filename"));
       unlink(dirname(BASEPATH).'/files/' . $filename);
//        unlink(dirname(BASEPATH) . '/files/' . $filename . '_thumb');
        redirect('gallery/index');
    }
}

