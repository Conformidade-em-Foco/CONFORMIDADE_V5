<?php
session_start();

// Se já estiver logado, redirecionar para dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: ../dashboard/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Conformidade em Foco</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                    <h1>Conformidade em Foco</h1>
                </div>
                <h2>Entrar na sua conta</h2>
                <p>Acesse sua conta para gerenciar suas avaliações LGPD</p>
            </div>

            <div class="login-form">
                <div id="alertContainer"></div>
                
                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            E-mail
                        </label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">
                            <i class="fas fa-lock"></i>
                            Senha
                        </label>
                        <div class="password-input">
                            <input type="password" id="senha" name="senha" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" id="lembrar" name="lembrar">
                            <span class="checkmark"></span>
                            Lembrar de mim
                        </label>
                        <a href="recuperar-senha.php" class="forgot-password">
                            Esqueceu a senha?
                        </a>
                    </div>

                    <button type="submit" class="btn-login" id="btnLogin">
                        <i class="fas fa-sign-in-alt"></i>
                        Entrar
                    </button>
                </form>

                <div class="login-divider">
                    <span>ou</span>
                </div>

                <div class="login-links">
                    <p>Não tem uma conta?</p>
                    <a href="../cadastro/" class="btn-cadastro">
                        <i class="fas fa-user-plus"></i>
                        Criar conta
                    </a>
                </div>

                <div class="back-home">
                    <a href="../" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Voltar ao início
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/login.js"></script>
</body>
</html>