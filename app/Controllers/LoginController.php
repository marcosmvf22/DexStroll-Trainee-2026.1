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

// tentando manter  a alteração da isa  de admins:
    public function store(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

// pra ver se ta vazio
        if (
            empty(trim($_POST['nome'])) || 
            empty(trim($_POST['username'])) || 
            empty(trim($_POST['email'])) || 
            empty($_POST['senha']) || 
            empty($_POST['confirmaSenha'])
        ) {
            $_SESSION['mensagem-erro'] = 'Todos os campos são obrigatórios e não podem ficar em branco.';
            header('Location: /login');
            exit();
        }
// confirmar senha
        $senha = $_POST['senha'];
        $confirmaSenha = $_POST['confirmaSenha'];


        if ($senha !== $confirmaSenha) {
            $_SESSION['mensagem-erro'] = 'Senhas incompatíveis!!';
            header('Location: /login');
            exit();
        }

// validar se  a senha tem os  requisitos de seguranca
        $temTamanho = strlen($senha) >= 8;
        $temMaiuscula = preg_match('/[A-Z]/', $senha);
        $temMinuscula = preg_match('/[a-z]/', $senha);
        $temNumero = preg_match('/[0-9]/', $senha);

        if (!$temTamanho || !$temMaiuscula || !$temMinuscula || !$temNumero) {
            $_SESSION['mensagem-erro'] = 'A senha deve ter no mínimo 8 caracteres, 1 letra maiúscula, 1 minúscula e 1 número.';
            header('Location: /login');
            exit();
        }


        $existe = App::get('database')->selectWhereUser(
            'usuarios',
            ['email' => $_POST['email']]
        );

        if ($existe) {
            $_SESSION['mensagem-erro'] = 'Email já cadastrado.';
            header('Location: /login');
            exit();
        }


        $parameters = [
            'nome' => trim($_POST['nome']),
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'nivel_acesso' => 'usuario', 
        ];

        App::get('database')->insert('usuarios', $parameters);
        
        header('Location: /login');
        exit();
    }
}