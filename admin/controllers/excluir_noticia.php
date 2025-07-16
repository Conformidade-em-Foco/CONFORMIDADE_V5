<?php
require_once '../../config/conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: ../views/noticias.php");
    exit;
} else {
    echo "ID inválido!";
}
?>
