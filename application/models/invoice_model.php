<?php
/**
 * Created by PhpStorm.
 * User: sun rise
 * Date: 3/27/2017
 * Time: 5:04 PM
 */
class Invoice_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function getInvoice()
    {
        $this->db->select('A.*, B.fullname, B.email');
        $this->db->from('invoices A');
        $this->db->join("users B", "A.user_id=B.id", "left");
        $this->db->order_by("A.id","desc");
        $st = $this->db->get()->result_array();
        return $st;
    }


    public function getSingleInvoiceDetail($invoice_id) {
        $st=$this->db->SELECT('A.*, B.fullname, B.email')->from('invoices A')
                        ->join("users B", "A.user_id=B.id", "left")
                        ->where("A.id", $invoice_id)
                        ->get()
                        ->result_array();
        if (count($st) == 0 )
            return null;
        return $st[0];
    }

    public function getInvoiceKeys($invoice_id) {
        $st=$this->db->SELECT('A.*')->from('invoices_key A')
                        ->where("A.invoice_id", $invoice_id)
                        ->get()
                        ->result_array();
        return $st;
    }


    public function getUserInvoice($user_id)
    {
        $st=$this->db->SELECT('*')->from('invoices')
                        ->WHERE('user_id',$user_id)
                        ->order_by("id","desc")
                        ->get()
                        ->result_array();
        return $st;
    }

    public function insertInvoice($data)
    {
        $data=$this->security->xss_clean($data);
        $user=array(
            'user_id' => $data['user_id'],
            'qty' => $data['qty'],
            'price' => $data['price'],
            'due_date'=> date("Y-m-d"),
            'status' => "pending"
        );
        $this->db->insert('invoices',$user);
        return $this->db->insert_id();
    }

    public function cancelUserInvoice($data) {
        $this->db->where('id', $data['id']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('status !=','paid');
        $this->db->update( 'invoices', $data);
    }

    public function mark_paid($invoice_id) {
        $st=$this->db->SELECT('*')->from('invoices')
                        ->WHERE('id',$invoice_id)
                        ->get()
                        ->result_array();
        if (count($st)==0)
            return;
        if ($st[0]['status']=='paid')
            return;
        $this->db->where('id', $invoice_id);
        $this->db->update( 'invoices', array('status'=>'paid'));

        for($i=0; $i < (int)$st[0]['qty']; $i++) {
            $k = md5( $st[0]['id'].'_'.$i.'_'.date().'_'.rand(10000,99999) );
            $this->db->insert("invoices_key", array(
                'invoice_id' => $st[0]['id'],
                'key'=> $k
            ));
        }
    }

    public function deleteInvoice($id) {
        $this->db->delete('invoices', array('id' => $id));
    }


    public function getStudentKey($student_id) {
        $st=$this->db->SELECT('A.*')->from('students_game_key A')
                        ->where("A.student_id", $student_id)
                        ->get()
                        ->result_array();
        return $st;
    }

    public function student_key_input($student_id, $key) {
        $item=array(
            'student_id' => $student_id,
            'key' => $key
        );
        $this->db->insert('students_game_key',$item);
        return $this->db->insert_id();
    }

    public function check_license_key_valid( $key ) {
        $st=$this->db->SELECT('A.*')->from('invoices_key A')
                        ->where('key', $key)
                        ->get()
                        ->result_array();
        return count($st);
    }

    public function check_license_key_used($key) {
        $st=$this->db->SELECT('A.*')->from('students_game_key A')
                        ->where('key', $key)
                        ->get()
                        ->result_array();
        return count($st);
    }

    public function mark_license_key_used($key) {
        $this->db->where('key', $key);
        $this->db->update("invoices_key", array('is_used'=>1) );
    }
}
