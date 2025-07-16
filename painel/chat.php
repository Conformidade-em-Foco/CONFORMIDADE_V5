<?php
session_start();
require_once '../config/conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/');
    exit;
}

$usuario_id = $_SESSION['user_id'];
$usuario_tipo = $_SESSION['user_type'];
$destino_id = $_GET['destino'] ?? null;

include_once '../includes/header_painel.php';
?>

<link rel="stylesheet" href="../assets/css/painel.css">

<div class="container">
    <h2>💬 Central de Mensagens</h2>

<?php
if ($destino_id && $destino_id != $usuario_id) {
    // Abrindo conversa com um destinatário
    $stmt = $pdo->prepare("SELECT nome_completo, razao_social FROM usuarios WHERE id = ?");
    $stmt->execute([$destino_id]);
    $destino = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$destino) {
        echo "<p>Usuário não encontrado.</p>";
    } else {
        $destino_nome = $destino['nome_completo'] ?? $destino['razao_social'] ?? 'Usuário';

        // Envio de mensagem
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensagem'])) {
            $mensagem = trim($_POST['mensagem']);
            $stmt = $pdo->prepare("INSERT INTO mensagens (de_id, para_id, conteudo, criado_em, lida) VALUES (?, ?, ?, NOW(), 0)");
            $stmt->execute([$usuario_id, $destino_id, $mensagem]);

            header("Location: chat.php?destino={$destino_id}");
            exit;
        }

        // Marcar como lidas
        $stmt = $pdo->prepare("UPDATE mensagens SET lida = 1 WHERE para_id = ? AND de_id = ?");
        $stmt->execute([$usuario_id, $destino_id]);

        // Buscar mensagens da conversa
        $stmt = $pdo->prepare("SELECT * FROM mensagens 
                               WHERE (de_id = ? AND para_id = ?) OR (de_id = ? AND para_id = ?)
                               ORDER BY criado_em ASC");
        $stmt->execute([$usuario_id, $destino_id, $destino_id, $usuario_id]);
        $mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <h3>🗨️ Conversando com <?= htmlspecialchars($destino_nome) ?></h3>
        <div class="chat-box" style="border:1px solid #ccc; padding:1rem; height:300px; overflow-y:scroll; background:#fff; margin-bottom:1rem;">
            <?php foreach ($mensagens as $m): ?>
                <div class="msg <?= $m['de_id'] == $usuario_id ? 'de' : 'para' ?>">
                    <?= htmlspecialchars($m['conteudo']) ?><br>
                    <small><?= date('d/m H:i', strtotime($m['criado_em'])) ?></small>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="POST">
            <textarea name="mensagem" rows="3" required></textarea>
            <button type="submit">Enviar</button>
        </form>

        <p style="margin-top: 1rem;"><a href="chat.php">⬅️ Voltar à lista de contatos</a></p>
        <?php
    }

} else {
    // Listar histórico completo de conversas com usuários únicos
    $stmt = $pdo->prepare("
        SELECT u.id, u.nome_completo, u.razao_social, u.cidade, u.estado,
               COUNT(CASE WHEN m.lida = 0 AND m.para_id = ? THEN 1 END) AS nao_lidas
        FROM usuarios u
        INNER JOIN mensagens m ON (m.de_id = u.id AND m.para_id = ?) OR (m.para_id = u.id AND m.de_id = ?)
        WHERE u.id != ?
        GROUP BY u.id, u.nome_completo, u.razao_social, u.cidade, u.estado
        ORDER BY MAX(m.criado_em) DESC
    ");
    $stmt->execute([$usuario_id, $usuario_id, $usuario_id, $usuario_id]);
    $conversas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($conversas) === 0) {
        echo "<p>Você ainda não possui conversas iniciadas.</p>";
    } else {
        echo "<p>Selecione com quem deseja conversar:</p>";
        echo '<ul class="lista-usuarios">';
        foreach ($conversas as $contato) {
            $nome = $contato['nome_completo'] ?? $contato['razao_social'] ?? 'Usuário';
            $naoLidas = (int)$contato['nao_lidas'];
            $badge = $naoLidas > 0 ? "<span style='color:red;font-weight:bold'> ({$naoLidas} novas)</span>" : "";

            echo "<li>
                    <strong>" . htmlspecialchars($nome) . "</strong>{$badge}<br>
                    📍 " . htmlspecialchars($contato['cidade']) . " - " . htmlspecialchars($contato['estado']) . "<br><br>
                    <a href='chat.php?destino={$contato['id']}'>📩 Conversar</a>
                  </li>";
        }
        echo '</ul>';
    }
}
?>
</div>

<?php include_once '../includes/footer.php'; ?>
