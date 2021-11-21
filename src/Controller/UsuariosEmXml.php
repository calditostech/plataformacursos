<?php

namespace Edsonmaia\Cursos\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;
use Edsonmaia\Cursos\Entity\Usuario;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UsuariosEmXml implements RequestHandlerInterface
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
        /** @var Usuario[] $usuarios */
        $usuarios = $this->repositorioDeUsuarios->findAll();
        $usuariosEmXml = new \SimpleXMLElement('<usuarios/>');

        foreach ($usuarios as $usuario) {
            $usuarioEmXml = $usuariosEmXml->addChild('usuario');
            $usuarioEmXml->addChild('id', $usuario->getId());
            $usuarioEmXml->addChild('email', $usuario->getEmail());
        }

        return new Response(200, ['Content-Type' => 'application/xml'], $usuariosEmXml->asXML());
    }

}
