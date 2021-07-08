<?php 

class Category_model extends NoAuth_Controller {

    var $table = 'tb_category';
    var $column_order = array('id_category','name','description');
    var $order = array('id_category','name','description');

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

    public function _get_data_query()
    {
        $this->db->from($this->table);

        if(isset($_POST['search']['value'])) {

            $this->db->like('name', $_POST['search']['value']);
            $this->db->or_like('description', $_POST['search']['value']);

        }

        if(isset($_POST['order'])) {

            $this->db->order_by( $this->order[$_POST['order'][0]['column']], $_POST['order'][0]['dir'] );

        } else {

            $this->db->order_by('id_category','DESC');

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

    public function getDataById($id_category)
    {
        return $this->db->get_where($this->table, ['id_category' => $id_category])->row();
    }

}