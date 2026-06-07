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
        return view('admin/pagina_publicacoes', compact('publicacoes'));
    }
    
    //Update - CRUD -> Edição das informações
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

    //Create - CRUD -> Inserção de informações no banco
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

    //Delete - CRUD -> Deleta uma informação do banco
    public function delete()
    {
        $id = $_POST['id'];

        App::get('database')->delete('publicacao', $id);

        header('Location: /publicacoes');
    }
}