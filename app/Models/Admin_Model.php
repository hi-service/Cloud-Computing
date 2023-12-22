<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Admin_Model extends Model{
	public function get_data($username, $password)
	{
      return $this->db->table('partnersdb as p')
      ->select('p.id_partner, desc.nama_bengkel')
      ->join('locations as loc', 'p.id_partner = loc.id')
      ->join('description as desc', 'loc.description_id = desc.id_description')
      ->where(array('p.username' => $username, 'p.password' => $password))
      ->get()->getRowArray();
	}
      public function getOrder($id){
            $builder = $this->db->table("orderdb as orders");
            $builder->select('orders.order_id, customers.nama, orders.id_location, orders.deskripsi, orders.waktu, orders.nohp, orders.lat, orders.lng, orders.address, orders.status,customers.fcm_token');
            $builder->join('customers', 'orders.id_customer = customers.id');
            $builder->where(array('orders.id_location' => $id));
            $builder->orderBy('orders.order_id', 'desc');
            return $builder->get()->getResult();
      }
      public function update_order_status($id,$data){
		return $this->db
                        ->table('orderdb')
                        ->where(["order_id" => $id])
                        ->set($data)
                        ->update();
    }		
    public function getUserChat($id){
      $builder = $this->db->table("conversation_db as convers");
      $builder->distinct();
      $builder->select('convers.id_user,customers.nama');
      $builder->join('customers','convers.id_user = customers.id');
      $builder->where(array('convers.id_bengkel' => $id));
      return $builder->get()->getResult();
    }
    public function getDataComplete($id){
      $builder = $this->db->table("orderdb");
      $builder->selectCount('order_id');
      $builder->where('id_location', $id);
      $builder->whereIn('status', ['finished', 'rejected']);
      $result = $builder->countAllResults();
      return $result;
    }
    public function getDataWaiting($id){
      $builder = $this->db->table("orderdb");
      $builder->selectCount('order_id');
      $builder->where('status', 'waiting');
      $builder->where('id_location', $id);
      $result = $builder->countAllResults();
      return $result;
    }
    public function getAllData($id){
      $builder = $this->db->table("orderdb");
      $builder->selectCount('order_id');
      $builder->where('id_location', $id);
      $result = $builder->countAllResults();
      return $result;
    }
    public function addItem($data){
      $this->db->table("itemsdb")->insert($data);
    }
    public function getItem($id){
      $builder = $this->db->table("itemsdb");
      $builder->select('*');
      $builder->where('id_bengkel', $id);
      $result = $builder->get()->getResultArray();
      return $result;
    }
    public function updateItem($id_barang,$id_bengkel,$data){
      return $this->db
      ->table('itemsdb')
      ->where(["id_barang" => $id_barang , 'id_bengkel' => $id_bengkel ])
      ->set($data)
      ->update();
      }		
      public function deleteItem($id_barang,$id_bengkel){
        return $this->db
        ->table('itemsdb')
        ->delete(["id_barang" => $id_barang , 'id_bengkel' => $id_bengkel ]);
      }
      public function getInvoiceItem($id_bengkel){
        $builder = $this->db->table("itemorder_status as its");
        $builder->select('its.id_order, customers.nama, customers.nohp ,its.id_user, its.id_bengkel , its.status, its.shipping, its.waktu, its.lat , its.lng , its.address')
        ->join('customers', 'its.id_user = customers.id')
        ->where('id_bengkel', $id_bengkel)
        ->orderBy('its.id_order', 'desc');
        return $builder->get()->getResultArray();
      }
      public function getItemOrder($id){
        $builder = $this->db->table("item_invoice as itin");
        $builder->select('item.nama_barang , itin.qty, item.price')
        ->join('itemsdb as item', 'itin.id_barang = item.id_barang')
        ->where('id_order', $id);
        return $builder->get()->getResultArray();
  }
  public function updateItemOrderStatus($id,$data){
		return $this->db
                        ->table('itemorder_status')
                        ->where(["id_order" => $id])
                        ->set($data)
                        ->update();
    }		
    public function setOrderChat($data){
      $this->db->table("order_chat")->insert($data);
      return $this->db->insertID();
      }
  public function getOrderChat($id_order){
      $builder = $this->db->table("order_chat");
      $builder->select('*');
      $builder->where("order_id", $id_order);
      $builder->orderBy('waktu','ASC');
      return $builder->get()->getResult();
      }
  
}