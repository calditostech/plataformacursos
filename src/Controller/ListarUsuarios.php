<?php

namespace Edsonmaia\Cursos\Controller;

use Edsonmaia\Cursos\Entity\Usuario;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15
use Doctrine\ORM\EntityManagerInterface;     // PSR11

class ListarUsuarios extends ControllerComHtml implements RequestHandlerInterface
{

    private $repositorioDeUsuarios;

    //public function __construct()
    public function __construct(EntityManagerInterface $entityManager) // PARA INJETAR
    {
        //$entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // PEGAR NO REPOSITORIO
        $usuarios = $this->repositorioDeUsuarios->findAll();
        $html = $this->renderizaHtml('/usuarios/listar-usuarios.php',
        [
            'usuarios'  => $usuarios,
            'titulo' => "Lista de Usuários"
        ]);
        return new Response(200, [], $html);
    }

}
