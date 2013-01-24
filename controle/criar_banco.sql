DROP DATABASE matapragas;
CREATE DATABASE matapragas;
USE matapragas;
CREATE TABLE clientes ( 
	id int NOT NULL auto_increment,
	nome varchar(255) NOT NULL,
	razao_social varchar(255) NOT NULL,
	cnpj char(18) NOT NULL,
	endereco varchar(255) NOT NULL,
	data_ultima_visita date NULL,
	data_proxima_visita date NULL,
	status varchar(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (nome),
	UNIQUE (cnpj),
	UNIQUE (razao_social)
);
CREATE TABLE funcionarios (
	id int NOT NULL auto_increment,
	nome varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	dias_semanas_trabalho varchar(255) NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE estoque (
	id int NOT NULL auto_increment,
	produto varchar(255) NOT NULL,
	codigo_produto char(10) NOT NULL,
	quantidade_produto varchar(255) NOT NULL,
	descricao_produto varchar(255) NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE servico_tecnico (
	id int NOT NULL auto_increment,
	data_execucao date NOT NULL,
	funcionario_id int NOT NULL,
	cliente_id int NOT NULL,
	tempo_garantia int NOT NULL,
	observacoes varchar(255) NOT NULL,
	status varchar(255) NOT NULL,
	tipo_servico varchar(255) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id),
	FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
CREATE TABLE users (
	id int NOT NULL auto_increment,
	tipo_usuario varchar(255) NOT NULL,
	login varchar(255) NOT NULL,
	senha varchar(255) NOT NULL,	
	PRIMARY KEY (id)
);

INSERT INTO clientes (nome, razao_social, cnpj, endereco, status) values ('ItCursos', 'Itrative Cursos', '12.123.123/1234-12', 'Rua Miguel Castro', 'contratado'),('Universidade Potiguar', 'ufrn', '11.123.123/1234-12', 'Rua Desconhecida', 'sob demanda'),('Evolux', 'Evolpixu', '13.123.123/1234-12', 'Rua Evesconhecida', 'contratado'); 

INSERT INTO funcionarios (nome) values ('Alisson Levi'),('Lucas Castro'),('Diego'),('Rodrigo Castro');

INSERT INTO servico_tecnico (data_execucao, funcionario_id, cliente_id, tempo_garantia, observacoes, status, tipo_servico) values ('2013-03-05', 1, 1, 3, 'nenhuma', 'agendado', 'rato, barata');

INSERT INTO users (tipo_usuario,login,senha) values ('agendamento','levi',md5('123456')),('estoque','rodrigo',md5('654321'));
