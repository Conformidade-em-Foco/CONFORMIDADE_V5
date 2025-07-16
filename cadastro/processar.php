<?php
header('Content-Type: application/json');
require_once '../config/conn.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    $tipo_cadastro = $_POST['tipo_cadastro'] ?? '';
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
    $stmt = $conn->prepare("SELECT email FROM empresas WHERE email = ? UNION SELECT email FROM dpos WHERE email = ?");
    $stmt->execute([$email, $email]);
    if ($stmt->fetch()) {
        throw new Exception('Este e-mail já está cadastrado');
    }
    
    // Gerar código de confirmação
    $codigo = sprintf('%06d', mt_rand(0, 999999));
    $codigo_expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    if ($tipo_cadastro === 'empresa') {
        cadastrarEmpresa($conn, $_POST, $email, $senha_hash, $codigo, $codigo_expiracao);
    } else {
        cadastrarDPO($conn, $_POST, $email, $senha_hash, $codigo, $codigo_expiracao);
    }
    
    // Enviar e-mail de confirmação
    enviarEmailConfirmacao($email, $codigo, $tipo_cadastro);
    
    echo json_encode([
        'success' => true,
        'message' => 'Cadastro realizado! Verifique seu e-mail para confirmar a conta.'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

function cadastrarEmpresa($conn, $dados, $email, $senha_hash, $codigo, $codigo_expiracao) {
    $razao_social = trim($dados['razao_social'] ?? '');
    $cnpj = preg_replace('/\D/', '', $dados['cnpj'] ?? '');
    
    if (empty($razao_social) || empty($cnpj)) {
        throw new Exception('Razão social e CNPJ são obrigatórios para empresas');
    }
    
    if (strlen($cnpj) !== 14) {
        throw new Exception('CNPJ inválido');
    }
    
    // Verificar se CNPJ já existe
    $stmt = $conn->prepare("SELECT cnpj FROM empresas WHERE cnpj = ?");
    $stmt->execute([$cnpj]);
    if ($stmt->fetch()) {
        throw new Exception('Este CNPJ já está cadastrado');
    }
    
    $stmt = $conn->prepare("INSERT INTO empresas (
        razao_social, nome_fantasia, cnpj, email, telefone, 
        setor_atividade, porte_empresa, numero_funcionarios,
        cidade, estado, cep, senha, codigo_confirmacao, codigo_expiracao
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $razao_social,
        trim($dados['nome_fantasia'] ?? ''),
        $cnpj,
        $email,
        trim($dados['telefone'] ?? ''),
        trim($dados['setor_atividade'] ?? ''),
        $dados['porte_empresa'] ?? 'micro',
        intval($dados['numero_funcionarios'] ?? 0),
        trim($dados['cidade'] ?? ''),
        trim($dados['estado'] ?? ''),
        preg_replace('/\D/', '', $dados['cep'] ?? ''),
        $senha_hash,
        $codigo,
        $codigo_expiracao
    ]);
}

function cadastrarDPO($conn, $dados, $email, $senha_hash, $codigo, $codigo_expiracao) {
    $nome_completo = trim($dados['nome_completo'] ?? '');
    $cpf = preg_replace('/\D/', '', $dados['cpf'] ?? '');
    
    if (empty($nome_completo) || empty($cpf)) {
        throw new Exception('Nome completo e CPF são obrigatórios para DPOs');
    }
    
    if (strlen($cpf) !== 11) {
        throw new Exception('CPF inválido');
    }
    
    // Verificar se CPF já existe
    $stmt = $conn->prepare("SELECT cpf FROM dpos WHERE cpf = ?");
    $stmt->execute([$cpf]);
    if ($stmt->fetch()) {
        throw new Exception('Este CPF já está cadastrado');
    }
    
    $stmt = $conn->prepare("INSERT INTO dpos (
        nome_completo, cpf, email, telefone, formacao_academica,
        certificacoes, experiencia_anos, cidade, estado, cep,
        senha, codigo_confirmacao, codigo_expiracao
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $nome_completo,
        $cpf,
        $email,
        trim($dados['telefone'] ?? ''),
        trim($dados['formacao_academica'] ?? ''),
        trim($dados['certificacoes'] ?? ''),
        intval($dados['experiencia_anos'] ?? 0),
        trim($dados['cidade'] ?? ''),
        trim($dados['estado'] ?? ''),
        preg_replace('/\D/', '', $dados['cep'] ?? ''),
        $senha_hash,
        $codigo,
        $codigo_expiracao
    ]);
}

function enviarEmailConfirmacao($email, $codigo, $tipo) {
    $assunto = "Confirme seu cadastro - Conformidade em Foco";
    $tipo_texto = $tipo === 'empresa' ? 'Empresa' : 'DPO';
    
    $mensagem = "
    <html>
    <body style='font-family: Arial, sans-serif;'>
        <div style='max-width: 600px; margin: 0 auto; background: #f9f9f9; padding: 20px;'>
            <div style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; color: white; border-radius: 10px;'>
                <h1>🛡️ Conformidade em Foco</h1>
                <h2>Bem-vindo!</h2>
            </div>
            
            <div style='background: white; padding: 30px; margin: 20px 0; border-radius: 10px;'>
                <h3>Confirme seu cadastro como $tipo_texto</h3>
                <p>Use o código abaixo para confirmar sua conta:</p>
                
                <div style='background: #f8f9fa; padding: 20px; text-align: center; border-radius: 10px; margin: 20px 0;'>
                    <h2 style='color: #667eea; font-size: 32px; letter-spacing: 5px; margin: 0;'>$codigo</h2>
                </div>
                
                <p><strong>Este código expira em 1 hora.</strong></p>
                
                <div style='text-align: center; margin: 30px 0;'>
                    <a href='https://seudominio.com/login/confirmar.php?email=" . urlencode($email) . "' 
                       style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                              color: white; text-decoration: none; padding: 15px 30px; 
                              border-radius: 25px; font-weight: bold; display: inline-block;'>
                        Confirmar Agora
                    </a>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Conformidade em Foco <noreply@seudominio.com>\r\n";
    
    return mail($email, $assunto, $mensagem, $headers);
}
?>
