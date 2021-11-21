<?php

// IMPORTs das Classes
use Edsonmaia\Cursos\Entity\Curso;
use Edsonmaia\Cursos\Helper\EntityManagerFactory;

// AUTOLOAD
require_once __DIR__ . '/../../vendor/autoload.php';

// GERENCIAR ENTIDADES CURSOS
$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// CRIAR REPOSITORIO DE CURSOS
$cursoRepository = $entityManager->getRepository(Curso::class);

// DADOS PARA USAR NA ATUALIZAÇÃO
$id = 1;
$novoNomeCurso = "Angular JS";
$novaCh = 180;

// 1 BUSCAR O CURSO PELO ID
$curso = $cursoRepository->find($id); // ao buscar o doctrine ja observa o objeto curso

// DEFINIR OS DADOS PARA ATUALIZAR
//$curso->setNomeCurso($novoNomeCurso);
//$curso->setCh($novaCh);

//$entityManager->flush($curso); // confirmar as modificacoes no objeto curso, aqui faz o UPDATE
