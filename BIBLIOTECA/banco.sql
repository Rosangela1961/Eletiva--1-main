CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    editora VARCHAR(255),
    ano INT,
    quantidade INT DEFAULT 1,
    categoria VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT,
    livro_id INT,
    data_emprestimo VARCHAR(50) NOT NULL,
    data_devolucao VARCHAR(50) DEFAULT 'Pendente'
);-- Garante que a tabela de usuários exista com as colunas certas
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Insere o acesso padrão para você testar
INSERT INTO usuarios (usuario, senha) VALUES ('admin', '123');