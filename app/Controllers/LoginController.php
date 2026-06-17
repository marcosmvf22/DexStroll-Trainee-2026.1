<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LoginController
{
    public function login(){
        return view('site/login');
    }

    public function efetuaLogin()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = App::get('database') -> verificaLogin($email);
        


        if ($user && password_verify($senha, $user->senha)) 
        {

            session_start();

            $_SESSION['id'] = $user->id;

            header('Location: /dashboard');
            exit();
        }
        else 
        {

            session_start();

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