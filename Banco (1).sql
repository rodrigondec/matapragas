CREATE DATABASE matapragas;
USE matapragas;
CREATE TABLE clientes ( 
	id int NOT NULL auto_increment,
	nome varchar(255) NOT NULL,
	razao_social varchar(255) NOT NULL,
	cnpj char(18) NOT NULL,
	endereço varchar(255) NOT NULL,
	data_ultima_visita date NOT NULL,
	data_proxima_visita date NOT NULL,
	status varchar(255) NOT NULL,
	PRIMARY KEY (id)
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
	PRIMARY KEY (id),
	FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id),
	FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
CREATE TABLE tipo_servico (
	id int NOT NULL auto_increment,
	nome_servico varchar(255) NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE tabela_intermediaria_servico (
	id int NOT NULL auto_increment,
	servico_id int NOT NULL,
	tipo_id int NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (servico_id) REFERENCES servico_tecnico(id),
	FOREIGN KEY (tipo_id) REFERENCES tipo_servico(id)
);
CREATE TABLE users (
	id int NOT NULL auto_increment,
	tipo_usuario varchar(255) NOT NULL,
	login varchar(255) NOT NULL,
	senha varchar(255) NOT NULL,	
	PRIMARY KEY (id)
);



INSERT INTO tipo_servico (nome_servico) values ('rato'),('barata'),('formiga'),('escorpiao'); 




INSERT INTO clientes (nome) values ('ItCursos'),('Universidade Potiguar'),('Evolux'); 




INSERT INTO funcionarios(nome) values ('Alisson Levi'),('Lucas Castro'),('Diego'),('Rodrigo Castro'); 



