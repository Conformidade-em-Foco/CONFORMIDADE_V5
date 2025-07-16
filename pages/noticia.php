<?php
require_once '../config/conn.php';
include('../includes/header.php');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo $noticia ? htmlspecialchars($noticia['titulo']) : 'Notícia não encontrada'; ?> - LGPD em Foco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <section class="features">
        <div class="container">
            <?php if ($noticia): ?>
                <div style="margin-top: 2rem;">
                    <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                    <p style="color: #666; font-size: 0.9rem;">
                        Publicado em <?php echo date('d/m/Y H:i', strtotime($noticia['data_publicacao'])); ?>
                    </p>
                    <img src="../uploads/noticias/<?php echo htmlspecialchars($noticia['imagem']); ?>" alt="Imagem da notícia" style="width: 100%; max-width: 800px; border-radius: 10px; margin: 1rem 0;">
                    <div style="line-height: 1.7; color: #333; font-size: 1.1rem;">
                        <?php echo nl2br($noticia['conteudo']); ?>
                    </div>
                    <br>
                    <a href="../index.php" class="btn btn-secondary">⬅️ Voltar para Início</a>
                </div>
            <?php else: ?>
                <p>Notícia não encontrada.</p>
            <?php endif; ?>
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
</body>
</html>
