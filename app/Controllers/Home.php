<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        
        // Mendapatkan instance dari database
        $db = \Config\Database::connect();

        // Membuat Query Biasa
        $query = $db->query("SELECT * FROM locations");

        // Mengirim data ke view
        $data = [
            'items' => $query->getResult()
        ];
        
        if(session()->get('status') == 'logined'){
            if(session()->get('status_order') == 'active' || session()->get('status_buy_order') == 'active'){
                return redirect()->to(base_url('service/auth'));
            }{
                return view('welcome_message',$data);
            }
            
        }else{
            return redirect()->to(base_url('login'));
        }
    }   
}
