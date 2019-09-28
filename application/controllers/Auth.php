<?php 

defined('BASEPATH') or exit();

class Auth extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index(){

        if(isLoggedIn()){
            redirect();
        }

        $meta['title'] = 'Login';

        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'password', 'required');

        if(!$this->form_validation->run()){
            $this->load->view('templates/front-end/header', $meta);
            $this->load->view('auth/index');
            $this->load->view('templates/front-end/footer');
        } else{

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $data = $this->User_model->getUserByEmail($email);

            if($data){
                if(password_verify($password, $data['password'])){
                    $data = [
                        'id' => $data['id'],
                        'email' => $data['email'],
                        'role_id' => $data['role_id']
                    ];
                    $this->session->set_userdata(['user' => $data]);
                    redirect('home');
                    die;
                } else{
                    $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-danger alert-dismissible fade show" role="alert">
                        Wrong Password !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('auth');
                }
            } else{
                $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-danger alert-dismissible fade show" role="alert">
            Wrong E-Mail
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth');  
            }
        }

    }

    public function register(){

        if(isLoggedIn()){
            redirect();
        }

        $meta['title'] = 'Register';

        $this->form_validation->set_rules('first_name', 'first name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'last name', 'required|trim');
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|is_unique[user_table.email]');
        $this->form_validation->set_rules('password1', 'password', 'required|min_length[5]|matches[password2]');
        $this->form_validation->set_rules('password2', 'password confirmation', 'required|matches[password1]');

        if(!$this->form_validation->run()){
            $this->load->view('templates/front-end/header', $meta);
            $this->load->view('auth/register');
            $this->load->view('templates/front-end/footer');
        } else{
            $this->User_model->addUser($this->input->post());
            $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> Check your email for activation !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('auth');
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
            Logged out !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth');  
    }
}