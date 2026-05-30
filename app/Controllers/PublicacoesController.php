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
}