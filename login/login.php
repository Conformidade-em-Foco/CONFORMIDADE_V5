<?php
session_start();
include_once '../config/conn.php';
require '../vendor/autoload.php';  // Carrega o PHPMailer (ajuste o caminho conforme seu projeto)

$username = $_POST['usuario'];
$password = $_POST['senha'];

// 1. Validar credenciais do usuário
$stmt = $conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE nome = ? OR email = ?");
$stmt->execute([$username, $username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['senha'])) {
    // Credenciais inválidas – você pode redirecionar de volta com mensagem de erro
    echo "Usuário ou senha incorretos!";
    exit;
}

// 2. Gerar código de 6 dígitos e salvar no banco com confirmado=0 e expiração em 5 min
$codigo = random_int(100000, 999999);              // gera número aleatório de 6 dígitos
$expiracao = date("Y-m-d H:i:s", strtotime("+5 minutes"));  // horário atual + 5 minutos

$stmt2 = $conn->prepare("UPDATE usuarios 
                            SET codigo_confirmacao = ?, confirmado = 0, codigo_expiracao = ? 
                          WHERE id = ?");
$stmt2->execute([$codigo, $expiracao, $user['id']]);

// 3. Enviar o código por e-mail usando PHPMailer via SMTP Gmail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);
try {
    // Configurações do servidor SMTP do Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lgpdemfoco123@gmail.com';   // SEU email Gmail de envio
    $mail->Password   = 'obnk dasd dstw zaez    ';      // senha (ou App Password) do Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    // Configurar remetente e destinatário
    $mail->setFrom('email_de_teste@gmail.com', 'LGPD em Foco');         // Remetente (Gmail)
    $mail->addAddress($user['email'], $user['nome']);                  // Destinatário: email do usuário

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = "Seu código de verificação";
    $mail->Body    = "<h3>Olá, {$user['nome']}.</h3>
                      <p>Seu código de confirmação é: <strong>$codigo</strong></p>
                      <p>Ele expira em 5 minutos. Caso não tenha solicitado, ignore este email.</p>";
    $mail->AltBody = "Seu código de confirmação é: $codigo. Ele expira em 5 minutos.";

    $mail->send();  // envia o email
} catch (Exception $e) {
    // Tratamento de erro no envio do email
    error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
    echo "Não foi possível enviar o código de confirmação por e-mail. Tente novamente mais tarde.";
    exit;
}

// 4. Redirecionar para a página de confirmação de código
header("Location: confirmar.php?email=" . urlencode($user['email']));
exit;
?>
