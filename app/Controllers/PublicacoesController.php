<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    private function getCategorias()
    {
        return[
            'Jogos',
            'Noticia',
            'Midia',
            'Guias'
        ];
    }

    public function index()
    {
        // $publicacoes = App::get('database')->selectAll('publicacao');

        // return view('admin/pagina_publicacoes', ['publicacoes' => $publicacoes]);
        // exit;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $usuarioLogado = App::get('database')->selectOne(
            'usuarios',
            $_SESSION['id']
        );

        $database = App::get('database');

        $limit = 6;
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

        $categorias = $this->getCategorias();

        return view('admin/pagina_publicacoes', [
            'publicacoes' => $postsDoBanco,
            'currentPage' => $currentPage,
            'totalPage' => $totalPages,
            'totalPosts' => $totalPosts,
            'usuarioLogado' => $usuarioLogado,
            'pesquisa' => $pesquisa,
            'categorias' => $categorias
        ]);

        exit();
    }

    public function edit()
    {
        $id = $_POST['id'];
        $post = App::get('database')->selectOne('publicacao', $id);
        $caminhodaimagem = $post->imagem;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;
            move_uploaded_file($temporario, $caminhodaimagem);

            if($post && !empty($post->imagem) && file_exists($post->imagem)){
                unlink($post->imagem);
            }
        }

        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'data' => date('Y-m-d'),
            'conteudo' => $_POST['conteudo'],
            'categoria' => $_POST['categoria'],
            'curiosidade' => $_POST['curiosidade'],
            'imagem' => $caminhodaimagem
        ];
        
        App::get('database')->update('publicacao', $id, $parameters);
        header('Location: /publicacoes');
        exit;
    }

    public function store()
    {
        session_start();

        $caminhodaimagem = null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;

            move_uploaded_file($temporario, $caminhodaimagem);
        }

        $parameters = [
            'titulo' => $_POST['titulo'],
            'autor' => $_SESSION['id'],
            'data' => date('Y-m-d'),
            'conteudo' => $_POST['conteudo'],
            'categoria' => $_POST['categoria'],
            'curiosidade' => $_POST['curiosidade'],
            'imagem' => $caminhodaimagem
        ];

        App::get('database')->insert('publicacao', $parameters);
        header('Location: /publicacoes');
        exit;
    }

    public function delete()
    {
        $id = $_POST['id'];

        $post = App::get('database')->selectOne('publicacao', $id);
        if($post && !empty($post->imagem) && file_exists($post->imagem)){
            unlink($post->imagem);
        }

        App::get('database')->delete('publicacao', $id);

        header('Location: /publicacoes');
        exit;
    }

    public function uploadImagem()
    {
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $temporario = $_FILES['imagem']['tmp_name'];
            $nomeimagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $caminhodaimagem = "public/assets/imagensPosts/" . $nomeimagem;

            if (move_uploaded_file($temporario, $caminhodaimagem)){
                echo 'http://' . $_SERVER['HTTP_HOST'] . '/public/assets/imagensPosts/' . $nomeimagem;
                exit;
            }
        }
        http_response_code(400);
        echo "Erro ao fazer upload da imagem.";
        exit;
    }


//popula banco


public function popularPosts()
    {

    $categorias = $this->getCategorias();
        

        $titulos = ['O retorno da franquia', 'Nova atualização lançada', 'Guia para iniciantes', 'Melhores momentos do ano', 'Análise completa', 'O que esperar do futuro', 'Entrevista exclusiva', 'Rumores confirmados', 'Promoção imperdível', 'Dicas avançadas'];
        
        $conteudos = [
            '<p>Este é um post gerado automaticamente para testes. O conteúdo é apenas um texto genérico para preencher espaço no layout e testar a paginação e a exibição correta das tags HTML geradas pelo Summernote.</p>',
            '<p>Pokemon é um tema muito legal e interessante pra muitosjovens por aí <b>A equipe de desenvolvimento</b> É  um universo enorme, não é pra qualquer um</p>',
            '<p>Nem todo mundo gosta, mas é bem legal se pegar  umtempo pra jogar <i>Explorar bem o mapa</i> e entender as mecânicas básicas é essencial para o sucesso.</p>'
        ];
        
        $curiosidades = ['Sabia que o desenvolvimento levou 5 anos?', 'Este é um dos tópicos mais comentados do fórum.', 'O jogo original quase foi cancelado.', 'Foram encontrados vários easter eggs nesta versão.', ''];

        //cria 50  igual  a de usuarios
        $quantidade = 50;
    //loopzinho basico
        for ($i = 0; $i < $quantidade; $i++) {

        $titulo = $titulos[array_rand($titulos)] . ' #' . rand(100, 999);
            

            $data = date('Y-m-d', strtotime('-' . rand(0, 60) . ' days'));
            

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $autorId = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

            $parameters = [
                'titulo'      => $titulo,
                'autor'       => $autorId,
                'data'        => $data,
                'conteudo'    => $conteudos[array_rand($conteudos)],
                'categoria'   => $categorias[array_rand($categorias)],
                'curiosidade' => $curiosidades[array_rand($curiosidades)],
                'imagem'      => 'public/assets/imagensPosts/1e3171a2b1082af948342a8ffa2c3b25c70fc16f.jpg' //sla, pega qualquer coisa
            ];


            \App\Core\App::get('database')->insert('publicacao', $parameters);
        }


        header('Location: /publicacoes?sucesso=posts_populados');
        exit();
    }




}