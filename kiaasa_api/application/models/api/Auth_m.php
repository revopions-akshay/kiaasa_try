<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class Auth_m extends MY_Model {

	protected $tbl_name = 'users';
    protected $primary_col = 'id';
    protected $order_by = 'created_on';

    public function __construct()
	{
		parent::__construct();   
	}



    public function getUserCount($username){
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email', $username);
        return $this->db->get()->num_rows();
    }

    public function getValidUser($username, $password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $username);
        $user = $this->db->get()->row();

        if(password_verify($password, $user->password)){
            return $user;
        }
        else{
            return false;
        }
    }

    
    public function registerUser($data){
        $this->db->insert('users', $data);
        return true;
    }


    public function updatePassword($email,$password){
        $data = [
            'password' => $password
        ];
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        return true;
    }

  


//end class

}
