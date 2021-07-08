<?php 

class Product_model extends NoAuth_Controller {

    var $table = 'tb_product';
    var $column_order = array('id_product','name','description','tb_category.id_category','stock','price');
    var $order = array('id_product','name','description','tb_category.id_category','stock','price');

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

    public function _get_data_query()
    {
        $this->db->select('tb_product.*,tb_product.name,tb_product.description,tb_category.id_category,stock,price');
        $this->db->from($this->table);
        $this->db->join('tb_category','tb_product.id_category = tb_category.id_category');

        if(isset($_POST['search']['value'])) {

            $this->db->like('tb_product.name', $_POST['search']['value']);
            $this->db->or_like('tb_product.description', $_POST['search']['value']);
            $this->db->or_like('tb_product.id_category', $_POST['search']['value']);
            $this->db->or_like('tb_product.stock', $_POST['search']['value']);
            $this->db->or_like('tb_product.price', $_POST['search']['value']);

        }

        if(isset($_POST['order'])) {

            $this->db->order_by( $this->order[$_POST['order'][0]['column']], $_POST['order'][0]['dir'] );

        } else {

            $this->db->order_by('tb_product.id_product','DESC');

        }
    }

    public function getDataTable()
    {
        $this->_get_data_query();

        if($_POST['length'] != -1) {

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filter_data()
    {
        $this->_get_data_query();

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getDataById($id_product)
    {
        return $this->db->get_where($this->table, ['id_product' => $id_product])->row();
    }

}