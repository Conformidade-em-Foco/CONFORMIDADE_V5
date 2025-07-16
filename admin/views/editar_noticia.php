<?php
session_start();
require_once '../../config/conn.php';
require_once '../controllers/noticiaController.php';

if (!isset($_GET['id'])) {
    header('Location: noticias.php');
    exit;
}

$id = $_GET['id'];
$noticia = buscarNoticia($pdo, $id);
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';
    $imagem = $noticia['imagem'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['imagem']['tmp_name'], '../../uploads/noticias/' . $imagem);
    }

    if (atualizarNoticia($pdo, $id, $titulo, $conteudo, $imagem)) {
        $mensagem = "Notícia atualizada com sucesso!";
        $noticia = buscarNoticia($pdo, $id);
    } else {
        $mensagem = "Erro ao atualizar notícia.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Notícia</title>
    <style>
        body {
            background: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 2rem;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #1e1e1e;
            padding: 2rem;
            border-radius: 10px;
        }
        h2 {
            color: #00d9ff;
        }
        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 0.7rem;
            border: none;
            border-radius: 5px;
            background: #2c2c2c;
            color: #fff;
        }
        img.preview {
            max-width: 100%;
            height: auto;
            margin-top: 1rem;
            border-radius: 8px;
        }
        button {
            margin-top: 1.5rem;
            padding: 0.8rem 2rem;
            background: #00d9ff;
            border: none;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .mensagem {
            margin-top: 1rem;
            font-weight: bold;
            color: #28a745;
        }
        a {
            color: #ccc;
            display: inline-block;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Editar Notícia</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>

        <label>Conteúdo:</label>
        <textarea name="conteudo" rows="8" required><?php echo htmlspecialchars($noticia['conteudo']); ?></textarea>

        <label>Imagem atual:</label>
        <img src="../../uploads/noticias/<?php echo htmlspecialchars($noticia['imagem']); ?>" alt="Preview" class="preview">

        <label>Nova imagem (opcional):</label>
        <input type="file" name="imagem" accept="image/*">

        <button type="submit">Salvar Alterações</button>
    </form>
    <?php if (!empty($mensagem)) echo "<p class='mensagem'>{$mensagem}</p>"; ?>
    <a href="noticias.php">← Voltar para notícias</a>
</div>
</body>
</html>
