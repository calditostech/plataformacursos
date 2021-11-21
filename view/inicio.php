<?php include __DIR__ . '/inicio-html.php'; ?>

<div class="px-4 py-5 my-5 text-center">
    
    <h1 class="display-5 fw-bold"> <?= $titulo ?> </h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Sistema Gerenciador de Cursos. Veja a listagem de cursos, cadastre novos cursos. Veja também a lista de usuários.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="/listar-cursos" class="btn btn-primary btn-lg px-4 gap-3">Cursos</a>
        <a href="/listar-usuarios"" class="btn btn-outline-secondary btn-lg px-4">Usuários</a>
      </div>
      <div class="d-grid gap-2 mt-4 d-sm-flex justify-content-sm-center">
        <a href="/buscarCursosEmJson" class="btn btn-secondary btn-lg px-4 gap-3">Cursos em JSON</a>
        <a href="/buscarCursosEmXml" class="btn btn-secondary btn-lg px-4 gap-3">Cursos em XML</a>
      </div>
      <div class="d-grid gap-2 mt-4 d-sm-flex justify-content-sm-center">
        <a href="/buscarUsuariosEmJson" class="btn btn-secondary btn-lg px-4 gap-3">Usuários em JSON</a>
        <a href="/buscarUsuariosEmXml" class="btn btn-secondary btn-lg px-4 gap-3">Usuários em XML</a>
      </div>
    </div>
  </div>

<?php include __DIR__ . '/fim-html.php'; ?>