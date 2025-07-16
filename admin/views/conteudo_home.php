<?php
// Conexão com banco
$conn = new mysqli("localhost", "root", "", "lgpd_site");
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$sql = "SELECT conteudo FROM conteudo_home ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo $row['conteudo'];
} else {
    echo "<p>Nenhum conteúdo disponível ainda.</p>";
}
?>
