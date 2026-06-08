<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    public function index()
    {
        $database = App::get('database');

        $limit = 6;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if($currentPage < 1){
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $limit;

        $totalPublicacao = $database->countAll('publicacao');
        $totalPages = ceil($totalPublicacao/$limit);

        $publicacoes = $database->paginate('publicacao',$limit,$offset);

        return view('admin/pagina_publicacoes', [
            'publicacoes' => $publicacoes,
            'currentPage' => $currentPage,
            'totalPage' => $totalPages,
            'totalPublicacoes' => $totalPublicacao
        ]);
    }
    public function edit()
    {
        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'data' => $_POST['data'],
            'conteudo' => $_POST['conteudo'],
            'curiosidade' => $_POST['curiosidade'],
            'data' => $_POST['data'],
        ];

        $id = $_POST['id'];
        
        App::get('database')->update('publicacao',$id, $parameters);
        header('Location: /publicacoes');
    }
    public function store()
    {
        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'] ?? 1,
            'data' => $_POST['data'],
            'conteudo' => $_POST['conteudo'],
            'curiosidade' => $_POST['curiosidade'],
            'imagem' => $_POST['imagem'] ?? ''
        ];

        App::get('database')->insert('publicacao', $parameters);
        header('Location: /publicacoes');
    }
    public function delete()
    {
        $id = $_POST['id'];

        App::get('database')->delete('publicacao', $id);

        header('Location: /publicacoes');
    }
}