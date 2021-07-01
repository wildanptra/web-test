<?php 

class Register_model extends NoAuth_Controller {
    
    private $table = 'tb_users';

    public function register($table,$data)
    {
        return $this->db->insert($table,$data);
    }

}