<?php

class Usuario extends Database implements AcoesDoUsuario
{
    
    Use InformacaoBancaria;
    Use Compra;

    private $conn;
    private $uri;
    private int $id;
    public string $src;
    public string $nome;
    public string $email;
    private string $senha;
    private int $saldo;
    public string $data_de_criacao;
    public int $id_tipo_de_usuario;	
    public  $id_informacoes_bancarias;
 
    public const icone_de_informacao = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>';
    public const icone_de_sucesso = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 01.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/> </svg> ";

    public function __construct(){
        $this->conn = $this->getConnection();
        $this->uri = 'http://localhost/bounty/projeto';
    }

    //Cadastro do usuario
    public function criarUsuario($src,$nome,$email,$senha,$saldo,$data_de_criacao,$id_tipo_de_usuario):void{
        //Inserindo dados na tabela de usuarios
        $stmt = $this->conn->query("INSERT INTO usuarios (src,nome,email,senha,saldo,data_de_criacao,id_tipo_de_usuario)
         VALUES 
        ('$src','$nome','$email','$senha','$saldo','$data_de_criacao','$id_tipo_de_usuario')");

        //Obtendo o ultimo id da última conexão com a base de dados
        $this->id = $this->conn->lastInsertId();

        //Inserindo dados na tabela de informacoes_bancarias
        $stmt = $this->conn->query("INSERT INTO informacoes_bancarias () VALUES ()");

        //Obtendo o ultimo id da última conexão com a base de dados
        $this->id_informacoes_bancarias = $this->conn->lastInsertId();
        
        //Alterando o id_informacoes_bancarias do usuário cadastrado na tabela de usuários
        $stmt = $this->conn->query("UPDATE usuarios SET id_informacoes_bancarias = '$this->id_informacoes_bancarias'
          WHERE id = '$this->id' ");
    }

    public function VerificarExistenciaDoUsuario($nome,$email):bool{
        //Verificando se o usuario já existe
        $stmt = $this->conn->query("SELECT * FROM usuarios WHERE nome = '$nome' OR email = '$email' ");

        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function ValidarFormulario($nome,$email,$senha,$confirmar_senha):bool{

        if (strlen($nome) < 8) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>".self::icone_de_informacao."</pan> Nome muito pequeno!</div>";
            return false;        

        } elseif (strlen($nome) > 20) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>".self::icone_de_informacao."</pan> Nome muito grande!</div>";
            return false;   

        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> Email inválido!</div>";
            return false;   

        }elseif ($senha != $confirmar_senha) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> As senhas são diferentes!</div>";
            return false;
    
        }elseif (strlen($senha) < 8) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> A senha deve ter no mínimo 8 caracteres</div>";
            return false;

        }elseif (!preg_match("/[a-z]/i",$senha) || !preg_match("/[0-9]/",$senha)) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> A senha deve ter no mínimo uma letra e um número</div>";
            return false;

        }else {

            return true;
        }

    }

    public function ValidarFormularioParaEdicaoDePerfil($nome,$email,$senha):bool{

        if (strlen($nome) < 8) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>".self::icone_de_informacao."</pan> Nome muito pequeno!</div>";
            return false;        

        } elseif (strlen($nome) > 20) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>".self::icone_de_informacao."</pan> Nome muito grande!</div>";
            return false;   

        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> Email inválido!</div>";
            return false;   

        }elseif (strlen($senha) < 8) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> A senha deve ter no mínimo 8 caracteres</div>";
            return false;

        }elseif (!preg_match("/[a-z]/i",$senha) || !preg_match("/[0-9]/",$senha)) {

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'>
            <span>". self::icone_de_informacao ."</pan> A senha deve ter no mínimo uma letra e um número</div>";
            return false;

        }else {

            return true;
        }

    }

    public function Cadastro():void{
        session_start();
        $_SESSION['mensagem'] = '';
        
        if (isset($_POST['sign_up'])) {

            $this->src = 'default.png';
            $this->nome = $_POST['nome'];
            $this->email = $_POST['email'];
            $senha = $_POST['senha'];
            //codificando a senha
            $this->senha = hash('sha256',$senha);
            $this->saldo = 0.00;
            $this->data_de_criacao = date('d/m/y');
            $this->id_tipo_de_usuario = $_POST['id_tipo_de_usuario'];
            $confirmar_senha = $_POST['confirmar_senha'];

            $validados = $this->ValidarFormulario($this->nome,$this->email,$senha,$confirmar_senha);

            if (!empty($validados)) {

                if (empty($this->VerificarExistenciaDoUsuario($this->nome,$this->email))) {

                    $this->criarUsuario($this->src,$this->nome,$this->email,$this->senha,
                    $this->saldo,$this->data_de_criacao,$this->id_tipo_de_usuario);

                    $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>$this->icone_de_sucesso</pan> Conta criada com sucesso</div>";
                    header('Location:../usuarios/login');

                }else {

                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>$this->icone_de_informacao</pan> Esta conta já existe</div>";

                }
                
            }
            
        }

    }
    
    //Autenticação do usuario
    public function AcharUsuarioPeloEmail($email):array{
        //Verificando se o usuario já existe
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $usuario = $stmt->fetch();

            return $usuario;
        }else{
            return [];
        }
    }

    public function AcharUsuarioPeloId($id):array{
        //Achando o usuário pelo id
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return $stmt->fetch();

        }else{

            return [];
        }
    }

    public function AcharInformacoesBancariasDoUsuario($id):array{
        //Achando o usuário pelo id
        $stmt = $this->conn->prepare("SELECT * FROM informacoes_bancarias WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return  $stmt->fetch();
        }else{
            return [];
        }
    }

    public function VerificarSenha($senha1,$senha2):bool{
        //Verificando se as senhas são iguais
        
        if ($senha1 == $senha2) {
            return true;
        }else{
            return false;
        }
    }

    public function BuscarTipoDeUsuarioPeloId($id):array{

        $stmt = $this->conn->query("SELECT * FROM tipos_de_usuario WHERE id = '$id'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function AlterarTokenDeSessao($token,$tipo,$id_informacoes_bancarias):void {

        // Salvar token na session
        $_SESSION["token"] = $token;
        $_SESSION["tipo_de_usuario"] = $tipo;
        $_SESSION["id_informacoes_bancarias"] = $id_informacoes_bancarias;
  
    }

    public function AutenticarUsuario():void{

        session_start();
        
        if (isset($_POST['sign_in'])) {

            $this->email = $_POST['email'];
            $senha = $_POST['senha'];
            //codificando a senha
            $this->senha = hash('sha256',$senha);
            
            // Achar o usuario
            $usuario = $this->AcharUsuarioPeloEmail($this->email);

            if (!empty($usuario)) {
                
                // Checar se as senhas batem
                $batem = $this->VerificarSenha($usuario['senha'],$this->senha);
                if ($batem == true) {

                    $_SESSION['src'] = $usuario['src'];
                    $nome = $usuario['nome'];
                    $resposta = $this->BuscarTipoDeUsuarioPeloId($usuario['id_tipo_de_usuario']);

                    // Atualizar token do usuário
                    $this->AlterarTokenDeSessao($usuario['id'],$resposta['tipo'],$usuario['id_informacoes_bancarias']);

                    //Verificar tipo de usuário e redirecionar
                    $dados = $this->BuscarTipoDeUsuarioPeloId($usuario['id_tipo_de_usuario']);

                    if ($dados['tipo'] == 'Administrador') {
                        header('Location:../gerir-usuarios');
                    } else {
                        header('Location:../perfil');
                    }
                    
                } else if ($batem != true){

                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Senha incorreta </div>";
                }
                
            } else {

                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Conta não encontrada</div>";
                
            }
        }
        
    }

    //Edição do perfil do usuário
    public function EditarInformacoesBasicas($id,$src,$nome,$email,$senha):void{

        $stmt = $this->conn->query("UPDATE usuarios SET src = '$src',nome = '$nome',email = '$email', senha = '$senha'
        WHERE id = '$id' ");
        
        if (!empty($_FILES['src']['name'])) {
            
            move_uploaded_file($_FILES['src']['tmp_name'],'./public/img/usuarios/'.$src);
        }

    }

    public function EditarInformacoesBancarias($id,$banco,$titular_da_conta,$iban):void{

        $stmt = $this->conn->query("UPDATE informacoes_bancarias SET banco = '$banco',titular_da_conta = '$titular_da_conta',iban = '$iban'
          WHERE id = '$id' ");
    }

    public function EditarPerfil():void{

        $_SESSION['mensagem'] = '';

        if (isset($_POST['editar_informacoes_basicas'])) {

            $this->id = $_POST['id'];
            $this->src = empty( $_FILES['src']['name']) ? $_SESSION['src'] :  bin2hex(random_bytes(20)).$_FILES['src']['name'];
            $this->nome = $_POST['nome'];
            $this->email = $_POST['email'];
            $senha = $_POST['senha'];
            $this->senha = hash('sha256',$senha);
            $validados = $this->ValidarFormularioParaEdicaoDePerfil($this->nome,$this->email,$this->senha);

            if (!empty($validados)) {

                $this->EditarInformacoesBasicas($this->id,$this->src,$this->nome,$this->email,$this->senha);
                header("location:./perfil");
            }
            
        }elseif (isset($_POST['editar_informacoes_bancarias'])) {

            $this->id = $_POST['id'];
            $this->id_informacoes_bancarias = $_POST['id_informacoes_bancarias'];
            $this->banco = $_POST['banco'];
            $this->titular_da_conta = $_POST['titular_da_conta'];
            $this->iban = $_POST['iban'];
            $this->EditarInformacoesBancarias($this->id_informacoes_bancarias,$this->banco,$this->titular_da_conta,$this->iban);
            header("location:./perfil");
        }
    }

    //Logout do usuário
    public function FazerLogout():void{
        
        if (isset($_POST['logout'])) {

            $_SESSION["token"] = '';
            $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</span> Sessão terminada com sucesso!</div>";
            header("Location:./");

        }
    }

    //Transações do usuário
    public function transacao():void{

        $stmt = $this->conn->prepare("INSERT INTO transacoes (banco,titular_da_conta,iban,valor_de_transacao,comprovativo,data_de_pedido,id_status_de_transacao,id_tipo_de_transacao,id_usuario) VALUES (:banco,:titular_da_conta,:iban,:valor_de_transacao,:comprovativo,:data_de_pedido,:id_status_de_transacao,:id_tipo_de_transacao,:id_usuario)");
        $stmt->bindParam(":banco",$this->banco);
        $stmt->bindParam(":titular_da_conta",$this->titular_da_conta);
        $stmt->bindParam(":iban",$this->iban);
        $stmt->bindParam(":valor_de_transacao",$this->valor_de_transacao);
        $stmt->bindParam(":comprovativo",$this->comprovativo);
        $stmt->bindParam(":data_de_pedido",$this->data_de_pedido);
        $stmt->bindParam(":id_status_de_transacao",$this->id_status_de_transacao);
        $stmt->bindParam(":id_tipo_de_transacao",$this->id_tipo_de_transacao);
        $stmt->bindParam(":id_usuario",$this->id);
        $stmt->execute();

    }

    public function EfetuarDeposito():void{

        $this->comprovativo = bin2hex(random_bytes(20)).$_FILES['comprovativo']['name'];
        $this->transacao();
        move_uploaded_file($_FILES['comprovativo']['tmp_name'],'./public/img/comprovativos/'.$this->comprovativo);            

        $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> Depósito efetuado com sucesso</div>";

    }

    public function EfetuarSaque():void{

        $this->comprovativo = '';
        $this->transacao();       
        $this->saldo = (double) $this->saldo - $this->valor_de_transacao;
        $stmt = $this->conn->prepare("UPDATE usuarios SET saldo = :saldo WHERE id = $this->id");
        $stmt->bindParam(":saldo",$this->saldo);
        $stmt->execute();

        $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> Saque efetuado com sucesso</div>";
    }

    public function BuscarTipoDeTransacao($tipo_de_transacao):array{
        $stmt = $this->conn->query("SELECT * FROM tipos_de_transacao WHERE tipo = '$tipo_de_transacao'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarTipoDeUsuario($tipo):array{

        $stmt = $this->conn->query("SELECT * FROM tipos_de_usuario WHERE tipo = '$tipo'");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarStatusDeTransacao($id):array{
        $stmt = $this->conn->query("SELECT * FROM status_de_transacao WHERE id = '$id' ");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function BuscarStatusDeTransacoes():array{
        $stmt = $this->conn->query("SELECT * FROM status_de_transacao ");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        
    }

    public function AcharTransacoesDoUsuario($id,$tipo_de_transacao):array{

        $tipo_de_transacao = $this->BuscarTipoDeTransacao($tipo_de_transacao);
        $id_tipo_de_transacao = $tipo_de_transacao['id'];

        $transacoes = [];

        $stmt = $this->conn->query("SELECT * FROM transacoes WHERE id_usuario = '$id' AND id_tipo_de_transacao = '$id_tipo_de_transacao';");
        $transacao_do_usuario =  $stmt->fetchAll();

        foreach ($transacao_do_usuario as $value) {

            $transacao = [];
            $id_transacao = $value['id'];
            
            $stmt = $this->conn->query("SELECT * FROM transacoes WHERE id = '$id_transacao' AND id_tipo_de_transacao = '$id_tipo_de_transacao';");
            $t =  $stmt->fetch();

            $transacao['banco'] = $t['banco'];
            $transacao['titular'] = $t['titular_da_conta'];
            $transacao['iban'] = $t['iban'];
            $transacao['valor'] = $t['valor_de_transacao'];
            $transacao['data'] = $t['data_de_pedido'];
            $transacao['comprovativo'] = $t['comprovativo'];

            $status = $this->BuscarStatusDeTransacao($value['id_status_de_transacao']);
            $transacao['status'] = $status['valor'];

            array_push($transacoes,$transacao);

        }

        return $transacoes;
    }

    public function AcharUmTipoDeUsuario($id_usuario,$id_tipo):array{

        $stmt = $this->conn->query("SELECT * FROM usuarios WHERE id = $id_usuario AND id_tipo_de_usuario = $id_tipo");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        

    }

    public function AlterarSaldoDoUsuario($id,$saldo):void{

        $stmt = $this->conn->query("UPDATE usuarios SET saldo = $saldo WHERE id = $id");

    }

    //Transações do usuário
    public function transacoes():void{

        if (isset($_POST['efetuar_transacao'])) {

            $this->id = $_SESSION['token'];
            $this->banco = $_POST['banco'];
            $this->titular_da_conta = $_POST['titular_da_conta'];
            $this->iban = $_POST['iban'];
            $this->valor_de_transacao = $_POST['valor_de_transacao'];
            $this->data_de_pedido = date("y/m/d");
            $tipo_de_transacao = $_POST['tipo_de_transacao'];
            $valor = 'Em espera';

            $usuario = $this->AcharUsuarioPeloId($this->id);
            $this->saldo = $usuario['saldo'];

            $stmt = $this->conn->query("SELECT * FROM status_de_transacao WHERE valor = '$valor'");
            $status = $stmt->fetch();
            $this->id_status_de_transacao = $status['id'];

            $transacao = $this->BuscarTipoDeTransacao($tipo_de_transacao);
            $this->id_tipo_de_transacao = $transacao['id'];
            
            if ($transacao['tipo'] === 'Saque') {

                if ($usuario['saldo'] > 1000) {
                    $this->EfetuarSaque();
                }else{
                    $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> O seu saldo deve ser maior que 1000kzs</div>";
                }

            } elseif($transacao['tipo'] === 'Depósito') {
                $this->EfetuarDeposito();   
            }

        }

    }

    //Acóes de usuário(afiliado)
    public function MeAfiliarAUmInfoproduto():void{

        if (isset($_POST['me_afiliar'])) {

            $id = $_POST['id'];
            $id_afiliado = $_SESSION['token'];
            $url = $this->uri."/conhecer-plataforma?id=$id&af=$id_afiliado";
            $link = "<a href='$url'>$url</a>";
            $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan>Afiliado com sucesso, copie este link para venderes o produto na internet $link </div>";
        }
    }

    //Compra de infoprodutos
    public function ComprarInfoproduto():void{

        if (!empty($_POST['comprar_infoproduto'])) {

            $this->id_usuario = $_POST['id_usuario'];
            $this->data_de_compra = date("y/m/d");
            $this->id_infoproduto = $_POST['id'];

            $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id = $this->id_infoproduto");
            $dados = $stmt->fetch();

            $id_produtor = $dados['id_usuario'];
            $percentual = $dados['percentual_para_afiliados'];
            $this->valor_de_compra = $dados['preco'];

            //Buscar saldo do usuario
            $usuario = $this->AcharUsuarioPeloId($this->id_usuario);
            $this->saldo = $usuario['saldo'];

            if ($this->saldo >= $this->valor_de_compra) {
 
                if (!empty($_COOKIE['id_afiliado'])) {

                    //Efetuando compra por meio de afiliado  
                    $dados = $this->BuscarTipoDeCompra('Por meio de afiliado');
                    $this->id_tipo_de_compra = $dados['id'];
                    $this->EfetuarCompra($this->valor_de_compra,$this->id_tipo_de_compra,$this->id_infoproduto,$this->id_usuario);

                    //Alterando o saldo do aluno
                    $this->saldo = ($this->saldo - $this->valor_de_compra);
                    $this->AlterarSaldoDoUsuario($this->id_usuario,$this->saldo);

                    //Alterando o saldo do Afiliado
                    $afiliado = $this->AcharUsuarioPeloId($_COOKIE['id_afiliado']);
                    $comissao_para_afiliado =  (($this->valor_de_compra * $percentual)/100);
                    $percentual_para_produtor = (int) (100 - $percentual);
                    $this->saldo = ($this->saldo + $comissao_para_afiliado);
                    $this->AlterarSaldoDoUsuario($afiliado['id'],$this->saldo);

                    //Alterando o saldo do produtor
                    $comissao_para_produtor =  (($this->valor_de_compra * $percentual_para_produtor)/100);
                    $this->saldo = ($this->saldo + $comissao_para_produtor);
                    $this->AlterarSaldoDoUsuario($id_produtor,$this->saldo);

                    $tempo_de_vida = (time()+ 9000*1000);
                    setcookie("id_afiliado",0,$tempo_de_vida);

                    $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan>Produto comprado com sucesso!</div>";

                }else {
                    
                    //Efetuando á compra normal   
                    $dados = $this->BuscarTipoDeCompra('Normal');
                    $this->id_tipo_de_compra = $dados['id'];
                    $this->EfetuarCompra($this->valor_de_compra,$this->id_tipo_de_compra,$this->id_infoproduto,$this->id_usuario);

                    //Alterando o saldo do aluno
                    $this->saldo = ($this->saldo - $this->valor_de_compra);
                    $this->AlterarSaldoDoUsuario($this->id_usuario,$this->saldo);

                    //Alterando o saldo do produtor
                    $this->saldo = ($this->saldo + $this->valor_de_compra);
                    $this->AlterarSaldoDoUsuario($id_produtor,$this->saldo);

                    $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan>Produto comprado com sucesso!</div>";

                }
                
            }else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan>Erro, o seu saldo não é suficiente, faça um depósito!</div>";
            }
            
        }elseif (!empty($_GET['af'])) {
            
            //Cria ou altera o id do afiliado como um cookie no navegador
            $id = $_GET['af'];
            $tempo_de_vida = (time()+ 9000*1000);
            setcookie('id_afiliado',$id,$tempo_de_vida);

            $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan>Crie uma conta, faça login, e um depósito para efetuar a compra!</div>";

        }
        
    }

    public function BuscarTipoDeInfoprodutoAdquiridos($id,$tipo_de_infoproduto):array{

        //Verificando se o usuário tem infoprodutos comprados
        $stmt = $this->conn->query("SELECT * FROM compras WHERE id_usuario = '$id'");
            
        //Buscando esses infoprodutos se o usuário ter feito compras
        $comprados = [];
        $dados = $stmt->fetchAll();
        
        $stmt = $this->conn->query("SELECT * FROM tipos_de_infoproduto WHERE tipo = '$tipo_de_infoproduto'");
        $tipos = $stmt->fetch();
        $id_tipo_de_infoproduto = $tipos['id'];

        foreach ($dados as $i) {

            $id_infoproduto = $i['id_infoproduto'];
            $stmt = $this->conn->query("SELECT * FROM infoprodutos WHERE id = '$id_infoproduto' ");
            /**
             * @method
             */
            

            $infoproduto = $stmt->fetch();

            if ($infoproduto['id_tipo_de_infoproduto'] == $id_tipo_de_infoproduto) {
            
                //Adicionando o infoproduto comprado ao array comprados
                array_push($comprados,$infoproduto);
            }

        }
        
        //Retornando os infoprodutos comprados pelo usuário
        if (!empty($comprados)) {
            return $comprados;
        } else {
            return [];
        }
        
    }

    //Acóes de redifinição de senha

    public function GerarCodigoDeVerificacao($token,$expirada,$id_usuario){

        $stmt = $this->conn->query("INSERT INTO solicitacoes_de_redifinicao_de_senha
        (token,expirada,id_usuario)
         VALUES
        ('$token','$expirada','$id_usuario')");

    }

    public function EnviarEmail($email,$token){

        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "venanciokq91@gmail.com";
        $to = $email;
        $subject = "Código de verificaçaõ";
        $message = "O código de veriicação é : $token";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);

    }

    public function CodigoDeVerificacao(){

        if (isset($_POST['receber_codigo'])) {

            $this->email = $_POST['email'];
            $usuario = $this->AcharUsuarioPeloEmail($this->email);

            //Verificando se o email existe
            if (!empty($usuario)) {

                $token = bin2hex(random_bytes(4));
                $expirada = 0;
                $this->id = $usuario['id'];

                //Gerando o codigo de verificacao
                $this->GerarCodigoDeVerificacao($token,$expirada,$this->id);
                //Enviar email para o usuário
                $this->EnviarEmail($this->email,$token);
                header('Location:../usuarios/redefinir-senha');

                $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> O Código foi enviado para o seu email com sucesso!</div>";

            } else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Erro, Este email não existe</div>";
            }
            
        }
    }

    public function BuscarCodigoDeVerificacao($token){

        $stmt = $this->conn->query("SELECT * FROM solicitacoes_de_redifinicao_de_senha WHERE
         token = '$token' ");

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
        
    }

    public function AlterarSenha($id_usuario,$senha,$id_solicitacao){

        $stmt = $this->conn->query("UPDATE usuarios SET senha = '$senha' WHERE id = '$id_usuario' ");
        
        $stmt = $this->conn->query("UPDATE solicitacoes_de_redifinicao_de_senha SET expirada = 1 WHERE id = '$id_solicitacao' ");
    }

    public function RedefinirSenha(){

        if (isset($_POST['alterar_senha'])) {

            $senha = $_POST['nova_senha'];
            $this->senha = hash('sha256',$senha);
            $token = $_POST['codigo_de_verificacao'];
            $expirada = 0;
            $solicitacao = $this->BuscarCodigoDeVerificacao($token);

            //Verificando se a solicitacao existe
            if (!empty($solicitacao)) {

                switch ($solicitacao['expirada']) {

                    case 0:

                        //Alterando a senha
                        $this->id = $solicitacao['id_usuario'];
                        $this->AlterarSenha($this->id,$this->senha,$solicitacao['id']);
                        $link = "<a href='../usuarios/login'>Clique aqui</a>";

                        $_SESSION['mensagem'] = "<div class='alert alert-success mt-5 p-3 center' role='alert'><span>".$this::icone_de_sucesso."</pan> A sua senha foi redefinida com sucesso!$link</div>";

                        break;
                    
                    default:

                        $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan> Está solicitacao está expirada, faça uma outra!</div>";
                        break;
                }
                

            } else {
                $_SESSION['mensagem'] = "<div class='alert alert-danger mt-5 p-3 center' role='alert'><span>".$this::icone_de_informacao."</pan>Erro, Código de verificação incorreto!</div>";
            }
            
        }
    }

    //Acões do Administrador
    public function EditarUsuario():void{

        $_SESSION['mensagem'] = '';

        if (isset($_POST['editar_informacoes_basicas_do_usuario'])) {

            $this->id = $_POST['id'];
            $this->saldo = $_POST['saldo'];
            $this->nome = $_POST['nome'];
            $this->email = $_POST['email'];
            $this->senha = $_POST['senha'];
            $stmt = $this->conn->query("UPDATE usuarios SET nome = '$this->nome',email = '$this->email', senha = '$this->senha',saldo = '$this->saldo'
            WHERE id = '$this->id' ");
            header("location:./editar-usuario?id=$this->id");

        }elseif (isset($_POST['editar_informacoes_bancarias_do_usuario'])) {

            $this->id = $_POST['id'];
            $this->id_informacoes_bancarias = $_POST['id_informacoes_bancarias'];
            $this->banco = $_POST['banco'];
            $this->titular_da_conta = $_POST['titular_da_conta'];
            $this->iban = $_POST['iban'];
            $this->EditarInformacoesBancarias($this->id_informacoes_bancarias,$this->banco,$this->titular_da_conta,$this->iban);
            header("location:./editar-usuario?id=$this->id");
        }
        
    }

    public function AlterarStatusDaTransacao(){

        if (isset($_POST['alterar_status_de_transacao'])) {

            $this->id = $_POST['id_usuario'];
            $this->comprovativo = $_POST['comprovativo'];    

            $this->id_status_de_transacao = $_POST['id_status'];    
            $this->conn->query("UPDATE transacoes SET id_status_de_transacao = '$this->id_status_de_transacao' 
             WHERE comprovativo = '$this->comprovativo'");

            header("Location:./editar-usuario?id=$this->id");;
        }
        
    }
}

interface AcoesDoUsuario{
                            
    //Acões de registro do usuário
    public function VerificarExistenciaDoUsuario($nome,$email):bool;
    public function criarUsuario($src,$nome,$email,$senha,$saldo,$data_de_criacao,$id_tipo_de_usuario):void;
    public function Cadastro():void;

    //Acões de autenticação do usuário
    public function AcharUsuarioPeloEmail($email):array;
    public function AcharUsuarioPeloId($id):array;
    public function AcharInformacoesBancariasDoUsuario($id_usuario):array;
    public function VerificarSenha($senha1,$senha2):bool;
    public function AlterarTokenDeSessao($token,$tipo,$id_informacoes_bancarias):void;
    public function AutenticarUsuario():void;

    //Acões de edição do perfil do usuário
    public function EditarPerfil():void;
    public function EditarInformacoesBasicas($id,$src,$nome,$email,$senha):void;
    public function EditarInformacoesBancarias($id,$banco,$titular_da_conta,$iban):void;

    //Ações de logout do usuário
    public function FazerLogout():void;

    //Ações acerca das transações do usuário
    public function transacao():void;
    public function EfetuarDeposito():void;
    public function EfetuarSaque():void;
    public function BuscarTipoDeTransacao($tipo_de_transacao):array;
    public function BuscarStatusDeTransacao($id):array;
    public function AcharTransacoesDoUsuario($id,$tipo_de_transacao):array;
    public function transacoes():void;

    //Ações de compra de infoproduto do usuário
    public function ComprarInfoproduto():void;
    public function BuscarTipoDeInfoprodutoAdquiridos($id,$tipo_de_infoproduto):array;
    
}

trait InformacaoBancaria
{
    public int $id_info_banc;
    public string $banco;
    public string $titular_da_conta;
    public string $iban;
    public float $valor_de_transacao;
    public string $comprovativo;
    public $data_de_pedido;
    public int $id_status_de_transacao;
    public int $id_tipo_de_transacao;
}

trait Compra
{
    public int $id_compra;
    public float $valor_de_compra;
    public string $data_de_compra;
    public int $id_tipo_de_compra;
    public int $id_infoproduto;
    public int $id_usuario;

    public function BuscarTipoDeCompra($tipo):array{
        $stmt = $this->conn->query("SELECT * FROM tipos_de_compra WHERE tipo = '$tipo' ");
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return [];
        }
    }

    public function EfetuarCompra($valor_de_compra,$id_tipo_de_compra,$id_usuario,$id_infoproduto):void{

        $stmt = $this->conn->query("INSERT INTO compras (valor_de_compra,id_tipo_de_compra,id_infoproduto,id_usuario
           )VALUES(
         $valor_de_compra,$id_tipo_de_compra,$id_infoproduto,$id_usuario
        )");

    }
}
