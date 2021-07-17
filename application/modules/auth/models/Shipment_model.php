<?php 

class Shipment_model extends NoAuth_Controller {

    var $table = 'tb_shipment';
    
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

    public function insertBatchShipment($data)
    {
        return $this->db->insert_batch('tb_shipment_order', $data);
    }

    public function insertShipmentOrder()
    {
        $this->db->trans_start();

            $data_shipment = [

                'date_shipment'     => $this->input->post('date_shipment',true),
                'address'           => $this->input->post('address',true),
                'courier_name'      => $this->input->post('courier_name',true),
                'grandtotal'        => $this->input->post('grandtotal',true),
                'status_shipment'   => $this->input->post('status_shipment',true),
            ];

            $this->db->insert('tb_shipment', $data_shipment);
            
            $id_shipment = $this->db->insert_id();

            
            $data_order =  $this->input->post('id_order',true);

            $result = array();
            
            foreach($data_order AS $key){
                $result[] = array(
                    'id_order'        => $key,
                    'id_shipment'     => $id_shipment,
                );
                 
            }  
            
            $this->db->insert_batch('tb_shipment_order', $result);

        $this->db->trans_complete();
    }

    public function updateShipmentOrder()
    {
        # code...
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

    public function getDataById($id_shipment)
    {
        return $this->db->get_where($this->table, ['id_shipment' => $id_shipment])->row();
    }

}