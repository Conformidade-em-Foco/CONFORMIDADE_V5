<?php
$senha = 'SenhaAdminLGPD@123'; // Coloque aqui a senha desejada
$hash = password_hash($senha, PASSWORD_DEFAULT);

echo "Senha original: $senha<br>";
echo "Hash gerado: $hash";
?>
