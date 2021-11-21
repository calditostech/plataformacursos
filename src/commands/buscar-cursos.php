<?php

use Edsonmaia\Cursos\Entity\Curso;
use Edsonmaia\Cursos\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

// GERENCIAR ENTIDADES CURSOS
$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// CRIAR REPOSITORIO DE CURSOS
$cursoRepository = $entityManager->getRepository(Curso::class);

/**
 * #var Curso[] $cursoList
 */
$cursoList = $cursoRepository->findAll(); // BUSCAR TODOS

foreach ($cursoList as $curso) {
    echo "<p>ID: {$curso->getId()}
     - Curso: {$curso->getNomeCurso()} 
     - CH   : {$curso->getCh()}</p>";
}

// BUSCAR POR ID
$busca1 = $cursoRepository->find(2);
echo "<p> {$busca1->getNomeCurso()} </p>";

// BUSCAR POR TODOS COM O NOME
$busca2 = $cursoRepository->findBy([
    'nomeCurso' => 'PHP 7.4'
]);
var_dump($busca2);

echo "<hr>"; // linha horizontal

// BUSCAR POR UM
$busca3 = $cursoRepository->findOneBy([
    'nomeCurso' => 'PHP 7.4'
]);
var_dump($busca3);
