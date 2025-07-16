<?php
session_start();
require_once '../config/conn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'empresa') {
    header("Location: ../login/");
    exit;
}

include_once '../includes/header_painel.php';
?>

<link rel="stylesheet" href="../assets/css/painel.css">

<div class="container">
    <h2>👨‍💼 DPOs disponíveis para contato</h2>

    <ul>
        <?php
        $stmt = $pdo->query("SELECT * FROM usuarios 
                             WHERE tipo_usuario = 'dpo' 
                             AND telefone IS NOT NULL 
                             AND disponivel_para_contato = 1");

        foreach ($stmt as $dpo): ?>
            <li>
                <strong><?= htmlspecialchars($dpo['nome_completo']) ?></strong><br>
                📞 <?= htmlspecialchars($dpo['telefone']) ?><br>
                🎓 <?= htmlspecialchars($dpo['formacao_academica']) ?><br>
                <a href="chat.php?destino=<?= $dpo['id'] ?>">📩 Enviar mensagem</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <p style="margin-top: 2rem;"><a href="painel_empresa.php">⬅️ Voltar ao painel</a></p>
</div>

<?php include_once '../includes/footer.php'; ?>
