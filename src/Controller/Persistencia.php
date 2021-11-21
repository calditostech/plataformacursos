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

class Persistencia implements RequestHandlerInterface
{
    use FlashMessagesTrait; // ADICIONEI
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    //public function __construct()
    public function __construct(EntityManagerInterface $entityManager) // PARA INJETAR
    {
        //$this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // pegar dados do formulario $_POST, usando filtros
        //$nomeCurso = filter_input(INPUT_POST, 'nomeCurso', FILTER_SANITIZE_STRING);
        //$chCurso   = filter_input(INPUT_POST, 'chCurso', FILTER_VALIDATE_INT);
        $nomeCurso = filter_var($request->getParsedBody()['nomeCurso'], FILTER_SANITIZE_STRING);
        $chCurso   = filter_var($request->getParsedBody()['chCurso'], FILTER_VALIDATE_INT);
        
        // montar modelo curso
        $curso = new Curso;
        $curso->setNomeCurso($nomeCurso);
        $curso->setCh($chCurso);

        // ATUALIZAR
        // pegar dados do formulario $_GET, usando filtros
        //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

        if(!is_null($id) && $id !== false) {
            // posso atualizar
            $curso->setId($id);
            // Como já temos o id, não precisa fazer o find,
            // basta fazer um merge (juntar) ja tenho um entidade montada, so que ele una
            $this->entityManager->merge($curso);
            $this->defineMensagem('success',"Curso atualizado com sucesso");
        } else {
            // Inserir no Banco
            $this->entityManager->persist($curso);
            $this->defineMensagem('success',"Curso inserido com sucesso");
        }
        
        $this->entityManager->flush();

        // redirecionar para outra pagina, false significa nao substituir o header, 302 movido temporaria
        return new Response(302, ['Location' => '/listar-cursos']);

    }

}
