<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users class
 * This class only provide logged in users page.
 * 
 * @Author Daniel
 */
class Games extends MY_Controller {
    /**
     * construct function
     */
    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata['id']))
        {
            redirect(base_url().'login');
        }
        $this->load->model('invoice_model');
        $keys = $this->invoice_model->getStudentKey($this->session->userdata['id']);
        if (!count($keys) ) {
            redirect("users/student_key");
        }
    }

    public function ac() {
        $view_data = array();
        $this->load->view('games/ac', $view_data);
    }

    public function ucr() {
        $view_data = array();
        $this->load->view('games/ucr', $view_data);
    }

}

/* End of file users.php */
/* Location: ./application/controllers/games.php */