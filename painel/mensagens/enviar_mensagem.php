<?php
session_start();
require_once '../../config/conn.php';

if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo 'Acesso negado';
    exit;
}

$de_id = $_SESSION['user_id'];
$para_id = $_POST['para_id'] ?? null;
$conteudo = trim($_POST['mensagem'] ?? '');

if (!$para_id || empty($conteudo)) {
    http_response_code(400);
    echo 'Dados incompletos.';
    exit;
}

$stmt = $pdo->prepare("INSERT INTO mensagens (de_id, para_id, conteudo, criado_em) VALUES (?, ?, ?, NOW())");
$stmt->execute([$de_id, $para_id, $conteudo]);

echo 'Mensagem enviada com sucesso.';
