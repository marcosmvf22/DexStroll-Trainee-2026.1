<?php

namespace App\Controllers;

use App\Core\App; 

class listadeusuarioscontroller
{
    
// aqui defini algumas  funcoes para poder pegar do  banco de dados, e funcionar no controller
// ao  invés da view no JS, que era temporario so pra mostrar pro cliente
    public function index()
    {
        $usuariosDoBanco = App::get('database')->selectAll('usuarios');
        return view('admin/listadeusuarios', [
            'usuarios' => $usuariosDoBanco
        ]);
    }

   
    
    public function create()
    {
// aqui é meio que por segurança, pra nao renderizar uma celular vaziaetc
    if (empty($_POST['username']) || empty($_POST['nome']) || empty($_POST['email'])) {

        header('Location: /usuarios?erro=campos_obrigatorios');
            exit();
        }


        $existe = App::get('database')->selectWhere('usuarios', ['email' => $_POST['email']]);
        if ($existe) {
            header('Location: /usuarios?erro=email_duplicado');
            exit();
        }
// definindo variaveis de pra
        $dados = [
            'username' => $_POST['username'],
            'nome'     => $_POST['nome'],
            'email'    => $_POST['email'],
            'avatar'   => '/public/assets/default-avatar.png' //isso é temporário depois  temq ue implementar melhor
        ];


        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/avatars/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $nomeArquivo);
            $dados['avatar'] = '/public/uploads/avatars/' . $nomeArquivo;
        }
// implementa desse jeitoac ho que funciona
        App::get('database')->insert('usuarios', $dados);
        header('Location: /usuarios?sucesso=criado');
        exit();
    }

    
    // aqui ta  meio, ou 80% caminho andado, ve aí, achjo que  só falta o JS memso
    public function update()
    {
        if (empty($_POST['id'])) {
            header('Location: /usuarios?erro=id_nao_informado');
            exit();
        }

        $id = (int)$_POST['id'];
        $dados = [
            'username' => $_POST['username'] ?? '',
            'nome'     => $_POST['nome'] ?? '',
            'email'    => $_POST['email'] ?? ''
        ];


        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/avatars/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $nomeArquivo);
            $dados['avatar'] = '/public/uploads/avatars/' . $nomeArquivo;
        }

        App::get('database')->update('usuarios', $dados, ['id' => $id]);
        header('Location: /usuarios?sucesso=atualizado');
        exit();
    }

   
    
    public function delete()
    {
        if (empty($_POST['id'])) {
            header('Location: /usuarios?erro=id_nao_informado');
            exit();
        }

        $id = (int)$_POST['id'];
        App::get('database')->delete('usuarios', ['id' => $id]);
        header('Location: /usuarios?sucesso=deletado');
        exit();
    }

   
    
    public function getUsuarioJson()
    {
        if (empty($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID não informado']);
            return;
        }

        $id = (int)$_GET['id'];
        $usuario = App::get('database')->selectWhere('usuarios', ['id' => $id]);

        if (!$usuario) {
            http_response_code(404);
            echo json_encode(['erro' => 'Usuário não encontrado']);
            return;
        }


        echo json_encode($usuario[0]);
    }
}