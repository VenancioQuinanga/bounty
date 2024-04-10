# CRIAÇÃO DA BASE
/*Criando a base de dados Bounty*/
CREATE DATABASE bounty
DEFAULT CHARACTER SET utf8;

/*14 tabelas criadas*/

USE bounty;

CREATE TABLE tipos_de_usuario(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipo VARCHAR(50)
);

CREATE TABLE informacoes_bancarias(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    banco VARCHAR(100),
    titular_da_conta VARCHAR(100),
    iban TEXT UNIQUE
);

CREATE TABLE usuarios(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    src TEXT,
    nome VARCHAR(50),
    email TEXT,
    senha TEXT,
    saldo DECIMAL(10,2),
    data_de_criacao DATE,
    id_tipo_de_usuario INT,/*pode ser : produtor,aluno ou administrador*/
    id_informacoes_bancarias INT,
    FOREIGN KEY (id_tipo_de_usuario) REFERENCES tipos_de_usuario(id),
    FOREIGN KEY (id_informacoes_bancarias) REFERENCES informacoes_bancarias(id)
);

CREATE TABLE solicitacoes_de_redifinicao_de_senha(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    token TEXT,
    expirada BOOLEAN DEFAULT 0,/*pode ser : 1 ou 0 true or false*/
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE tipos_de_transacao(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipo VARCHAR(30)
);

CREATE TABLE status_de_transacao(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    valor VARCHAR(30)
);

CREATE TABLE transacoes(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    banco VARCHAR(100),
    titular VARCHAR(100),
    iban VARCHAR(100) unique,
    valor_de_transacao DECIMAL(10,2),
    data_de_pedido DATE,
    id_status_de_transacao INT,
    id_tipo_de_transacao INT,
    id_usuario INT,
    FOREIGN KEY (id_status_de_transacao) REFERENCES status_de_transacao(id),
    FOREIGN KEY (id_tipo_de_transacao) REFERENCES tipos_de_transacao(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE tipos_de_infoproduto(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipo VARCHAR(30)
);

CREATE TABLE status_de_infoproduto(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    valor VARCHAR(30)
);

CREATE TABLE categorias_de_infoprodutos(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    categoria VARCHAR(100)
);

CREATE TABLE infoprodutos(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    src TEXT,
    descricao VARCHAR(50),
    preco DECIMAL(10,2),
    percentual_para_afiliados VARCHAR(10),
    data_de_criacao DATE,
    id_categoria int,
    id_tipo_de_infoproduto  INT,
    id_status_de_infoproduto INT,
    id_usuario INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias_de_infoprodutos(id),
    FOREIGN KEY (id_tipo_de_infoproduto) REFERENCES tipos_de_infoproduto(id),
    FOREIGN KEY (id_status_de_infoproduto) REFERENCES status_de_infoproduto(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE aulas_dos_cursos(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    src TEXT,
    numero_da_licao INT,
    sumario VARCHAR(100),
    id_curso INT,
    FOREIGN KEY (id_curso) REFERENCES infoprodutos(id)
);

CREATE TABLE capitulos_dos_livros(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    numero_do_capitulo INT,
    capitulo VARCHAR(100),
    id_livro INT,
    FOREIGN KEY (id_livro) REFERENCES infoprodutos(id)
);

CREATE TABLE tipos_de_compra(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipo VARCHAR(50)
);

CREATE TABLE compras(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    valor_de_compra DECIMAL(10,2),
    data_de_compra TIMESTAMP,
    id_tipo_de_compra INT,
    id_infoproduto INT,
    id_usuario INT,
    FOREIGN KEY (id_tipo_de_compra) REFERENCES tipos_de_compra(id),
    FOREIGN KEY (id_infoproduto) REFERENCES infoprodutos(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

# INSERÇÃO DE DADOS INICIAIS 

/*Tipos de usuarios*/
INSERT INTO tipos_de_usuario(tipo) VALUES ('Administrador');
INSERT INTO tipos_de_usuario(tipo) VALUES ('Produtor');
INSERT INTO tipos_de_usuario(tipo) VALUES ('Aluno');

/*Tipos de transação*/
INSERT INTO tipos_de_transacao(tipo) VALUES ('Depósito');
INSERT INTO tipos_de_transacao(tipo) VALUES ('Saque');

/*Status de transação*/
INSERT INTO status_de_transacao(valor) VALUES ('Em espera');
INSERT INTO status_de_transacao(valor) VALUES ('Em revisão');
INSERT INTO status_de_transacao(valor) VALUES ('Sucesso');

/*Tipos de infoprodutos*/
INSERT INTO tipos_de_infoproduto(tipo) VALUES ('Curso em video');
INSERT INTO tipos_de_infoproduto(tipo) VALUES ('Livro');

/*Status de infoprodutos*/
INSERT INTO status_de_infoproduto(valor) VALUES ('Disponível');
INSERT INTO status_de_infoproduto(valor) VALUES ('Indisponível');

/*categorias de infoprodutos*/
INSERT INTO categorias_de_infoprodutos(categoria) VALUES ('Informàtica');
INSERT INTO categorias_de_infoprodutos(categoria) VALUES ('Marketing Digital');
INSERT INTO categorias_de_infoprodutos(categoria) VALUES ('Matemática');
INSERT INTO categorias_de_infoprodutos(categoria) VALUES ('Progamação');
INSERT INTO categorias_de_infoprodutos(categoria) VALUES ('Medicina');
INSERT INTO categorias_de_infoprodutos(categoria) VALUES ('Farmacia');

/*Tipos de compras*/
INSERT INTO tipos_de_compra(tipo) VALUES ('Normal');
INSERT INTO tipos_de_compra(tipo) VALUES ('Por meio de afiliado');

/*Criando um administrador*/
INSERT INTO informacoes_bancarias(banco,titular_da_conta,iban)
VALUES
('BFA','Jacó José Felipe',002233566787992211231);

INSERT INTO usuarios (src,nome,email,senha,saldo,data_de_criacao,id_tipo_de_usuario,id_informacoes_bancarias)
VALUES
('default.png','Jacó Felipe','Jaco567@gmail.com','2909Kq',0.00,'2024-03-08',1,1);