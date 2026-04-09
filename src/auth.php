<?php

require_once __DIR__ . '/db.php';

function start_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function auth_user(): ?array
{
    start_session();
    return $_SESSION['user'] ?? null;
}

function require_auth(): array
{
    $user = auth_user();
    if (!$user) {
        header('Location: login.php');
        exit;
    }
    return $user;
}

function login_user(string $email, string $password): bool
{
    $pdo = db();
    $stmt = $pdo->prepare('SELECT id, name, email, password_hash FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['password_hash'])) {
        return false;
    }

    start_session();
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
    ];
    return true;
}

function logout_user(): void
{
    start_session();
    $_SESSION = [];
    session_destroy();
}
