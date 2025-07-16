<?php
session_start();
require_once '../../config/conn.php';
require_once '../controllers/noticiaController.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';
    $imagem_nome = '';

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem_nome = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['imagem']['tmp_name'], '../../uploads/noticias/' . $imagem_nome);
    }

    if (salvarNoticia($pdo, $titulo, $conteudo, $imagem_nome)) {
        $mensagem = "Notícia cadastrada com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar notícia.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Notícia</title>
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
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
        }
        h2 {
            margin-top: 0;
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
        input[type="file"] {
            margin-top: 0.5rem;
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
        <h2>Nova Notícia</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>

            <label for="conteudo">Conteúdo:</label>
            <textarea name="conteudo" rows="8" required></textarea>

            <label for="imagem">Imagem destacada:</label>
            <input type="file" name="imagem" accept="image/*">

            <button type="submit">Publicar</button>
        </form>

        <?php if (!empty($mensagem)) echo "<p class='mensagem'>{$mensagem}</p>"; ?>

        <a href="noticias.php">← Voltar para notícias</a>
    </div>
</body>
</html>
