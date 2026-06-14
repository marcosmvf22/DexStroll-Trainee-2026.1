<?php

namespace App\Controllers;

use App\Core\App; 

class listadeusuarioscontroller
{
    
    // aqui defini algumas  funcoes para poder pegar do  banco de dados, e funcionar no controller
    // ao  invés da view no JS, que era temporario so pra mostrar pro cliente
    
   public function index()
    {

        if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $usuarioLogado = App::get('database')->selectOne(
                    'usuarios',
                    $_SESSION['id']
                );

 
        $database = App::get('database');

        $limit = 6;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if($currentPage < 1){
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $limit;


        $pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';


        if ($pesquisa !== '') {
            $totalUsuarios = $database->countSearch('usuarios', $pesquisa);
            $totalPages = ceil($totalUsuarios / $limit);
            $usuariosDoBanco = $database->paginateSearch('usuarios', $pesquisa, $limit, $offset);
        } 
        else{
            $totalUsuarios = $database->countAll('usuarios');
            $totalPages = ceil($totalUsuarios / $limit);
            $usuariosDoBanco = $database->paginate('usuarios', $limit, $offset);
        }


        return view('admin/listadeusuarios', [
            'usuarios' => $usuariosDoBanco,
            'currentPage' => $currentPage,
            'totalPage' => $totalPages,
            'totalUsuarios' => $totalUsuarios,
            'pesquisa' => $pesquisa,
            'usuarioLogado' => $usuarioLogado
        ]);
    }

    
    public function create()
    {
        // aqui é meio que por segurança, pra nao renderizar uma celular vazia,etc
        if (empty($_POST['username']) || empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']))
        {    
            header('Location: /usuarios?erro=campos_obrigatorios');
            exit();
        }
            
            
        $existe = App::get('database')->selectWhereUser('usuarios', ['email' => $_POST['email']]);
        if ($existe) 
        {
            header('Location: /usuarios?erro=email_duplicado');
            exit();
        }

                
        // definindo variaveis
        $dados = 
        [
            'username' => $_POST['username'],
            'nome'     => $_POST['nome'],
            'email'    => $_POST['email'],
            'senha'    => password_hash($_POST['senha'], PASSWORD_DEFAULT),
            'avatar'   => '/public/assets/default-avatar.png'
        ];

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) 
        {
            $uploadDir = __DIR__ . '/../../public/uploads/avatars/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid() . '.' . $ext;

            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $nomeArquivo);
            $dados['avatar'] = '/public/uploads/avatars/' . $nomeArquivo;
        }

        // implementa desse jeitoac ho que funciona
        App::get('database')->insertUser('usuarios', $dados);
        header('Location: /usuarios?sucesso=criado');
        exit();
    }


    public function update()
    {
        if (empty($_POST['id'])) {
            header('Location: /usuarios?erro=id_nao_informado');
            exit();
        }

        $id = (int)$_POST['id'];

        //pega usuario atual
        $usuarioAtual = App::get('database')->selectWhereUser(
            'usuarios',
            ['id' => $id]
        );
        $usuarioAtual = $usuarioAtual[0] ?? null;

        $dados = [
            'username' => $_POST['username'] ?? '',
            'nome'     => $_POST['nome'] ?? '',
            'email'    => $_POST['email'] ?? '',
        ];

        if (!empty($_POST['senha'])) 
        {
            $dados['senha'] = password_hash(
                $_POST['senha'],
                PASSWORD_DEFAULT
            );
        }


        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/avatars/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // remove avatar antigo
            if (!empty($usuarioAtual->avatar) && $usuarioAtual->avatar !== '/public/assets/default-avatar.png') {

                $avatarAntigo = __DIR__ . '/../../' . ltrim($usuarioAtual->avatar, '/');

                if (file_exists($avatarAntigo)) {
                    unlink($avatarAntigo);
                }
            }

            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid() . '.' . $ext;

            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $nomeArquivo);

            $dados['avatar'] = '/public/uploads/avatars/' . $nomeArquivo;
        }

        App::get('database')->updateUser('usuarios', $dados, ['id' => $id]);
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

        //remove a foto do perfil junto do usuario igual em update
        $usuario = App::get('database')->selectWhereUser(
            'usuarios',
            ['id' => $id]
        );

        $usuario = $usuario[0] ?? null;

        if (
            $usuario &&
            !empty($usuario->avatar) &&
            $usuario->avatar !== '/public/assets/default-avatar.png'
        ) {
            $avatar = __DIR__ . '/../../' . ltrim($usuario->avatar, '/');

            if (file_exists($avatar)) {
                unlink($avatar);
            }
        }

        App::get('database')->deleteUser('usuarios', ['id' => $id]);
        header('Location: /usuarios?sucesso=deletado');
        exit();
    }




    // POPULAR O BANCO ENCHER DE USUARIO PARA TESTE
        public function popularBanco()
    {
//achei um gerador de nomes  aleatorios para  teste, e  enfiei aqui
    $nomes = ['Kael', 'Ivan', 'Bruce', 'Paul', 'Serj', 'Isadora', 'Ana', 'Guilherme', 'José', 'João'];
        $sobrenomes = ['Turguêniev', 'Dickinson', 'DiAnno', 'Tankian', 'Simões', 'Nicácio', 'Silva', 'Santos', 'Oliveira'];

        
        $senhaPadrao = password_hash('123456', PASSWORD_DEFAULT);


        $quantidade = 50;

        for ($i = 0; $i < $quantidade; $i++) {
            $nomeRandom = $nomes[array_rand($nomes)];
            $sobrenomeRandom = $sobrenomes[array_rand($sobrenomes)];
            

            $nomeCompleto = $nomeRandom . ' ' . $sobrenomeRandom;

            $username = strtolower($nomeRandom) . rand(1000, 9999); 
            $email = $username . '@teste.com';

            $dados = [
                'username' => $username,
                'nome'     => $nomeCompleto,
                'email'    => $email,
                'senha'    => $senhaPadrao,
                'avatar'   => '/public/assets/default-avatar.png'
            ];


            \App\Core\App::get('database')->insertUser('usuarios', $dados);
        }


        header('Location: /usuarios?sucesso=banco_populado');
        exit();
    }
   
    
    // public function getUsuarioJson()
    // {
    //     if (empty($_GET['id'])) {
    //         http_response_code(400);
    //         echo json_encode(['erro' => 'ID não informado']);
    //         return;
    //     }

    //     $id = (int)$_GET['id'];
    //     $usuario = App::get('database')->selectWhere('usuarios', ['id' => $id]);

    //     if (!$usuario) {
    //         http_response_code(404);
    //         echo json_encode(['erro' => 'Usuário não encontrado']);
    //         return;
    //     }


    //     echo json_encode($usuario[0]);
    // }
}