<?php namespace App\Controllers;

use App\Models\Customer_Model;

class Login extends BaseController
{
	public function index()
	{  
      //Melakukan pengecekan apakah user sudah login atau belum
      //Jika belum akan mengembalikan ke login page
      if(session()->get('status') == 'logined'){
         return redirect()->to(base_url(''));
     }else{
         return view('login');
     }
		
   }
   
   public function login_action() 
   {

      $customer = new Customer_Model();

      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');
      // melakukan pengecekan apakah userame dan password ada
      $cek = $customer->get_data($username, $password);
      if($cek){
            session()->set('status', 'logined');
            session()->set('id_user', $cek['id']);
            session()->set('status_order', $cek['status_order']);
            session()->set('status_buy_order', $cek['status_buy_order']);
            session()->set('username', $cek['username']);
            session()->set('name', $cek['nama']);
            session()->set('nohp', $cek['nohp']);
            return redirect()->to(base_url(''));
         }
         else {
            session()->setFlashdata('gagal', 'Username / Password salah');
            return redirect()->to(base_url('login'));
         }
   }

   public function logout() 
   {
      // mematikan data session
      session()->destroy();
      return redirect()->to(base_url('login'));
   }
   public function register() 
   {
      return view('register');
   }
   public function submit_register()
   {
       // Mengambil data dari form
       $name = $this->request->getPost('name');
       $email = $this->request->getPost('username');
       $password = $this->request->getPost('password');
       $password_confirm = $this->request->getPost('password-confirm');
       $phoneNumber = $this->request->getPost('user-number');

       if(isset($name) && isset($email) && isset($password) && isset($password_confirm) && isset($phoneNumber)){
         $customer = new Customer_Model();
         $existingUser = $customer->existData($email);
         if ($existingUser) {
             // Email sudah ada dalam database, berikan respon sesuai kebutuhan Anda
             return redirect()->back()->withInput()->with('gagal', 'Email sudah terdaftar');
         }
         $customer->registerData([
             'nama' => $name,
             'username' => $email,
             'password' => $password,
             'nohp' => $phoneNumber,
             'status_order' => 'inactive',
             'last_order_id' => 0,
             'status_buy_order' =>'inactive',
             'buy_last_id' => 0
         ]);
         return redirect()->back()->withInput()->with('success', 'Register Berhasil Silahkan login');

     }else{
      return redirect()->back()->withInput()->with('gagal', 'Email Atau Data Tidak Valid');
     }
       }
      

      

}
