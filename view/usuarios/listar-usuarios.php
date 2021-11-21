<?php include __DIR__ . '/../inicio-html.php'; ?>

    <h1> <?= $titulo ?> </h1>
    <!--
      <a href="/novo-usuario" class="btn btn-primary mb-3">Novo Usuário</a>
    -->
    <ul class="list-group">
      <?php foreach ($usuarios as $usuario): ?>
        <li class="list-group-item d-flex justify-content-between">
            <?= $usuario->getEmail() ?>

              <span>
              <!--
                <a href="/alterar-usuario?id=<?= $usuario->getId(); ?>" class="btn btn-warning btn-sm">Atualizar</a> &nbsp;
                <a href="/excluir-usuario?id=<?= $usuario->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
              -->
              </span>
        </li>
      <?php endforeach; ?>
    </ul>

<?php include __DIR__ . '/../fim-html.php'; ?>