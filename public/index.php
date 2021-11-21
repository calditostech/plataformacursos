<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

use Psr\Http\Server\RequestHandlerInterface; // PSR15

$caminho = @$_SERVER['PATH_INFO'];
$rotas   = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start(); // INICIAR A SESSAO importante para o Sistema de Login

// PROTEGER O ACESSO
 $ehRotaDeLogin = stripos($caminho, 'login');
if(!isset($_SESSION['logado']) && $ehRotaDeLogin === false) {
//if(!isset($_SESSION['logado']) && $caminho !== "/login" && $caminho !== "/realiza-login") {
     header('Location: /login'); // redirecionar para login
     exit();                     // parar execucao
}
// PROTEGER O ACESSO

// USAR PSR7
$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];

// PARA INJETAR AS DEPENDENCIAS, NO FRONTCONTROLLER, CRIAR UM CONTAINER
/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/dependencies.php';

/** @var RequestHandlerInterface $controlador */
$controlador = $container->get($classeControladora);
//$controlador = new $classeControladora(); // SEM INJECAO DE DEPENDENCIA
$resposta = $controlador->handle($request);

// pegar os cabeçalhos
foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}
// pegar o corpo da pagina
echo $resposta->getBody();
