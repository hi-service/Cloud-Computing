<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CurrentLocation_Model extends Model{
    public function getCurrentLocation($id){
        $builder = $this->db->table("locations as loc");
        $builder->select('loc.id,loc.lat,loc.long,desc.nama_bengkel,desc.alamat_bengkel');
        $builder->join('description as desc', 'loc.description_id = desc.id_description');
        $builder->where(array('loc.id' => $id));
        return $builder->get()->getResult();
        }
        
    //						
}