<?php

require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/filmes.php';

require_auth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$titulo = trim($_POST['nome'] ?? '');
$genero = trim($_POST['genero'] ?? '');
$ano = (int) ($_POST['ano'] ?? 0);
$nota = (float) ($_POST['nota'] ?? -1);

if ($titulo === '' || $genero === '' || $ano < 1888 || $ano > 2100 || $nota < 0 || $nota > 10) {
    header('Location: index.php?erro=1#cadastro');
    exit;
}

criar_filme([
    'title' => $titulo,
    'year' => $ano,
    'rating' => $nota,
    'genre' => $genero,
]);

header('Location: index.php?sucesso=1#catalogo');
exit;
