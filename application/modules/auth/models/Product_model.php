<?php 

class Product_model extends NoAuth_Controller {

    var $table = 'tb_product';

    public function getProduct()
    {
        return $this->db->get($this->table)->result();
    }

    public function insertProduct($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    public function updateProduct($where,$data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteProduct($id_product)
    {
        $this->db->delete($this->table,['id_product' => $id_product]);
        return $this->db->affected_rows();
    }

    public function getDataById($id_product)
    {
        return $this->db->get_where($this->table, ['id_product' => $id_product])->row();
    }

}