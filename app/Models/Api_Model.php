<?php namespace App\Models;
 
use CodeIgniter\Model;
use PDO;

class Api_Model extends Model{

    public function Register($data){
        $this->db->table("customers")->insert($data);
        return $this->db->insertID();
        }
    
        public function Login($user_data)
        {
            $builder = $this->db->table("customers");
            $builder->select('id,auth_token');
            $builder->where('id', $user_data['id']);
            $result = $builder->get()->getFirstRow();
            
            if ($result === null) {
                throw new \Exception('User with the provided uid does not exist.');
            }
            
            $builder->set('auth_token', $user_data['auth_token']);
            $builder->set('fcm_token', $user_data['fcm_token']);
            $builder->where('id', $user_data['id']);
            $builder->update();
            
            return $result;
        }

        public function initToken($auth_token): bool
        {
            $builder = $this->db->table("customers"); // Set the database table name here
            $builder->select('nama, nohp');
            $builder->where('auth_token', $auth_token);
            $result = $builder->get()->getFirstRow();
        
            if ($result === null) {
                return false;
            } else {
                return true;
            }
        }
        public function getUserData($auth_token)
        {
                $api_model = new Api_Model();
                if (!$api_model->initToken($auth_token)) {
                    throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
                }
                $builder = $this->db->table("customers");
                $builder->select('id,nama, nohp,status_order,last_order_id,status_buy_order,buy_last_id');
                $builder->where('auth_token', $auth_token);
                $result = $builder->get()->getFirstRow();
        
                return $result;
        }
        public function getBengkel($auth_token)
        {
                $api_model = new Api_Model();
                if (!$api_model->initToken($auth_token)) {
                    throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
                }
                $builder = $this->db->table("locations");
                $builder->select('locations.id,locations.text_mark as nama_bengkel, locations.lat,locations.long as lng,d.jenis_bengkel,d.url_gambar');
                $builder->join('description as d', 'locations.description_id = d.id_description');
                $result = $builder->get()->getResult();
        
                return $result;
        }
        public function getKeluhan($auth_token)
        {
                $api_model = new Api_Model();
                if (!$api_model->initToken($auth_token)) {
                    throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
                }
                $builder = $this->db->table("data_keluhan");
                $builder->select('text_keluhan');
                $result = $builder->get()->getResult();
        
                return $result;
        }
        public function getBengkelById($auth_token,$id)
        {
                $api_model = new Api_Model();
                if (!$api_model->initToken($auth_token)) {
                    throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
                }
                $builder = $this->db->table("locations as l");
                $builder->select('d.nama_bengkel,d.alamat_bengkel,d.jam_buka,d.jam_tutup,d.url_gambar,d.deskripsi_bengkel,d.pemilik_bengkel,d.jenis_bengkel');
                $builder->join('description as d', 'l.description_id = d.id_description');
                $builder->where("id",$id);
                $result = $builder->get()->getResult();
        
                return $result;
        }
        public function getBengkelById_Rating($id,$auth_token)
        {
            $api_model = new Api_Model();
            if (!$api_model->initToken($auth_token)) {
                throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
            }
            $builder = $this->db->table("rating");
            $builder->select('AVG(rating) AS rata_rata');
            $builder->where("id_bengkel", $id);
            $result = $builder->get()->getResult();
        
            if (!empty($result)) {
                return $result[0]->rata_rata;
            } else {
                return 0.0;
            }
        }
        public function setOrder($data,$auth_token){
            $api_model = new Api_Model();
            if (!$api_model->initToken($auth_token)) {
                throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
            }
            $this->db->table("orderdb")->insert($data);
            return $this->db->insertID();
            
            }
        public function setOrderStatus($data,$auth_token){
            $api_model = new Api_Model();
            if (!$api_model->initToken($auth_token)) {
                throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
            }
            $builder = $this->db->table("customers");
            $builder->set('status_order', $data['status_order']);
            $builder->set('last_order_id', $data['last_order_id']);
            $builder->where('auth_token', $auth_token);
            $builder->update();
        }
        public function getOrderStatus($id){
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
    public function setOrderRating($data,$auth_token){
        $api_model = new Api_Model();
        if (!$api_model->initToken($auth_token)) {
            throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
        }
        $this->db->table("rating")->insert($data);
        return $this->db->insertID();
        }
        public function setOrderChat($data,$auth_token){
            $api_model = new Api_Model();
            if (!$api_model->initToken($auth_token)) {
                throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
            }
            $this->db->table("order_chat")->insert($data);
            return $this->db->insertID();
            }
        public function getOrderChat($id_order,$auth_token){
            $api_model = new Api_Model();
            if (!$api_model->initToken($auth_token)) {
                throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
            }
            $builder = $this->db->table("order_chat");
            $builder->select('*');
            $builder->where("order_id", $id_order);
            $builder->orderBy('waktu','ASC');
            return $builder->get()->getResult();
            }

            public function getOrderData($user_id){
                $builder = $this->db->table("orderdb as orders");
                $builder->select('orders.order_id, customers.nama, description.nama_bengkel, orders.deskripsi, orders.waktu, customers.nohp, orders.address, orders.status,orders.km_sebelum,orders.km_sesudah');
                $builder->join('customers', 'orders.id_customer = customers.id');
                $builder->join('locations', 'orders.id_location = locations.id');
                $builder->join('description', 'description.id_description = locations.description_id');
                $builder->where(array('orders.id_customer' => $user_id));
                $builder->orderBy('orders.order_id','DESC');
                return $builder->get()->getResult();
          }
          public function getBengkelShop($auth_token)
          {
                  $api_model = new Api_Model();
                  if (!$api_model->initToken($auth_token)) {
                      throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
                  }
                  $builder = $this->db->table("locations");
                  $builder->select('locations.id,locations.text_mark as nama_bengkel, locations.lat,locations.long as lng,d.jenis_bengkel,d.url_gambar,d.nohp,d.alamat_bengkel');
                  $builder->join('description as d', 'locations.description_id = d.id_description');
                  $result = $builder->get()->getResult();
                  return $result;
          }
          public function getItemCount($id_bengkel){
            $builder = $this->db->table("itemsdb");
            $builder->where('id_bengkel',$id_bengkel);
            return $builder->countAllResults();
          }

          public function getItemsData($id_bengkel,$auth_token){
            $api_model = new Api_Model();
            if (!$api_model->initToken($auth_token)) {
                throw new \Exception('Token tidak valid atau pengguna tidak ditemukan.');
            }
            $builder = $this->db->table("itemsdb");
            $builder->where('id_bengkel',$id_bengkel);
            return $builder->get()->getResult();
          }
}