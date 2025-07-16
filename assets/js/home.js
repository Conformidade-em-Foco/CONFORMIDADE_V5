document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('slider-track');
    const wrapper = track.parentElement;
    const speed = 2;

    // Inicializa posição do slider fora da tela à direita
    let position = wrapper.offsetWidth;

    // Aguarda um pouco para garantir layout completo
    window.requestAnimationFrame(() => {
        // Só exibe o carrossel após calcular largura
        setTimeout(() => {
            track.style.transition = 'transform 0.1s linear';
            track.style.opacity = '1'; // exibe suavemente

            function animate() {
                position -= speed;
                const totalWidth = track.scrollWidth;

                track.style.transform = `translateX(${position}px)`;

                // Quando todo conteúdo sumir da tela à esquerda
                if (Math.abs(position) >= totalWidth) {
                    track.style.transition = 'none';
                    position = wrapper.offsetWidth;
                    track.style.transform = `translateX(${position}px)`;

                    // Força o reflow
                    void track.offsetWidth;

                    // Volta a animação
                    track.style.transition = 'transform 0.1s linear';
                }

                requestAnimationFrame(animate);
            }

            animate();
        }, 300); // tempo de setup seguro (~300ms)
    });

    // Conteúdo dinâmico da página
    fetch('admin/api/conteudo-home.php')
        .then(response => response.text())
        .then(data => {
            const conteudo = document.getElementById('conteudo-dinamico');
            if (conteudo) conteudo.innerHTML = data;
        })
        .catch(() => {
            const conteudo = document.getElementById('conteudo-dinamico');
            if (conteudo) conteudo.innerHTML = "<p>Erro ao carregar o conteúdo.</p>";
        });
});
