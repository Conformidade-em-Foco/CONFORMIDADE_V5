<?php
require_once '../../config/conn.php';

// Funções

function listarNoticias($pdo) {
    $stmt = $pdo->query("SELECT * FROM noticias ORDER BY data_publicacao DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function salvarNoticia($pdo, $titulo, $conteudo, $imagem) {
    $stmt = $pdo->prepare("INSERT INTO noticias (titulo, conteudo, imagem) VALUES (?, ?, ?)");
    return $stmt->execute([$titulo, $conteudo, $imagem]);
}

function buscarNoticia($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarNoticia($pdo, $id, $titulo, $conteudo, $imagem = null) {
    if ($imagem) {
        $stmt = $pdo->prepare("UPDATE noticias SET titulo = ?, conteudo = ?, imagem = ? WHERE id = ?");
        return $stmt->execute([$titulo, $conteudo, $imagem, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE noticias SET titulo = ?, conteudo = ? WHERE id = ?");
        return $stmt->execute([$titulo, $conteudo, $id]);
    }
}

function excluirNoticia($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    return $stmt->execute([$id]);
}

// Nova função para alternar destaque
function alternarDestaque($pdo, $id) {
    $stmt = $pdo->prepare("UPDATE noticias SET destaque = NOT destaque WHERE id = ?");
    return $stmt->execute([$id]);
}

// Ação de destaque via GET
if (isset($_GET['acao']) && $_GET['acao'] === 'destaque' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    alternarDestaque($pdo, $id);
    header("Location: ../views/noticias.php");
    exit;
}
?>
