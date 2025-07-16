<?php 
require_once '../config/conn.php'; 
include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Todas as Notícias | LGPD em Foco</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<section class="features">
    <div class="container">
        <h2>Últimas Notícias</h2>

        <?php
        $stmt = $pdo->query("SELECT * FROM noticias ORDER BY data_publicacao DESC");
        $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($noticias):
            foreach ($noticias as $noticia):
        ?>
            <div class="feature-card">
                <img src="../uploads/noticias/<?php echo htmlspecialchars($noticia['imagem']); ?>" 
                     alt="Imagem" 
                     style="width:50%; max-height:300px; object-fit:cover; border-radius:10px; margin-bottom: 1rem;">

                <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                <p><?php echo substr(strip_tags($noticia['conteudo']), 0, 180) . '...'; ?></p>
            </div>
        <?php 
            endforeach;
        else:
            echo "<p>Nenhuma notícia publicada ainda.</p>";
        endif;
        ?>
    </div>
</section>

<?php include('../includes/footer.php'); ?>

</body>
</html>
