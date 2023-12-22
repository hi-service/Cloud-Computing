<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Items_Model extends Model{
    public function getItem($id){
        $builder = $this->db->table("itemsdb");
        $builder->select('*');
        $builder->where('id_bengkel', $id);
        $result = $builder->get()->getResultArray();
        return $result;
      }
        public function getInvoiceItem($id){
        $builder = $this->db->table("itemsdb");
        $builder->select('*');
        $builder->where('id_barang', $id);
        $result = $builder->get()->getResultArray();
        return $result;
      }
      public function setInvoice($data){
        $this->db->table("itemorder_status")->insert($data);
        return $this->db->insertID();
        }
       public function setInvoiceItem($data){
        return $this->db->table("item_invoice")->insert($data);
        }
        public function getBengkelId($id){
          $builder = $this->db->table("itemorder_status");
          $builder->select('id_bengkel');
          $builder->where('id_order', $id);
          $result = $builder->get()->getResultArray();
          return $result;
        }
        public function getDataInvoiceOrder($id){
          $builder = $this->db->table("itemorder_status");
          $builder->select('* , description.nama_bengkel');
          $builder->where('id_order', $id);
          $builder->join('locations', 'itemorder_status.id_bengkel = locations.id');
          $builder->join('description', 'description.id_description = locations.description_id');
          $result = $builder->get()->getRowArray();
          return $result;
        }
        public function update_order_status($id,$data){
          return $this->db
              ->table('itemorder_status')
              ->where(["id_order" => $id])
              ->set($data)
              ->update();
          }		
        public function getItemOrder($id){
          $builder = $this->db->table("item_invoice as itin");
          $builder->select('item.nama_barang , itin.qty, item.price')
          ->join('itemsdb as item', 'itin.id_barang = item.id_barang')
          ->where('id_order', $id);
          return $builder->get()->getResultArray();
    }
}