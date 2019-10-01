<?php 

defined('BASEPATH') or exit();

class Auth extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Token_model');
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

    public function forgot(){

        $this->form_validation->set_rules('email', 'e-mail', 'required|trim|valid_email');

        if($this->form_validation->run()){

            $email = $this->input->post('email', true);

            if($data = $this->User_model->getUserByEmail($email)){

                $token = uniqid('mhb-fg-');
                $emailContent = "Hello " . $data['first_name'] . ' , to reset your password, klik this <a target="blank" href=" ' . base_url('auth/reset/?token=' . urlencode($token) . '&uid='. $data['id'] . '&type=1') . '">link</a>';

                if($this->sendEmail($email, 'Reset your password', $emailContent)){

                    // Insert token to database
                    $this->Token_model->insertToken($data['id'], $token, 1);

                    $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
                        E-Mail has been sended, check your inbox / spam !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');

                    redirect('auth/forgot'); 

                } else{

                    $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
                        <strong>Failed ! </strong> Can\'t send verification email
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');

                    redirect('auth/forgot'); 

                }
            } else{
                $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-danger" role="alert">
                <strong>Failed !</strong> E-Mail is not registered
                </div>');
                redirect('auth/forgot');
            }

        } else{
            $meta['title'] = 'Forgot Password';
    
            $this->load->view('templates/front-end/header', $meta);
            $this->load->view('auth/forgot');
            $this->load->view('templates/front-end/footer');
        }
    }

    private function sendEmail($for, $subject, $content){

        $config = [

            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'mhbshop1@gmail.com',
            'smtp_pass' => 'mhbshop0303',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' =>'utf-8',
            'newline' => "\r\n"

        ];

        $this->load->library('email', $config);

        $this->email->from("mhbshop1@gmail.com","MHBs shop Admin");
        $this->email->to($for);
        $this->email->subject($subject);
        $this->email->message($content);

        if($this->email->send()){
            return true;
        } else{
            $this->email->print_debugger();
            die;
            return false;
        }
    }

    public function reset(){
        if(!(!$this->input->get('token') || !$this->input->get('uid') || !$this->input->get('type'))){

            $token = $this->input->get('token');
            $user_id = $this->input->get('uid');
            $type = $this->input->get('type');

            $tokenVerify = $this->Token_model->verifyToken($user_id, $token, $type, true, 30);

            if($tokenVerify['stats'] && $type == 1){
                
                // Set form validation messages

                $this->form_validation->set_message('matches', '{field} not matched');
                $this->form_validation->set_message('min_length', '{field} too short');

                $this->form_validation->set_rules('pass-1', 'new password', 'required|min_length[5]');
                $this->form_validation->set_rules('pass-2', 'confirmation password', 'required|matches[pass-1]');

                if($this->form_validation->run()){
                    
                    $this->User_model->updatePassword($user_id, $this->input->post('pass-1'));
                    $this->Token_model->deleteToken($user_id, $token);

                    $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-success" role="alert">
                    <strong>Success !</strong> Password was resetted
                    </div>');
                    redirect('auth');
                } else{
                    $meta['title'] = 'Reset Password';
        
                    $this->load->view('templates/front-end/header', $meta);
                    $this->load->view('auth/reset');
                    $this->load->view('templates/front-end/footer');
                }

            } else{
                $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-danger" role="alert">
                <strong>Failed !</strong> ' . $tokenVerify['msg'] .'
                </div>');
                redirect('auth/forgot');
            }
        } else{
            redirect('404');
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