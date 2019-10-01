<?php 

defined('BASEPATH') or exit();

class Auth extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('cookie');
    }

    public function index(){

        if(isLoggedIn()){
            redirect();
        }

        // Check cookie is valid or not
        if(get_cookie('app_version') && get_cookie('browser_info')){
            $data = $this->User_model->getUserById(get_cookie('app_version'));
            if($data){
                if(sha1($data['email']) === get_cookie('browser_info')){
                    // Give session after cookie verify complete
                    $data = [
                        'id' => $data['id'],
                        'email' => $data['email'],
                        'role_id' => $data['role_id']
                    ];
                    $this->session->set_userdata(['user' => $data]);
                    redirect('home');
                    die;
                }
            }
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
            $remember = $this->input->post('remember');

            $data = $this->User_model->getUserByEmail($email);

            if($data){

                if(password_verify($password, $data['password'])){

                    // Give session after verify complete
                    $data = [
                        'id' => $data['id'],
                        'email' => $data['email'],
                        'role_id' => $data['role_id']
                    ];
                    $this->session->set_userdata(['user' => $data]);

                    // Give cookie if user checked remember me
                    if($remember){

                        // Give fake name to prevent user from hijacking
                        $this->authSetCookie('app_version', $data['id']);
                        $this->authSetCookie('browser_info', sha1($data['email']));
                    }
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

    private function authSetCookie($name, $value, $expiredDate = (((60 * 60) * 24) * 30)){
        set_cookie($name, $value, $expiredDate);
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

        $this->session->unset_userdata('user');
        $this->session->unset_userdata('shipAddress');
        $this->cart->destroy();

        delete_cookie('app_version');
        delete_cookie('browser_info');
        
        $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
            Logged out !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth');  
    }
}