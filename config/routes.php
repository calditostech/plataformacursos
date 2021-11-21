<?php

use Edsonmaia\Cursos\Controller\{
    Exclusao,
    FormularioLogin,
    RealizarLogin,
    FormularioEdicao,
    FormularioInsercaoCurso,
    ListarCursos,
    Persistencia,
    Inicio,
    Deslogar,
    ListarUsuarios,
    CursosEmJson,
    CursosEmXml,
    UsuariosEmJson,
    UsuariosEmXml,
    };

return [
    ''                 => Inicio::class,
    '/'                => Inicio::class,
    '/index'           => Inicio::class,
    '/listar-cursos'   => ListarCursos::class,
    '/novo-curso'      => FormularioInsercaoCurso::class,
    '/salvar-curso'    => Persistencia::class,
    '/excluir-curso'   => Exclusao::class,
    '/alterar-curso'   => FormularioEdicao::class,
    '/login'           => FormularioLogin::class,
    '/realiza-login'   => RealizarLogin::class,
    '/logout'          => Deslogar::class,
    '/listar-usuarios' => ListarUsuarios::class,

    '/buscarCursosEmJson'   => CursosEmJson::class,
    '/buscarCursosEmXml'    => CursosEmXml::class,
    '/buscarUsuariosEmJson' => UsuariosEmJson::class,
    '/buscarUsuariosEmXml'  => UsuariosEmXml::class,
];
