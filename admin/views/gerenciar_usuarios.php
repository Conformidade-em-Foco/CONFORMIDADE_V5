<?php
require_once '../../config/conn.php';

// Filtros de pesquisa
$busca = $_GET['busca'] ?? '';
$tipo = $_GET['tipo'] ?? '';

// Monta consulta com filtros
$sql = "SELECT * FROM usuarios WHERE 1=1";
$params = [];

if (!empty($busca)) {
    $sql .= " AND (nome_completo LIKE ? OR email LIKE ? OR cidade LIKE ?)";
    $params[] = "%$busca%";
    $params[] = "%$busca%";
    $params[] = "%$busca%";
}

if (!empty($tipo)) {
    $sql .= " AND tipo_usuario = ?";
    $params[] = $tipo;
}

$sql .= " ORDER BY criado_em DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="../css/admin-usuarios.css">
</head>
<body>
    <h2>👤 Gerenciar Usuários</h2>

    <!-- Filtro de pesquisa -->
    <form method="GET" style="margin-bottom: 2rem; text-align: center;">
        <input type="text" name="busca" placeholder="Buscar por nome, email ou cidade" value="<?= htmlspecialchars($busca) ?>">
        
        <select name="tipo">
            <option value="">Todos os Tipos</option>
            <option value="dpo" <?= $tipo === 'dpo' ? 'selected' : '' ?>>DPO</option>
            <option value="empresa" <?= $tipo === 'empresa' ? 'selected' : '' ?>>Empresa</option>
        </select>

        <button type="submit">Filtrar</button>
        <a href="gerenciar_usuarios.php" style="margin-left: 10px;">Limpar</a>
    </form>

    <!-- Tabela de usuários -->
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Cidade</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['nome_completo'] ?? $usuario['razao_social']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['cidade']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($usuario['criado_em'])) ?></td>
                    <td class="acoes">
                        <a href="editar_usuario.php?id=<?= $usuario['id'] ?>">✏️ Editar</a>
                        <a href="alterar_senha_usuario.php?id=<?= $usuario['id'] ?>">🔐 Senha</a>
                        <a href="excluir_usuario.php?id=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">🗑️ Excluir</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- Botão Voltar -->
    <div style="text-align: center; margin-top: 2rem;">
        <a href="../dashboard.php" class="btn-voltar">⬅️ Voltar ao Dashboard</a>
    </div>
</body>
</html>
