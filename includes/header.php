<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuario_logado = isset($_SESSION['user_id']);
$nome_usuario = $_SESSION['user_name'] ?? '';
$tipo_usuario = $_SESSION['user_type'] ?? '';
$painel_link = ($tipo_usuario === 'empresa') 
    ? '/lgpd/painel/painel_empresa.php' 
    : '/lgpd/painel/painel_dpo.php';

$iniciais = '';
if ($nome_usuario) {
    $partes = explode(' ', $nome_usuario);
    foreach ($partes as $parte) {
        $iniciais .= strtoupper(mb_substr($parte, 0, 1));
    }
    $iniciais = mb_substr($iniciais, 0, 2);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>LGPD em Foco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontes e ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/lgpd/assets/css/style.css">
    <link rel="stylesheet" href="/lgpd/assets/css/form.css">
    <link rel="stylesheet" href="/lgpd/assets/css/tabs.css">

    <style>
        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: #667eea;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            position: relative;
        }

        .user-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            display: none;
            min-width: 160px;
            z-index: 999;
        }

        .user-menu a {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #333;
        }

        .user-menu a:hover {
            background: #f0f0f0;
        }

        .user-dropdown {
            position: relative;
        }

        .user-dropdown:hover .user-menu {
            display: block;
        }
    </style>
</head>
<body>

<!-- Navegação -->
<header class="header">
    <div class="container nav">
        <a href="/lgpd/index.php" class="logo"><i class="fas fa-shield-alt"></i> Conformidade em Foco</a>
        <nav>
            <ul class="nav-links">
                <li><a href="/lgpd/index.php">Início</a></li>
                <li><a href="/lgpd/pages/testedeconformidade.php">Teste de Conformidade</a></li>
                <li><a href="/lgpd/pages/noticias.php">Notícias</a></li>
                <li><a href="/lgpd/pages/contato.php">Contato</a></li>
            </ul>
        </nav>

        <?php if ($usuario_logado): ?>
            <div class="user-dropdown">
                <div class="user-avatar"><?= htmlspecialchars($iniciais) ?></div>
                <div class="user-menu">
                    <a href="<?= $painel_link ?>"><i class="fas fa-user"></i> Meu Painel</a>
                    <a href="/lgpd/painel/editar_perfil.php"><i class="fas fa-cog"></i> Perfil</a>
                    <a href="/lgpd/login/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </div>
        <?php else: ?>
            <nav>
                <ul class="nav-links">
                    <li><a href="/lgpd/login/index.php">Login</a></li>
                    <li><a href="/lgpd/login/index.php">Cadastrar-se</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</header>
