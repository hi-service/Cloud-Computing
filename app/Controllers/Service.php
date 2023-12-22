<?php

namespace App\Controllers;

use App\Models\Admin_Model;
use App\Models\Chat_Model;
use App\Models\CurrentLocation_Model;
use App\Models\Customer_Model;
use App\Models\Garage_Model;
use App\Models\Items_Model;
use App\Models\Order_Model;

class Service extends BaseController
{
    
    public function index()
    {   
        if(session()->get('status') == 'logined'){
            if(session()->get('status_order') == 'active' || session()->get('status_buy_order') == 'active'){
                return redirect()->to(base_url('service/auth'));
            }else{
        session()->remove('idValid');
        $Location = new Garage_Model();

        $description = $Location->getLocation();
        #Mengambil data 
        $lat = $this->request->getPost('saved_lat');
        $lng = $this->request->getPost('saved_lng');
        session()->set('lat',$lat);
        session()->set('lng',$lng);
        $garageData = array();
        foreach($description as $locData):
            $distance  = $this->getDistanceBetween($lat,$lng,$locData->lat,$locData->long);
            $newGarageData = array(
                'id_bengkel' => $locData->id,
                'nama_bengkel' => $locData->nama_bengkel,
                'jarak' => $distance,
                'alamat_bengkel' => $locData->alamat_bengkel
            );
            if($distance < 20){
                array_push($garageData,$newGarageData);
            }
        endforeach;
        
        //````````````````````````````````
        $sortValues = array_column($garageData, 'jarak');
        array_multisort($sortValues, SORT_ASC, $garageData);
        //Memasukkan array id_bengkel untuk menjadi session agar bisa di akses di auth
        $idValid = implode("|",array_column($garageData, 'id_bengkel'));
        session()->set('idValid',$idValid);
        $address =  $this->request->getPost('saved_address');
        session()->set('address',$address);
        $data = array(
            'address' => $address,
            'garageData' => $garageData,
        );

            return view('service',$data);
        }
        }else{
            return redirect()->to(base_url('login'));
        }
        
    }
    public function auth(){
        $Order_Model = new Order_Model();
        $Customer = new Customer_Model();
        $Item_Model = new Items_Model();
        if(session()->get('status') == 'logined'){
            if(session()->get('status_order') == 'active'){
                $locID_stat = $Order_Model->getData_Active('id_customer',session()->get('id_user'));
            if($locID_stat['status'] == 'waiting' || $locID_stat['status'] == 'ongoing' || $locID_stat['status'] == 'rejected'){
                $locID = $locID_stat['id_location'];
                session()->set("locID",$locID);
                return redirect()->to(base_url('/service/dashboard'));
            }else{
                return redirect()->to(base_url(''));
            }
            }elseif(session()->get('status_buy_order') == 'active'){
                $idLastItemOrder = $Customer->getLastInvoiceId('id', session()->get('id_user'));
                $idBengkel = $Item_Model->getBengkelId($idLastItemOrder);
                session()->set("locID",$idBengkel[0]['id_bengkel']);
                
                return redirect()->to(base_url('/service/dashboard'));
            }else{
            $locID = $this->request->getGet('loc_id');
            $validId = session()->get('idValid');
            $arrValidId = explode("|",$validId);
            $check= false;
            foreach($arrValidId as $valid):
                if($locID == $valid){
                    $check = true;
                    break;
                }else{
                }
            endforeach;
                if($check){
                    session()->set("locID",$locID);
                    return redirect()->to(base_url('/service/dashboard'));
                }else{
                    die('403 Fobidden');
                }
            }
        }else{
                return redirect()->to(base_url('login'));
        }


    }
    public function dashboard(){
        $check = session()->get('locID');
        if(session()->get('status') == 'logined'){
            if(isset($check)){
            $customer = new Customer_Model();
            $Location = new CurrentLocation_Model();
            $user_status = $customer->getSingleData('id',session()->get('id_user'));
            session()->set('status_order',$user_status['status_order']);
            $description = $Location->getCurrentLocation(session()->get("locID"));
            $nama_bengkel = array_column($description, 'nama_bengkel');
            session()->set('nama_bengkel',$nama_bengkel[0]);
            return view('dashboard_service');
            }
            else{
                return redirect()->to(base_url(''));
            }
        }else{
            return redirect()->to(base_url('login'));
        }

    }
    public function order(){
        $check = session()->get('locID');
    if(session()->get('status') == 'logined'){
        if(session()->get('status_order') == 'active'){
            return redirect()->to(base_url('service/status_order'));
        }else{
            return view('order');
        }
        
    }else{
        return redirect()->to(base_url('login'));
    }
    }
 
       
        
    public function auth_order()
    {
        if ($this->request->getMethod() == 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'description' => 'required',
                'nohp' => 'required'
            ]);
            if ($validation->withRequest($this->request)->run()) {
                
                $id_location = session()->get('locID');
                $id_customer = session()->get('id_user');
                $user_lat = session()->get('lat');
                $user_lng = session()->get('lng');
                $user_address = session()->get('address');
                $user_nohp = $this->request->getPost('nohp');
                $description = $this->request->getPost('description');
                
                $ordermdl = new Order_Model();
                $customer = new Customer_Model();
                $db_data = [
                    'id_customer' => $id_customer,
                    'id_location' => $id_location,
                    'deskripsi' => $description,
                    'nohp' => $user_nohp ,
                    'lat' => $user_lat ,
                    'lng' => $user_lng,
                    'address' => $user_address,
                    'status' => "waiting"
                ];
               
                $id_order = $ordermdl->setData($db_data);
                $customer->set_data($id_customer,['last_order_id' => $id_order]);
                $customer->set_data($id_customer,['status_order' => 'active']);
                // Menampilkan data status 
                $data =[
                    "id_order" =>  $id_order,
                    "nama_user" => session()->get("name"),
                    "nama_bengkel" => session()->get("nama_bengkel"),
                    "alamatuser"   => session()->get("address"),
                    "no_hp"        => $user_nohp,
                    "deskripsi"     => $this->insertLineBreaks($description)
                ];
                session()->set('status_order','active');
                return redirect()->to(base_url('service/auth_order_out'))->with('data',$data);
            } else {
                session()->setFlashdata('error', $validation->getErrors());
                return redirect()->back();
            }
        } else {
            echo "Akses Ditolak";
        }
    }
    
    public function auth_order_out()
    { 
        $data = session()->getFlashdata('data');
        if(isset($data)){
            session()->set('status_order','active');
            return view('auth_order', $data);
        }else{
            echo "Akses Ditolak!";
        }
        
    }
    public function status_order(){
        if(session()->get('status') == 'logined' && (session()->get('status_order') == 'active')){
            $customer = new Customer_Model();
            $Order = new Order_Model();
            $id_customer = session()->get('id_user');
            $getLastOrder = $customer->getLastOrder('id',$id_customer);
            $data_order = $Order->getOrder($getLastOrder);
            $data = [
                'id_order' => $getLastOrder,
                'data_order' => $data_order
            ];
        return view('order_status',$data);
        }else{
            echo 'Akses Ditolak';
        }
    }
    public function auth_status(){
        if(session()->get('status') == 'logined' && (session()->get('status_order') == 'active')){
        $order_id = request()->getPost('order_id');
        $status = request()->getPost('status');
        $id_user = request()->getPost('id_user');
        $Order_Model = new Order_Model();
        $Customer_Model = new Customer_Model();
        
        if(isset($id_user)){
            $Customer_Model->set_data($id_user,['status_order' => 'inactive','last_order_id' => '0']);
            session()->set('status_order','inactive');
        }elseif(isset($order_id) && isset($status)){
            $Order_Model->update_order_status($order_id,['status' => $status]);
        }else{
            echo 'Akses Ditolak!';
        }
        }else{
            echo 'Akses Ditolak!';
        }



    }
    public function conversation(){
        $check = session()->get('locID');
        if(session()->get('status') == 'logined' || isset($check)){
            return view('conversation');
        }else{
            return redirect()->to(base_url('login'));
        }

        
    }
    public function get_message(){
         $get_user = $this->request->getGetPost('user');
            $chatModel = new Chat_Model();
            $id_user = $get_user;
            $id_bengkel = 2;
            $messages = $chatModel->getData('id_user',$id_user,'id_bengkel',$id_bengkel);
            return json_encode($messages);
        }
        public function send_message(){
            
            $chatModel = new Chat_Model();
            $id_user = session()->get('id_user');
            $id_bengkel = session()->get('locID');
            $message = request()->getPost('message');
            $sender = request()->getPost('sender');
            $data = ['id_user' => $id_user,
            'id_bengkel' => $id_bengkel,
            'message' => $message,
            'sender' => $sender
        ];  
        $check = session()->get('locID');
        if(session()->get('status') == 'logined' || isset($check)){
            $chatModel->setData($data);
        }else{
            return redirect()->to(base_url('login'));
        }
        }
    public function order_barang(){
        $check = session()->get('locID');
        if(session()->get('status_buy_order') == 'active'){
            return redirect()->to(base_url('/service/status_invoice'));
        }else if(session()->get('status') == 'logined' || isset($check)){
        if(session()->has('userInvoice')){
            session()->remove('userInvoice');
        }
        $items = new Items_Model();
        $id_bengkel = session()->get('locID');
        $data = [
            'itemData' => $items->getItem($id_bengkel)
        ];
        return view('order_barang.php',$data);
        }else{
            return redirect()->to(base_url('login'));
        }

       
    }
    public function set_invoice(){
        $id_barang = request()->getPost('id_barang');
        $qty = request()->getPost('qty');
        $data = [];
        if(isset($id_barang) && isset($qty)){
            if(session()->has('userInvoice')){
                $data = session()->get('userInvoice');
                $id_newdata = $data['id_barang'] . '|' . $id_barang ;
                $qty_newdata = $data['qty'] . '|' . $qty ;
                $data = ['id_barang' => $id_newdata, 'qty' => $qty_newdata];
                session()->set('userInvoice',$data);
            }else{
                $data = ['id_barang' => $id_barang, 'qty' => $qty];
                session()->set('userInvoice',$data);
            }
        }else{
            echo 'Akses Ditolak !';
        }

       
        
    }
    public function getInvoice(){
        
        $item_model = new Items_Model();
        $sessionData = session()->get('userInvoice');
        if(isset($sessionData)){
            $id_barang = explode('|',$sessionData['id_barang']);
            $qty = explode('|',$sessionData['qty']);
            
            $newData = [];
            for($i=0;$i<count($id_barang);$i++){
                $db_data = $item_model->getInvoiceItem($id_barang[$i]);
                $newData = array_merge($newData, $db_data);
            }
            $data = [
                'detail_item' => $newData,
                'qty'         => $qty
            ];
            return view('get_invoice',$data);
        }else{
            echo 'Akses Ditolak!';
        }
       
    }
        public function set_invoice_status(){ // Melakukan pengambilan data barang yang sesuai dari database lalu memasukkan ke dalam invoice
        $item_model = new Items_Model();
        $sessionData = session()->get('userInvoice');
        $id_barang = explode('|',$sessionData['id_barang']);
        $qty = explode('|',$sessionData['qty']);
        $shipping = request()->getPost('shipping');
        if(isset($shipping)){
            $newData = [
                'id_user'	=> session()->get('id_user'),
                'id_bengkel' => session()->get('locID'),
                'status'	=>  'waiting',
                'shipping'	=>  $shipping ,
                'lat'       => session()->get('lat'),
                'lng'       => session()->get('lng'),
                'address'       => session()->get('address'),
            ];
    
            $id_invoice = $item_model->setInvoice($newData);
            $id_invoice_string = strval($id_invoice);
            for($i=0;$i<count($id_barang);$i++){
                $itemData = [        
                'id_barang' 	=> $id_barang[$i],
                'qty'       	=> $qty[$i],
                'id_order'      => $id_invoice_string
            ];
            $item_model->setInvoiceItem($itemData);
            }
            session()->setFlashdata('id_order' , $id_invoice_string);
            session()->setFlashdata('detail',$newData);
            $customer  = new Customer_Model();
            $customer->setCustomerOrderData(session()->get('id_user'),
            array('status_buy_order' => 'active','buy_last_id' => $id_invoice_string));
            session()->set('status_buy_order', 'active');
        }else{
            echo 'Akses Ditolak!';
        }

   }
   public function print_invoice(){ // Melakukan Print Invoice yang telah dibuat
    $order_mdl = new Admin_Model();
    $id_order = session()->getFlashdata('id_order');
    $detail = session()->getFlashdata('detail');
    if(session()->getFlashdata('id_order')!= null){
        $data = [
            'id_order'  =>       $id_order,
            'detail'    =>       $detail,
            'detail_item' =>       $order_mdl->getItemOrder($id_order)
        ];
        return view('print_invoice', $data);
    }else{
        echo "Akses Ditolak!";
    }
   }
   public function status_invoice(){
    
    if(session()->get('status') == 'logined' && (session()->get('status_buy_order') == 'active')){
        $customer = new Customer_Model();
        $Item = new Items_Model();
        $id_customer = session()->get('id_user');
        $getLastOrder = $customer->getLastInvoiceId('id',$id_customer);
        $data_order = $Item->getDataInvoiceOrder($getLastOrder);
    $data_item = $Item->getItemOrder($getLastOrder['buy_last_id']);
    $dataContent = '<table>';
    $dataContent .= '<tr><th>Nama Barang</th><th>Qty</th><th>Harga Satuan</th><th>Total Harga</th></tr>';
        $harga = 0;
        $hargatotal = 0;
        for($i=0;$i<count($data_item);$i++){
            $harga = (int)$data_item[$i]['price'] * $data_item[$i]['qty'];
            $hargatotal += $harga;
                $dataContent .= '<tr>';
                $dataContent .= '<td>' . $data_item[$i]['nama_barang'] . '</td>';
                $dataContent .= '<td>' . $data_item[$i]['qty'] . '</td>';
                $dataContent .= '<td>' . $data_item[$i]['price'] . '</td>';
                $dataContent .= '<td>' . $harga  . '</td>';
                $dataContent .= '</tr>';
        }
    $dataContent .= '<tr>';
    $dataContent .= '<td colspan="3">Grand Total</td>';
    $dataContent .= '<td>' .$hargatotal . '</td>';
    $dataContent .= '<tr>';
    $dataContent .= '</table>';
        $data = [
            'id_order' => $getLastOrder,
            'data_order' => $data_order,
            'data_item'  => $dataContent
        ];
    return view('status_invoice',$data);
    }else{
        echo 'Akses Ditolak';
    }
    }
    public function set_invoice_order_status(){
        if(session()->get('status') == 'logined' && (session()->get('status_buy_order') == 'active')){
            $order_id = request()->getPost('order_id');
            $status = request()->getPost('status');
            $id_user = request()->getPost('id_user');
            $Items = new Items_Model();
            $Customer_Model = new Customer_Model();
            
            if(isset($id_user)){
                $Customer_Model->set_data($id_user,['status_buy_order' => 'inactive','buy_last_id' => '0']);
                session()->set('status_buy_order','inactive');
            }elseif(isset($order_id) && isset($status)){
                $Items->update_order_status($order_id,['status' => $status]);
            }else{
                echo 'Akses Ditolak!';
            }
            }else{
                echo 'Akses Ditolak!';
            }
    }

}