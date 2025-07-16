<?php
session_start();
require_once '../../config/conn.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['destino'])) {
    http_response_code(403);
    echo 'Acesso negado';
    exit;
}

$de_id = $_SESSION['user_id'];
$para_id = $_GET['destino'];

$stmt = $pdo->prepare("SELECT * FROM mensagens 
    WHERE (de_id = ? AND para_id = ?) OR (de_id = ? AND para_id = ?)
    ORDER BY criado_em ASC");
$stmt->execute([$de_id, $para_id, $para_id, $de_id]);
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($mensagens as $m) {
    $classe = $m['de_id'] == $de_id ? 'de' : 'para';
    echo "<div class='msg $classe'>" . 
         htmlspecialchars($m['conteudo']) . 
         "<br><small>" . date('d/m H:i', strtotime($m['criado_em'])) . "</small></div>";
}
