<?php
require_once '../config/conn.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    $tipo_cadastro = $_POST['tipo_usuario'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    // Validações básicas
    if (empty($email) || empty($senha)) {
        throw new Exception('E-mail e senha são obrigatórios');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('E-mail inválido');
    }
    
    if (strlen($senha) < 6) {
        throw new Exception('A senha deve ter pelo menos 6 caracteres');
    }
    
    // Verificar se e-mail já existe
    $stmt = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header("Location: index.php?erro=usuario");
        exit;
    }
    
    // Gerar código de confirmação
    $codigo = sprintf('%06d', mt_rand(0, 999999));
    $codigo_expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    if ($tipo_cadastro === 'empresa') {
        $stmt = $pdo->prepare("INSERT INTO usuarios (
            tipo_usuario, email, senha, telefone, razao_social, nome_fantasia, cnpj, setor_atividade,
            porte_empresa, numero_funcionarios, cep, cidade, estado, criado_em
        ) VALUES ('empresa', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        $stmt->execute([
            $email,
            $senha_hash,
            $_POST['telefone'] ?? '',
            $_POST['razao_social'] ?? '',
            $_POST['nome_fantasia'] ?? '',
            preg_replace('/\D/', '', $_POST['cnpj'] ?? ''),
            $_POST['setor_atividade'] ?? '',
            $_POST['porte_empresa'] ?? '',
            $_POST['numero_funcionarios'] ?? 0,
            preg_replace('/\D/', '', $_POST['cep'] ?? ''),
            $_POST['cidade'] ?? '',
            $_POST['estado'] ?? ''
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (
            tipo_usuario, email, senha, telefone, cpf, nome_completo, formacao_academica, experiencia_anos,
            certificacoes, cep, cidade, estado, criado_em
        ) VALUES ('dpo', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        $stmt->execute([
            $email,
            $senha_hash,
            $_POST['telefone'] ?? '',
            preg_replace('/\D/', '', $_POST['cpf'] ?? ''),
            $_POST['nome_completo'] ?? '',
            $_POST['formacao_academica'] ?? '',
            $_POST['experiencia_anos'] ?? 0,
            $_POST['certificacoes'] ?? '',
            preg_replace('/\D/', '', $_POST['cep'] ?? ''),
            $_POST['cidade'] ?? '',
            $_POST['estado'] ?? ''
        ]);
    }

    // Redireciona com sucesso
    header("Location: index.php?sucesso=1");
    exit;

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
