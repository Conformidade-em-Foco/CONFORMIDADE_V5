<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/conn.php';

$userId = $_SESSION['user_id'] ?? null;
$totalNaoLidas = 0;

if ($userId) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM mensagens WHERE para_id = ? AND lida = 0");
    $stmt->execute([$userId]);
    $totalNaoLidas = (int) $stmt->fetchColumn();
}
?>
<header style="background: #fff; border-bottom: 1px solid #ccc; padding: 1rem 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1100px; margin: auto;">
        <h1 style="color: #667eea;">🔐 LGPD em Foco</h1>
        <nav>
            <a href="/lgpd/index.php">🏠 Site</a> |
            <a href="/lgpd/painel/editar_perfil.php">⚙️ Meu Perfil</a>
            <?php
            if (isset($_SESSION['user_type'])) {
                $painelLink = $_SESSION['user_type'] === 'empresa'
                    ? '/lgpd/painel/painel_empresa.php'
                    : '/lgpd/painel/painel_dpo.php';
                echo ' | <a href="' . $painelLink . '">📂 Meu Painel</a>';
            }
            ?>

            <?php if ($userId): ?>
                | <a href="/lgpd/painel/chat.php">💬 Chat
                    <?php if ($totalNaoLidas > 0): ?>
                        <span style="background:red;color:white;border-radius:50%;padding:2px 6px;margin-left:4px;font-size:0.8rem;">
                            <?= $totalNaoLidas ?>
                        </span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            | <a href="/lgpd/login/logout.php">🚪 Sair</a>
        </nav>
    </div>
</header>
