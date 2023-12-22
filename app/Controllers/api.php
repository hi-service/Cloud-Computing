<?php

namespace App\Controllers;

use PHPUnit\Util\Json;
use Ramsey\Uuid\Uuid;
use App\Models\Api_Model;
use CodeIgniter\API\ResponseTrait;
use Ramsey\Uuid\Type\Integer;

class api extends BaseController
{
    use ResponseTrait;

    public function register()
    {
        try {
            $api_model = new Api_Model();
    
            $postData = $this->request->getPost();
            $user_id = $postData['uid'];
            $user_name = $postData['name'];
    
            // Check if uid or name is null and throw an exception
            if ($user_id == null || $user_name == null) {
                throw new \Exception('uid and name fields are required.');
            }
            
            $user_data = [
                'id' => $user_id,
                'nama' => $user_name
            ];
            
            $api_model->Register($user_data);
    
            $data = [
                'status' => 'Success',
                'message' => 'Pendaftaran Berhasil, Silahkan lakukan Login.'
            ];
    
            return $this->respond($data);
        } catch (\Exception $e) {
            // Exception occurred
            $data = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
    
            return $this->respond($data, 500);
        }
    }
    public function login()
    {
        try {
            $api_model = new Api_Model();
    
            $postData = $this->request->getPost();
            $user_id = $postData['uid'];
            
            // Check if uid or name is null and throw an exception
            if ($user_id == null) {
                throw new \Exception('uid fields are required.');
            }
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            
            $user_data = [
                'id' => $user_id,
                'auth_token' => $uuidString,
                'fcm_token' => $postData['fcm_token']
            ];
            
            $api_model->Login($user_data);
            $data = [
                'status' => 'Success',
                'data' => $user_data
            ];
    
            return $this->respond($data);
        } catch (\Exception $e) {
            // Exception occurred
            $data = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            return $this->respond($data, 500);
        }
    }
    public function getUserData()
{
    try {
        $api_model = new Api_Model();

        // Mendapatkan token dari data POST
        $auth_header = $this->request->getHeaderLine('Authorization');

        // Verifikasi token dan mendapatkan data pengguna
        $userData = $api_model->getUserData($auth_header);

        $data = [
            'status' => 'Success',
            'data' => $userData
        ];

        return $this->respond($data);
    } catch (\Exception $e) {
        // Exception occurred
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}

public function getBengkel()
{
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $data_lokasi = $api_model->getBengkel($auth_header);
        $postData = $this->request->getGet();
        $lat = $postData['lat'];
        $lng = $postData['lng'];
        $garageData = array();
        foreach($data_lokasi as $locData):
            $rating = $api_model->getBengkelById_Rating($locData->id,$auth_header);
            $distance  = $this->getDistanceBetween($lat,$lng,$locData->lat,$locData->lng);

            $newData= array(
                "id" => $locData->id,
                "nama_bengkel" => $locData->nama_bengkel,
                "lat" => (float) $locData->lat,
                "lng" => (float) $locData->lng,
                "jenis_bengkel" => $locData->jenis_bengkel,
                "jarak" => $this->getDistanceBetween($lat,$lng,$locData->lat,$locData->lng),
                "url_photo" => $locData->url_gambar,
                "rating" =>(float) $rating
            );
            $normalData = array(
                "id" => $locData->id,
                "nama_bengkel" => $locData->nama_bengkel,
                "lat" => (float) $locData->lat,
                "lng" => (float) $locData->lng,
                "jarak" => $this->getDistanceBetween($lat,$lng,$locData->lat,$locData->lng),
                "jenis_bengkel" => $locData->jenis_bengkel,
                "url_photo" => $locData->url_gambar,
                "rating" => 0
            );
            if($distance<20){
                if($rating !=0){
                    array_push($garageData,$newData);
                }else{
                    array_push($garageData,$normalData);
                }
            }else if($lat == 0.0  && $lng==0.0){
                if($rating !=0){
                    array_push($garageData,$newData);
                }else{
                    array_push($garageData,$normalData);
                }
            }

        endforeach;
        $data = [
            'status' => 'Success',
            'data' => $garageData
        ];

        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function getKeluhan()
{
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $data_lokasi = $api_model->getKeluhan($auth_header);
        $data = [
            'status' => 'Success',
            'data' => $data_lokasi
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function getBengkelDesc($dataID)
{
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $data_lokasi = $api_model->getBengkelById($auth_header,$dataID);
        $rating = $api_model->getBengkelById_Rating($dataID,$auth_header);
        if ($rating == null) {
            $rating = 0.0;
        }
        $data = [
            'status' => 'Success',
            'data' => $data_lokasi,
            'rating' => (float) $rating
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function setOrder()
{
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $postData = $this->request->getPost();
        $user_id = $api_model->getUserData($auth_header);
        $bengkelTujuan = $postData['bengkel'];
        $db_data = [
            'id_customer' => $user_id->id,
            'id_location' => $bengkelTujuan,
            'deskripsi' => $postData['desc'],
            'nohp' => $postData['nohp'],
            'lat' => $postData['lat'],
            'lng' => $postData['lng'],
            'address' => $postData['address'],
            'status' => "waiting"
        ];
        $id_order = $api_model->setOrder($db_data,$auth_header);
        $dataUser = [
            "status_order" => "active",
          "last_order_id" => $id_order
        ];
        $api_model->setOrderStatus($dataUser,$auth_header);
        $data = [
            'status' => 'Success',
            'message' => 'Order berhasil dibuat, tunggu hingga bengkel mengambil pesananmu.'
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function getOrderStatus()
{
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $user_id = $api_model->getUserData($auth_header);
        
        $data = [
            'status' => 'Success',
            'order_data' => $api_model->getOrderStatus($user_id->last_order_id)
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function setOrderStatusDone(){
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $user_id = $api_model->getUserData($auth_header);
        $postData = $this->request->getPost();
        $api_model->update_order_status($user_id->last_order_id,['status' => $postData['orderstatus']]);
        $dataUser = [
            "status_order" => "inactive",
          "last_order_id" => 0
        ];
        $api_model->setOrderStatus($dataUser,$auth_header);
        $data = [
            'status' => 'Success',
            'order_status' => "Status order berhasil diselesaikan"
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function setOrderRating(){
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $user_id = $api_model->getUserData($auth_header);
        $postData = $this->request->getPost();
        $dataUser = [
            "rating" => $postData['rating'],
            "id_bengkel" => $postData['id_bengkel'],
          "user_id" => $user_id->id,
          "statement" => $postData['statement'],
          
        ];
        $api_model->setOrderRating($dataUser,$auth_header);
        $data = [
            'status' => 'Success',
            'rating_status' => "Rating berhasil disimpan"
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function setOrderChat(){
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $postData = $this->request->getPost();
        $dataUser = [
        "order_id" => $postData['id_order'],
          "message" => $postData['message'],
          "sender" => 1,
        ];

        $api_model->setOrderChat($dataUser,$auth_header);
        $data = [
            'status' => 'Success',
            'message' => "Chat berhasil dikirim"
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function getOrderChat($order_id){
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');        
        $data = [
            'status' => 'Success',
            'chat' => $api_model->getOrderChat($order_id,$auth_header)
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}

public function getOrderHistory(){
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');        
        $user_id = $api_model->getUserData($auth_header);
        $data = [
            'status' => 'Success',
            'data' =>  $api_model->getOrderData($user_id->id)
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function getBengkelShop()
{
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');
        $data_lokasi = $api_model->getBengkelShop($auth_header);
        $garageData = array();
        $postData = $this->request->getGet();
        $lat = $postData['lat'];
        $lng = $postData['lng'];
        foreach($data_lokasi as $locData):
            $totaldata = $api_model->getItemCount($locData->id);

            $newData= array(
                "id" => $locData->id,
                "nama_bengkel" => $locData->nama_bengkel,
                "lat" => (float) $locData->lat,
                "lng" => (float) $locData->lng,
                "alamat_bengkel" => $locData->alamat_bengkel,
                "url_photo" => $locData->url_gambar,
                "total_barang" =>(float) $totaldata,
                "jarak" => $this->getDistanceBetween($lat,$lng,$locData->lat,$locData->lng),
            );
            
            if($totaldata!=0){
                array_push($garageData,$newData);
            }
            
        endforeach;
        $data = [
            'status' => 'Success',
            'data_bengkel_shop' => $garageData
        ];

        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
public function getItemsData($bengkel){
    try {
        $api_model = new Api_Model();
        $auth_header = $this->request->getHeaderLine('Authorization');        
        $data = [
            'status' => 'Success',
            'data' =>  $api_model->getItemsData($bengkel,$auth_header)
        ];
        
        return $this->respond($data);
    } catch (\Exception $e) {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        return $this->respond($data, 500);
    }
}
}

