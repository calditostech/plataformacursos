<?php

    $senha = "12345";

    $senhaCriptografada = password_hash($senha, PASSWORD_ARGON2I);

    echo "$senhaCriptografada";
