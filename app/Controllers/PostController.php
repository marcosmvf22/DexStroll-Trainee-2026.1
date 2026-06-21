<?php

namespace App\Controllers;


use App\Core\App;

class PostController
{
   public function index()
    {   
        $database = App::get('database');

        $limit = 8;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if($currentPage < 1){
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $limit;


        $pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';
        $categoria = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';


        if ($pesquisa !== '') {
            $totalPosts = $database->countSearchposts('publicacao', $pesquisa);
            $totalPages = ceil($totalPosts / $limit);
            $postsDoBanco = $database->paginateSearchposts('publicacao', $pesquisa, $limit, $offset);
        } 
        elseif ($categoria !== '') { 
            $totalPosts = $database->countByCategory('publicacao', $categoria);
            $totalPages = ceil($totalPosts / $limit);
            $postsDoBanco = $database->paginateByCategory('publicacao', $categoria, $limit, $offset);
        } 
        else { // Fluxo normal (todos os posts)
            $totalPosts = $database->countAll('publicacao');
            $totalPages = ceil($totalPosts/$limit);
            $postsDoBanco = $database->paginate('publicacao',$limit,$offset);
        }

        return view('site/postspage', [
            'publicacoes' => $postsDoBanco,
            'currentPage' => $currentPage,
            'totalPage' => $totalPages,
            'totalPosts' => $totalPosts,
            'pesquisa' => $pesquisa,
            'categoriaSelecionada' => $categoria
        ]);

        exit();
    }
}