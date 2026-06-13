<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{
    public function index()
    {
        // $publicacoes = App::get('database')->selectAll('publicacao');

        // return view('admin/pagina_publicacoes', ['publicacoes' => $publicacoes]);
        // exit;

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

        $totalPosts = $database->countAll('publicacao');
        $totalPages = ceil($totalPosts/$limit);

        $postsDoBanco = $database->paginate('publicacao',$limit,$offset);

        return view('admin/pagina_publicacoes', [
            'publicacoes' => $postsDoBanco,
            'currentPage' => $currentPage,
            'totalPage' => $totalPages,
            'totalPosts' => $totalPosts,
            'usuarioLogado' => $usuarioLogado
        ]);

        exit();
    }

    public function edit()
    {
        $id = $_POST['id'];
        $post = App::get('database')->selectOne('publicacao', $id);
        $caminhodaimagem = $post->imagem;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;
            move_uploaded_file($temporario, $caminhodaimagem);

            if($post && !empty($post->imagem) && file_exists($post->imagem)){
                unlink($post->imagem);
            }
        }

        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'data' => $_POST['data'],
            'conteudo' => $_POST['conteudo'],
            'curiosidade' => $_POST['curiosidade'],
            'imagem' => $caminhodaimagem
        ];
        
        App::get('database')->update('publicacao', $id, $parameters);
        header('Location: /publicacoes');
        exit;
    }

    public function store()
    {
        session_start();

        $caminhodaimagem = null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;

            move_uploaded_file($temporario, $caminhodaimagem);
        }

        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_SESSION['id'],
            'data' => $_POST['data'],
            'conteudo' => $_POST['conteudo'],
            'curiosidade' => $_POST['curiosidade'],
            'imagem' => $caminhodaimagem
        ];

        App::get('database')->insert('publicacao', $parameters);
        header('Location: /publicacoes');
        exit;
    }

    public function delete()
    {
        $id = $_POST['id'];

        $post = App::get('database')->selectOne('publicacao', $id);
        if($post && !empty($post->imagem) && file_exists($post->imagem)){
            unlink($post->imagem);
        }

        App::get('database')->delete('publicacao', $id);

        header('Location: /publicacoes');
        exit;
    }

    public function uploadImagem()
    {
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;

            if (move_uploaded_file($temporario, $caminhodaimagem)){
                echo 'http://' . $_SERVER['HTTP_HOST'] . '/public/assets/imagensPosts/' . $nomeimagem;
                exit;
            }
        }
        http_response_code(400);
        echo "Erro ao fazer upload da imagem.";
        exit;
    }
}