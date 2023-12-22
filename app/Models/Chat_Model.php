<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Chat_Model extends Model{
    public function getData($sender, $idsender,$receiver,$idreceiver)
    {
      return $this->db->table('conversation_db')
      ->select('*')
      ->where([$sender => $idsender,$receiver => $idreceiver])
      ->get()->getResultArray();
    }	
    public function setData($data){
        $this->db->table("conversation_db")->insert($data);
        return $this->db->insertID();
        }
}