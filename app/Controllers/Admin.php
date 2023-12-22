<?php


namespace App\Controllers;

use App\Models\Admin_Model;
use App\Models\Chat_Model;

class Admin extends BaseController
{
    public function index()
    {
        $admin_model = new Admin_Model();
        
        if(session()->get('status') == 'admin_login'){
            $data = [
                'data'=> (string) current_url(true)
            
        ];
        $dashboardData=[                
                'allData' => $admin_model->getAllData(session()->get('id_admin')),
                'completeData' => $admin_model->getDataComplete(session()->get('id_admin')),
                'waitingData' =>$admin_model->getDataWaiting(session()->get('id_admin'))
                        ];
        return view('admin/sidebar',$data) . view('admin/dashboard.php',$dashboardData);
        }else{
            return redirect()->to(base_url('admin/login'));
        }

    }   

    public function login(){
        if(session()->get('status') == 'admin_login'){
            return redirect()->to(base_url('admin'));
        }else{
            return view('admin/login');
        }
    }
    public function auth_login(){
        if(session()->get('status') == 'admin_login'){
            return redirect()->to(base_url('admin'));
        }else{
            $admin_model = new Admin_Model();

            $username = $this->request->getPost('admin_username');
            $password = $this->request->getPost('admin_password');
            // melakukan pengecekan apakah userame dan password ada
            $cek = $admin_model->get_data($username, $password);
            if($cek){
                session()->set('status','admin_login');
                session()->set('id_admin',$cek['id_partner']);
                session()->set('nama_bengkel_admin',$cek['nama_bengkel']);
                return redirect()->to(base_url('admin'));
               }
               else {
                  session()->setFlashdata('gagal', 'Username / Password salah');
                  return redirect()->to(base_url('admin/login'));
               }
        }

    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
    
    public function order(){
        if(session()->get('status') == 'admin_login'){
        $Admin_Model = new Admin_Model();
        $order_data['orders'] = $Admin_Model->getOrder(session()->get('id_admin'));
        $data = ['data'=> (string) current_url(true)];
        return view('admin\sidebar',$data) . view('admin\order.php',$order_data);
        }else{
            return redirect()->to(base_url('admin/login')); 
        }
    }
    public function auth_order(){
        $order_id = request()->getPost('order_id');
        $status = request()->getPost('status');
        $Admin_Model = new Admin_Model();
        if(isset($order_id) && isset($status)){
            $Admin_Model->update_order_status($order_id,['status' => $status]);
        }else{
            echo 'Akses Ditolak!';
        }

    }
    public function inventory(){
        $admin_model = new Admin_Model();
        $data_item['data_item'] = $admin_model->getItem(session()->get('id_admin'));

        if(session()->get('status') == 'admin_login'){
            $data = [
                'data'=> (string) current_url(true)
        ];
            
        return view('admin\sidebar',$data) . view('admin\inventory.php',$data_item);
        }else{
            return redirect()->to(base_url('admin/login'));
        }
    }
    public function cs_page(){
        if(session()->get('status') == 'admin_login'){
            $admin_model = new Admin_Model();
            $userChat = $admin_model->getUserChat(session()->get('id_admin'));
            $data = ['data'=> (string) current_url(true),
                'user_chat' => $userChat
                    ];
            return view('admin\sidebar',$data) . view('admin\cs_page.php');
        }
        else{
            return redirect()->to(base_url('admin/login')); 
        }

    }
    public function get_message(){

        $chatModel = new Chat_Model();
        $id_bengkel = session()->get('id_admin');
        $id_user = request()->getPost('id_user');
        if($id_user && isset($id_bengkel)){
            $messages = $chatModel->getData('id_user',$id_user,'id_bengkel',$id_bengkel);
            return json_encode($messages);
        }else{
            echo 'Akses ditolak';
        }
    }
    public function send_message(){
        $chatModel = new Chat_Model();
        $id_bengkel = session()->get('id_admin');
        $id_user = request()->getPost('id_user');
        $message = request()->getPost('message');
        $sender = request()->getPost('sender');
        if(isset($id_bengkel) &&isset($id_user) && isset($message) && isset($sender)){
            $data = ['id_user' => $id_user,
            'id_bengkel' => $id_bengkel,
            'message' => $message,
            'sender' => $sender
        ];  
            $chatModel->setData($data);
        }else{
            echo 'Akses ditolak';
        }
    }
    public function add_item()
    {   
        $admin_model = new Admin_Model();
        if ($this->request->getMethod() === 'post') {
            $namaBarang     = $this->request->getPost('nama_barang');
            $qtyBarang      = $this->request->getPost('qty_barang');
            $hargaBarang    = $this->request->getPost('harga_barang');
            $file           = $this->request->getFile('userfile');
            $uploadDir      = ROOTPATH . 'public/uploads/img/items';
            
            if(isset($namaBarang) && isset($qtyBarang) && isset($hargaBarang) && isset($file)){
                $newName = $file->getRandomName();

                // Pindahkan file foto ke direktori penyimpanan
                if ($file->isValid() && !$file->hasMoved()) {
                    // Validasi ekstensi file
                    $allowedExtensions = ['jpg', 'png'];
                    $fileExtension = $file->getExtension();
                
                    if (!in_array($fileExtension, $allowedExtensions)) {
                        // Ekstensi file tidak valid
                        // Lakukan tindakan yang sesuai, misalnya, tampilkan pesan kesalahan
                        echo "Hanya file dengan ekstensi JPG atau PNG yang diizinkan.";
                    } else {
                        // Ekstensi file valid, pindahkan file ke direktori penyimpanan
                        $file->move($uploadDir, $newName);
                        $data = [
                            'nama_barang' => $namaBarang,
                            'qty' => $qtyBarang,
                            'price' => $hargaBarang,
                            'image' => $newName,
                            'id_bengkel' => session()->get('id_admin')
                        ];
                        
                        $admin_model->addItem($data);
                        return redirect()->to(base_url('admin/inventory')); 
                    }
                }
                
            }else{
                echo 'Akses Ditolak';
            }
            

            
    }else{
        echo 'Akses Ditolak';
    }

}
            public function update_item(){
                $admin_model = new Admin_Model();
                $id_barang     = $this->request->getPost('id_barang');
                $namaBarang     = $this->request->getPost('nama_barang');
                $qtyBarang      = $this->request->getPost('qty_barang');
                $hargaBarang    = $this->request->getPost('harga_barang');
                $data = [
                    'nama_barang' => $namaBarang,
                    'qty' => $qtyBarang,
                    'price' => $hargaBarang,
                ];
                $admin_model->updateItem($id_barang ,session()->get('id_admin'), $data);
            }
            public function delete_item(){
                $admin_model = new Admin_Model();
                $id_barang   = $this->request->getPost('id_barang');
                $admin_model->deleteItem($id_barang ,session()->get('id_admin'));
            }
            public function order_item(){
                if(session()->get('status') == 'admin_login'){
                    $item_model = new Admin_Model();
                    $invoiceStatus = $item_model->getInvoiceItem(session()->get('id_admin'));
                    $viewData = [
                    'invoiceStatus' => $invoiceStatus
                    ];
                    $data = [
                        'data'=> (string) current_url(true)
                    ];
                    return view('admin\sidebar',$data) . view('admin\order_item.php',$viewData);
                    }else{
                        return redirect()->to(base_url('admin/login')); 
                    }
            }
            public function update_order_status(){
                $order_id = request()->getPost('order_id');
                $status = request()->getPost('status');
                $Admin_Model = new Admin_Model();
                if(isset($order_id) && isset($status)){
                    $Admin_Model->updateItemOrderStatus($order_id,['status' => $status]);
                }else{
                    echo 'Akses Ditolak!';
                }
            }
            public function getOrderMessage(){
                $admin_model = new Admin_Model();
                $idOrder = $this->request->getGet();
                $messages = $admin_model->getOrderChat($idOrder['order_id']);
                return json_encode($messages);
            }
            public function sendOrderMessage(){
                $admin_model = new Admin_Model();
                $id_user = request()->getPost('order_id');
                $message = request()->getPost('message');
                $sender = request()->getPost('sender');
                    $data = [
                    'order_id' => $id_user,
                    'message' => $message,
                    'sender' => $sender ];
                $admin_model->setOrderChat($data);
            }
            public function cs_order_page(){
                if(session()->get('status') == 'admin_login'){
                    $idOrders = $this->request->getGet();
                    
                    $data = [
                        'id_order' => $idOrders["id_order"]
                    ];
                    return view('admin/mobile_conversation.php',$data);
                }
                else{
                    return redirect()->to(base_url('admin/login')); 
                }
        
            }
            public function setNextOrderKM(){
                if(session()->get('status') == 'admin_login'){
                    $admin_model = new Admin_Model();
                    $postData = $this->request->getPost();
                    $kmData = ['km_sebelum' => $postData['km_sebelum'],'km_sesudah' => $postData['km_sesudah']];
                    $messages = $admin_model->update_order_status($postData['order_id'],$kmData);
                    return json_encode($messages);
            }
        }
}
