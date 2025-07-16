document.addEventListener('DOMContentLoaded', function () {
    const chatBox = document.querySelector('.chat-box');
    const mensagemInput = document.querySelector('textarea[name="mensagem"]');
    const destinoId = new URLSearchParams(window.location.search).get('destino');

    // Atualiza o chat a cada 3 segundos
    setInterval(() => {
        if (!destinoId) return;
        fetch(`mensagens/listar_mensagens.php?destino=${destinoId}`)
            .then(res => res.text())
            .then(html => {
                chatBox.innerHTML = html;
                chatBox.scrollTop = chatBox.scrollHeight; // rola para o final
            });
    }, 3000);

    // Scroll no carregamento inicial
    chatBox.scrollTop = chatBox.scrollHeight;
});
