<?php
session_start();
include_once '../config/conn.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    $email = $_POST['email'] ?? '';
    $codigo = $_POST['codigo'] ?? '';
    
    if (empty($email) || empty($codigo)) {
        throw new Exception('E-mail e código são obrigatórios');
    }
    
    // Buscar em empresas
    $stmt = $conn->prepare("SELECT id, 'empresa' as tipo, confirmado, codigo_expiracao 
                           FROM empresas 
                           WHERE email = ? AND codigo_confirmacao = ?");
    $stmt->execute([$email, $codigo]);
    $usuario = $stmt->fetch();
    
    // Se não encontrou, buscar em DPOs
    if (!$usuario) {
        $stmt = $conn->prepare("SELECT id, 'dpo' as tipo, confirmado, codigo_expiracao 
                               FROM dpos 
                               WHERE email = ? AND codigo_confirmacao = ?");
        $stmt->execute([$email, $codigo]);
        $usuario = $stmt->fetch();
    }
    
    if (!$usuario) {
        throw new Exception('Código inválido');
    }
    
    if ($usuario['confirmado']) {
        throw new Exception('Esta conta já foi confirmada');
    }
    
    // Verificar se o código expirou
    if ($usuario['codigo_expiracao'] < date("Y-m-d H:i:s")) {
        throw new Exception('Código expirado. Solicite um novo código.');
    }
    
    // Confirmar conta
    $tabela = $usuario['tipo'] === 'empresa' ? 'empresas' : 'dpos';
    $stmt = $conn->prepare("UPDATE {$tabela} SET 
                           confirmado = 1, 
                           data_confirmacao = NOW(),
                           codigo_confirmacao = NULL,
                           codigo_expiracao = NULL
                           WHERE id = ?");
    $stmt->execute([$usuario['id']]);
    
    // Criar sessão
    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['user_type'] = $usuario['tipo'];
    $_SESSION['authenticated'] = true;
    
    $redirect_url = $usuario['tipo'] === 'empresa' ? '../dashboard/empresa/' : '../dashboard/dpo/';
    
    echo json_encode([
        'success' => true,
        'message' => 'Conta confirmada com sucesso!',
        'redirect' => $redirect_url
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>

