<?php 

defined('BASEPATH') or exit();

class Owner extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!isAdmin()){
            redirect('404');
        }
        $this->load->model('User_model');
    }

    public function index(){

        $meta['title'] = 'Account Details';
        $data['owner'] = $this->User_model->getOwnerById($this->session->userdata('admin')['id']);

        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('username', 'username', 'required|trim');

        if(!$this->form_validation->run()){

            $this->load->view('templates/back-end/header', $meta);
            $this->load->view('templates/back-end/sidebar');
            $this->load->view('templates/back-end/topbar');
            $this->load->view('owner/index', $data);
            $this->load->view('templates/back-end/footer');

        } else{

            if($_FILES['img']['error'] != 4){

                $uploadFile = $this->uploadImage();

                if($uploadFile['stats']){

                    $oldImg = $this->session->userdata('admin')['image'];
                    $newImage = $uploadFile['data']['file_name'];

                    $data = $this->input->post();
                    $data['image'] = $newImage;
                    

                    if($oldImg != 'default.png'){
                        unlink('./assets/img/profile/' . $oldImg);
                    }

                    $this->User_model->updateOwner($data, true);

                    $_SESSION['admin']['image'] = $newImage;

                } else{

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    '. $uploadFile['data'] .'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

                    redirect('Owner');

                }

            } else{

                $this->User_model->updateOwner($this->input->post(), false);

            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Owner Account Updated !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            redirect('Owner');

        }
    }

    public function ownerUpdatePassword(){

        if($this->input->post()){
            
            // Replace the error messages

            $this->form_validation->set_message('matches', '{field} not match !');

            $this->form_validation->set_rules('curr-pass', 'current password', 'required');
            $this->form_validation->set_rules('password-1', 'new password', 'required|min_length[5]');
            $this->form_validation->set_rules('password-2', 'confirm password', 'required|matches[password-1]');

            if(!$this->form_validation->run()){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . validation_errors() .'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Owner');
            } else{

                $owner = $this->User_model->getOwnerById($this->input->post('owner-id'));

                if(password_verify($this->input->post('curr-pass'), $owner['password'])){

                    $this->User_model->updateOwnerPassword($this->input->post('owner-id'), $this->input->post('password-1'));

                    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Password updated !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');

                    redirect('Owner');

                } else{

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Current password is wrong
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

                    redirect('Owner');

                }
            }
        } else{
            redirect('404');
        }
    }

    public function uploadImage(){
        
        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpeg|png|jpg|bmp';
        $config['max_size'] = 1024;
        $config['file_ext_tolower'] = true;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('img')){
            return ['stats' => true, 'data' => $this->upload->data()];
        } else{
            return ['stats' => false, 'data' => $this->upload->display_errors()];
        }
    }
}