<?php 

class Order_model extends NoAuth_Controller {

    var $table = 'tb_order';
    var $column_order = array('id_order','tb_product.id_product','tb_order.qty','tb_order.price','tb_order.total','tb_users.user_id','tb_order.tanggal_transaksi');
    var $order = array('id_order','tb_product.id_product','tb_order.qty','tb_order.price','tb_order.total','tb_users.user_id','tb_order.tanggal_transaksi');

    public function getOrder()
    {
        $this->db->select('tb_order.*,tb_product.id_product,tb_product.name as name_product,tb_product.description as description_product,tb_product.stock as stock_product,tb_product.price as price_product,tb_order.qty,tb_order.price,tb_order.total,tb_users.user_id,tb_users.username as username_user,tb_order.status_order,tb_order.tanggal_transaksi');
        $this->db->from($this->table);
        $this->db->join('tb_product','tb_order.id_product = tb_product.id_product');
        $this->db->join('tb_users','tb_order.user_id = tb_users.user_id');
        $order = $this->db->get();
        return $order->result();
    }

    public function insertOrder($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    public function updateOrder($where,$data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteOrder($id_order)
    {
        $this->db->delete($this->table,['id_order' => $id_order]);
        return $this->db->affected_rows();
    }

    public function bayarOrder($id_order)
    {

        $this->db->where('id_order', $id_order);
        $this->db->set('status_order', 'selesai');
        $this->db->set('tanggal_transaksi', 'DATE_ADD(NOW(), INTERVAL 1 MINUTE)', FALSE);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function _get_data_query()
    {
        $this->db->select('tb_order.*,tb_product.id_product,tb_product.name as name_product,tb_product.description as description_product,tb_product.stock as stock_product,tb_product.price as price_product,tb_order.qty,tb_order.price,tb_order.total,tb_users.user_id,tb_users.username as username_user,tb_order.status_order,tb_order.tanggal_transaksi')
        ->from($this->table)
        ->join('tb_product','tb_order.id_product = tb_product.id_product')
        ->join('tb_users','tb_order.user_id = tb_users.user_id');

        if(isset($_POST['search']['value'])) {

            $this->db->like('tb_order.id_product', $_POST['search']['value']);
            $this->db->or_like('tb_order.qty', $_POST['search']['value']);
            $this->db->or_like('tb_order.price', $_POST['search']['value']);
            $this->db->or_like('tb_order.total', $_POST['search']['value']);
            $this->db->or_like('tb_order.user_id', $_POST['search']['value']);
            $this->db->or_like('tb_order.status_order', $_POST['search']['value']);
            $this->db->or_like('tb_order.tanggal_transaksi', $_POST['search']['value']);
            
        }

        if(isset($_POST['order'])) {

            $this->db->order_by( $this->order[$_POST['order'][0]['column']], $_POST['order'][0]['dir'] );

        } else {

            $this->db->order_by('tb_order.id_order','DESC');

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

    public function getDataById($id_order)
    {
        return $this->db->get_where($this->table, ['id_order' => $id_order])->row();
    }

}