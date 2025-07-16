<?php
session_start();
require_once '../../config/conn.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['banner'])) {
    $arquivo = $_FILES['banner'];
    $titulo = $_POST['titulo'] ?? null;
    $subtitulo = $_POST['subtitulo'] ?? null;
    $nome = uniqid() . '_' . basename($arquivo['name']);

    // Caminho físico correto
    $caminhoFisico = __DIR__ . '/../../uploads/banner/' . $nome;

    if (move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
        // Remove banner anterior, se desejar manter um só
        $pdo->exec("DELETE FROM banner");

        // Insere no banco
        $stmt = $pdo->prepare("INSERT INTO banner (imagem, titulo, subtitulo) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $titulo, $subtitulo]);
        $msg = "Banner atualizado com sucesso!";
    } else {
        $msg = "Erro ao enviar imagem.";
    }
}

// Carrega o banner atual
$stmt = $pdo->query("SELECT * FROM banner ORDER BY id DESC LIMIT 1");
$banner = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Banner</title>
    <link rel="stylesheet" href="../css/admin-banner.css">
</head>
<body>
    <div class="container">
        <h2>Editar Banner Principal</h2>

        <?php if ($msg): ?>
            <p class="mensagem"><?php echo htmlspecialchars($msg); ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($banner['titulo'] ?? ''); ?>">

            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="subtitulo" id="subtitulo" value="<?php echo htmlspecialchars($banner['subtitulo'] ?? ''); ?>">

            <label for="banner">Imagem do Banner:</label>
            <input type="file" name="banner" id="banner" accept="image/*" required>

            <button type="submit">Salvar</button>
        </form>

        <?php if (!empty($banner['imagem'])): ?>
            <h3>Banner Atual:</h3>
            <img class="preview-banner" src="../../uploads/banner/<?php echo htmlspecialchars($banner['imagem']); ?>" alt="Banner Atual">

            <form method="POST" action="../controllers/excluir_banner.php" onsubmit="return confirm('Tem certeza que deseja excluir o banner atual?');" style="margin-top: 1rem;">
                <button type="submit" style="background: #dc3545;">🗑️ Excluir Banner</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
