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

// DADOS PARA USAR NA EXCLUSÃO, SÓ O ID
$id = 8;

// 1 BUSCAR O CURSO PELO ID
//$curso = $cursoRepository->find($id); // ao buscar o doctrine ja observa o objeto curso
$curso = $entityManager->getReference(Curso::class, $id);

// VERIFICAR SE O CURSO EXISTE NA BASE DE DADOS
if (is_null($curso)) {
    echo "<p>Curso inexistente</p>";
}

$entityManager->remove($curso); // APAGAR O CURSO
$entityManager->flush($curso); // confirmar as modificacoes no objeto curso, aqui faz o UPDATE
