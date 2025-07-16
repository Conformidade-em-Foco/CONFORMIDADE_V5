<?php
require_once '../../config/conn.php';

$stmt = $pdo->query("SELECT * FROM noticias WHERE destaque = 1 ORDER BY data_publicacao DESC LIMIT 10");
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($noticias): ?>
<div class="slider-container">
    <?php foreach ($noticias as $noticia): ?>
        <div class="slide">
            <img src="uploads/noticias/<?php echo htmlspecialchars($noticia['imagem']); ?>" alt="Imagem" style="width:100%; max-height:300px; object-fit:cover; border-radius:10px; margin-bottom: 1rem;">
            <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
            <p><?php echo substr(strip_tags($noticia['conteudo']), 0, 180) . '...'; ?></p>
            <a href="pages/noticias.php" class="btn btn-primary">Ver todas</a>
        </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <p>Nenhuma notícia em destaque disponível.</p>
<?php endif; ?>
