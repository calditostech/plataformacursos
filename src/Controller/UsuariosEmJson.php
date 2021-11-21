<?php

namespace Edsonmaia\Cursos\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;
use Edsonmaia\Cursos\Entity\Usuario;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UsuariosEmJson implements RequestHandlerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioDeUsuarios;

    //public function __construct(EntityManagerInterface $entityManager)
    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager
            ->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $usuarios = $this->repositorioDeUsuarios->findAll();
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($usuarios));
    }

}