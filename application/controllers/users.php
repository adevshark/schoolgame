<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users class
 * This class only provide logged in users page.
 * 
 * @Author Daniel
 */
class Users extends CI_Controller {

    var $menus = array(
        'dashboard' => array('url' => '/users/dashboard', 'title' => 'Dashboard'),
        'change_password' => array('url' => '/users/change_password', 'title' => 'Change Password'),
        'invoices' => array('url' => '/users/invoices', 'title' => 'invoices'),
        'logout' => array('url' => '/login/logout', 'title' => 'Logout'),
    );

    var $current_menu = 'dashboard';

    var $title = 'Users';

    /**
     * construct function
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model('Login_model');
        $this->load->library('form_validation');

        if(!$this->isLoggedin())
        {
            redirect(base_url().'Login');
        }
    }

    /**
     * check if user is already logged in.
     * 
     * @return boolean true if user is already logged in, otherwise false
     */
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

    private function view($view, $vars = array()) {
        $this->load->view('includes/user_header', array('menus' => $this->menus,
             'current_menu' => $this->current_menu,
             'title' => $this->title
            ));
        $this->load->view($view, $vars);
        $this->load->view('includes/user_footer');
    }
    /**
     * 
     */
    public function dashboard() {
        $this->current_menu = 'dashboard';
        $this->view('users/dashboard');
    }

    public function change_password() {

        $this->current_menu = 'change_password';
        
        $data = array();
        $data['title']='Change Password';
        if($_POST)
        {
            $config=array(
                array(
                    'field' => 'old_password',
                    'label' => 'Old Password',
                    'rules' => 'trim|required|callback_checkPassword'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'conf_password',
                    'label' => 'Confirm Password',
                    'rules' => 'trim|required|matches[password]'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false)
            {
                // if validation has errors, save those errors in variable and send it to view
                $data['errors'] = validation_errors();
                $data['csrf'] = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                $this->view('users/change_password',$data);
            }
            else
            {
                // if validation passes, check for user credentials from database
                $this->Login_model->updatePassword($_POST['password'],$this->session->userdata['id']);
                $this->session->set_flashdata('log_success','Congratulations! Password Changed');
                redirect('users/dashboard');
            }

        }
        else
        {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->view('change_password',$data);
        }
    }

    public function invoices() {
        $this->current_menu = 'invoices';
        $this->view('users/invoices');
    }

    public function invoice($invoice_id) {
        $this->current_menu = 'invoices';

        $this->view('users/invoice');
    }

    public function purchase() {
        $this->current_menu = 'invoices';

        $this->view('users/purchase');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */