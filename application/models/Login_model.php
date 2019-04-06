<?php
/**
 * Created by PhpStorm.
 * User: sun rise
 * Date: 3/27/2017
 * Time: 5:04 PM
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function checkUser($data)
    {
        $st=$this->db->SELECT('*')->from('users')
                        ->WHERE('email',$data['email'])
                        ->WHERE('password',sha1(md5($data['password'])))
                        ->get()->result_array();
        if(count($st)>0)
        {
            return $st[0];
        }
        else
        {
            return false;
        }
    }

    public function checkPassword($str)
    {
        $st=$this->db->SELECT('*')->from('users')
            ->WHERE('id',$this->session->userdata['id'])
            ->WHERE('password',sha1(md5($str)))
            ->get()->result_array();
        if(count($st)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePassword($password,$id)
    {
        $pass=array(
            'password' => sha1(md5($password))
        );
        $this->db->WHERE('id',$id)->update('users',$pass);
    }

    public function register($data)
    {
        $data=$this->security->xss_clean($data);
        $user=array(
            'email' => $data['email'],
            'password' => sha1(md5($data['password'])),
            'fullname' => $data['fullname'],
            'hash' => sha1(md5($this->session->userdata['session_id'])),
            'user_role' => 'student'
        );

        if ($data['user_role'] == 'teacher') {
            $user['user_role'] = 'teacher';
        }
        $this->db->insert('users',$user);
        return $this->db->insert_id();
    }

    public function activateAccount($id,$hash)
    {
        $st=$this->db->select('*')->from('users')->WHERE('id',$id)->WHERE('hash',$hash)->get()->row();
        if($st)
        {
            $status=array(
              'status' => 'approved'
            );
            $this->db->WHERE('id',$id)->WHERE('users',$status);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function setRecoveryToken( $email ) {
        $st=$this->db->SELECT('*')->from('users')
                        ->where('email',$email)
                        ->get()->result_array();
        if (count($st)==0) {
            return null;
        }
        $token = md5($email."_".rand(0,9999)."_".rand(0,9999));
        $this->db->where('email', $email);
        $this->db->update('users', array('forgot_token'=> $token, 'forgot_token_ts'=>time()) );
        return $token;
    }

    public function recoverPasswordWithToken( $token , $password ) {
        $st=$this->db->SELECT('*')->from('users')
                        ->where('forgot_token',$token)
                        ->get()->result_array();
        if (count($st)==0) {
            return "Token is invalid, token can be used only for 1 time."; 
        }
        if (  $st[0]['forgot_token_ts']+ 60*15 <time() ) {
            return "Token time is expired! Please try again to recover password!";
        }

        $this->db->where('id', $st[0]['id'] );
        $this->db->update('users', array('password'=> sha1(md5($password)), 'forgot_token'=>'', 'forgot_token_ts'=>0 ) );
        return "OK";
    }
}
