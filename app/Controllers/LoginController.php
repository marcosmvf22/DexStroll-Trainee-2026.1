<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LoginController
{
    public function login(){

        if (session_status() === PHP_SESSION_NONE) 
        {
        session_start();
        }

        if (isset($_SESSION['id'])) 
        {
            header('Location: /dashboard');
            exit();
        }

        return view('site/login');
    }

   public function efetuaLogin()
{
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $user = App::get('database')->verificaLogin($email);
    

    if ($user && password_verify($senha, $user->senha)) 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['id'] = $user->id;
        $_SESSION['nivel_acesso'] = $user->nivel_acesso; 

        if ($_SESSION['nivel_acesso'] === 'admin') {
            header('Location: /dashboard');
        } else {
            header('Location: /');
        }
        exit();
    }
    else 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['mensagem-erro'] = 'Usuário ou senha incorretos!';
        header('Location: /login');
        exit();
    }
}

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header('Location: /login');
        exit();

    }


    public function store(){
         $parameters = [
            'nome' => $_POST['nome'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
            'nivel_acesso' => 'usuario',
        ];

        $existe = App::get('database')->selectWhereUser(
            'usuarios',
            ['email' => $_POST['email']]
        );

        if ($existe) {
            session_start();
            $_SESSION['mensagem-erro'] = 'Email já cadastrado.';
            header('Location: /login');
            exit();
        }

        if($_POST['senha'] == $_POST['confirmaSenha']){
             App::get('database')->insert('usuarios',$parameters);
        } else {
            $_SESSION['mensagem-erro'] = 'Senhas incompatíveis!!';
            
        }
           header('Location: /login');
    }
}