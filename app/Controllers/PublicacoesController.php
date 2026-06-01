<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    public function index()
    {
        $publicacoes = App::get('database')->selectAll('publicacao');
        return view('admin/pagina_publicacoes', compact('publicacoes'));
    }
    public function edit()
    {
        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'data' => $_POST['data'],
            'descricao' => $_POST['descricao'],
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
            'titulo' => $POST['titulo'],
            'descricao' => $_['descricao'],
            'curiosidade' => $_['curiosidade'],
            'data' => $_POST['data'],
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