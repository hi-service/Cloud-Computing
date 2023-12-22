<?php

namespace App\Models;

use CodeIgniter\Model;

class Order_Model extends Model
{
  protected $primaryKey = 'order_id';
  protected $useAutoIncrement     = true;
	
    public function setData($data){
        $this->db->table("orderdb")->insert($data);
        return $this->db->insertID();
        
        }
        public function getData($user_data, $data)
        {
          return $this->db->table('orderdb')
          ->select('*')
          ->where([$user_data => $data])
          ->get()->getRowArray();
        }	
        public function getData_Active($status_data, $data)
        {
          return $this->db->table('orderdb')
          ->select('id_location , status')
          ->where([$status_data => $data])
          ->orderBy('order_id', 'DESC')->limit(1)->get()->getRowArray();
        }	
        public function getOrder($id){
          $builder = $this->db->table("orderdb as orders");
          $builder->select('orders.order_id, customers.nama, description.nama_bengkel, orders.id_location, orders.deskripsi, orders.waktu, customers.nohp, orders.lat, orders.lng, orders.address, orders.status');
          $builder->join('customers', 'orders.id_customer = customers.id');
          $builder->join('locations', 'orders.id_location = locations.id');
          $builder->join('description', 'description.id_description = locations.description_id');
          $builder->where(array('orders.order_id' => $id));
          return $builder->get()->getRowArray();
    }
    public function update_order_status($id,$data){
      return $this->db
          ->table('orderdb')
          ->where(["order_id" => $id])
          ->set($data)
          ->update();
      }		


    }