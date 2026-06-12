<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{
   
    //Read - CRUD -> Leitura das informações
    public function index()
    {
        $publicacoes = App::get('database')->selectAll('publicacao');

        // Forçando o array manualmente sem usar o compact
        return view('admin/pagina_publicacoes', ['publicacoes' => $publicacoes]);
        exit;
    }
    

    //Update - CRUD -> Edição das informações
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
            'descricao' => $_POST['conteudo'],
            'curiosidade' => $_POST['curiosidade'],
            'data' => $_POST['data'],
        ];

        $id = $_POST['id'];
        
        App::get('database')->update('publicacao',$id, $parameters);
        header('Location: /publicacoes');
        exit;
    }
    public function store()
    {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;

            move_uploaded_file($temporario, $caminhodaimagem);

        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'] ?? 1,
            'data' => $_POST['data'],
            'descricao' => $_POST['conteudo'],
            'curiosidade' => $_POST['curiosidade'],
            'imagem' => $caminhodaimagem //para imagem de capa
        ];

        App::get('database')->insert('publicacao', $parameters);
        header('Location: /publicacoes');
        exit;
    }


    //Delete - CRUD -> Deleta uma informação do banco
    public function delete()
    {
        $id = $_POST['id'];

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
