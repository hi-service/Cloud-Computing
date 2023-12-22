<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Customer_Model extends Model{
	public function get_data($username, $password)
	{
      return $this->db->table('customers')
      ->where(array('username' => $username, 'password' => $password))
      ->get()->getRowArray();
	}
    public function set_data($id,$data){
		return $this->db
                        ->table('customers')
                        ->where(["id" => $id])
                        ->set($data)
                        ->update();
    }	
    public function existData($data){
      return $this->db
                  ->table('customers')
                  ->where('username', $data)->get()->getFirstRow();
}		
public function registerData($data){
      return $this->db
                  ->table('customers')
                  ->insert($data);
}
    public function setCustomerOrderData($id,$data){
      return $this->db
                  ->table('customers')
                  ->where(["id" => $id])
                  ->set($data)
                  ->update();
}		
    public function getSingleData($user_data, $data)
	{
      return $this->db->table('customers')
      ->select('status_order')
      ->where([$user_data => $data])
      ->get()->getRowArray();
	}		
      public function getLastOrder($user_data, $data)
	{
      return $this->db->table('customers')
      ->select('last_order_id')
      ->where([$user_data => $data])
      ->get()->getRowArray();
	}
      public function getStatusOrder($user_data, $data)
	{
      return $this->db->table('customers')
      ->select('status_buy_order')
      ->where([$user_data => $data])
      ->get()->getRowArray();
	}		
      public function getLastInvoiceId($user_data, $data)
	{
      return $this->db->table('customers')
      ->select('buy_last_id')
      ->where([$user_data => $data])
      ->get()->getRowArray();
	}				
      
}