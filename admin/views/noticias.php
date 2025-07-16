<?php
session_start();
require_once '../../config/conn.php';
require_once '../controllers/noticiaController.php';

$noticias = listarNoticias($pdo);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Notícias</title>
    <style>
        body {
            background: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 1rem;
        }
        .noticia-card {
            background: #1e1e1e;
            border: 1px solid #333;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            padding: 1rem;
            display: flex;
            gap: 1rem;
        }
        .noticia-card img {
            width: 180px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        .noticia-info {
            flex-grow: 1;
        }
        .noticia-info h3 {
            margin-top: 0;
            color: #00d9ff;
        }
        .botoes {
            margin-top: 0.5rem;
        }
        .botoes a {
            margin-right: 1rem;
            color: #00d9ff;
            text-decoration: none;
        }
        .botoes a.destaque {
            color: #ffd700;
            font-weight: bold;
        }
        .topo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .topo a {
            color: #28a745;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="topo">
        <h1>Gerenciar Notícias</h1>
        <a href="nova_noticia.php">+ Nova Notícia</a>
    </div>
    <?php foreach ($noticias as $noticia): ?>
        <div class="noticia-card">
            <img src="../../uploads/noticias/<?php echo htmlspecialchars($noticia['imagem']); ?>" alt="Imagem">
            <div class="noticia-info">
                <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                <p><?php echo nl2br(substr($noticia['conteudo'], 0, 150)) . '...'; ?></p>
                <div class="botoes">
                    <a href="editar_noticia.php?id=<?php echo $noticia['id']; ?>">✏️ Editar</a>
                    <a href="../controllers/excluir_noticia.php?id=<?php echo $noticia['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">🗑️ Excluir</a>
                    <a href="../controllers/noticiaController.php?acao=destaque&id=<?php echo $noticia['id']; ?>" class="destaque">
                        <?php echo $noticia['destaque'] ? '❌ Remover Destaque' : '⭐ Marcar como Destaque'; ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>