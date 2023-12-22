<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Garage_Model extends Model{
    public function getLocation(){
        $builder = $this->db->table("locations as loc");
        $builder->select('loc.id,loc.lat,loc.long,desc.nama_bengkel,desc.alamat_bengkel');
        $builder->join('description as desc', 'loc.description_id = desc.id_description');
        return $builder->get()->getResult();
        }
    //						
}