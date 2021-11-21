<?php

namespace Edsonmaia\Cursos\Controller;

use Edsonmaia\Cursos\Entity\Curso;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15
use Doctrine\ORM\EntityManagerInterface;     // PSR11

class ListarCursos extends ControllerComHtml implements RequestHandlerInterface
{

    private $repositorioDeCursos;

    //public function __construct()
    public function __construct(EntityManagerInterface $entityManager) // PARA INJETAR
    {
        //$entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // PEGAR NO REPOSITORIO
        $cursos = $this->repositorioDeCursos->findAll();
        $html   = $this->renderizaHtml('/cursos/listar-cursos.php',
        [
            'cursos'  => $cursos,
            'titulo' => "Lista de Cursos"
        ]);
        return new Response(200, [], $html);
    }

}
