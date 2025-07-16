<?php
$email = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar E-mail - Conformidade em Foco</title>
    <link rel="stylesheet" href="../assets/css/cadastro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .codigo-input {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 2rem 0;
        }
        
        .codigo-digit {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }
        
        .codigo-digit:focus {
            border-color: #667eea;
            outline: none;
        }
        
        .reenviar-section {
            text-align: center;
            margin: 2rem 0;
        }
        
        .reenviar-codigo {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .reenviar-codigo.disabled {
            color: #ccc;
            pointer-events: none;
        }
        
        .timer {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <div class="cadastro-header">
            <h1><i class="fas fa-envelope-open"></i> Confirme seu E-mail</h1>
            <p>Enviamos um código de 6 dígitos para:</p>
            <strong><?php echo htmlspecialchars($email); ?></strong>
        </div>
        
        <div class="cadastro-form">
            <div id="alertContainer"></div>
            
            <form id="codigoForm">
                <input type="hidden" id="email" value="<?php echo htmlspecialchars($email); ?>">
                
                <div class="codigo-input">
                    <input type="text" class="codigo-digit" maxlength="1" data-index="0">
                    <input type="text" class="codigo-digit" maxlength="1" data-index="1">
                    <input type="text" class="codigo-digit" maxlength="1" data-index="2">
                    <input type="text" class="codigo-digit" maxlength="1" data-index="3">
                    <input type="text" class="codigo-digit" maxlength="1" data-index="4">
                    <input type="text" class="codigo-digit" maxlength="1" data-index="5">
                </div>
                
                <button type="submit" class="btn-cadastrar" id="btnConfirmar">
                    <i class="fas fa-check"></i> Confirmar Código
                </button>
            </form>
            
            <div class="reenviar-section">
                <a href="#" id="reenviarCodigo" class="reenviar-codigo">
                    <i class="fas fa-redo"></i> Reenviar Código
                </a>
                <div class="timer" id="timer" style="display: none;"></div>
            </div>
            
            <div class="login-link">
                <a href="../login/"><i class="fas fa-arrow-left"></i> Voltar ao Login</a>
            </div>
        </div>
    </div>
    
    <script>
        // Configurar inputs do código
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.codigo-digit');
            
            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value.replace(/\D/g, '');
                    e.target.value = value;
                    
                    if (value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    
                    // Auto-submit quando todos preenchidos
                    if (Array.from(inputs).every(inp => inp.value.length === 1)) {
                        setTimeout(() => document.getElementById('codigoForm').dispatchEvent(new Event('submit')), 500);
                    }
                });
                
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
                
                // Colar código completo
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');
                    if (pastedData.length === 6) {
                        inputs.forEach((inp, idx) => inp.value = pastedData[idx] || '');
                    }
                });
            });
            
            inputs[0].focus();
        });
        
        // Submit do formulário
        document.getElementById('codigoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const inputs = document.querySelectorAll('.codigo-digit');
            const codigo = Array.from(inputs).map(input => input.value).join('');
            
            if (codigo.length !== 6) {
                showAlert('Digite o código completo de 6 dígitos', 'error');
                return;
            }
            
            const btnConfirmar = document.getElementById('btnConfirmar');
            btnConfirmar.disabled = true;
            btnConfirmar.innerHTML = 'Verificando...';
            
            fetch('verificar_codigo.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `email=${encodeURIComponent(document.getElementById('email').value)}&codigo=${codigo}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    setTimeout(() => window.location.href = data.redirect, 2000);
                } else {
                    showAlert(data.message, 'error');
                    inputs.forEach(input => input.value = '');
                    inputs[0].focus();
                }
            })
            .catch(() => showAlert('Erro interno. Tente novamente.', 'error'))
            .finally(() => {
                btnConfirmar.disabled = false;
                btnConfirmar.innerHTML = '<i class="fas fa-check"></i> Confirmar Código';
            });
        });
        
        // Reenviar código
        document.getElementById('reenviarCodigo').addEventListener('click', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const reenviarLink = this;
            
            reenviarLink.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Reenviando...';
            
            fetch('../cadastro/processar.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=reenviar&email=${encodeURIComponent(email)}`
            })
            .then(response => response.json())
            .then(data => {
                showAlert(data.message, data.success ? 'success' : 'error');
                if (data.success) iniciarTimer(60);
            })
            .catch(() => showAlert('Erro ao reenviar código', 'error'))
            .finally(() => {
                reenviarLink.innerHTML = '<i class="fas fa-redo"></i> Reenviar Código';
            });
        });
        
        // Timer para reenvio
        function iniciarTimer(segundos) {
            const reenviarLink = document.getElementById('reenviarCodigo');
            const timer = document.getElementById('timer');
            let tempoRestante = segundos;
            
            reenviarLink.classList.add('disabled');
            timer.style.display = 'block';
            
            const interval = setInterval(() => {
                timer.textContent = `Reenviar disponível em ${tempoRestante}s`;
                tempoRestante--;
                
                if (tempoRestante < 0) {
                    clearInterval(interval);
                    reenviarLink.classList.remove('disabled');
                    timer.style.display = 'none';
                }
            }, 1000);
        }
        
        // Mostrar alerta
        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i> ${message}`;
            
            alertContainer.innerHTML = '';
            alertContainer.appendChild(alert);
            
            if (type === 'error') {
                setTimeout(() => {
                    if (alertContainer.contains(alert)) alertContainer.removeChild(alert);
                }, 5000);
            }
        }
    </script>
</body>
</html>
