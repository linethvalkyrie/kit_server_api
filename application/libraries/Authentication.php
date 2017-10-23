<?php

Class Authentication{
   /* public function get_hashed_password($username) {
        $user = $this->ci->db->select('password')
        ->where('username',$username)->get('users');
        if ($user->num_rows() == 0) {
            return false;
        }
    }*/
    public function login($username, $password) {
        echo $username."pw = ".$password;
        //if($username == 'admin' && $password == 1)
        if($username == 'admin' && $password == '1234')
        {
            
            return md5($username.":"."REST API".":".$password);            
        }
        else
        {
            return false;           
        }           
    }
}