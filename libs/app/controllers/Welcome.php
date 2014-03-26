<?php

class Welcome {

    public function __construct() {
        //parent::__construct();
    }

    public function index() {
        // Chama a pagina welcome_view na pasta /libs/app/view/
        $user = new User();
        if(Session::exists('user')) {
            $user = Session::get('user');
        }
        Routers::changePage('welcome_view', array('title'=>'Welcome Sweet PHP', 'user'=>$user));
    }

    public function contact() {
        // Insira seu código aqui
        // Ex:
        $user = new User();
        //Session::put($user);
        // Helpers::redirect('welcome', true);
        if(!Session::exists('user')) {
            if($user != Session::get('user')){
                Session::put('user', $user);
            }
        }
        return "Welcome {$user->login}";
    }
    
    public function redirect() {
        return Helpers::redirect('welcome/page', true);
    }
    
    public function backIndex() {
        return Helpers::redirect('welcome', true);
    }
    
    public function page() {
        Routers::changePage('page_view', array('title'=>'Page Test'));
    }
    
    public function listener() {
        $_SESSION['datetime'] = date('y');
        $ano = $_SESSION['datetime'];
    }

}
