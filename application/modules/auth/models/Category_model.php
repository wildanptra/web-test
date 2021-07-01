<?php 

class Category_model extends NoAuth_Controller {

    private $table = 'tb_category';

    public function getAllCategory()
    {
        return $this->db->get('tb_category')->result_array();
    }

    public function insertCategory($table,$data)
    {
        return $this->db->insert($table,$data);
    }

}