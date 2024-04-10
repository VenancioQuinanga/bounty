<?php

final class infoproduto extends Database implements AcoesDoInfoproduto
{

    use AulaDoCurso;
    use CapituloDoLivro;

    private $conn;
    private $api = 'http://localhost/bounty/api';
    
    public int $id;
    public string $src;
    public string $src2;
    public string $descricao;
    public float $preco;
    public string $percentual_para_afiliados;
    public string $data_de_criacao;
    public int $id_categoria;
    public int $id_tipo_de_infoproduto;
    public int $id_status_de_infoproduto;
    public int $id_usuario;

    public const icone_de_informacao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>';
    public const icone_de_sucesso = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 01.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/> </svg> ";

    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function BuscarCategoriasDeInfoprodutos():array{

        $stmt = $this->conn->query("SELECT * FROM categorias_de_infoprodutos");
        
        if ($stmt->rowCount() > 0) {

            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarTipoDoInfoproduto($id):array{

        $stmt = $this->conn->query("SELECT * FROM tipos_de_infoproduto WHERE id = '$id'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarTipoDoInfoprodutoPeloTipo($tipo):array{

        $stmt = $this->conn->query("SELECT * FROM tipos_de_infoproduto WHERE tipo = '$tipo'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarStatusDoInfoproduto($valor):array{

        $stmt = $this->conn->query("SELECT * FROM status_de_infoproduto WHERE valor = '$valor'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function Criar($src,$descricao,$preco,$percentual_para_afiliados,$data_de_criacao,$id_categoria,$id_tipo_de_infoproduto,$id_status_de_infoproduto,$id_usuario):void{

        $extensao = pathinfo($src,PATHINFO_EXTENSION);
        $extensoes = ['png','jpg','jpeg','PNG','JPG','JPEG'];

        if (!in_array($extensao,$extensoes)) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Arquivo não permitido, tente um arquivo do tipo png,jpg ou jpeg !</div>";
                
        }else {

            if (move_uploaded_file($_FILES['src']['tmp_name'],'./public/img/infoprodutos/'.$src)) {
                
                $stmt = $this->conn->query("INSERT INTO infoprodutos (src,descricao,preco,percentual_para_afiliados,data_de_criacao,id_categoria,id_tipo_de_infoproduto,id_status_de_infoproduto,id_usuario)
                VALUES 
                ('$src','$descricao','$preco','$percentual_para_afiliados','$data_de_criacao','$id_categoria','$id_tipo_de_infoproduto','$id_status_de_infoproduto','$id_usuario'
                )");

            } else {

                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel, Fazer o upload do arquivo</div>";
            }
        }
    }

    public function BuscarTipos():array{

        $stmt = $this->conn->query("SELECT * FROM tipos_de_infoproduto");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarCategorias():array{

        $stmt = $this->conn->query("SELECT * FROM categorias_de_infoprodutos");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarStatus():array{

        $stmt = $this->conn->query("SELECT * FROM status_de_infoproduto");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
    }

    public function UploadDoLivro():void{

        session_start();
        if (isset($_POST['subir_livro'])) {
            
            $this->src2 = bin2hex(random_bytes(20)).$_FILES['src']['name'];
            $this->id = $_SESSION['id_livro'];
            $extensao = pathinfo($this->src2,PATHINFO_EXTENSION);
            $extensoes = ['pdf','PDF'];

            $dados = $this->BuscarStatusDoInfoproduto('Disponível');
            $this->id_status_de_infoproduto = $dados['id'];

            if (!in_array($extensao,$extensoes)) {

                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Arquivo não permitido, tente um arquivo do tipo pdf!</div>";
                
            }else {

                if (move_uploaded_file($_FILES['src']['tmp_name'],'../api/assets/docs/'.$this->src2)) {

                    $stmt = $this->conn->query("UPDATE infoprodutos SET src2 = '$this->src2',id_status_de_infoproduto = '$this->id_status_de_infoproduto' WHERE id = '$this->id' ");
                    $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> Upload do livro feito com sucesso!<br><a href='./meus-produtos'>aqui</a></div>";
                    $_SESSION['id_livro'] = '';
                    header('Location:./meus-produtos');

                } else {

                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel, Fazer o upload do arquivo</div>";
                }
                
            }

        }
    }

    public function BuscarCursosDisponiveis():array{

        $resposta = $this->BuscarStatusDoInfoproduto('Disponível');
        $this->id_status_de_infoproduto = $resposta['id'];

        $resposta = $this->BuscarTipoDoInfoprodutoPeloTipo('Curso em video');
        $this->id_tipo_de_infoproduto = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id_tipo_de_infoproduto = '$this->id_tipo_de_infoproduto' AND id_status_de_infoproduto = '$this->id_status_de_infoproduto' ");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarCursosDoProdutor():array{

        $this->id_usuario = $_SESSION['token'];
        $resposta = $this->BuscarTipoDoInfoprodutoPeloTipo('Curso em video');
        $this->id_tipo_de_infoproduto = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id_usuario = $this->id_usuario AND id_tipo_de_infoproduto = '$this->id_tipo_de_infoproduto'");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarLivrosDisponiveis():array{

        $resposta = $this->BuscarStatusDoInfoproduto('Disponível');
        $this->id_status_de_infoproduto = $resposta['id'];

        $resposta = $this->BuscarTipoDoInfoprodutoPeloTipo('Livro');
        $this->id_tipo_de_infoproduto = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id_tipo_de_infoproduto = '$this->id_tipo_de_infoproduto' AND id_status_de_infoproduto = '$this->id_status_de_infoproduto' ");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
    }

    public function BuscarLivrosDoProdutor():array{

        $this->id_usuario = $_SESSION['token'];
        $resposta = $this->BuscarTipoDoInfoprodutoPeloTipo('Livro');
        $this->id_tipo_de_infoproduto = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id_usuario = $this->id_usuario AND id_tipo_de_infoproduto = '$this->id_tipo_de_infoproduto'");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function CadastrarInfoproduto():void{

        $this->BuscarCategorias();
        $this->BuscarTipos();

        if (isset($_POST['criar_infoproduto'])) {

            $this->src =  bin2hex(random_bytes(20)).$_FILES['src']['name'];
            $this->descricao = $_POST['descricao'];
            $this->preco = $_POST['preco'];
            $this->percentual_para_afiliados = $_POST['percentual_para_afiliados'];
            $this->data_de_criacao = date('d/m/y');
            $this->id_usuario = (int) $_SESSION['token'];
            $this->id_categoria = (int) $_POST['id_categoria'];
            $this->id_tipo_de_infoproduto = (int) $_POST['id_tipo_de_infoproduto'];
            $status = 'Indisponível';

            $dados = $this->BuscarStatusDoInfoproduto($status);
            $this->id_status_de_infoproduto = (int) $dados['id'];
            $dados = $this->BuscarTipoDoInfoproduto($this->id_tipo_de_infoproduto);
            $this->Criar($this->src,$this->descricao,$this->preco,$this->percentual_para_afiliados,
            $this->data_de_criacao,$this->id_categoria,$this->id_tipo_de_infoproduto,$this->id_status_de_infoproduto,$this->id_usuario);

            if ($dados['tipo'] == 'Livro'){
                header('Location:./adicionar-livro');
            } else{
                header('Location:./meus-produtos');
            }
        }
        
    }

    // Edição de infoprodutos
    public function BuscarInfoprodutoPeloId($id):array{

        $this->id = $id;
        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id = '$this->id' ");

        if ($stmt->rowCount() > 0) {

            $infoproduto = $stmt->fetch();
            $this->src = $infoproduto['src'];
            $_SESSION['infoproduto_src'] = $this->src;
            
            return $infoproduto;

        } else {
            return [];
        }
        
    }

    public function EditarInfoproduto():void{

        if (isset($_POST['editar_infoproduto'])) {

            $this->id = $_POST['id'];
            $this->src = !empty($_FILES['src']['name'])? bin2hex(random_bytes(20)).$_FILES['src']['name'] : $_SESSION['infoproduto_src'];
            $this->descricao = $_POST['descricao'];
            $this->preco = $_POST['preco'];
            $this->percentual_para_afiliados = $_POST['id_percentual_para_afiliados'];
            $this->id_categoria = $_POST['id_categoria'];
            $this->id_status_de_infoproduto = $_POST['id_status_de_infoproduto'];

            if (!empty($_FILES['src']['name'])) {

                $extensao = pathinfo($this->src,PATHINFO_EXTENSION);
                $extensoes = ['png','jpg','jpeg','PNG','JPG','JPEG'];

                switch (in_array($extensao,$extensoes)) {

                    case '1':

                        if (move_uploaded_file($_FILES['src']['tmp_name'],'./public/img/infoprodutos/'.$this->src)) {
                            
                            $this->Editar($this->id,$this->src,$this->descricao,$this->preco,$this->percentual_para_afiliados,$this->id_categoria,$this->id_status_de_infoproduto);

                        } else {

                            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel, Fazer o upload do arquivo</div>";
                        }
                        break;
                    
                    default:

                        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Arquivo não permitido, tente um arquivo do tipo png,jpg ou jpeg !</div>";
                        break;
                }
    
            }else {

                $this->Editar($this->id,$this->src,$this->descricao,$this->preco,$this->percentual_para_afiliados,$this->id_categoria,$this->id_status_de_infoproduto);
                
            }

        }
    }

    public function Editar($id,$src,$descricao,$preco,$percentual_para_afiliados,$id_categoria,$id_status_de_infoproduto):void{

        $stmt = $this->conn->query("UPDATE infoprodutos SET src = '$src',descricao = '$descricao',preco = '$preco',
            percentual_para_afiliados = '$percentual_para_afiliados',id_categoria = '$id_categoria',
            id_status_de_infoproduto = '$id_status_de_infoproduto' WHERE id = '$id'");

        header('Location:./meus-produtos');
    }

    public function AcharProdutorDoInfoproduto($id):array{
        $this->id = $id;

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id = '$this->id' ");

        $dados = $stmt->fetch();
        $id = $dados['id_usuario'];

        $stmt = $this->conn->query("SELECT * FROM usuarios WHERE id = '$id' ");

        if ($stmt->rowCount() > 0) {

            return $stmt->fetch();

        } else {
            return [];
        }
    }
    //Acões do Administrador
    public function BuscarCursos():array{

        $resposta = $this->BuscarTipoDoInfoprodutoPeloTipo('Curso em video');
        $this->id_tipo_de_infoproduto = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id_tipo_de_infoproduto = '$this->id_tipo_de_infoproduto' ");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarLivros():array{

        $resposta = $this->BuscarTipoDoInfoprodutoPeloTipo('Livro');
        $this->id_tipo_de_infoproduto = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id_tipo_de_infoproduto = '$this->id_tipo_de_infoproduto' ");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarTipoDoUsuarioPeloTipo($tipo):array{

        $stmt = $this->conn->query("SELECT * FROM tipos_de_usuario WHERE tipo = '$tipo'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarUsuarios():array{

        $resposta = $this->BuscarTipoDoUsuarioPeloTipo('Administrador');
        $id_tipo_de_usuario = $resposta['id'];

        $stmt = $this->conn->query("SELECT * FROM usuarios WHERE id_tipo_de_usuario != '$id_tipo_de_usuario' ");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarProdutorPeloId($id):array{

        $stmt = $this->conn->query("SELECT * FROM usuarios WHERE id = $id");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarTipoDeCompraPeloId($id):array{
     
        $stmt = $this->conn->query("SELECT * FROM tipos_de_compra WHERE id = $id");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }else {
            return [];
        }
    }

    public function BuscarCompras():array{

        $stmt = $this->conn->query("SELECT * FROM compras");
        
        if ($stmt->rowCount() > 0) {
            
            $dados = $stmt->fetchAll();
            $compras = [];

            foreach ($dados as $d) {

                $infoproduto =  $this->BuscarInfoprodutoPeloId($d['id']);
                $tipo_de_compra = $this->BuscarTipoDeCompraPeloId($d['id_tipo_de_compra']);
                $produtor = $this->BuscarProdutorPeloId($infoproduto['id_usuario']);

                $compra = 
                [
                    'id'=>$d['id'],
                    'produto'=>$infoproduto['descricao'],
                    'tipo'=>$tipo_de_compra['tipo'],
                    'produtor'=>$produtor['nome'],
                    'valor'=>$d['valor_de_compra'],
                    'data'=>$d['data_de_compra']
                ];

                array_push($compras,$compra);

            }

            return $compras;

        } else {
            return [];
        }
        
    }

}

interface AcoesDoInfoproduto
{

    //Criação do infoproduto
    public function Criar($src,$descricao,$preco,$percentual_para_afiliados,$data_de_criacao,$id_categoria,$id_tipo_de_infoproduto,$id_status_de_infoproduto,$id_usuario):void;
    public function CadastrarInfoproduto():void;

    // Busca de dados do infoproduto e produtor
    public function AcharProdutorDoInfoproduto($id):array;
    public function BuscarInfoprodutoPeloId($id):array;
    public function BuscarLivrosDoProdutor():array;
    public function BuscarLivrosDisponiveis():array;
    public function BuscarCursosDoProdutor():array;
    public function BuscarCursosDisponiveis():array;
    public function UploadDoLivro():void;
    public function BuscarStatus():array;
    public function BuscarCategorias():array;
    public function BuscarTipos():array;
    public function BuscarStatusDoInfoproduto($valor):array;
    public function BuscarTipoDoInfoprodutoPeloTipo($tipo):array;
    public function BuscarTipoDoInfoproduto($id):array;
    public function BuscarCategoriasDeInfoprodutos():array;
    
    //Edição do infoproduto
    public function Editar($id,$src,$descricao,$preco,$percentual_para_afiliados,$id_categoria,$id_status_de_infoproduto):void;
    public function EditarInfoproduto():void;
}

trait AulaDoCurso
{
    public int $id_aula_do_curso;
    public string $src;
    public int $numero_da_licao;
    public string $sumario;
    public int $id_curso;

    public function UploadDeVideoAula():void{

        if (isset($_POST['subir_video_aula'])) {
            
            $this->id = $_POST['id_curso'];
            $this->src = bin2hex(random_bytes(20)).'.mp4';
            $this->numero_da_licao = $_POST['licao'];
            $this->sumario = $_POST['sumario'];
            $extensao = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);
            $extensoes = ['mp4'];

            if (!in_array($extensao,$extensoes)) {

                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Arquivo não permitido, tente um arquivo do tipo mp4!</div>";
                
            }else {

                if (move_uploaded_file($_FILES['arquivo']['tmp_name'],'./public/video/'.$this->src)) {                    

                    $stmt = $this->conn->prepare("INSERT INTO aulas_dos_cursos (src,numero_da_licao,sumario,id_curso
                     )VALUES(:src,:numero_da_licao,:sumario,:id_curso
                     )");

                    $stmt->bindParam(':src',$this->src);
                    $stmt->bindParam(':numero_da_licao',$this->numero_da_licao);
                    $stmt->bindParam(':sumario',$this->sumario);
                    $stmt->bindParam(':id_curso',$this->id);
                    $stmt->execute();

                    $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> Upload da aula feito com sucesso!<br>clique <a href='./meus-produtos'>aqui</a></div>";

                } else {

                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel, Fazer o upload do arquivo</div>";
                }
            }   
        }
    }

    public function EfetuarEdicaoDaAula($src,$numero_da_licao,$sumario,$id_aula_do_curso){

        $stmt = $this->conn->prepare("UPDATE aulas_dos_cursos SET src = :src,numero_da_licao = :numero_da_licao,sumario = :sumario
            WHERE id = :id");

        $stmt->bindParam(':src',$src);
        $stmt->bindParam(':numero_da_licao',$numero_da_licao);
        $stmt->bindParam(':sumario',$sumario);
        $stmt->bindParam(':id',$id_aula_do_curso);
        $stmt->execute();

        $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> Upload da aula feito com sucesso!<br>clique <a href='./meus-produtos'>aqui</a></div>";
    }

    public function EditarVideoAula():void{

        if (isset($_POST['editar_video_aula'])) {
            
            $this->id_aula_do_curso = $_POST['id'];            
            $this->src = !empty($_FILES['arquivo']['name'])? bin2hex(random_bytes(40)).'.mp4' : $_SESSION['aula_src'];
            $this->numero_da_licao = $_POST['licao'];
            $this->sumario = $_POST['sumario'];
            $extensao = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);
            $extensoes = ['mp4'];

            if (!empty($_FILES['arquivo']['name'])) {

                if (!in_array($extensao,$extensoes)) {

                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Arquivo não permitido, tente um arquivo do tipo mp4!</div>";
                    
                }else {
    
                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'],'./public/video/'.$this->src)) {                    
    
                        $this->EfetuarEdicaoDaAula($this->src,$this->numero_da_licao,$this->sumario,$this->id_aula_do_curso);
    
                    } else {
    
                        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Não foi possivel, Fazer o upload do arquivo</div>";
                    }
                }   

            }else {
                $this->EfetuarEdicaoDaAula($this->src,$this->numero_da_licao,$this->sumario,$this->id_aula_do_curso);
            }

        }
    }

    public function BuscarVideoAulas($id):array{
        
        $stmt = $this->conn->query("SELECT * FROM aulas_dos_cursos WHERE id_curso = $id");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarVideoAula($id):array{
        
        $stmt = $this->conn->query("SELECT * FROM aulas_dos_cursos WHERE id = $id");

        if ($stmt->rowCount() > 0) {

            $aula = $stmt->fetch();
            $_SESSION['aula_src'] = $aula['src'];
            return $aula;

        } else {
            return [];
        }
        
    }
}

trait CapituloDoLivro
{
    public int $id_capitulo_do_livro;

    public int $numero_do_capitulo;

    public string $capitulo;

    public int $id_livro;

    public $icone_de_sucesso = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 01.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/> </svg> ";

    public function BuscarCapitulos($id):array{
        $stmt = $this->conn->query("SELECT * FROM capitulos_dos_livros WHERE id_livro = $id");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function BuscarCapitulo($id):array{
        $stmt = $this->conn->query("SELECT * FROM capitulos_dos_livros WHERE id = $id");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function AdicionarCapitulo():void{

        if (isset($_POST['adicionar_capitulo'])) {
            
            $this->id_capitulo_do_livro = $_POST['id_livro'];        
            $this->capitulo = $_POST['capitulo'];    
            $this->numero_do_capitulo = $_POST['numero_do_capitulo'];

            $stmt = $this->conn->prepare("INSERT INTO capitulos_dos_livros (numero_do_capitulo,capitulo,id_livro
             )VALUES(:numero_do_capitulo,:capitulo,:id_livro
             )");

            $stmt->bindParam(':numero_do_capitulo',$this->numero_do_capitulo);
            $stmt->bindParam(':capitulo',$this->capitulo);
            $stmt->bindParam(':id_livro',$this->id_capitulo_do_livro);
            $stmt->execute();

            $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this->icone_de_sucesso."</pan> Capitulo adicionado com sucesso!<br>clique <a href='./meus-produtos'>aqui</a></div>";

        }
    }

    public function EditarCapitulo():void{

        if (isset($_POST['editar_capitulo'])) {

            $this->id_capitulo_do_livro = $_POST['id'];
            $this->capitulo = $_POST['capitulo'];
            $this->numero_do_capitulo = $_POST['numero_do_capitulo'];

            $stmt = $this->conn->prepare("UPDATE capitulos_dos_livros SET numero_do_capitulo = :numero_do_capitulo,capitulo = :capitulo
              WHERE id = :id
            ");

            $stmt->bindParam(':numero_do_capitulo',$this->numero_do_capitulo);
            $stmt->bindParam(':capitulo',$this->capitulo);
            $stmt->bindParam(':id',$this->id_capitulo_do_livro);
            $stmt->execute();

            $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> Upload da aula feito com sucesso!<br>clique <a href='./meus-produtos'>aqui</a></div>";
        }
    }
}
