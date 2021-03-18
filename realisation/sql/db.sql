/**
  Author : Pedroletti Michael
  CreationDate : 11.02.2021
 */

-- Export de la structure de la base pour cpa
CREATE DATABASE IF NOT EXISTS `gg110_cpa`;
USE `gg110_cpa`;

-- Export de la structure de la table abris. gg110_cpa
CREATE TABLE `gg110_cpa`.`abris` (
    `idAbris` INT NOT NULL AUTO_INCREMENT ,
    `fkCommune` INT NOT NULL ,
    `fkPieces` INT NOT NULL ,
    `nom` VARCHAR NOT NULL ,
    `statutVisite` TINYINT NOT NULL ,
    `placeDisponible` INT NOT NULL ,
    `responsable` VARCHAR NOT NULL ,
    PRIMARY KEY (`idAbris`)) ENGINE = InnoDB;

-- Export de la structure de la table utilisateurs. gg110_cpa
CREATE TABLE `gg110_cpa`.`utilisateurs` (
    `idUtilisateur` INT NOT NULL AUTO_INCREMENT ,
    `nom` VARCHAR(256) NOT NULL ,
    `prenom` VARCHAR(256) NOT NULL ,
    `mail` VARCHAR(256) NOT NULL ,
    `statuUtilisateur` BOOLEAN NOT NULL ,
    PRIMARY KEY (`idUtilisateur`)) ENGINE = InnoDB;

-- Export de la structure de la table communes. gg110_cpa
CREATE TABLE `gg110_cpa`.`communes` (
    `idCommune` INT NOT NULL AUTO_INCREMENT ,
    `nom` VARCHAR(256) NOT NULL ,
    `region` VARCHAR(256) NOT NULL ,
    PRIMARY KEY (`idCommune`)) ENGINE = InnoDB;

CREATE TABLE `gg110_cpa`.`pieces` (
    `idPiece` INT NOT NULL AUTO_INCREMENT ,
    `nom` VARCHAR(256) NOT NULL ,
    `placesDisponibles` INT NOT NULL ,
    `type` VARCHAR(256) NOT NULL ,
    PRIMARY KEY (`idPiece`)) ENGINE = InnoDB;

CREATE TABLE `gg110_cpa`.`defauts` (
    `idPiece` INT NOT NULL AUTO_INCREMENT ,
    `type` VARCHAR(256) NOT NULL ,
    `description` VARCHAR(256) NOT NULL ,
    PRIMARY KEY (`idPiece`)) ENGINE = InnoDB;

CREATE TABLE `gg110_cpa`.`pieces_defauts` (
    `fkPiece` INT NOT NULL ,
    `fkDefaut` INT NOT NULL )
    ENGINE = InnoDB;

CREATE TABLE `gg110_cpa`.`visite` (
    `idVisite` INT NOT NULL AUTO_INCREMENT ,
    `idExpert` INT NOT NULL ,
    `dateVisite` DATETIME NOT NULL ,
    `statutVisite` BOOLEAN NOT NULL ,
    `type` BOOLEAN NOT NULL ,
    PRIMARY KEY (`idVisite`))
    ENGINE = InnoDB;