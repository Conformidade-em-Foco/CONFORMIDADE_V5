<?php
function listarEmpresas($pdo) {
    $stmt = $pdo->query("SELECT id, razao_social, email, cidade, estado FROM usuarios WHERE tipo_usuario = 'empresa'");
    echo '<ul>';
    while ($e = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li><strong>{$e['razao_social']}</strong> ({$e['cidade']}/{$e['estado']}) - <a href='chat.php?destino={$e['id']}'>Enviar mensagem</a></li>";
    }
    echo '</ul>';
}

function listarDPOs($pdo) {
    $stmt = $pdo->query("SELECT id, nome_completo, email, cidade, estado FROM usuarios WHERE tipo_usuario = 'dpo'");
    echo '<ul>';
    while ($d = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li><strong>{$d['nome_completo']}</strong> ({$d['cidade']}/{$d['estado']}) - <a href='chat.php?destino={$d['id']}'>Enviar mensagem</a></li>";
    }
    echo '</ul>';
}
