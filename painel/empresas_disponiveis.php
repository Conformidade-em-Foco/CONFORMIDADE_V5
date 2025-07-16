<?php
session_start();
require_once '../config/conn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'dpo') {
    header("Location: ../login/");
    exit;
}

include_once '../includes/header_painel.php';
?>

<link rel="stylesheet" href="../assets/css/painel.css">

<div class="container">
    <h2>🏢 Empresas que procuram DPO</h2>

    <ul class="lista-usuarios">
    <?php
    $stmt = $pdo->query("SELECT * FROM usuarios 
                         WHERE tipo_usuario = 'empresa' 
                         AND telefone IS NOT NULL 
                         AND disponivel_para_contato = 1");

    foreach ($stmt as $empresa): ?>
        <li>
            <strong><?= htmlspecialchars($empresa['razao_social'] ?? $empresa['email']) ?></strong><br>
            📞 <?= htmlspecialchars($empresa['telefone']) ?><br>
            📍 <?= htmlspecialchars($empresa['cidade']) ?> - <?= htmlspecialchars($empresa['estado']) ?><br><br>
            <a href="chat.php?destino=<?= $empresa['id'] ?>">📩 Enviar mensagem</a>
        </li>
    <?php endforeach; ?>
</ul>

    <p style="margin-top: 2rem;"><a href="painel_dpo.php">⬅️ Voltar ao painel</a></p>
</div>

<?php include_once '../includes/footer.php'; ?>
