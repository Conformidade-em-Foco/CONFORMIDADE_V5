<?php
session_start();
require_once '../config/conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_tipo = $_SESSION['user_type'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_completo'] ?? $_POST['razao_social'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $disponivel = isset($_POST['disponivel_para_contato']) ? 1 : 0;

    // Upload de foto
    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_nome = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/perfil/$foto_nome");

        $stmt = $pdo->prepare("UPDATE usuarios SET foto = ? WHERE id = ?");
        $stmt->execute([$foto_nome, $user_id]);
    }

    // Atualizar nome, cidade, estado, disponibilidade
    $campo_nome = ($user_tipo === 'empresa') ? 'razao_social' : 'nome_completo';
    $stmt = $pdo->prepare("UPDATE usuarios 
                           SET $campo_nome = ?, cidade = ?, estado = ?, disponivel_para_contato = ? 
                           WHERE id = ?");
    $stmt->execute([$nome, $cidade, $estado, $disponivel, $user_id]);

    header("Location: " . ($user_tipo === 'empresa' ? 'painel_empresa.php' : 'painel_dpo.php'));
    exit;
}

// Buscar dados atuais
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$user_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
</head>
<body>
<?php include_once '../includes/header.php'; ?>

<div class="container">
    <h2>🛠️ Editar Perfil</h2>

    <form method="POST" enctype="multipart/form-data">
        <label><?= $user_tipo === 'empresa' ? 'Razão Social' : 'Nome Completo' ?>:</label><br>
        <input type="text" name="<?= $user_tipo === 'empresa' ? 'razao_social' : 'nome_completo' ?>"
               value="<?= htmlspecialchars($usuario['nome_completo'] ?? $usuario['razao_social']) ?>" required><br><br>

        <label>Cidade:</label><br>
        <input type="text" name="cidade" value="<?= htmlspecialchars($usuario['cidade']) ?>"><br><br>

        <label>Estado:</label><br>
        <input type="text" name="estado" value="<?= htmlspecialchars($usuario['estado']) ?>"><br><br>

        <label>Foto de Perfil:</label><br>
        <input type="file" name="foto"><br><br>

        <label>
            <input type="checkbox" name="disponivel_para_contato" value="1" <?= $usuario['disponivel_para_contato'] ? 'checked' : '' ?>>
            🟢 Quero ser encontrado para parcerias
        </label><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <p style="margin-top: 1rem;"><a href="<?= $user_tipo === 'empresa' ? 'painel_empresa.php' : 'painel_dpo.php' ?>">⬅️ Voltar ao Painel</a></p>
</div>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>
