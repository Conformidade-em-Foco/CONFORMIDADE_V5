<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Conformidade em Foco</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                    <h1>Conformidade em Foco</h1>
                </div>
                <h2>Recuperar Senha</h2>
                <p>Digite seu e-mail para receber as instruções de recuperação</p>
            </div>

            <div class="login-form">
                <div id="alertContainer"></div>
                
                <form id="recuperarForm">
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            E-mail
                        </label>
                        <input type="email" id="email" name="email" required 
                               placeholder="Digite seu e-mail cadastrado">
                    </div>

                    <button type="submit" class="btn-login" id="btnRecuperar">
                        <i class="fas fa-paper-plane"></i>
                        Enviar Instruções
                    </button>
                </form>

                <div class="login-links">
                    <p>Lembrou da senha?</p>
                    <a href="index.php" class="btn-cadastro">
                        <i class="fas fa-sign-in-alt"></i>
                        Fazer Login
                    </a>
                </div>

                <div class="back-home">
                    <a href="../" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Voltar ao início
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('recuperarForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            const btnRecuperar = document.getElementById('btnRecuperar');
            const alertContainer = document.getElementById('alertContainer');
            
            if (!email) {
                showAlert('Por favor, digite seu e-mail.', 'error');
                return;
            }
            
            btnRecuperar.disabled = true;
            btnRecuperar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            
            const formData = new FormData();
            formData.append('email', email);
            
            fetch('processar_recuperacao.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('Instruções enviadas para seu e-mail!', 'success');
                    document.getElementById('recuperarForm').reset();
                } else {
                    showAlert(data.message || 'Erro ao enviar instruções.', 'error');
                }
            })
            .catch(error => {
                showAlert('Erro de conexão. Tente novamente.', 'error');
            })
            .finally(() => {
                btnRecuperar.disabled = false;
                btnRecuperar.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar Instruções';
            });
        });
        
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            
            const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
            
            alertDiv.innerHTML = `
                <i class="fas fa-${icon}"></i>
                ${message}
            `;
            
            document.getElementById('alertContainer').innerHTML = '';
            document.getElementById('alertContainer').appendChild(alertDiv);
            
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>