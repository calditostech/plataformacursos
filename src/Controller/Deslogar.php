<?php

namespace Edsonmaia\Cursos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15

class Deslogar implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy(); // destruir a sessao atual
        return new Response(302, ['Location' => '/login']);
    }

}
