<?php

namespace App\Controllers;


use App\Core\App;

class PostController
{
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

        $limit = 3;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if($currentPage < 1){
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $limit;


        $pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';


        if ($pesquisa !== '') {
            $totalPosts = $database->countSearchposts('publicacao', $pesquisa);
            $totalPages = ceil($totalPosts / $limit);
            $postsDoBanco = $database->paginateSearchposts('publicacao', $pesquisa, $limit, $offset);
        } 
        else{
            $totalPosts = $database->countAll('publicacao');
            $totalPages = ceil($totalPosts/$limit);
            $postsDoBanco = $database->paginate('publicacao',$limit,$offset);
        }

        return view('site/postspage', [
            'publicacoes' => $postsDoBanco,
            'currentPage' => $currentPage,
            'totalPage' => $totalPages,
            'totalPosts' => $totalPosts,
            'pesquisa' => $pesquisa 
        ]);

        exit();
    }
}