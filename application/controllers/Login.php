<?php

class Login extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if($this->isLoggedin()){ redirect(base_url().'login/dashboard');}
        $data['title']='Login Now';
        if($_POST)
        {
            $config=array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                // if validation has errors, save those errors in variable and send it to view
                $data['errors'] = validation_errors();
                $data['csrf'] = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                $data['title']='Login Now';
                $this->load->view('login',$data);
            } else {
                // if validation passes, check for user credentials from database
                $data = $this->security->xss_clean($_POST);
                $user = $this->login_model->checkUser($data);
                if ($user) {
                // if an record of user is returned from model, save it in session and send user to dashboard
                    $this->session->set_userdata($user); 
                    $this->session->set_flashdata('log_success','Logged in Successfully');
                    redirect(base_url() . 'login/dashboard');
                } else {
                // if nothing returns from model , show an error
                    $data['errors'] = 'Sorry! The credentials you have provided are not correct';
                    $data['csrf'] = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );
                    $data['title']='Login Now';
                    $this->load->view('login',$data);
                }
            }

        }
        else
        {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('login',$data);
        }

    }

    public function change_password()
    {
        redirect('users/change_password');        
    }

    public function register()
    {
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        if(!$this->isLoggedin()){
            $data['title']='Register';
            if($_POST)
            {
                $config=array(
                    array(
                        'field' => 'fullname',
                        'label' => 'Full Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|is_unique[users.email]'
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false)
                {
                    // if validation has errors, save those errors in variable and send it to view
                    $data['errors'] = validation_errors();
                    $this->load->view('register',$data);
                }
                else
                {
                    // if validation passes, check for user credentials from database
                    $id=$this->login_model->register($_POST);
                    // You can send Email here for account activation
                    $this->session->set_flashdata('log_success','Congratulations! You are registered. Please Click on <a href='.base_url().'login/activate/'.$id.'/'.sha1(md5($this->session->userdata['session_id'])).'>this Link</a> to activate your account.
                     ');
                    redirect(base_url() . 'login');
                }

            }
            else
            {
                $this->load->view('register',$data);
            }
        }
        else
        {
            redirect(base_url().'login');
        }

    }

    public function activate()
    {
        $id=$this->uri->segment(3);
        $hash=$this->uri->segment(4);
        $check=$this->login_model->activateAccount($id,$hash);
        if($check)
        {
            $this->session->set_flashdata('log_success','Account Activated Successfully');
            redirect(base_url().'login');
        }
        else
        {
            $this->session->set_flashdata('log_error','Incorrect Hash, Please try again');
            redirect(base_url().'login');
        }
    }

    public function checkPassword($str)
    {
        $check=$this->login_model->checkPassword($str);
        if($check)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('checkPassword', 'The Current Password you have provided is incorrect');
            return false;
        }
    }

    public function dashboard()
    {
        redirect('/users/dashboard');
        /*
        if($this->isLoggedin())
        {
            $data['title']='Welcome! You are logged in';
            $this->load->view('success',$data);
        }
        else
        {
            redirect(base_url().'login');
        }
        */
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }

    public function isLoggedin()
    {
        if(!empty($this->session->userdata['id']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function forgot_password() {
        if (empty($_POST['forgotemail']))
            return;        
        print($_POST['forgotemail']);
        $token = $this->login_model->setRecoveryToken( $_POST['forgotemail'] );
        if ( $token == null) {
            die("Invalid email address. Make sure this is your email.");
        }
        $this->sendmail($_POST['forgotemail'], "Password Recovery", "<h1>Hi,Thanks for using our support.</h1>"
                ."<h4>Please copy below link and visit to recover your password!</h4>"
                ."<p>".site_url('login/forgot_password_recover/'.$token)."</p>");
        
        echo "<script type='text/javascript'>alert('Check your mailbox. Recovery email is sent!'); location.href='".site_url('login')."';</script>";
    }

    public function forgot_password_recover($token) {
        $post = $this->input->post();
        $view_data = array( 'token'=>$token );
        if ( isset($post['password']) ) {
            if ( $post['password'] != $post['password_confirm']) {
                $view_data['message'] = "<div class='alert alert-danger'>Password confirm did not match!</div>";
            } else {
                $ret = $this->login_model->recoverPasswordWithToken( $token, $post['password'] );
                if ( $ret == "OK") {
                    echo "<script type='text/javascript'>alert('Success! Please login with this credentials'); location.href='".site_url('login')."';</script>";
                    return;
                } else {
                    $view_data['message'] = "<div class='alert alert-danger'>".$ret."</div>";
                }
            }
        }
        $this->load->view('forgot_password_recover', $view_data);    
    }

}

