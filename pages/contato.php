<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contato | LGPD em Foco</title>
    <link rel="stylesheet" href="../assets/css/contato.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="contato-container">
        <img src="../assets/imagens/logo-lgpd.png" alt="Logo LGPD em Foco" class="logo">
        <h1>Entre em Contato</h1>
        <p>Tem dúvidas, sugestões ou precisa de ajuda? Fale com a gente!</p>

        <!-- Formulário -->
        <form method="POST" action="../backend/enviar_contato.php">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="email" name="email" placeholder="Seu e-mail" required>
            <textarea name="mensagem" placeholder="Sua mensagem" rows="5" required></textarea>
            <button type="submit">Enviar</button>
        </form>

        <!-- Informações de contato -->
        <div class="info-contato">
            <p><strong>Email:</strong> conformidadeemfoco@gmail.com</p>
            <p><strong>WhatsApp:</strong> </p>
            <p><strong>GitHub:</strong> <a href="https://github.com/Conformidade-em-Foco/CONFORMIDADE_V4" target="_blank">https://github.com/Conformidade-em-Foco/CONFORMIDADE_V4</a></p>
        </div>

        <!-- Frase -->
        <blockquote>
            🔐 <strong>"Nossa missão é tornar a proteção de dados acessível, clara e eficaz para todos."</strong>
        </blockquote>

        <!-- Créditos -->
        <div class="creditos">
            Sistema LGPD em Foco - Versão 1.0<br>
            Desenvolvido para pessoas de Segurança da informação - © <?= date('Y') ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
