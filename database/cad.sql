-- username: 'root'
-- host: 'localhost'
-- DBname: 'cad_users'
-- pswd: ''

CREATE SCHEMA `cad_users` ;

CREATE TABLE `cad_users`.`cad` (
  `idcad` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `endereco` VARCHAR(150) NULL,
  `bairro` VARCHAR(100) NULL,
  `cidade` VARCHAR(100) NULL,
  `estado` VARCHAR(80) NULL,
  `telefone` VARCHAR(15) NULL,
  `cpf` VARCHAR(12) NULL,
  `idade` VARCHAR(3) NULL,
  `signo` VARCHAR(12) NULL,
  PRIMARY KEY (`idcad`));