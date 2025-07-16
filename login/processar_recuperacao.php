<?php
include_once '../config/conn.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    $email = $_POST['email'] ?? '';
    
    if (empty($email)) {
        throw new Exception('E-mail é obrigatório');
    }
    
    // Buscar usuário em empresas
    $stmt = $conn->prepare("SELECT id, nome, 'empresa' as tipo FROM empresas WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    // Se não encontrou, buscar em DPOs
    if (!$usuario) {
        $stmt = $conn->prepare("SELECT id, nome, 'dpo' as tipo FROM dpos WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
    }
    
    if (!$usuario) {
        // Por segurança, não informar que o e-mail não existe
        echo json_encode([
            'success' => true,
            'message' => 'Se o e-mail estiver cadastrado, você receberá as instruções.'
        ]);
        exit;
    }
    
    // Gerar token de recuperação
    $token = bin2hex(random_bytes(32));
    $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    // Salvar token no banco
    $tabela = $usuario['tipo'] === 'empresa' ? 'empresas' : 'dpos';
    $stmt = $conn->prepare("UPDATE {$tabela} SET 
                           token_recuperacao = ?, 
                           token_expiracao = ? 
                           WHERE id = ?");
    $stmt->execute([$token, $expiracao, $usuario['id']]);
    
    // Aqui você enviaria o e-mail com o link de recuperação
    // Por enquanto, vamos apenas simular o envio
    
    echo json_encode([
        'success' => true,
        'message' => 'Instruções enviadas para seu e-mail!'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>