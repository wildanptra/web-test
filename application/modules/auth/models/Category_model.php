<?php 

class Category_model extends NoAuth_Controller {

    var $table = 'tb_category';

    public function getCategory()
    {
        return $this->db->get($this->table)->result();
    }

    public function insertCategory($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    public function updateCategory($where,$data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteCategory($id_category)
    {
        $this->db->delete($this->table,['id_category' => $id_category]);
        return $this->db->affected_rows();
    }

    public function getDataById($id_category)
    {
        return $this->db->get_where($this->table, ['id_category' => $id_category])->row();
    }

}