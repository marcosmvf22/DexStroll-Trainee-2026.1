<?php

namespace App\Controllers;


use App\Core\App;

class PostController
{
    public function index()
    {
        
    
        // $publicacoesDoBanco = App::get('database')->selectAll('publicacao');
        // return view('site/postspage', [
        //     'publicacoes' => $publicacoesDoBanco
        // ]);

        $database = App::get('database');

        $limit = 3;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if($currentPage < 1){
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $limit;


        $pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';


        if ($pesquisa !== '') {
            $totalPosts = $database->countSearch('publicacao', $pesquisa);
            $totalPages = ceil($totalPosts / $limit);
            $postsDoBanco = $database->paginateSearch('publicacao', $pesquisa, $limit, $offset);
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