<?php 

class Order_model extends NoAuth_Controller {

    var $table = 'tb_order';

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

    public function getDataById($id_order)
    {
        return $this->db->get_where($this->table, ['id_order' => $id_order])->row();
    }

}