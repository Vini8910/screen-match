<?php

require_once __DIR__ . '/../src/auth.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (login_user($email, $senha)) {
        header('Location: index.php');
        exit;
    }

    $erro = 'Email ou senha inválidos.';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScreenMatch | Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Manrope:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sm-black: #0b0b0f;
            --sm-panel: #1f1f2b;
            --sm-red: #e50914;
            --sm-text: #f5f5f7;
            --sm-muted: #a1a1b5;
        }
        body {
            font-family: "Manrope", sans-serif;
            background:
                linear-gradient(120deg, rgba(11, 11, 15, 0.6), rgba(11, 11, 15, 0.95)),
                url("https://images.unsplash.com/photo-1497032205916-ac775f0649ae?auto=format&fit=crop&w=1600&q=80") center/cover no-repeat;
            min-height: 100vh;
            color: var(--sm-text);
        }
        .brand {
            font-family: "Bebas Neue", sans-serif;
            letter-spacing: 0.3rem;
            font-size: 2.2rem;
            color: var(--sm-red);
        }
        .login-card {
            background: rgba(31, 31, 43, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        .form-control {
            background: #0e0e14;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: var(--sm-text);
        }
        .form-control:focus {
            border-color: var(--sm-red);
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.3);
        }
        .cta-btn {
            background: var(--sm-red);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
        }
        .muted {
            color: var(--sm-muted);
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4 brand">ScreenMatch</div>
                <div class="login-card p-4 p-md-5">
                    <h1 class="h3 mb-3">Entrar</h1>
                    <p class="muted mb-4">Acesse seu catálogo pessoal de filmes.</p>
                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= $erro; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button class="btn cta-btn" type="submit">Entrar</button>
                        </div>
                    </form>
                    <div class="mt-4 muted small">
                        Primeiro acesso? Rode o setup para criar o usuário inicial.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
