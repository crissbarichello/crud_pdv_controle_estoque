-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: db_pdv
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `itens_venda`
--

DROP TABLE IF EXISTS `itens_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens_venda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `venda_id` int DEFAULT NULL,
  `produto_id` int DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venda_id` (`venda_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`),
  CONSTRAINT `itens_venda_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_venda`
--

LOCK TABLES `itens_venda` WRITE;
/*!40000 ALTER TABLE `itens_venda` DISABLE KEYS */;
INSERT INTO `itens_venda` VALUES (1,1,1,2,10.00,20.00),(2,1,4,1,4.99,4.99),(3,2,4,3,4.99,14.97),(4,2,3,3,5.50,16.50),(5,2,5,3,18.90,56.70),(6,2,2,2,2.56,5.12),(7,3,20,1,8.49,8.49),(8,3,12,1,7.50,7.50),(9,3,6,1,1.00,1.00),(10,3,16,1,11.99,11.99),(11,3,23,1,2.49,2.49),(12,3,19,1,12.99,12.99);
/*!40000 ALTER TABLE `itens_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimentacoes_estoque`
--

DROP TABLE IF EXISTS `movimentacoes_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimentacoes_estoque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produto_id` int DEFAULT NULL,
  `tipo` enum('ENTRADA','SAIDA','AJUSTE') DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `data_movimento` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `movimentacoes_estoque_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacoes_estoque`
--

LOCK TABLES `movimentacoes_estoque` WRITE;
/*!40000 ALTER TABLE `movimentacoes_estoque` DISABLE KEYS */;
INSERT INTO `movimentacoes_estoque` VALUES (1,1,'ENTRADA',50,'Carga inicial','2026-09-08 21:42:19'),(2,2,'ENTRADA',100,'Carga inicial','2026-09-08 21:42:19'),(3,3,'ENTRADA',80,'Carga inicial','2026-09-08 21:42:19'),(4,4,'ENTRADA',60,'Carga inicial','2026-09-08 21:42:19'),(5,5,'ENTRADA',30,'Carga inicial','2026-09-08 21:42:19'),(6,1,'SAIDA',2,'Venda #1','2026-09-08 21:42:33'),(7,4,'SAIDA',1,'Venda #1','2026-09-08 21:42:33'),(8,4,'SAIDA',3,'Venda #2','2026-09-14 20:22:14'),(9,3,'SAIDA',3,'Venda #2','2026-09-14 20:22:14'),(10,5,'SAIDA',3,'Venda #2','2026-09-14 20:22:14'),(11,2,'SAIDA',2,'Venda #2','2026-09-14 20:22:14'),(12,7,'ENTRADA',40,'Carga inicial','2026-09-14 20:27:39'),(13,8,'ENTRADA',50,'Carga inicial','2026-09-14 20:27:39'),(14,9,'ENTRADA',80,'Carga inicial','2026-09-14 20:27:39'),(15,10,'ENTRADA',60,'Carga inicial','2026-09-14 20:27:39'),(16,11,'ENTRADA',100,'Carga inicial','2026-09-14 20:27:39'),(17,12,'ENTRADA',40,'Carga inicial','2026-09-14 20:27:39'),(18,13,'ENTRADA',70,'Carga inicial','2026-09-14 20:27:39'),(19,14,'ENTRADA',30,'Carga inicial','2026-09-14 20:27:39'),(20,15,'ENTRADA',120,'Carga inicial','2026-09-14 20:27:39'),(21,16,'ENTRADA',40,'Carga inicial','2026-09-14 20:27:39'),(22,17,'ENTRADA',35,'Carga inicial','2026-09-14 20:27:39'),(23,18,'ENTRADA',50,'Carga inicial','2026-09-14 20:27:39'),(24,19,'ENTRADA',25,'Carga inicial','2026-09-14 20:27:39'),(25,20,'ENTRADA',45,'Carga inicial','2026-09-14 20:27:39'),(26,21,'ENTRADA',60,'Carga inicial','2026-09-14 20:27:39'),(27,22,'ENTRADA',80,'Carga inicial','2026-09-14 20:27:39'),(28,23,'ENTRADA',70,'Carga inicial','2026-09-14 20:27:39'),(29,24,'ENTRADA',35,'Carga inicial','2026-09-14 20:27:39'),(30,25,'ENTRADA',30,'Carga inicial','2026-09-14 20:27:39'),(31,26,'ENTRADA',20,'Carga inicial','2026-09-14 20:27:39'),(43,20,'SAIDA',1,'Venda #3','2026-09-14 20:28:15'),(44,12,'SAIDA',1,'Venda #3','2026-09-14 20:28:15'),(45,6,'SAIDA',1,'Venda #3','2026-09-14 20:28:15'),(46,16,'SAIDA',1,'Venda #3','2026-09-14 20:28:15'),(47,23,'SAIDA',1,'Venda #3','2026-09-14 20:28:15'),(48,19,'SAIDA',1,'Venda #3','2026-09-14 20:28:15'),(49,7,'ENTRADA',40,'Carga inicial','2026-09-14 21:15:17'),(50,8,'ENTRADA',50,'Carga inicial','2026-09-14 21:15:17'),(51,9,'ENTRADA',80,'Carga inicial','2026-09-14 21:15:17'),(52,10,'ENTRADA',60,'Carga inicial','2026-09-14 21:15:17'),(53,11,'ENTRADA',100,'Carga inicial','2026-09-14 21:15:17'),(54,12,'ENTRADA',39,'Carga inicial','2026-09-14 21:15:17'),(55,13,'ENTRADA',70,'Carga inicial','2026-09-14 21:15:17'),(56,14,'ENTRADA',30,'Carga inicial','2026-09-14 21:15:17'),(57,15,'ENTRADA',120,'Carga inicial','2026-09-14 21:15:17'),(58,16,'ENTRADA',39,'Carga inicial','2026-09-14 21:15:17'),(59,17,'ENTRADA',35,'Carga inicial','2026-09-14 21:15:17'),(60,18,'ENTRADA',50,'Carga inicial','2026-09-14 21:15:17'),(61,19,'ENTRADA',24,'Carga inicial','2026-09-14 21:15:17'),(62,20,'ENTRADA',44,'Carga inicial','2026-09-14 21:15:17'),(63,21,'ENTRADA',60,'Carga inicial','2026-09-14 21:15:17'),(64,22,'ENTRADA',80,'Carga inicial','2026-09-14 21:15:17'),(65,23,'ENTRADA',69,'Carga inicial','2026-09-14 21:15:17'),(66,24,'ENTRADA',35,'Carga inicial','2026-09-14 21:15:17'),(67,25,'ENTRADA',30,'Carga inicial','2026-09-14 21:15:17'),(68,26,'ENTRADA',20,'Carga inicial','2026-09-14 21:15:17'),(80,7,'ENTRADA',40,'Carga inicial','2026-09-14 21:15:19'),(81,8,'ENTRADA',50,'Carga inicial','2026-09-14 21:15:19'),(82,9,'ENTRADA',80,'Carga inicial','2026-09-14 21:15:19'),(83,10,'ENTRADA',60,'Carga inicial','2026-09-14 21:15:19'),(84,11,'ENTRADA',100,'Carga inicial','2026-09-14 21:15:19'),(85,12,'ENTRADA',39,'Carga inicial','2026-09-14 21:15:19'),(86,13,'ENTRADA',70,'Carga inicial','2026-09-14 21:15:19'),(87,14,'ENTRADA',30,'Carga inicial','2026-09-14 21:15:19'),(88,15,'ENTRADA',120,'Carga inicial','2026-09-14 21:15:19'),(89,16,'ENTRADA',39,'Carga inicial','2026-09-14 21:15:19'),(90,17,'ENTRADA',35,'Carga inicial','2026-09-14 21:15:19'),(91,18,'ENTRADA',50,'Carga inicial','2026-09-14 21:15:19'),(92,19,'ENTRADA',24,'Carga inicial','2026-09-14 21:15:19'),(93,20,'ENTRADA',44,'Carga inicial','2026-09-14 21:15:19'),(94,21,'ENTRADA',60,'Carga inicial','2026-09-14 21:15:19'),(95,22,'ENTRADA',80,'Carga inicial','2026-09-14 21:15:19'),(96,23,'ENTRADA',69,'Carga inicial','2026-09-14 21:15:19'),(97,24,'ENTRADA',35,'Carga inicial','2026-09-14 21:15:19'),(98,25,'ENTRADA',30,'Carga inicial','2026-09-14 21:15:19'),(99,26,'ENTRADA',20,'Carga inicial','2026-09-14 21:15:19'),(111,7,'ENTRADA',40,'Carga inicial','2026-09-14 21:15:20'),(112,8,'ENTRADA',50,'Carga inicial','2026-09-14 21:15:20'),(113,9,'ENTRADA',80,'Carga inicial','2026-09-14 21:15:20'),(114,10,'ENTRADA',60,'Carga inicial','2026-09-14 21:15:20'),(115,11,'ENTRADA',100,'Carga inicial','2026-09-14 21:15:20'),(116,12,'ENTRADA',39,'Carga inicial','2026-09-14 21:15:20'),(117,13,'ENTRADA',70,'Carga inicial','2026-09-14 21:15:20'),(118,14,'ENTRADA',30,'Carga inicial','2026-09-14 21:15:20'),(119,15,'ENTRADA',120,'Carga inicial','2026-09-14 21:15:20'),(120,16,'ENTRADA',39,'Carga inicial','2026-09-14 21:15:20'),(121,17,'ENTRADA',35,'Carga inicial','2026-09-14 21:15:20'),(122,18,'ENTRADA',50,'Carga inicial','2026-09-14 21:15:20'),(123,19,'ENTRADA',24,'Carga inicial','2026-09-14 21:15:20'),(124,20,'ENTRADA',44,'Carga inicial','2026-09-14 21:15:20'),(125,21,'ENTRADA',60,'Carga inicial','2026-09-14 21:15:20'),(126,22,'ENTRADA',80,'Carga inicial','2026-09-14 21:15:20'),(127,23,'ENTRADA',69,'Carga inicial','2026-09-14 21:15:20'),(128,24,'ENTRADA',35,'Carga inicial','2026-09-14 21:15:20'),(129,25,'ENTRADA',30,'Carga inicial','2026-09-14 21:15:20'),(130,26,'ENTRADA',20,'Carga inicial','2026-09-14 21:15:20');
/*!40000 ALTER TABLE `movimentacoes_estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `estoque` int DEFAULT '0',
  `ativo` tinyint DEFAULT '1',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'789000001','Coca-Cola 2L',6.50,10.50,50,1,'2026-09-08 21:42:15'),(2,'789000002','Água Mineral 500ml',1.20,2.56,98,1,'2026-09-08 21:42:15'),(3,'789000003','Chocolate Barra 90g',3.00,5.50,77,1,'2026-09-08 21:42:15'),(4,'789000004','Biscoito Recheado',2.50,4.99,56,1,'2026-09-08 21:42:15'),(5,'789000005','Café 500g',12.00,18.90,27,1,'2026-09-08 21:42:15'),(6,'789000006','Paçoquinha Melhor do Brasil',0.50,1.00,99,1,'2026-09-14 20:23:18'),(7,'789000007','Arroz Tipo 1 5Kg',22.50,29.90,40,1,'2026-09-14 20:26:29'),(8,'789000008','Feijão Preto 1Kg',5.80,8.49,50,1,'2026-09-14 20:26:29'),(9,'789000009','Açúcar Refinado 1Kg',3.90,5.99,80,1,'2026-09-14 20:26:29'),(10,'789000010','Óleo de Soja 900ml',5.50,7.99,60,1,'2026-09-14 20:26:29'),(11,'789000011','Leite Integral 1L',3.80,5.49,100,1,'2026-09-14 20:26:29'),(12,'789000012','Margarina 500g',4.90,7.50,39,1,'2026-09-14 20:26:29'),(13,'789000013','Macarrão Espaguete 500g',2.80,4.49,70,1,'2026-09-14 20:26:29'),(14,'789000014','Farinha de Trigo 5Kg',15.00,19.90,30,1,'2026-09-14 20:26:29'),(15,'789000015','Detergente Líquido 500ml',1.80,3.29,120,1,'2026-09-14 20:26:29'),(16,'789000016','Sabão em Pó 800g',7.50,11.99,39,1,'2026-09-14 20:26:29'),(17,'789000017','Papel Higiênico 12 Rolos',12.50,18.90,35,1,'2026-09-14 20:26:29'),(18,'789000018','Refrigerante Guaraná 2L',5.90,8.99,50,1,'2026-09-14 20:26:29'),(19,'789000019','Suco Uva Integral 1L',8.50,12.99,24,1,'2026-09-14 20:26:29'),(20,'789000020','Achocolatado 400g',5.20,8.49,44,1,'2026-09-14 20:26:29'),(21,'789000021','Biscoito Cream Cracker 400g',3.10,4.99,60,1,'2026-09-14 20:26:29'),(22,'789000022','Molho de Tomate 300g',1.80,2.99,80,1,'2026-09-14 20:26:29'),(23,'789000023','Sal Refinado 1Kg',1.50,2.49,69,1,'2026-09-14 20:26:29'),(24,'789000024','Água Sanitária 2L',4.20,6.99,35,1,'2026-09-14 20:26:29'),(25,'789000025','Desinfetante 2L',5.40,8.99,30,1,'2026-09-14 20:26:29'),(26,'789000026','Shampoo 350ml',9.50,14.99,20,1,'2026-09-14 20:26:29');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `perfil` enum('ADMIN','OPERADOR') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','admin','$2y$10$abcdefghijklmnopqrstuv','ADMIN'),(2,'Operador Caixa','caixa','$2y$10$abcdefghijklmnopqrstuv','OPERADOR');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data_venda` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) DEFAULT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (1,'2026-09-08 21:42:22',24.99,'PIX'),(2,'2026-09-14 20:22:14',93.29,'CARTAO'),(3,'2026-09-14 20:28:15',44.46,'DINHEIRO');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_pdv'
--

--
-- Dumping routines for database 'db_pdv'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-22 21:35:16
