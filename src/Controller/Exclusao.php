<?php

namespace Edsonmaia\Cursos\Controller;

use Edsonmaia\Cursos\Infra\EntityManagerCreator;
use Edsonmaia\Cursos\Entity\Curso;
use Edsonmaia\Cursos\Helper\FlashMessagesTrait; // ADICIONEI

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15
use Doctrine\ORM\EntityManagerInterface;     // PSR11

class Exclusao implements RequestHandlerInterface
{
    use FlashMessagesTrait; // ADICIONEI
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    //public function __construct()
    public function __construct(EntityManagerInterface $entityManager)
    {
        //$this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // pegar dados do formulario $_GET, usando filtros
        //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
        
        // redirecionar
        if(is_null($id) || $id === false) {
            $this->defineMensagem('danger',"Curso inexistente");
            return new Response(302, ['Location' => '/listar-cursos']);
        }

        // Pegar a referencia por id usando o Doctrine ORM
        $curso = $this->entityManager->getReference(Curso::class, $id);

        // Apagar do Banco
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->defineMensagem('success',"Curso excluído com sucesso");

        // redirecionar para outra pagina
        return new Response(200, ['Location' => '/listar-cursos']);

    }

}
