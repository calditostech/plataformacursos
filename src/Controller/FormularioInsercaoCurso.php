<?php

namespace Edsonmaia\Cursos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Server\RequestHandlerInterface; // PSR15

class FormularioInsercaoCurso extends ControllerComHtml implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('/cursos/novo-curso.php',
        [
            'titulo' => "Cadastro de Curso"
        ]);
        return new Response(200, [], $html);
    }

}
