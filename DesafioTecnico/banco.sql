-- drop database desafiotecnico;
create database desafiotecnico;
use desafiotecnico;

create table deputados(
    _id int unsigned auto_increment not null primary key,
    id int not null,
    nome varchar(200) not null,
    nomeServidor varchar(200) not null,
    partido varchar(50) not null,
    email varchar(200) not null
);

create table redes_sociais(
	_id int unsigned auto_increment not null primary key,
    nome varchar(100) not null,
    url varchar(300) not null,
    deputados_id int not null, foreign key(deputados_id) references deputados(id)
);

create table verbas_indenizatorias(
	_id int unsigned auto_increment not null primary key,
    nome varchar(200) not null,
    mes int unsigned not null,
    idDeputado int not null
);