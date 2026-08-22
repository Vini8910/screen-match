<?php

require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/filmes.php';

$user = require_auth();
$filmes = listar_filmes();

$sucesso = $_GET['sucesso'] ?? '';
$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScreenMatch | Catálogo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Manrope:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sm-black: #0b0b0f;
            --sm-dark: #14141c;
            --sm-panel: #1f1f2b;
            --sm-red: #e50914;
            --sm-red-glow: rgba(229, 9, 20, 0.35);
            --sm-text: #f5f5f7;
            --sm-muted: #a1a1b5;
        }
        * {
            scroll-behavior: smooth;
        }
        body {
            font-family: "Manrope", sans-serif;
            background-color: var(--sm-black);
            color: var(--sm-text);
        }
        .hero {
            position: relative;
            min-height: 70vh;
            background:
                linear-gradient(120deg, rgba(11, 11, 15, 0.4), rgba(11, 11, 15, 0.95)),
                url("https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80") center/cover no-repeat;
        }
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(60% 60% at 15% 20%, rgba(229, 9, 20, 0.25) 0%, transparent 60%);
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .brand {
            font-family: "Bebas Neue", sans-serif;
            letter-spacing: 0.3rem;
            font-size: 2rem;
            color: var(--sm-red);
        }
        .hero-title {
            font-family: "Bebas Neue", sans-serif;
            font-size: clamp(3rem, 8vw, 6rem);
            line-height: 0.95;
            text-transform: uppercase;
        }
        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(229, 9, 20, 0.15);
            border: 1px solid rgba(229, 9, 20, 0.4);
            color: #ffd3d5;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            font-size: 0.9rem;
        }
        .cta-btn {
            background: var(--sm-red);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 0.85rem 1.6rem;
            box-shadow: 0 0 30px var(--sm-red-glow);
        }
        .cta-btn:hover {
            filter: brightness(1.05);
        }
        .ghost-btn {
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #fff;
        }
        .section-title {
            font-family: "Bebas Neue", sans-serif;
            letter-spacing: 0.2rem;
            font-size: 2.2rem;
        }
        .catalog-card {
            background: var(--sm-panel);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .catalog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }
        .catalog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .poster-placeholder {
            height: 200px;
            background: linear-gradient(135deg, #2b2b3b, #1a1a24);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sm-muted);
            font-size: 0.9rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .form-panel {
            background: linear-gradient(145deg, rgba(31, 31, 43, 0.9), rgba(20, 20, 28, 0.9));
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        .form-control, .form-select {
            background: #0e0e14;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--sm-text);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--sm-red);
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.3);
        }
        .muted {
            color: var(--sm-muted);
        }
        footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body>
    <header class="hero d-flex align-items-center">
        <div class="container hero-content py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="brand">ScreenMatch</div>
                <div class="d-flex align-items-center gap-3">
                    <span class="muted small">Olá, <?= htmlspecialchars($user['name']); ?></span>
                    <a href="logout.php" class="btn btn-sm ghost-btn">Sair</a>
                </div>
            </div>
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="hero-pill mb-3">Catálogo pessoal</div>
                    <h1 class="hero-title mb-3">Seu ScreenMatch<br>com cara de streaming</h1>
                    <p class="lead muted mb-4">
                        Gerencie seus filmes favoritos, organize o catálogo e mantenha tudo com visual premium.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#cadastro" class="btn cta-btn">Adicionar filme</a>
                        <a href="#catalogo" class="btn ghost-btn">Ver catálogo</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="catalog-card">
                                <img src="https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=600&q=80" alt="Cartaz cinema">
                                <div class="p-3">
                                    <div class="fw-semibold">Top Gun: Maverick</div>
                                    <div class="small muted">Ação · 2022</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="catalog-card">
                                <img src="https://images.unsplash.com/photo-1517602302552-471fe67acf66?auto=format&fit=crop&w=600&q=80" alt="Sala de cinema">
                                <div class="p-3">
                                    <div class="fw-semibold">Thor: Ragnarok</div>
                                    <div class="small muted">Super-herói · 2017</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="catalog-card">
                                <img src="https://images.unsplash.com/photo-1524985069026-dd778a71c7b4?auto=format&fit=crop&w=1200&q=80" alt="Pipoca e filme">
                                <div class="p-3">
                                    <div class="fw-semibold">Noite de cinema em casa</div>
                                    <div class="small muted">Comédia · Drama · Romance</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="catalogo" class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <div class="section-title">Seu catálogo</div>
                    <div class="muted">Os filmes cadastrados aparecem aqui.</div>
                </div>
                <span class="muted small"><?= count($filmes); ?> filmes</span>
            </div>
            <?php if ($sucesso): ?>
                <div class="alert alert-success">Filme cadastrado com sucesso!</div>
            <?php endif; ?>
            <?php if ($erro): ?>
                <div class="alert alert-danger">Preencha todos os campos corretamente.</div>
            <?php endif; ?>
            <div class="row g-4">
                <?php if (count($filmes) === 0): ?>
                    <div class="col-12">
                        <div class="form-panel p-4 text-center">
                            <div class="fw-semibold mb-1">Nenhum filme cadastrado ainda</div>
                            <div class="muted">Use o formulário abaixo para começar seu catálogo.</div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($filmes as $filme): ?>
                        <div class="col-md-4">
                            <div class="catalog-card">
                                <div class="poster-placeholder">Poster</div>
                                <div class="p-3">
                                    <div class="fw-semibold"><?= htmlspecialchars($filme['title']); ?></div>
                                    <div class="small muted">
                                        <?= htmlspecialchars($filme['genre']); ?> · <?= (int) $filme['year']; ?>
                                    </div>
                                    <div class="small muted">Nota: <?= number_format((float) $filme['rating'], 1, ',', '.'); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="cadastro" class="py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="section-title mb-3">Adicione ao seu catálogo</div>
                    <p class="muted">
                        Use o formulário para registrar um filme no banco de dados.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <div class="p-3 rounded-4 form-panel">
                            <div class="fw-semibold">Banco SQLite</div>
                            <div class="small muted">Persistência local rápida</div>
                        </div>
                        <div class="p-3 rounded-4 form-panel">
                            <div class="fw-semibold">Login seguro</div>
                            <div class="small muted">Sessão protegida</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="form-panel p-4 p-md-5">
                        <h2 class="h4 mb-4">Cadastrar filme</h2>
                        <form action="exporta-arquivo.php" method="post" class="row g-3">
                            <div class="col-12">
                                <label for="nome" class="form-label">Nome do filme</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex.: Top Gun - Maverick" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ano" class="form-label">Ano de lançamento</label>
                                <input type="number" name="ano" id="ano" class="form-control" min="1888" max="2100" placeholder="2022" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nota" class="form-label">Nota</label>
                                <input type="number" name="nota" id="nota" class="form-control" min="0" max="10" step="0.1" placeholder="8.7" required>
                            </div>
                            <div class="col-12">
                                <label for="genero" class="form-label">Gênero</label>
                                <select name="genero" id="genero" class="form-select" required>
                                    <option value="" selected disabled>Selecione um gênero</option>
                                    <option value="super-heroi">Super-herói</option>
                                    <option value="comedia">Comédia</option>
                                    <option value="acao">Ação</option>
                                    <option value="drama">Drama</option>
                                    <option value="animacao">Animação</option>
                                </select>
                            </div>
                            <div class="col-12 d-grid d-md-flex gap-2">
                                <button type="submit" class="btn cta-btn px-4">Salvar filme</button>
                                <button type="reset" class="btn ghost-btn px-4">Limpar</button>
                            </div>
                        </form>
                        <div class="small muted mt-3">
                            Dica: a nota vai de 0 a 10, com uma casa decimal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div class="muted">ScreenMatch © 2026</div>
            <div class="muted">Projeto finalizado com visual Netflix moderno</div>
        </div>
    </footer>
</body>
</html>
