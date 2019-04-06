<?php

class My_Controller extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * send email via SMTP
     * $to - comma delimited string or array of email addresses
     */
    function sendmail($to, $subject, $message) {
        $this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.cucircle.com';
        $config['smtp_user'] = 'support@cucircle.com';
        $config['smtp_pass'] = 'eMASBzbx>Ch5d|C';
        $config['smtp_port'] = 26;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('support@cucircle.com', 'Cucircle.com');
        // -----------------------------
        $this->email->to($to);
        // -----------------------------
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }
}
