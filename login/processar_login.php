<?php
session_start();
include_once '../config/conn.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $lembrar = isset($_POST['lembrar']) && $_POST['lembrar'] === '1';
    
    if (empty($email) || empty($senha)) {
        throw new Exception('E-mail e senha são obrigatórios');
    }
    
    // Buscar usuário na tabela unificada "usuarios"
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$usuario) {
        throw new Exception('E-mail ou senha incorretos');
    }

    // Verificar senha
    if (!password_verify($senha, $usuario['senha'])) {
        throw new Exception('E-mail ou senha incorretos');
    }

    // Criar sessão
    $_SESSION['user_id']    = $usuario['id'];
    $_SESSION['user_name']  = $usuario['nome_completo'] ?? $usuario['razao_social'];
    $_SESSION['user_email'] = $usuario['email'];
    $_SESSION['user_type']  = $usuario['tipo_usuario'];
    $_SESSION['login_time'] = time();

    // Atualizar último login (se quiser adicionar esse campo depois)
    // $stmt = $pdo->prepare("UPDATE usuarios SET ultimo_login = NOW() WHERE id = ?");
    // $stmt->execute([$usuario['id']]);

    // Lembrar de mim (opcional)
    if ($lembrar) {
        $token = bin2hex(random_bytes(32));
        $expires = time() + (30 * 24 * 60 * 60); // 30 dias

        // Adicionar campo remember_token se desejar
        $stmt = $pdo->prepare("UPDATE usuarios SET remember_token = ? WHERE id = ?");
        $stmt->execute([$token, $usuario['id']]);

        setcookie('remember_token', $token, $expires, '/', '', true, true);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Login realizado com sucesso!',
        'redirect' => ($_SESSION['user_type'] === 'empresa') 
            ? '../painel/painel_empresa.php' 
            : '../painel/painel_dpo.php'
    ]);    

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
