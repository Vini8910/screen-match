<?php

require_once __DIR__ . '/db.php';

function listar_filmes(): array
{
    $pdo = db();
    $stmt = $pdo->query('SELECT id, title, year, rating, genre, created_at FROM movies ORDER BY created_at DESC');
    return $stmt->fetchAll();
}

function criar_filme(array $dados): void
{
    $pdo = db();
    $stmt = $pdo->prepare(
        'INSERT INTO movies (title, year, rating, genre, created_at) VALUES (:title, :year, :rating, :genre, :created_at)'
    );
    $stmt->execute([
        'title' => $dados['title'],
        'year' => $dados['year'],
        'rating' => $dados['rating'],
        'genre' => $dados['genre'],
        'created_at' => date('Y-m-d H:i:s'),
    ]);
}
