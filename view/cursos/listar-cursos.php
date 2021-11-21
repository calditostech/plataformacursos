<?php include __DIR__ . '/../inicio-html.php'; ?>

    <h1> <?= $titulo ?> </h1>

    <a href="/novo-curso" class="btn btn-primary mb-3">Novo Curso</a>

    <ul class="list-group">
      <?php foreach ($cursos as $curso): ?>
        <li class="list-group-item d-flex justify-content-between">
            <?php
              echo $curso->getNomeCurso() . " - " .
              $curso->getCh() . " horas" ?>

              <span>
                <a href="/alterar-curso?id=<?= $curso->getId(); ?>" class="btn btn-warning btn-sm">Atualizar</a> &nbsp;
                <a href="/excluir-curso?id=<?= $curso->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
              </span>
        </li>
      <?php endforeach; ?>
    </ul>

<?php include __DIR__ . '/../fim-html.php'; ?>