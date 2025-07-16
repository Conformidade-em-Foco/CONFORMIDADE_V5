<?php
include('includes/header.php');
require_once 'config/conn.php';

$stmt = $pdo->query("SELECT * FROM noticias WHERE destaque = 1 ORDER BY data_publicacao DESC LIMIT 10");
$destaques = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>LGPD em Foco - Página Inicial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/inicio.css">
    <script src="https://kit.fontawesome.com/a2d5ad9876.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="hero">
        <div class="container">
        <?php
        $stmtBanner = $pdo->query("SELECT * FROM banner ORDER BY id DESC LIMIT 1");
        $banner = $stmtBanner->fetch(PDO::FETCH_ASSOC);
        ?>

        <?php if ($banner): ?>
        <img class="banner-home" src="uploads/banner/<?php echo $banner['imagem']; ?>" alt="Banner Principal">
        <h1><?php echo htmlspecialchars($banner['titulo']); ?></h1>
        <p><?php echo htmlspecialchars($banner['subtitulo']); ?></p>
        <?php endif; ?>

            <h1>Bem-vindo ao Conformidade em foco</h1>
            <p>O seu portal central de atualizações sobre a Lei Geral de Proteção de Dados e Segurança da Informação.</p>
        </div>
    </section>

    <!-- Destaques -->
    <section class="features">
        <div class="container">
            <h2>Notícias em Destaque</h2>
            <div class="slider-wrapper">
                <div class="slider-track" id="slider-track">
                    <?php foreach ($destaques as $destaque): ?>
                        <a href="pages/noticia.php?id=<?php echo $destaque['id']; ?>" class="slide" style="text-decoration: none; color: inherit;">
                            <img src="uploads/noticias/<?php echo htmlspecialchars($destaque['imagem']); ?>" alt="Imagem">
                            <div class="slide-content">
                                <h3><?php echo htmlspecialchars($destaque['titulo']); ?></h3>
                                <p><?php echo mb_strimwidth(strip_tags($destaque['conteudo']), 0, 100, "..."); ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Conteúdo dinâmico -->
    <section class="features">
        <div class="container">
            <h2>Atualizações e Notícias</h2>
            <div id="conteudo-dinamico">
                <p>Carregando novidades...</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 LGPD em Foco. Todos os direitos reservados.</p>
            <div class="footer-links">
                <a href="#">Política de Privacidade</a>
                <a href="#">Termos de Uso</a>
                <a href="#">Contato</a>
            </div>
        </div>
    </footer>
    <script src="assets/js/home.js"></script>
</body>
</html>
