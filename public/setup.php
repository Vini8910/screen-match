<?php

$config = require __DIR__ . '/../src/config.php';
$db = $config['db'];

$setupEnabled = $config['setup_enabled'] ?? false;
if (!$setupEnabled) {
    http_response_code(403);
    echo 'Setup desativado.';
    exit;
}

$dsnRoot = sprintf('mysql:host=%s;charset=%s', $db['host'], $db['charset']);
$pdo = new PDO($dsnRoot, $db['user'], $db['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec(sprintf(
    'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET %s COLLATE %s',
    $db['name'],
    $db['charset'],
    $db['charset'] . '_unicode_ci'
));
$pdo->exec(sprintf('USE `%s`', $db['name']));

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(120) NOT NULL,
        email VARCHAR(180) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
);

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS movies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        year INT NOT NULL,
        rating DECIMAL(3,1) NOT NULL,
        genre VARCHAR(80) NOT NULL,
        created_at DATETIME NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
);

$stmt = $pdo->query('SELECT COUNT(*) as total FROM users');
$total = (int) $stmt->fetch()['total'];

if ($total === 0) {
    $senha = password_hash($config['admin']['password'], PASSWORD_DEFAULT);
    $insert = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password_hash)');
    $insert->execute([
        'name' => $config['admin']['name'],
        'email' => $config['admin']['email'],
        'password_hash' => $senha,
    ]);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup ScreenMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container py-5">
        <div class="alert alert-success">
            Banco criado com sucesso.
        </div>
        <p>Usuário inicial:</p>
        <ul>
            <li>Email: <strong><?= $config['admin']['email']; ?></strong></li>
            <li>Senha: <strong><?= $config['admin']['password']; ?></strong></li>
        </ul>
        <a class="btn btn-danger" href="login.php">Ir para login</a>
    </div>
</body>
</html>
