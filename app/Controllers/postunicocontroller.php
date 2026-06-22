<?php

namespace App\Controllers;

use App\Core\App;

class postunicocontroller
{
    public function index()
    {
        if (!isset($_GET['id'])) {
            header('Location: /postspage');
            exit;
        }

        $id = (int) $_GET['id'];

        $limit = 6;

        $publicacao = App::get('database')->selectPublicacaoComAutor($id);

        $postsRelacionados = App::get('database')->getPostsRelacionados(
            $publicacao->categoria,
            $publicacao->id,
            $limit
        );

        if (!$publicacao) {
            header('Location: /postspage');
            exit;
        }

        $temCuriosidade = !empty(trim($publicacao->curiosidade));

        return view('site/pagina-de-visualizacao', [
            'publicacao' => $publicacao,
            'temCuriosidade' => $temCuriosidade,
            'postsRelacionados' => $postsRelacionados
        ]);
    }
}