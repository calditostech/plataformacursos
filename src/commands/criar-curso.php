<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Edsonmaia\Cursos\Entity\Curso;
use Edsonmaia\Cursos\Helper\EntityManagerFactory;

$curso1 = new Curso();
$curso1->setNomeCurso('PHP 7.4');
$curso1->setCh(120);

$curso2 = new Curso();
$curso2->setNomeCurso('PHP 7.4 Orientado a Objetos');
$curso2->setCh(140);

$curso3 = new Curso();
$curso3->setNomeCurso('JavaScript');
$curso3->setCh(160);

$curso4 = new Curso();
$curso4->setNomeCurso('React');
$curso4->setCh(80);

$curso5 = new Curso();
$curso5->setNomeCurso('Angular');
$curso5->setCh(80);

// GERENCIAR ENTIDADES CURSOS
$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Doctrine observa as modificações na entidade
//$entityManager->persist($curso1);
//$entityManager->persist($curso2);
//$entityManager->persist($curso3);
$entityManager->persist($curso5);

// Doctrine salva as modificações na base de dados = INSERT, flush = descarga
$entityManager->flush();
