<?php 

class Shipment_order_model extends NoAuth_Controller {

    var $table = 'tb_shipment_order';

    public function getShipmentOrder()
    {
        $this->db->select('tb_shipment_order.*,tb_order.qty as qty_order,tb_order.price as price_order,tb_order.total as total_order,tb_order.user_id,tb_order.status_order,tb_order.tanggal_transaksi,tb_shipment.date_shipment,tb_shipment.address as address_shipment,tb_shipment.courier_name,tb_shipment.status_shipment');
        $this->db->from($this->table);
        $this->db->join('tb_order','tb_shipment_order.id_order = tb_order.id_order');
        $this->db->join('tb_shipment','tb_shipment_order.id_shipment = tb_shipment.id_shipment');
        $order = $this->db->get();
        return $order->result();
    }

    public function insertShipmentOrder($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    public function updateShipmentOrder($where,$data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteShipmentOrder($id_shipment_order)
    {
        $this->db->delete($this->table,['id_shipment_order' => $id_shipment_order]);
        return $this->db->affected_rows();
    }

    public function getDataById($id_shipment_order)
    {
        return $this->db->get_where($this->table, ['id_shipment_order' => $id_shipment_order])->row();
    }
    
}