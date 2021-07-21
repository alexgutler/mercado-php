<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Db\Database;

$db = new Database;

$db->execute("SET FOREIGN_KEY_CHECKS = 0;");

// REMOVER E CRIAR A TABELA DE TIPOS DE PRODUTOS
$db->execute("DROP TABLE IF EXISTS `tipos_produtos`;");
$db->execute("CREATE TABLE `tipos_produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
      `nome` VARCHAR(150) NOT NULL,
      `descricao` TEXT NULL,
      `percentual_imposto` DECIMAL(10,2) NOT NULL,
      `ativo` TINYINT NOT NULL DEFAULT 1,
      `dh_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_unicode_ci
    AUTO_INCREMENT=1;"
);
$db->execute("INSERT INTO `tipos_produtos`(`id`,`nome`,`descricao`,`percentual_imposto`,`ativo`,`dh_cadastro`) VALUES 
    (1,'Notebook','',11.00,1,'2021-07-21 17:45:11'),
    (2,'Smartphone','',13.50,1,'2021-07-21 17:45:24'),
    (3,'Monitor','',8.75,1,'2021-07-21 17:45:50'),
    (4,'Smartwatch','',12.00,1,'2021-07-21 17:46:51');"
);

// REMOVER E CRIAR A TABELA DE PRODUTOS
$db->execute("DROP TABLE IF EXISTS `produtos`;");
$db->execute("CREATE TABLE `produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
      `tipo_id` INT NOT NULL,
      `nome` VARCHAR(155) NOT NULL,
      `descricao` TEXT NULL,
      `ativo` TINYINT NOT NULL DEFAULT 0,
      `dh_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      INDEX `produtos_tipo_id_foreign_idx` (`tipo_id` ASC),
      CONSTRAINT `produtos_tipo_id_foreign`
        FOREIGN KEY (`tipo_id`)
        REFERENCES `tipos_produtos` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_unicode_ci
    AUTO_INCREMENT = 1;"
);
$db->execute("INSERT INTO `produtos`(`id`,`tipo_id`,`nome`,`descricao`,`ativo`,`dh_cadastro`) VALUES 
    (1,4,'Smartwatch Samsung Galaxy Watch Active','',1,'2021-07-21 17:48:30'),
    (2,4,'Smartwatch Amazfit GTS 2','',1,'2021-07-21 17:49:06'),
    (3,4,'Smartwatch Apple Watch Serie 6','',1,'2021-07-21 17:49:19'),
    (4,2,'Smartphone Samsung Galaxy S21','',1,'2021-07-21 17:49:53'),
    (5,2,'Smartphone Apple iPhone 11','',1,'2021-07-21 17:50:04'),
    (6,2,'Smartphone Motorola Moto G10','',1,'2021-07-21 17:50:52'),
    (7,1,'Notebook Acer Aspire 5','',1,'2021-07-21 17:51:59'),
    (8,1,'Notebook Lenovo Ideapad 330','',1,'2021-07-21 17:52:39'),
    (9,1,'Notebook Dell Inspiron i15','',1,'2021-07-21 17:52:58');"
);

// REMOVER E CRIAR A TABELA DE VENDAS
$db->execute("DROP TABLE IF EXISTS `vendas`;");
$db->execute("CREATE TABLE `vendas` (
    `id` INT NOT NULL AUTO_INCREMENT,
      `observacoes` TEXT NULL,
      `valor_total_compra` DECIMAL(10,2) NOT NULL,
      `valor_total_imposto` DECIMAL(10,2) NOT NULL,
      `dh_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 1
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_unicode_ci;"
);

// REMOVER E CRIAR A TABELA DOS PRODUTOS DA VENDA
$db->execute("DROP TABLE IF EXISTS `vendas_produtos`;");
$db->execute("CREATE TABLE `vendas_produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
      `venda_id` INT NOT NULL,
      `produto_id` INT NOT NULL,
      `quantidade` INT NOT NULL,
      `valor_unitario` DECIMAL(10,2) NOT NULL,
      `valor_total` DECIMAL(10,2) NOT NULL,
      `percentua_imposto` DECIMAL(10,2) NULL,
      `valor_total_imposto` DECIMAL(10,2) NULL,
      PRIMARY KEY (`id`),
      INDEX `vendas_produtos_venda_id_foreign_idx` (`venda_id` ASC),
      INDEX `vendas_produtos_produto_id_foreign_idx` (`produto_id` ASC),
      CONSTRAINT `vendas_produtos_venda_id_foreign`
        FOREIGN KEY (`venda_id`)
        REFERENCES `vendas` (`id`)
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
      CONSTRAINT `vendas_produtos_produto_id_foreign`
        FOREIGN KEY (`produto_id`)
        REFERENCES `produtos` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB
    AUTO_INCREMENT = 1
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_unicode_ci;"
);

echo "BASE DE DADOS GERADA COM SUCESSO!";