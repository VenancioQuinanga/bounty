<?php

class ControladorDeUsuario extends RenderView
{
    private $uri = "http://localhost/bounty/projeto";
    private $api = "http://localhost/bounty/api";
    public const icone_de_informacao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>';
    public const icone_de_sucesso = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 01.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/> </svg> ";
    public const icone_de_visualizacao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg> ';
    public const icone_de_edicao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>';
    
    public function registro(){
        
        $usuario = new Usuario();

        $this->loadView('usuarios/registro',
        ['titulo'=>'Criar conta',
        'api'=>$this->api,
        'url'=>$this->uri,
        'funcao'=>$usuario->Cadastro()
        ]);
    }

    public function login(){
        
        $usuario = new usuario();

        $this->loadView('usuarios/login',
        ['titulo'=>'Fazer login',
        'api'=>$this->api,
        'url'=>$this->uri,
        'funcao'=>$usuario->AutenticarUsuario(),
        ]);
    }

    public function logout(){
        
        session_start();
        $usuario = new usuario();

        $usuario->FazerLogout();
        
    }

    public function perfil(){

        session_start();
        $usuario = new usuario();
        
        if (!empty($_SESSION['token'])) {
            
            $dados = $usuario->AcharUsuarioPeloId($_SESSION['token']);
            $this->loadView('usuarios/perfil',
            ['titulo'=>'Minha conta',
            'api'=>$this->api,
            'url'=>$this->uri,
            'usuario'=>$dados,
            'informacoes_bancarias'=>$usuario->AcharInformacoesBancariasDoUsuario($_SESSION['id_informacoes_bancarias']),
            'funcao'=>$usuario->EditarPerfil(),
            'funcao_logout'=>$usuario->FazerLogout()
            ]);

        } else {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login!</div>";
            header("Location:./");

        }
        
        
    }

    public function depositos(){
        session_start();
        $usuario = new Usuario();

        if (!empty($_SESSION['token'])) {

            $this->loadView('usuarios/depositos',
            ['titulo'=>'Depositos',
            'api'=>$this->api,
            'url'=>$this->uri,
            'informacoes_bancarias'=>$usuario->AcharInformacoesBancariasDoUsuario($_SESSION['id_informacoes_bancarias']),
            'funcao'=>$usuario->transacoes(),
            'transacoes'=>$usuario->AcharTransacoesDoUsuario($_SESSION['token'],'Deposito')
            ]);
            

        } else {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
            header("Location:./");
        }
    }

    public function saques(){

        session_start();
        $usuario = new Usuario();

        if (!empty($_SESSION['token'])) {
                
            $this->loadView('usuarios/saques',
            ['titulo'=>'Saques',
            'api'=>$this->api,
            'url'=>$this->uri,
            'informacoes_bancarias'=>$usuario->AcharInformacoesBancariasDoUsuario($_SESSION['id_informacoes_bancarias']),
            'funcao'=>$usuario->transacoes(),
            'transacoes'=>$usuario->AcharTransacoesDoUsuario($_SESSION['token'],'Saque'),
            ]);

        } else {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
            header("Location:./");
        }
    }
    
    public function carteira(){

        session_start();
        $usuario = new usuario();
        
        if (!empty($_SESSION['token'])) {

            $this->loadView('usuarios/carteira',
            ['titulo'=>'Carteira',
            'api'=>$this->api,
            'url'=>$this->uri,
            'usuario'=>$usuario->AcharUsuarioPeloId($_SESSION['token'])
            ]);

        } else {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login!</div>";
            header("Location:./");

        }
    }

    public function criar_infoproduto(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Produtor' ) {

            $this->loadView('infoprodutos/criar_infoproduto',
            ['titulo'=>'Criar infoproduto',
            'api'=>$this->api,
            'url'=>$this->uri,
            'tipos'=>$infoproduto->BuscarTipos(),
            'categorias'=>$infoproduto->BuscarCategorias(),
            'funcao'=>$infoproduto->CadastrarInfoproduto()
            ]);

            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um produtor, cadastre-se como produtor! </div>";
                header("Location:./produtores");
            }

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
            header("Location:./produtores");
        }
        
    }

    public function codigo_de_verificacao(){

        session_start();
        $usuario = new Usuario();

        $this->loadView('usuarios/codigo_de_verificacao',
        ['titulo'=>'Código de verificacao',
        'api'=>$this->api,
        'url'=>$this->uri,
        'funcao'=>$usuario->CodigoDeVerificacao()
        ]);

    }

    public function redefinir_senha(){

        session_start();
        $usuario = new Usuario();

        $this->loadView('usuarios/redefinir_senha',
        ['titulo'=>'Redefinir senha',
        'api'=>$this->api,
        'url'=>$this->uri,
        'funcao'=>$usuario->RedefinirSenha()
        ]);
    }

    public function gerir_usuarios(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Administrador' ) {

                $this->loadView('usuarios/gerir_usuarios',
                ['titulo'=>'Gerir usuarios',
                'api'=>$this->api,
                'url'=>$this->uri,
                'icone_de_visualizacao'=>self::icone_de_visualizacao,
                'icone_de_edicao'=>self::icone_de_edicao,
                'usuarios'=>$infoproduto->BuscarUsuarios(),
                ]);

            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um Administrador! </div>";
                header("Location:./");
            }

        } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
        header("Location:./");
        }

    }

    public function gerir_compras(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Administrador' ) {

                $this->loadView('usuarios/gerir_compras',
                ['titulo'=>'Gerir compras',
                'api'=>$this->api,
                'url'=>$this->uri,
                'icone_de_visualizacao'=>self::icone_de_visualizacao,
                'icone_de_edicao'=>self::icone_de_edicao,
                'compras'=>$infoproduto->BuscarCompras()
                ]);

            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um Administrador! </div>";
                header("Location:./");
            }

        } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
        header("Location:./");
        }
        
    }

    public function gerir_produtos(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Administrador' ) {

                $this->loadView('usuarios/gerir_produtos',
                ['titulo'=>'Gerir produtos',
                'api'=>$this->api,
                'url'=>$this->uri,
                'icone_de_visualizacao'=>self::icone_de_visualizacao,
                'icone_de_edicao'=>self::icone_de_edicao,
                'cursos'=>$infoproduto->BuscarCursos(),
                'livros'=>$infoproduto->BuscarLivros()
                ]);
            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um Administrador! </div>";
                header("Location:./");
            }

        } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
        header("Location:./");
        }
    }

    public function editar_usuario(){

        session_start();
        $usuario = new Usuario();
        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Administrador' ) {

                if (!empty($_GET['id'])) {
                
                $dados = $usuario->AcharUsuarioPeloId($_GET['id']);
                $this->loadView('usuarios/editar_usuario',
                ['titulo'=>'Editar usuario',
                'url'=>$this->uri,
                'usuario'=>$dados,
                'informacoes_bancarias'=>$usuario->AcharInformacoesBancariasDoUsuario($dados['id_informacoes_bancarias']),
                'status'=>$usuario->BuscarStatusDeTransacoes(),
                'depositos'=>$usuario->AcharTransacoesDoUsuario($_GET['id'],'Deposito'),
                'saques'=>$usuario->AcharTransacoesDoUsuario($_GET['id'],'Saque'),
                'funcao'=>$usuario->EditarUsuario(),
                'funcao2'=>$usuario->AlterarStatusDaTransacao()
                ]);

                }else {
                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Usuário não encontrado! </div>";
                    header("Location:./");
                }

            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um Administrador! </div>";
                header("Location:./");
            }

        } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
        header("Location:./");
        }
    }

    public function produtores(){
        
        session_start();
        $usuario = new Usuario();

        $this->loadView('usuarios/produtores',
        ['titulo'=>'Produtores',
        'api'=>$this->api,
        'url'=>$this->uri
        ]);
    }

    public function afiliados(){
        
        session_start();
        $usuario = new Usuario();

        $this->loadView('usuarios/afiliados',
        ['titulo'=>'Afiliados',
        'api'=>$this->api,
        'url'=>$this->uri
        ]);
    }

    public function meus_produtos(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Produtor' ) {

            $this->loadView('usuarios/meus_produtos',
            ['titulo'=>'Meus Produtos',
            'api'=>$this->api,
            'url'=>$this->uri,
            'icone_de_visualizacao'=>self::icone_de_visualizacao,
            'icone_de_edicao'=>self::icone_de_edicao,
            'cursos'=>$infoproduto->BuscarCursosDoProdutor(),
            'livros'=>$infoproduto->BuscarLivrosDoProdutor()
            ]);

            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um produtor, cadastre-se como produtor! </div>";
                header("Location:./produtores");
            }

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login! </div>";
            header("Location:./produtores");
        }

    }
    
    public function adquiridos(){
        
        session_start();
        $usuario = new usuario();
        
        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Aluno' ) {

                $this->loadView('usuarios/adquiridos',
                ['titulo'=>'Adquiridos',
                'api'=>$this->api,
                'url'=>$this->uri,
                'icone_de_visualizacao'=>self::icone_de_visualizacao,
                'icone_de_edicao'=>self::icone_de_edicao,
                'produtor','',
                'cursos'=>$usuario->BuscarTipoDeInfoprodutoAdquiridos($_SESSION['token'],'Curso em video'),
                'livros'=>$usuario->BuscarTipoDeInfoprodutoAdquiridos($_SESSION['token'],'Livro')
                ]);
            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não è um Aluno, cadastre-se como Aluno! </div>";
                header("Location:./produtores");
            }

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não está autenticado, faça login!</div>";
            header("Location:./");
        }
    }

    public function explorar_infoprodutos(){

        session_start();
        $infoproduto = new infoproduto();
        $usuario = new usuario();
        
        if (!empty($_SESSION['token'])) {

            if ($_SESSION['tipo_de_usuario'] == 'Aluno') {

                $this->loadView('infoprodutos/explorar_infoprodutos',
                ['titulo'=>'Explorar infoprodutos',
                'url'=>$this->uri,
                'cursos'=>$infoproduto->BuscarCursosDisponiveis(),
                'livros'=>$infoproduto->BuscarLivrosDisponiveis(),
                'funcao'=>$usuario->MeAfiliarAUmInfoproduto(),
                ]);

            } else {

                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan>Erro, Você não pode se afiliar porque voce não é um aluno(a)! </div>";        
                header("Location:./");
            }
            
        } else {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não esta autenticado, faça login! </div>";        
            header("Location:./");
        }
        

    }

    public function assistir_curso(){

        session_start();
        $infoproduto = new infoproduto();

        if (!empty($_GET['id'])) {
        
            $this->loadView('usuarios/assistir_curso',
            ['titulo'=>'Assistir curso',
            'url'=>$this->uri,
            'aulas'=>$infoproduto->BuscarVideoAulas($_GET['id']),
            'infoproduto'=>$infoproduto->BuscarInfoprodutoPeloId($_GET['id']),
            'produtor'=>$infoproduto->AcharProdutorDoInfoproduto($_GET['id'])
            ]);

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel encontrar o curso! </div>";        
            header("Location:./");
        }
    }

    public function editar_infoproduto(){

        $infoproduto = new infoproduto();
        session_start();
        
        if (!empty($_GET['id'])) {

            $this->loadView('usuarios/editar_infoproduto',
            ['titulo'=>'Ler livro',
            'api'=>$this->api,
            'url'=>$this->uri,
            'status'=>$infoproduto->BuscarStatus(),
            'categorias'=>$infoproduto->BuscarCategoriasDeInfoprodutos(),
            'infoproduto'=>$infoproduto->BuscarInfoprodutoPeloId($_GET['id']),
            'funcao'=>$infoproduto->EditarInfoproduto()
            ]);

        } else {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Infoproduto não encontrado! </div>";        
            header("Location:./");
        }
        
    }

    public function conhecer_plataforma(){
        
        session_start();
        $usuario = new Usuario();

        $this->loadView('usuarios/conhecer_plataforma',
        ['titulo'=>'Comprar infoproduto',
        'url'=>$this->uri,
        'funcao_de_compra'=>$usuario->ComprarInfoproduto()
        ]);
    }

    public function comprar_infoproduto(){

        session_start();
        $usuario = new Usuario();

        if (!empty($_SESSION['token'])) {

            $dados  = $usuario->AcharUsuarioPeloId($_SESSION['token']);
            $id_tipo = $dados['id_tipo_de_usuario'];

            $dados = $usuario->BuscarTipoDeUsuarioPeloId($id_tipo);

                if ($dados['tipo'] === 'Aluno') {

                    $this->loadView('usuarios/comprar_infoproduto',
                    ['titulo'=>'Comprar infoproduto',
                    'url'=>$this->uri,
                    'funcao_de_compra'=>$usuario->ComprarInfoproduto()
                    ]);

                } else {
                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você não é um aluno! </div>";        
                    header("Location:./");
                }

        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Você deve estar autenticado, faça login! </div>";        
            header("Location:./");
        }
        
    }

}
