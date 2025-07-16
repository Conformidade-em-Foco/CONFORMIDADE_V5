document.addEventListener('DOMContentLoaded', function () {
    const tipoButtons = document.querySelectorAll('.tipo-btn');
    const empresaFields = document.getElementById('empresa-fields');
    const dpoFields = document.getElementById('dpo-fields');
    const tipoUsuarioInput = document.getElementById('tipo_usuario');
    const cadastroForm = document.getElementById('cadastroForm');

    let tipoUsuarioSelecionado = 'empresa';

    tipoButtons.forEach(button => {
        button.addEventListener('click', function () {
            tipoButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            tipoUsuarioSelecionado = this.getAttribute('data-tipo');
            tipoUsuarioInput.value = tipoUsuarioSelecionado;

            if (tipoUsuarioSelecionado === 'empresa') {
                empresaFields.style.display = 'block';
                dpoFields.style.display = 'none';
                document.getElementById('razao_social').required = true;
                document.getElementById('cnpj').required = true;
                document.getElementById('nome_completo').required = false;
                document.getElementById('cpf').required = false;
            } else {
                empresaFields.style.display = 'none';
                dpoFields.style.display = 'block';
                document.getElementById('razao_social').required = false;
                document.getElementById('cnpj').required = false;
                document.getElementById('nome_completo').required = true;
                document.getElementById('cpf').required = true;
            }
        });
    });

    if (cadastroForm) {
        cadastroForm.addEventListener('submit', function () {
            tipoUsuarioInput.value = tipoUsuarioSelecionado;
        });
    }
});
