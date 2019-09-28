<?php 

defined('BASEPATH') or exit();

class User extends CI_Controller{

    public function __construct(){

        parent::__construct();

        if(!isLoggedIn()){
            redirect('404');
        }

        $this->load->model('User_model');
    }

    public function index(){

        $meta['title'] = 'Product Details';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        $this->form_validation->set_rules('first_name', 'first name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'last name', 'required|trim');
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|trim');

        if(!$this->form_validation->run()){
            $this->load->view('templates/front-end/header', $meta);
            $this->load->view('templates/front-end/navbar', $req);
            $this->load->view('user/index', $req);
            $this->load->view('templates/front-end/footer');
        } else{
            $_POST['id'] = $req['user']['id'];
            $this->User_model->editUser($this->input->post());
            $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
            Profile Edited !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('user');
        }

    }

    public function uploadimg(){
        if(!$_FILES['img'] || !$this->session->userdata('user')){
            redirect('404');
        } else{

            $uploadData = $this->User_model->updateImg();

            if($uploadData['stats']){
                
                // Update image in db

                $user = $this->User_model->getUserById($this->session->userdata('user')['id']);

                $this->User_model->updateImageName($user['id'], $uploadData['data']['file_name']);

                if($user['image'] != 'default.png'){
                    unlink('./assets/img/profile/' . $user['image']);
                }
                
                $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
                Profile Photo Updated !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('user');
            } else{
                $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
                ' . $uploadData['data'] .'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('user');
            }
        }
    }
}