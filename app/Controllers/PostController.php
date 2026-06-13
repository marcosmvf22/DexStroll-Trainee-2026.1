<?php

namespace App\Controllers;


use App\Core\App;

class PostController
{
    public function index()
    {
        
    
        $publicacoesDoBanco = App::get('database')->selectAll('publicacao');


        return view('site/postspage', [
            'publicacoes' => $publicacoesDoBanco
        ]);
    }
}