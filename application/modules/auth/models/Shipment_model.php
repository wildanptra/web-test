<?php 

class Shipment_model extends NoAuth_Controller {

    var $table = 'tb_shipment';
    var $column_order = array('id_shipment','tb_shipment.date_shipment','tb_shipment.address','tb_shipment.courier_name','tb_shipment.status_shipment');
    var $order = array('id_shipment','tb_shipment.date_shipment','tb_shipment.address','tb_shipment.courier_name','tb_shipment.status_shipment');

    public function getShipment()
    {
        $this->db->select('tb_shipment.*,tb_shipment.date_shipment,tb_shipment.address,tb_shipment.courier_name,tb_shipment.status_shipment');
        $this->db->from($this->table);
        $order = $this->db->get();
        return $order->result();
    }

    public function insertShipment($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    public function updateShipment($where,$data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteShipment($id_shipment)
    {
        $this->db->delete($this->table,['id_shipment' => $id_shipment]);
        return $this->db->affected_rows();
    }

    public function _get_data_query()
    {
        $this->db->select('tb_shipment.*,tb_shipment.date_shipment,tb_shipment.address,tb_shipment.courier_name,tb_shipment.status_shipment');
        $this->db->from($this->table);

        if(isset($_POST['search']['value'])) {

            $this->db->like('tb_shipment.date_shipment', $_POST['search']['value']);
            $this->db->or_like('tb_shipment.address', $_POST['search']['value']);
            $this->db->or_like('tb_shipment.courier_name', $_POST['search']['value']);
            $this->db->or_like('tb_shipment.status_shipment', $_POST['search']['value']);
            
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

    public function getDataById($id_shipment)
    {
        return $this->db->get_where($this->table, ['id_shipment' => $id_shipment])->row();
    }

}