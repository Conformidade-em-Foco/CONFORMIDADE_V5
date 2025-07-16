<?php
require_once '../../config/conn.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID inválido.");
}

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header("Location: gerenciar_usuarios.php");
exit;
