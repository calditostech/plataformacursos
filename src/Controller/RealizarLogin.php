<?php

namespace Edsonmaia\Cursos\Controller;

use Edsonmaia\Cursos\Entity\Usuario;
use Edsonmaia\Cursos\Infra\EntityManagerCreator;
use Edsonmaia\Cursos\Helper\FlashMessagesTrait; // ADICIONEI

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15
use Doctrine\ORM\EntityManagerInterface;     // PSR11

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessagesTrait; // ADICIONEI
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioDeUsuarios;

    //public function __construct()
    public function __construct(EntityManagerInterface $entityManager) // PARA INJETAR
    {
            //$entityManager = (new EntityManagerCreator())->getEntityManager();
            $this->entityManager = $entityManager;
            $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
     }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        //$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $email = filter_var($request->getParsedBody()['email'], FILTER_VALIDATE_EMAIL);

        if (is_null($email) || $email === false) {
            $this->defineMensagem('danger', "O e-mail digitado não é um e-mail válido.");
            return new Response(302, ['Location' =>'/login'], '');
        }

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        /** @var Usuario $usuario */
        $usuario = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger',"E-mail ou senha inválidos");
            return new Response(302, ['Location' =>'/login']);
        }

        // INDICAR NA SESSAO QUE ESTA LOGADO, ARMAZENAR O EMAIL NA SESSAO
        $_SESSION['logado'] = true;
        $_SESSION['email']  = $usuario->getEmail();
        $this->defineMensagem('success',"Usuário(a) logado(a) com sucesso!");

        return new Response(200, ['Location' =>'/']);
    }
}
