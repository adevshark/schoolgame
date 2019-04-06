<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users class
 * This class only provide logged in users page.
 * 
 * @Author Daniel
 */
class Users extends MY_Controller {

    var $menus = array(
        'dashboard' => array('url' => '/users/dashboard', 'title' => 'Dashboard', 'icon'=>'fa fa-desktop', 'role'=>array('superadmin','student','teacher')),
        // =======
        'games' => array('url' => '/users/games', 'title' => 'Game', 'icon'=>'fa fa-heart', 'role'=>array('student')),
        'student_key' => array('url' => '/users/student_key', 'title' => 'License Key', 'icon'=>'fa fa-key', 'role'=>array('student')),
        'invoices' => array('url' => '/users/invoices', 'title' => 'invoices', 'icon'=>'fa fa-money', 'role'=>array('teacher')),
        'invoices_admin' => array('url' => '/users/invoices_admin', 'title' => 'Manage Invoices', 'icon'=>'fa fa-money', 'role'=>array('superadmin')),
        // =======
        'change_password' => array('url' => '/users/change_password', 'title' => 'Change Password', 'icon'=>'fa fa-lock', 'role'=>array('superadmin','student','teacher')),
        'logout' => array('url' => '/login/logout', 'title' => 'Logout', 'icon'=>'fa fa-sign-out', 'role'=>array('superadmin','student','teacher')),
    );

    var $purchase_plan = array(
        array('qty'=>1, 'price'=>5),
        array('qty'=>5, 'price'=>20),
        array('qty'=>10, 'price'=>35)
    );

    var $current_menu = 'dashboard';

    var $title = 'Users';

    /**
     * construct function
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model('login_model');
        $this->load->model('invoice_model');
        $this->load->library('form_validation');

        if(!$this->isLoggedin())
        {
            redirect(base_url().'login');
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
        $user_menus = array();
        foreach($this->menus as $key=>$menu) {
            if (in_array($this->session->userdata['user_role'], $menu['role'])) {
                $user_menus[$key] = $menu ;
            }
        }
        $this->load->view('includes/user_header', array(
             'menus' => $user_menus,
             'current_menu' => $this->current_menu,
             'title' => $this->title
        ));
        $this->load->view($view, $vars);
        $this->load->view('includes/user_footer');
    }

     
    private function checkRole ($mixed_role) {
        if( is_array($mixed_role)) {
            return in_array(  $this->session->userdata['user_role'], $mixed_role );
        } else if ( $this->session->userdata['user_role'] == $mixed_role ) {
            return true;
        }  
        return false;
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
                $this->login_model->updatePassword($_POST['password'],$this->session->userdata['id']);
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
        $this->checkRole('teacher');
        $ret = $this->invoice_model->getUserInvoice(  $this->session->userdata['id'] );
        $page = 1;
        $row_per_page = 10;
        $invoices = array();
        if (!empty($_GET['page']) ) {
            $page = (int) $_GET['page'];
        }
        if( ($page-1)*$row_per_page < count($ret)) {
            $invoices =  array_slice($ret, ($page-1)*$row_per_page , $row_per_page);
        }
        $total_page = ceil(count($ret)/$row_per_page);
        
        $this->view('users/invoices',array('invoices'=>$invoices, 'total_page'=>$total_page, 'current_page'=>$page));
    }

    public function invoice($invoice_id) {
        $this->current_menu = 'invoices';
        $this->checkRole('teacher', 'superadmin');
        $sp = $this->invoice_model->getSingleInvoiceDetail( $invoice_id );
        if($sp == null) {
            die("Invalid invoice id!");
        }
        $licenses = $this->invoice_model->getInvoiceKeys( $invoice_id );
        $this->view('users/invoice', array("invoice_detail"=>$sp, 'licenses'=>$licenses) );
    }

    public function purchase() {
        $this->current_menu = 'invoices';
        $this->checkRole('teacher');
        $this->view('users/purchase');
    }

    public function purchase_plan($id) {
        $this->checkRole('teacher');
        $pp = $this->purchase_plan[$id];
        $insert_id = $this->invoice_model->insertInvoice(array(
            'user_id' => $this->session->userdata['id'],
            'qty' => $pp['qty'],
            'price' => $pp['price']
        ));
        $this->session->userdata['id'];
        redirect("users/invoices?new=".$insert_id);
    }

    public function cancel_invoice($id) {
        $this->checkRole('teacher');
        $this->invoice_model->cancelUserInvoice(array(
            'id' => $id, 
            'user_id' => $this->session->userdata['id'],
            'status' => 'cancelled'
        ));
        redirect("users/invoices");
    }

    public function games() {
        $this->checkRole('student');

        $this->current_menu = 'games';        
        $keys = $this->invoice_model->getStudentKey($this->session->userdata['id']);
        $this->view('users/games', array('keys'=> $keys) );
    }

    public function student_key() {
        $this->current_menu = 'student_key';
        $this->checkRole('student');

        $view_data = array();        
        $post = $this->input->post();
        if(!empty($post['key'])) {
            $is_valid_key = $this->invoice_model->check_license_key_valid($post['key']);
            $is_used_key = $this->invoice_model->check_license_key_used($post['key']);
            if ( !$is_valid_key) {
                $view_data['msg'] = "<div class='alert alert-danger'>Your license key is invalid! Please Try Another!</div>" ;
            } 
            else if ( $is_used_key) {
                $view_data['msg'] = "<div class='alert alert-danger'>Your license key is already used!</div>" ;
            } else {
                $view_data['msg'] = "<div class='alert alert-success'>Thanks for input license!</div>" ;
                $this->invoice_model->student_key_input( $this->session->userdata['id'], $post['key'] );
                $this->invoice_model->mark_license_key_used($post['key']);
            }
        }
        //==========================================
        $keys = $this->invoice_model->getStudentKey($this->session->userdata['id']);
        $view_data['keys'] = $keys;
        $this->view('users/student_key', $view_data );
    }
    

    /**
     * Functions for superadmin
     */
    public function invoices_admin() {
        $this->checkRole('superadmin');
        $this->current_menu = 'invoices_admin';
        $ret = $this->invoice_model->getInvoice();
        $page = 1;
        $row_per_page = 10;
        if (!empty($_GET['page']) ) {
            $page = (int) $_GET['page'];
        }
        if( ($page-1)*$row_per_page < count($ret)) {
            $result =  array_slice($ret, ($page-1)*$row_per_page , $row_per_page);
        }
        $total_page = ceil(count($ret)/$row_per_page);
        $this->view('admin/admin_invoices', array('invoices'=>$result, 'total_page'=>$total_page, 'current_page'=>$page));
    }

    public function invoices_admin_mark_pay($invoice_id) {
        $this->checkRole('superadmin');
        $ret = $this->invoice_model->mark_paid($invoice_id);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */