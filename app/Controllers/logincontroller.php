<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LoginController
{

    public function efetuaLogin()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = App::get('database') -> verificaLogin(
            $email,
            $senha
        );

        if($user != false){
            session_start();

            $_SESSION['id'] = $user->id;

            header('Location: /dashboard');
            exit();
        }
        else{
            session_start();
            $_SESSION['mensagem-erro'] = 'Usuário ou senha incorretos!';
            header('Location: /login');
        }

    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header('Location: /login');
        exit();

    }

    public function dashboard(){
        return view('admin/dashboard');
    }
    public function login(){
        return view('site/login');
    }

    public function store(){
         $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
        ];

        if($_POST['senha'] == $_POST['confirmaSenha']){
             App::get('database')->insert('usuarios',$parameters);
        } else {
            $_SESSION['mensagem-erro'] = 'Senhas incompatíveis!!';
            
        }
           header('Location: /login');
    }
}