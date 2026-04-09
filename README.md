# ScreenMatch

Projeto web estilo streaming com login, catálogo e cadastro de filmes (PHP + MySQL).

## Requisitos
- PHP 8+
- MySQL (Wamp)

## Configuração rápida
1. Ajuste as credenciais em `src/config.php` (host, usuário, senha e nome do banco).
2. Acesse `http://localhost/public/setup.php` para criar o banco e o admin.
3. Entre em `http://localhost/public/login.php`.

## Login padrão
- Email: `admin@screenmatch.com`
- Senha: `123456`

## Produção
- Desative o setup alterando `setup_enabled` para `false` em `src/config.php`.
