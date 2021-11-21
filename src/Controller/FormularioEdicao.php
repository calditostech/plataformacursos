<?php

namespace Edsonmaia\Cursos\Controller;

use Edsonmaia\Cursos\Entity\Curso;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15
use Doctrine\ORM\EntityManagerInterface;     // PSR11

class FormularioEdicao extends ControllerComHtml implements RequestHandlerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioCursos;

    //public function __construct()
    public function __construct(EntityManagerInterface $entityManager)
    {
        //$entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID de curso inválido');
            return new Response(302, ['Location' => '/listar-cursos']);
        }

        $curso = $this->repositorioCursos->find($id);

        $html  = $this->renderizaHtml('/cursos/novo-curso.php',
        [
            'curso'  => $curso,
            'titulo' => "Atualizar curso " . $curso->getNomeCurso()
        ]);
        
        return new Response(200, [], $html);
        
    }
}
