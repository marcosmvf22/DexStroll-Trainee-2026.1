<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class InitController
{

    public function index()
    {
        $limit = 10;

        $ultimasPublicacoes = App::get('database')->ultimasPublicacoes($limit);
        return view('site/landingpage', [
            'ultimasPublicacoes' => $ultimasPublicacoes
        ]);
        
    }
}