<?php

// IMPLEMENTAR A PSR11 Container interface para injetar dependencias
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    EntityManagerInterface::class => function () {
        return (new EntityManagerCreator())->getEntityManager();
    }
]);

$container = $builder->build();

return $container;
