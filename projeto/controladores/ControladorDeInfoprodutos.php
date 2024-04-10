<?php

final class ControladorDeInfoprodutos extends RenderView
{
    private $uri = "http://localhost/bounty/projeto";
    private $api = "http://localhost/bounty/api";
    public const icone_de_informacao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>';
    public const icone_de_sucesso = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 01.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/> </svg> ";
    public const icone_de_visualizacao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg> ';
    public const icone_de_edicao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>';

    //Paginas de cursos
    public function cursos(){
        
        $infoproduto = new infoproduto();
        
        $this->loadView('infoprodutos/cursos',
        ['titulo'=>'Cursos',
        'api'=>$this->api,
        'url'=>$this->uri,
        'categorias'=>$infoproduto->BuscarCategoriasDeInfoprodutos(),
        'cursos'=>$infoproduto->BuscarCursosDisponiveis(),
        ]);
    
    }

    public function adicionar_aulas(){
        
        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_GET['id_curso'])) {

            $this->loadView('infoprodutos/adicionar_aulas',
            ['titulo'=>'Adicionar aulas',
            'api'=>$this->api,
            'url'=>$this->uri,
            'aulas'=>$infoproduto->UploadDeVideoAula()
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Infoproduto não encontrado! </div>";        
            header("Location:./");
        }
    }

    public function editar_aulas(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_GET['id'])) {

            $this->loadView('infoprodutos/editar_aulas',
            ['titulo'=>'Editar aulas',
            'api'=>$this->api,
            'url'=>$this->uri,
            'aula'=>$infoproduto->BuscarVideoAula($_GET['id']),
            'funcao'=>$infoproduto->EditarVideoAula()
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Aula não encontrada! </div>";        
            header("Location:./");
        }
    }

    public function gerir_aulas(){

        $infoproduto = new infoproduto();
        session_start();

        if (!empty($_GET['id_curso'])) {

            $this->loadView('infoprodutos/gerir_aulas',
            ['titulo'=>'Gerir aulas',
            'api'=>$this->api,
            'url'=>$this->uri,
            'icone_de_visualizacao'=>self::icone_de_visualizacao,
            'icone_de_edicao'=>self::icone_de_edicao,
            'aulas'=>$infoproduto->BuscarVideoAulas($_GET['id_curso']),
            'infoproduto'=>$infoproduto->BuscarInfoprodutoPeloId($_GET['id_curso']),
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Infoproduto não encontrado! </div>";        
            header("Location:./");
        }
    }

    public function ver_curso(){

        session_start();
        $infoproduto = new infoproduto();
        $usuario = new Usuario();
        
        if (!empty($_SESSION['token'])) {

            if (!empty($_GET['id'])) {

                $this->loadView('infoprodutos/ver_curso',
                ['titulo'=>'Ver curso',
                'api'=>$this->api,
                'url'=>$this->uri,
                'icone_de_visualizacao'=>self::icone_de_visualizacao,
                'icone_de_edicao'=>self::icone_de_edicao,
                'aulas'=>$infoproduto->BuscarVideoAulas($_GET['id']),
                'infoproduto'=>$infoproduto->BuscarInfoprodutoPeloId($_GET['id']),
                ]);

            } else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel encontrar o curso! </div>";        
                header("Location:./");
            }

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você deve estar autenticado, faça login! </div>";        
            header("Location:./");
        }
    }
    
    //Paginas de livros
    public function livros(){

        $infoproduto = new infoproduto();

        $this->loadView('infoprodutos/livros',
        ['titulo'=>'Livros',
        'api'=>$this->api,
        'url'=>$this->uri,
        'categorias'=>$infoproduto->BuscarCategoriasDeInfoprodutos(),
        'livros'=>$infoproduto->BuscarLivrosDisponiveis()
        ]);

    }

    public function adicionar_livro(){

        $livro = new infoproduto();

        $this->loadView('infoprodutos/adicionar_livro',
        ['titulo'=>'Upload do livro',
        'api'=>$this->api,
        'url'=>$this->uri,
        'funcao'=>$livro->UploadDoLivro()
        ]);
    }
    
    public function adicionar_capitulos(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_GET['id_livro'])) {

            $this->loadView('infoprodutos/adicionar_capitulos',
            ['titulo'=>'Adicionar capitulos',
            'api'=>$this->api,
            'url'=>$this->uri,
            'funcao'=>$infoproduto->AdicionarCapitulo()
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Infoproduto não encontrado! </div>";        
            header("Location:./");
        }

    }

    public function editar_capitulos(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_GET['id'])) {

            $this->loadView('infoprodutos/editar_capitulos',
            ['titulo'=>'Editar capitulos',
            'api'=>$this->api,
            'url'=>$this->uri,
            'capitulo'=>$infoproduto->BuscarCapitulo($_GET['id']),
            'funcao'=>$infoproduto->EditarCapitulo()
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Capitulo não encontrado! </div>";        
            header("Location:./");
        }

    }

    public function gerir_capitulos(){

        $infoproduto = new infoproduto();
        session_start();

        if (!empty($_GET['id_livro'])) {

            $this->loadView('infoprodutos/gerir_capitulos',
            ['titulo'=>'Gerir capitulos',
            'api'=>$this->api,
            'url'=>$this->uri,
            'icone_de_visualizacao'=>self::icone_de_visualizacao,
            'icone_de_edicao'=>self::icone_de_edicao,
            'capitulos'=>$infoproduto->BuscarCapitulos($_GET['id_livro']),
            'infoproduto'=>$infoproduto->BuscarInfoprodutoPeloId($_GET['id_livro'])
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Infoproduto não encontrado! </div>";        
            header("Location:./");
        }

    }
    
    public function ver_livro(){

        session_start();
        $infoproduto = new infoproduto();
        $usuario = new Usuario();

        if (!empty($_SESSION['token'])) {

            if (!empty($_GET['id'])) {

                $this->loadView('infoprodutos/ver_livro',
                ['titulo'=>'Ver capitulos',
                'api'=>$this->api,
                'url'=>$this->uri,
                'icone_de_visualizacao'=>self::icone_de_visualizacao,
                'icone_de_edicao'=>self::icone_de_edicao,
                'capitulos'=>$infoproduto->BuscarCapitulos($_GET['id']),
                'infoproduto'=>$infoproduto->BuscarInfoprodutoPeloId($_GET['id']),
                ]);

            } else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel encontrar o livro! </div>";        
                header("Location:./");
            }

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você deve estar autenticado, faça login! </div>";        
            header("Location:./");
        }
    }

}
