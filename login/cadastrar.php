<?php
include_once '../config/conn.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$tipo = $_POST['tipo'];
$cnpj = $_POST['cnpj'] ?? null;
$codigo = rand(100000, 999999); // código de 6 dígitos

try {
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo, cnpj, codigo_confirmacao) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $senha, $tipo, $cnpj, $codigo]);

    // (Em breve: envio de e-mail com o código)

    header("Location: confirmar.php?email=" . urlencode($email));
    exit;
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
