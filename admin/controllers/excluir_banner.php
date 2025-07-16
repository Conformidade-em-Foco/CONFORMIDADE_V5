<?php
session_start();
require_once '../../config/conn.php';

// Buscar imagem atual
$stmt = $pdo->query("SELECT imagem FROM banner ORDER BY id DESC LIMIT 1");
$banner = $stmt->fetch(PDO::FETCH_ASSOC);

if ($banner && !empty($banner['imagem'])) {
    $caminho = __DIR__ . '/../../uploads/banner/' . $banner['imagem'];

    // Deleta o arquivo físico, se existir
    if (file_exists($caminho)) {
        unlink($caminho);
    }
}

// Limpa a tabela (remove o registro do banner)
$pdo->exec("DELETE FROM banner");

// Redireciona de volta
header('Location: ../views/editar_banner.php');
exit;
