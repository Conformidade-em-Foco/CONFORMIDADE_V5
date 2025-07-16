<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | LGPD em Foco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin-login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-login-wrapper">
        <div class="admin-login-card">

            <div class="admin-header">
                <i class="fas fa-user-shield"></i>
                <h2>Área Administrativa</h2>
                <p>Acesso exclusivo para administradores do sistema</p>
            </div>

            <form method="post" action="autenticar.php">
                <label for="usuario"><i class="fas fa-user"></i> Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required>

                <label for="senha"><i class="fas fa-lock"></i> Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                <button type="submit" class="btn-admin-login">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </form>

            <div class="voltar-site">
                <a href="/lgpd/index.php"><i class="fas fa-arrow-left"></i> Voltar ao site</a>
            </div>

        </div>
    </div>
</body>
</html>
