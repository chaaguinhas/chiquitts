-- MySQL Script generated by MySQL Workbench
-- Qua 15 Mai 2019 17:10:51 -04
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Table `marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marca` (
  `idmarca` INT NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmarca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proprietario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proprietario` (
  `idproprietario` INT(200) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  PRIMARY KEY (`idproprietario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veiculo` (
  `idveiculo` INT NOT NULL AUTO_INCREMENT,
  `idproprietario` INT NOT NULL,
  `idmarca` INT NOT NULL,
  `placa` CHAR(7) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `ano` INT NOT NULL,
  PRIMARY KEY (`idveiculo`),
  INDEX `fk_veiculo_proprietario_idx` (`idproprietario` ASC),
  CONSTRAINT `fk_veiculo_proprietario`
    FOREIGN KEY (`idproprietario`)
    REFERENCES `proprietario` (`idproprietario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_veiculo_marca1`
    FOREIGN KEY (`idmarca`)
    REFERENCES `marca` (`idmarca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO usuario (idusuario, email, senha, nome) VALUES
  ('1','thor@gmail.com','marvel', 'THOR'),
  ('2','hulk@gmail.com', 'marvel', 'HULK'),
  ('3','iron.man@gmail.com', 'marvel', 'IRON MAN'),
  ('4', 'thanos@gmail.com', 'marvel', 'THANOS O DESTEMIDO');

INSERT INTO marca (marca) VALUES
	('Fiat'),
	('Volkswagen'),
	('Chevrolet'),
	('Ford'),
	('Renault'),
	('Toyota'),
	('Nissan'),
	('Hyundai'),
	('Honda'),
	('Kia'),
	('Mercedes-Benz'),
	('Peugeot'),
	('BMW'),
	('Audi'),
	('Mazda'),
	('Buick'),
	('Jeep'),
	('Suzuki'),
	('Changan'),
	('Maruti Suzuki');	