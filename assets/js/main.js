// Variáveis globais
let currentPage = 'home';
let checklistData = {};
let categories = [
    {
        id: 'governanca',
        name: 'Governança e Organização',
        icon: 'fas fa-users-cog',
        questions: [
            'A organização possui um Encarregado de Proteção de Dados (DPO) designado?',
            'Existe uma política de proteção de dados documentada e aprovada?',
            'A alta direção está comprometida com a proteção de dados?',
            'Há um comitê ou grupo responsável pela governança de dados?',
            'Os papéis e responsabilidades em proteção de dados estão claramente definidos?'
        ]
    },
    {
        id: 'base_legal',
        name: 'Base Legal e Consentimento',
        icon: 'fas fa-balance-scale',
        questions: [
            'A organização identifica e documenta as bases legais para cada tratamento?',
            'O consentimento é obtido de forma clara e específica quando necessário?',
            'Existe um processo para gerenciar e revogar consentimentos?',
            'As finalidades do tratamento são claramente comunicadas aos titulares?',
            'A organização verifica a adequação das bases legais regularmente?'
        ]
    },
    {
        id: 'direitos_titulares',
        name: 'Direitos dos Titulares',
        icon: 'fas fa-user-shield',
        questions: [
            'Existe um canal para receber solicitações dos titulares de dados?',
            'A organização responde às solicitações dentro do prazo legal?',
            'Há processos para confirmação, acesso, correção e eliminação de dados?',
            'Os titulares são informados sobre seus direitos de forma clara?',
            'Existe um registro das solicitações e respostas aos titulares?'
        ]
    },
    {
        id: 'seguranca_tecnica',
        name: 'Segurança Técnica',
        icon: 'fas fa-shield-alt',
        questions: [
            'Existem medidas técnicas adequadas para proteger os dados pessoais?',
            'O acesso aos dados é controlado e monitorado?',
            'Os dados são criptografados quando apropriado?',
            'Há backups seguros e testados regularmente?',
            'Existe controle de acesso baseado em perfis e necessidades?'
        ]
    },
    {
        id: 'gestao_incidentes',
        name: 'Gestão de Incidentes',
        icon: 'fas fa-exclamation-triangle',
        questions: [
            'Existe um plano de resposta a incidentes de segurança?',
            'A organização possui procedimentos para notificar a ANPD?',
            'Há um processo para comunicar incidentes aos titulares?',
            'Os incidentes são documentados e analisados?',
            'Existe uma equipe treinada para responder a incidentes?'
        ]
    },
    {
        id: 'gestao_fornecedores',
        name: 'Gestão de Fornecedores',
        icon: 'fas fa-handshake',
        questions: [
            'Contratos com fornecedores incluem cláusulas de proteção de dados?',
            'Fornecedores são avaliados quanto à conformidade com a LGPD?',
            'Existe um processo de due diligence para novos fornecedores?',
            'Há monitoramento contínuo dos fornecedores que processam dados?',
            'Transferências internacionais seguem os requisitos legais?'
        ]
    },
    {
        id: 'treinamento',
        name: 'Treinamento e Conscientização',
        icon: 'fas fa-graduation-cap',
        questions: [
            'Funcionários recebem treinamento regular sobre LGPD?',
            'Existe um programa de conscientização em proteção de dados?',
            'Novos funcionários são treinados sobre políticas de dados?',
            'Há materiais educativos disponíveis para os funcionários?',
            'O treinamento é atualizado conforme mudanças na legislação?'
        ]
    },
    {
        id: 'documentacao',
        name: 'Documentação e Registros',
        icon: 'fas fa-file-alt',
        questions: [
            'Existe um inventário/mapeamento de dados pessoais?',
            'Os fluxos de dados são documentados e atualizados?',
            'Há registros das atividades de tratamento?',
            'A documentação é revisada e atualizada regularmente?',
            'Existe um relatório de impacto quando necessário?'
        ]
    }
];

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Mostrar página inicial
    showPage('home');
    
    // Gerar checklist
    generateChecklist();
    
    // Adicionar event listeners
    addEventListeners();
}

function addEventListeners() {
    // Smooth scroll para links da navbar
    document.querySelectorAll('.nav-link[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

// Função para mostrar páginas
function showPage(pageId) {
    // Esconder todas as páginas
    document.querySelectorAll('.page').forEach(page => {
        page.classList.remove('active');
    });
    
    // Mostrar página selecionada
    const targetPage = document.getElementById(pageId);
    if (targetPage) {
        targetPage.classList.add('active');
        currentPage = pageId;
        
        // Scroll para o topo
        window.scrollTo(0, 0);
        
        // Se for a página de resultados, atualizar data
        if (pageId === 'results') {
            updateEvaluationDate();
        }
    }
}

// Gerar checklist dinamicamente
function generateChecklist() {
    const checklistForm = document.getElementById('checklistForm');
    if (!checklistForm) return;
    
    let html = '';
    
    categories.forEach((category, categoryIndex) => {
        html += `
            <div class="category-section">
                <div class="category-header">
                    <i class="${category.icon}"></i>
                    <h3>${category.name}</h3>
                    <div class="category-progress">
                        <span class="progress-text">0/${category.questions.length}</span>
                        <div class="progress-bar">
                            <div class="progress-fill" data-category="${category.id}"></div>
                        </div>
                    </div>
                </div>
                <div class="questions-container">
        `;
        
        category.questions.forEach((question, questionIndex) => {
            const questionId = `${category.id}_${questionIndex}`;
            html += `
                <div class="question-item">
                    <div class="question-text">
                        <span class="question-number">${questionIndex + 1}.</span>
                        ${question}
                    </div>
                    <div class="question-options">
                        <label class="option-label">
                            <input type="radio" name="${questionId}" value="sim" onchange="updateProgress('${category.id}')">
                            <span class="option-text sim">Sim</span>
                        </label>
                        <label class="option-label">
                            <input type="radio" name="${questionId}" value="parcial" onchange="updateProgress('${category.id}')">
                            <span class="option-text parcial">Parcial</span>
                        </label>
                        <label class="option-label">
                            <input type="radio" name="${questionId}" value="nao" onchange="updateProgress('${category.id}')">
                            <span class="option-text nao">Não</span>
                        </label>
                    </div>
                </div>
            `;
        });
        
        html += `
                </div>
            </div>
        `;
    });
    
    checklistForm.innerHTML = html;
}

// Atualizar progresso da categoria
function updateProgress(categoryId) {
    const category = categories.find(cat => cat.id === categoryId);
    if (!category) return;
    
    const totalQuestions = category.questions.length;
    let answeredQuestions = 0;
    
    // Contar perguntas respondidas
    category.questions.forEach((question, index) => {
        const questionId = `${categoryId}_${index}`;
        const selectedOption = document.querySelector(`input[name="${questionId}"]:checked`);
        if (selectedOption) {
            answeredQuestions++;
        }
    });
    
    // Atualizar interface
    const progressText = document.querySelector(`[data-category="${categoryId}"]`).parentElement.querySelector('.progress-text');
    const progressFill = document.querySelector(`[data-category="${categoryId}"]`);
    
    if (progressText) {
        progressText.textContent = `${answeredQuestions}/${totalQuestions}`;
    }
    
    if (progressFill) {
        const percentage = (answeredQuestions / totalQuestions) * 100;
        progressFill.style.width = `${percentage}%`;
    }
}

// Calcular resultados
function calculateResults() {
    let totalQuestions = 0;
    let totalScore = 0;
    const categoryResults = [];
    
    categories.forEach(category => {
        let categoryScore = 0;
        let categoryTotal = category.questions.length;
        
        category.questions.forEach((question, index) => {
            const questionId = `${category.id}_${index}`;
            const selectedOption = document.querySelector(`input[name="${questionId}"]:checked`);
            
            if (selectedOption) {
                const value = selectedOption.value;
                if (value === 'sim') categoryScore += 2;
                else if (value === 'parcial') categoryScore += 1;
                // 'nao' = 0 pontos
            }
        });
        
        const categoryPercentage = (categoryScore / (categoryTotal * 2)) * 100;
        categoryResults.push({
            name: category.name,
            icon: category.icon,
            score: categoryScore,
            total: categoryTotal * 2,
            percentage: categoryPercentage
        });
        
        totalQuestions += categoryTotal;
        totalScore += categoryScore;
    });
    
    // Verificar se todas as perguntas foram respondidas
    const totalAnswered = categories.reduce((sum, category) => {
        return sum + category.questions.filter((question, index) => {
            const questionId = `${category.id}_${index}`;
            return document.querySelector(`input[name="${questionId}"]:checked`);
        }).length;
    }, 0);
    
    if (totalAnswered < totalQuestions) {
        alert('Por favor, responda todas as perguntas antes de calcular o resultado.');
        return;
    }
    
    // Calcular porcentagem geral
    const overallPercentage = (totalScore / (totalQuestions * 2)) * 100;
    
    // Mostrar resultados
    displayResults(overallPercentage, categoryResults);
    showPage('results');
}

// Exibir resultados
function displayResults(overallPercentage, categoryResults) {
    // Atualizar score geral
    const scorePercentage = document.getElementById('scorePercentage');
    const scoreLevel = document.getElementById('scoreLevel');
    const scoreDescription = document.getElementById('scoreDescription');
    const scoreCircle = document.getElementById('scoreCircle');
    
    if (scorePercentage) {
        scorePercentage.textContent = `${Math.round(overallPercentage)}%`;
    }
    
    // Determinar nível de conformidade
    let level, description, color;
    if (overallPercentage >= 80) {
        level = 'Excelente Conformidade';
        description = 'Sua organização demonstra alto nível de conformidade com a LGPD.';
        color = '#28a745';
    } else if (overallPercentage >= 60) {
        level = 'Boa Conformidade';
        description = 'Sua organização está no caminho certo, mas há pontos para melhorar.';
        color = '#ffc107';
    } else if (overallPercentage >= 40) {
        level = 'Conformidade Parcial';
        description = 'Sua organização precisa de melhorias significativas para estar em conformidade.';
        color = '#fd7e14';
    } else {
        level = 'Baixa Conformidade';
        description = 'Sua organização precisa de ações urgentes para adequação à LGPD.';
        color = '#dc3545';
    }
    
    if (scoreLevel) scoreLevel.textContent = level;
    if (scoreDescription) scoreDescription.textContent = description;
    if (scoreCircle) scoreCircle.style.background = `linear-gradient(135deg, ${color} 0%, ${color}dd 100%)`;
    
    // Atualizar resultados por categoria
    const categoriesResult = document.getElementById('categoriesResult');
    if (categoriesResult) {
        let html = '<h3>Resultados por Categoria</h3><div class="categories-grid">';
        
        categoryResults.forEach(category => {
            let categoryColor;
            if (category.percentage >= 80) categoryColor = '#28a745';
            else if (category.percentage >= 60) categoryColor = '#ffc107';
            else if (category.percentage >= 40) categoryColor = '#fd7e14';
            else categoryColor = '#dc3545';
            
            html += `
                <div class="category-result-card">
                    <div class="category-result-header">
                        <i class="${category.icon}"></i>
                        <h4>${category.name}</h4>
                    </div>
                    <div class="category-score">
                        <div class="score-circle-small" style="background: ${categoryColor}">
                            ${Math.round(category.percentage)}%
                        </div>
                        <div class="score-details">
                            <span>${category.score}/${category.total} pontos</span>
                        </div>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        categoriesResult.innerHTML = html;
    }
}

// Atualizar data da avaliação
function updateEvaluationDate() {
    const evaluationDate = document.getElementById('evaluationDate');
    if (evaluationDate) {
        const now = new Date();
                const dateString = now.toLocaleDateString('pt-BR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        evaluationDate.textContent = `Avaliação realizada em ${dateString}`;
    }
}

// Função para imprimir resultados
function printResults() {
    // Criar uma nova janela com apenas o conteúdo dos resultados
    const printWindow = window.open('', '_blank');
    const resultContent = document.querySelector('.result-container').innerHTML;
    
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Resultado Avaliação LGPD - Conformidade em Foco</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .result-header { text-align: center; margin-bottom: 30px; }
                .score-card { text-align: center; margin: 30px 0; padding: 20px; border: 2px solid #ddd; }
                .score-circle { width: 100px; height: 100px; border-radius: 50%; background: #667eea; color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; margin: 10px; }
                .categories-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 20px; }
                .category-result-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
                .category-result-header { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
                .score-circle-small { width: 50px; height: 50px; border-radius: 50%; color: white; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; }
                .action-buttons { display: none; }
                @media print { .action-buttons { display: none !important; } }
            </style>
        </head>
        <body>
            ${resultContent}
        </body>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.focus();
    
    // Aguardar um pouco para o conteúdo carregar e então imprimir
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 500);
}

// Função para resetar formulário
function resetChecklist() {
    const checklistForm = document.getElementById('checklistForm');
    if (checklistForm) {
        checklistForm.reset();
        
        // Resetar barras de progresso
        document.querySelectorAll('.progress-fill').forEach(fill => {
            fill.style.width = '0%';
        });
        
        document.querySelectorAll('.progress-text').forEach(text => {
            const category = categories.find(cat => 
                text.parentElement.querySelector(`[data-category="${cat.id}"]`)
            );
            if (category) {
                text.textContent = `0/${category.questions.length}`;
            }
        });
    }
}

// Função para salvar progresso (se usuário estiver logado)
function saveProgress() {
    // Verificar se usuário está logado
    // Esta função pode ser expandida para salvar no servidor
    const formData = new FormData(document.getElementById('checklistForm'));
    const progressData = {};
    
    for (let [key, value] of formData.entries()) {
        progressData[key] = value;
    }
    
    // Salvar no localStorage como backup
    localStorage.setItem('lgpd_checklist_progress', JSON.stringify(progressData));
    
    console.log('Progresso salvo:', progressData);
}

// Função para carregar progresso salvo
function loadProgress() {
    const savedProgress = localStorage.getItem('lgpd_checklist_progress');
    if (savedProgress) {
        try {
            const progressData = JSON.parse(savedProgress);
            
            // Restaurar respostas
            Object.entries(progressData).forEach(([questionId, value]) => {
                const input = document.querySelector(`input[name="${questionId}"][value="${value}"]`);
                if (input) {
                    input.checked = true;
                    
                    // Atualizar progresso da categoria
                    const categoryId = questionId.split('_')[0];
                    updateProgress(categoryId);
                }
            });
            
            console.log('Progresso carregado:', progressData);
        } catch (error) {
            console.error('Erro ao carregar progresso:', error);
        }
    }
}

// Auto-salvar progresso a cada mudança
document.addEventListener('change', function(e) {
    if (e.target.type === 'radio' && e.target.name.includes('_')) {
        saveProgress();
    }
});

// Carregar progresso ao inicializar checklist
document.addEventListener('DOMContentLoaded', function() {
    // Aguardar um pouco para o checklist ser gerado
    setTimeout(() => {
        loadProgress();
    }, 100);
});

// Função para validar se todas as perguntas foram respondidas
function validateAllAnswered() {
    let totalQuestions = 0;
    let answeredQuestions = 0;
    
    categories.forEach(category => {
        category.questions.forEach((question, index) => {
            totalQuestions++;
            const questionId = `${category.id}_${index}`;
            const selectedOption = document.querySelector(`input[name="${questionId}"]:checked`);
            if (selectedOption) {
                answeredQuestions++;
            }
        });
    });
    
    return {
        total: totalQuestions,
        answered: answeredQuestions,
        isComplete: answeredQuestions === totalQuestions
    };
}

// Função para mostrar progresso geral
function updateOverallProgress() {
    const validation = validateAllAnswered();
    const percentage = (validation.answered / validation.total) * 100;
    
    // Atualizar indicador de progresso geral se existir
    const overallProgress = document.querySelector('.overall-progress');
    if (overallProgress) {
        overallProgress.textContent = `${validation.answered}/${validation.total} perguntas respondidas (${Math.round(percentage)}%)`;
    }
}

// Adicionar indicador de progresso geral
function addOverallProgressIndicator() {
    const submitSection = document.querySelector('.submit-section');
    if (submitSection && !document.querySelector('.overall-progress-container')) {
        const progressContainer = document.createElement('div');
        progressContainer.className = 'overall-progress-container';
        progressContainer.innerHTML = `
            <div class="overall-progress-bar">
                <div class="overall-progress-fill"></div>
            </div>
            <div class="overall-progress">0/${categories.reduce((sum, cat) => sum + cat.questions.length, 0)} perguntas respondidas (0%)</div>
        `;
        
        submitSection.insertBefore(progressContainer, submitSection.firstChild);
    }
}

// Atualizar progresso geral quando uma pergunta for respondida
document.addEventListener('change', function(e) {
    if (e.target.type === 'radio' && e.target.name.includes('_')) {
        updateOverallProgress();
        
        const validation = validateAllAnswered();
        const percentage = (validation.answered / validation.total) * 100;
        
        // Atualizar barra de progresso geral
        const overallProgressFill = document.querySelector('.overall-progress-fill');
        if (overallProgressFill) {
            overallProgressFill.style.width = `${percentage}%`;
        }
    }
});

// Smooth scroll melhorado
function smoothScrollTo(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        const offsetTop = element.offsetTop - 100; // Compensar navbar fixa
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    }
}

// Função para exportar resultados como PDF (básico)
function exportToPDF() {
    // Esta é uma implementação básica
    // Para uma implementação completa, seria necessário usar uma biblioteca como jsPDF
    alert('Funcionalidade de exportação para PDF será implementada em breve!');
}

// Adicionar estilos CSS necessários dinamicamente
function addDynamicStyles() {
    const style = document.createElement('style');
    style.textContent = `
        .category-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .category-header i {
            font-size: 2rem;
            color: #667eea;
        }
        
        .category-header h3 {
            flex: 1;
            font-size: 1.5rem;
            color: #333;
            margin: 0;
        }
        
        .category-progress {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }
        
        .progress-text {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }
        
        .progress-bar {
            width: 150px;
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .question-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .question-item:last-child {
            border-bottom: none;
        }
        
        .question-text {
            flex: 1;
            font-size: 1rem;
            color: #333;
            line-height: 1.5;
            margin-right: 2rem;
        }
        
        .question-number {
            font-weight: 600;
            color: #667eea;
            margin-right: 0.5rem;
        }
        
        .question-options {
            display: flex;
            gap: 1rem;
        }
        
        .option-label {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .option-label input[type="radio"] {
            display: none;
        }
        
        .option-text {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .option-text.sim {
            background-color: #d4edda;
            color: #155724;
        }
        
        .option-text.parcial {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .option-text.nao {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .option-label input:checked + .option-text {
            border-color: currentColor;
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .overall-progress-container {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        
        .overall-progress-bar {
            width: 100%;
            height: 12px;
            background-color: #e9ecef;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 1rem;
        }
        
        .overall-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .category-result-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        
        .category-result-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .category-result-header i {
            font-size: 1.5rem;
            color: #667eea;
        }
        
        .category-result-header h4 {
            margin: 0;
            color: #333;
        }
        
        .category-score {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .score-circle-small {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .score-details {
            color: #666;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .question-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .question-text {
                margin-right: 0;
            }
            
            .question-options {
                width: 100%;
                justify-content: space-between;
            }
            
            .category-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .category-progress {
                align-items: flex-start;
                width: 100%;
            }
            
            .progress-bar {
                width: 100%;
            }
        }
    `;
    
    document.head.appendChild(style);
}

// Inicializar estilos dinâmicos
// Inicializar estilos dinâmicos
document.addEventListener('DOMContentLoaded', function() {
    addDynamicStyles();
    
    // Aguardar um pouco para o checklist ser gerado e então adicionar indicador de progresso
    setTimeout(() => {
        addOverallProgressIndicator();
        updateOverallProgress();
    }, 200);
});

// Função para animar números nos resultados
function animateNumbers() {
    const scoreElement = document.getElementById('scorePercentage');
    if (scoreElement) {
        const finalScore = parseInt(scoreElement.textContent);
        let currentScore = 0;
        const increment = finalScore / 50; // Animar em 50 passos
        
        const timer = setInterval(() => {
            currentScore += increment;
            if (currentScore >= finalScore) {
                currentScore = finalScore;
                clearInterval(timer);
            }
            scoreElement.textContent = `${Math.round(currentScore)}%`;
        }, 20);
    }
}

// Função para mostrar dicas baseadas no resultado
function showRecommendations(overallPercentage, categoryResults) {
    const recommendationsContainer = document.createElement('div');
    recommendationsContainer.className = 'recommendations-section';
    
    let recommendations = [];
    
    // Recomendações baseadas no score geral
    if (overallPercentage < 40) {
        recommendations.push({
            title: 'Ação Urgente Necessária',
            text: 'Sua organização precisa implementar medidas básicas de proteção de dados imediatamente.',
            icon: 'fas fa-exclamation-triangle',
            priority: 'high'
        });
    } else if (overallPercentage < 60) {
        recommendations.push({
            title: 'Melhorias Significativas',
            text: 'Foque nas categorias com menor pontuação para aumentar sua conformidade.',
            icon: 'fas fa-chart-line',
            priority: 'medium'
        });
    } else if (overallPercentage < 80) {
        recommendations.push({
            title: 'Refinamento Necessário',
            text: 'Sua organização está bem encaminhada. Ajuste os pontos fracos identificados.',
            icon: 'fas fa-tools',
            priority: 'low'
        });
    } else {
        recommendations.push({
            title: 'Manutenção da Excelência',
            text: 'Continue monitorando e atualizando suas práticas de proteção de dados.',
            icon: 'fas fa-star',
            priority: 'info'
        });
    }
    
    // Recomendações específicas por categoria com baixa pontuação
    categoryResults.forEach(category => {
        if (category.percentage < 50) {
            recommendations.push({
                title: `Melhore: ${category.name}`,
                text: `Esta categoria precisa de atenção especial (${Math.round(category.percentage)}% de conformidade).`,
                icon: category.icon,
                priority: 'medium'
            });
        }
    });
    
    // Gerar HTML das recomendações
    let html = '<div class="recommendations-header"><h3><i class="fas fa-lightbulb"></i> Recomendações</h3></div>';
    html += '<div class="recommendations-grid">';
    
    recommendations.forEach(rec => {
        html += `
            <div class="recommendation-card ${rec.priority}">
                <div class="recommendation-icon">
                    <i class="${rec.icon}"></i>
                </div>
                <div class="recommendation-content">
                    <h4>${rec.title}</h4>
                    <p>${rec.text}</p>
                </div>
            </div>
        `;
    });
    
    html += '</div>';
    recommendationsContainer.innerHTML = html;
    
    // Inserir após os resultados das categorias
    const categoriesResult = document.getElementById('categoriesResult');
    if (categoriesResult && categoriesResult.parentNode) {
        categoriesResult.parentNode.insertBefore(recommendationsContainer, categoriesResult.nextSibling);
    }
}

// Atualizar função displayResults para incluir recomendações
const originalDisplayResults = displayResults;
displayResults = function(overallPercentage, categoryResults) {
    originalDisplayResults(overallPercentage, categoryResults);
    
    // Animar números
    setTimeout(() => {
        animateNumbers();
    }, 500);
    
    // Mostrar recomendações
    setTimeout(() => {
        showRecommendations(overallPercentage, categoryResults);
    }, 1000);
};

// Função para compartilhar resultados
function shareResults() {
    const scorePercentage = document.getElementById('scorePercentage');
    const scoreLevel = document.getElementById('scoreLevel');
    
    if (navigator.share && scorePercentage && scoreLevel) {
        navigator.share({
            title: 'Meu Resultado LGPD - Conformidade em Foco',
            text: `Obtive ${scorePercentage.textContent} de conformidade LGPD - ${scoreLevel.textContent}`,
            url: window.location.href
        });
    } else {
        // Fallback para navegadores que não suportam Web Share API
        const text = `Obtive ${scorePercentage?.textContent || '0%'} de conformidade LGPD - ${scoreLevel?.textContent || 'Avaliação'}`;
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Resultado copiado para a área de transferência!');
            });
        } else {
            // Fallback mais antigo
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Resultado copiado para a área de transferência!');
        }
    }
}

// Adicionar botão de compartilhar aos resultados
function addShareButton() {
    const actionButtons = document.querySelector('.action-buttons');
    if (actionButtons && !document.querySelector('.btn-share')) {
        const shareButton = document.createElement('button');
        shareButton.className = 'btn btn-info btn-share';
        shareButton.innerHTML = '<i class="fas fa-share-alt"></i> Compartilhar';
        shareButton.onclick = shareResults;
        
        actionButtons.insertBefore(shareButton, actionButtons.lastElementChild);
    }
}

// Função para salvar resultados no histórico (se usuário logado)
function saveResultsToHistory(overallPercentage, categoryResults) {
    const resultsData = {
        date: new Date().toISOString(),
        overallPercentage: overallPercentage,
        categoryResults: categoryResults,
        totalQuestions: categories.reduce((sum, cat) => sum + cat.questions.length, 0)
    };
    
    // Salvar no localStorage como backup
    let history = JSON.parse(localStorage.getItem('lgpd_results_history') || '[]');
    history.unshift(resultsData); // Adicionar no início
    
    // Manter apenas os últimos 10 resultados
    if (history.length > 10) {
        history = history.slice(0, 10);
    }
    
    localStorage.setItem('lgpd_results_history', JSON.stringify(history));
    
    // Aqui você poderia enviar para o servidor se o usuário estiver logado
    console.log('Resultado salvo no histórico:', resultsData);
}

// Atualizar calculateResults para salvar no histórico
const originalCalculateResults = calculateResults;
calculateResults = function() {
    originalCalculateResults();
    
    // Aguardar um pouco para os resultados serem calculados
    setTimeout(() => {
        const scorePercentage = document.getElementById('scorePercentage');
        if (scorePercentage) {
            const overallPercentage = parseInt(scorePercentage.textContent);
            
            // Recalcular categoryResults (simplificado)
            const categoryResults = categories.map(category => {
                let categoryScore = 0;
                let categoryTotal = category.questions.length;
                
                category.questions.forEach((question, index) => {
                    const questionId = `${category.id}_${index}`;
                    const selectedOption = document.querySelector(`input[name="${questionId}"]:checked`);
                    
                    if (selectedOption) {
                        const value = selectedOption.value;
                        if (value === 'sim') categoryScore += 2;
                        else if (value === 'parcial') categoryScore += 1;
                    }
                });
                
                return {
                    name: category.name,
                    percentage: (categoryScore / (categoryTotal * 2)) * 100
                };
            });
            
            saveResultsToHistory(overallPercentage, categoryResults);
            addShareButton();
        }
    }, 1500);
};

// Função para mostrar histórico de resultados
function showResultsHistory() {
    const history = JSON.parse(localStorage.getItem('lgpd_results_history') || '[]');
    
    if (history.length === 0) {
        alert('Nenhum resultado anterior encontrado.');
        return;
    }
    
    // Criar modal ou página para mostrar histórico
    const modal = document.createElement('div');
    modal.className = 'history-modal';
    modal.innerHTML = `
        <div class="history-modal-content">
            <div class="history-header">
                <h2><i class="fas fa-history"></i> Histórico de Avaliações</h2>
                <button class="close-modal" onclick="this.parentElement.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="history-list">
                ${history.map((result, index) => `
                    <div class="history-item">
                        <div class="history-date">
                            ${new Date(result.date).toLocaleDateString('pt-BR', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })}
                        </div>
                        <div class="history-score">
                            <span class="score-badge">${Math.round(result.overallPercentage)}%</span>
                        </div>
                        <div class="history-details">
                            ${result.totalQuestions} perguntas respondidas
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
}

// Adicionar estilos para o modal de histórico
const historyStyles = `
    .history-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    
    .history-modal-content {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
    }
    
    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }
    
    .close-modal {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #666;
        padding: 0.5rem;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .close-modal:hover {
        background: #f8f9fa;
        color: #333;
    }
    
    .history-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
    
    .history-date {
        flex: 1;
        font-size: 0.9rem;
        color: #666;
    }
    
    .score-badge {
        background: #667eea;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-weight: bold;
        font-size: 0.9rem;
    }
    
    .history-details {
        font-size: 0.8rem;
        color: #999;
    }
    
    .recommendations-section {
        margin: 2rem 0;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 15px;
    }
    
    .recommendations-header h3 {
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .recommendations-grid {
        display: grid;
        gap: 1rem;
    }
    
    .recommendation-card {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #667eea;
        display: flex;
        gap: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .recommendation-card.high {
        border-left-color: #dc3545;
    }
    
    .recommendation-card.medium {
        border-left-color: #ffc107;
    }
    
    .recommendation-card.low {
        border-left-color: #28a745;
    }
    
    .recommendation-card.info {
        border-left-color: #17a2b8;
    }
    
    .recommendation-icon {
        font-size: 1.5rem;
        color: #667eea;
        margin-top: 0.25rem;
    }
    
    .recommendation-card.high .recommendation-icon {
        color: #dc3545;
    }
    
    .recommendation-card.medium .recommendation-icon {
        color: #ffc107;
    }
    
    .recommendation-card.low .recommendation-icon {
        color: #28a745;
    }
    
    .recommendation-card.info .recommendation-icon {
        color: #17a2b8;
    }
    
    .recommendation-content h4 {
        margin: 0 0 0.5rem 0;
        color: #333;
    }
    
    .recommendation-content p {
        margin: 0;
        color: #666;
        line-height: 1.4;
    }
`;

// Adicionar estilos do histórico
const historyStyleSheet = document.createElement('style');
historyStyleSheet.textContent = historyStyles;
document.head.appendChild(historyStyleSheet);

// Função para detectar dispositivo móvel
function isMobile() {
    return window.innerWidth <= 768;
}

// Função para otimizar interface em dispositivos móveis
function optimizeForMobile() {
    if (isMobile()) {
        // Ajustar layout para mobile
        document.body.classList.add('mobile-layout');
        
        // Reduzir animações em dispositivos móveis para melhor performance
        document.documentElement.style.setProperty('--animation-duration', '0.2s');
    }
}

// Função para lazy loading das categorias (melhor performance)
function lazyLoadCategories() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const categorySection = entry.target;
                categorySection.classList.add('loaded');
                observer.unobserve(categorySection);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });
    
    document.querySelectorAll('.category-section').forEach(section => {
        observer.observe(section);
    });
}

// Função para validação em tempo real
function setupRealTimeValidation() {
    document.addEventListener('change', function(e) {
        if (e.target.type === 'radio' && e.target.name.includes('_')) {
            // Adicionar feedback visual imediato
            const questionItem = e.target.closest('.question-item');
            if (questionItem) {
                questionItem.classList.add('answered');
                
                // Adicionar ícone de check
                let checkIcon = questionItem.querySelector('.check-icon');
                if (!checkIcon) {
                    checkIcon = document.createElement('i');
                    checkIcon.className = 'fas fa-check-circle check-icon';
                    questionItem.querySelector('.question-text').appendChild(checkIcon);
                }
            }
        }
    });
}

// Função para salvar rascunho automaticamente
function setupAutoSave() {
    let saveTimeout;
    
    document.addEventListener('change', function(e) {
        if (e.target.type === 'radio' && e.target.name.includes('_')) {
            // Debounce para evitar muitas operações de salvamento
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(() => {
                saveProgress();
                showSaveIndicator();
            }, 1000);
        }
    });
}

// Mostrar indicador de salvamento
function showSaveIndicator() {
    let indicator = document.querySelector('.save-indicator');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.className = 'save-indicator';
        indicator.innerHTML = '<i class="fas fa-check"></i> Progresso salvo';
        document.body.appendChild(indicator);
    }
    
    indicator.classList.add('show');
    
    setTimeout(() => {
        indicator.classList.remove('show');
    }, 2000);
}

// Função para navegação por teclado
function setupKeyboardNavigation() {
    document.addEventListener('keydown', function(e) {
        // Esc para voltar à página inicial
        if (e.key === 'Escape' && currentPage !== 'home') {
            showPage('home');
        }
        
        // Enter para calcular resultados se todas as perguntas estiverem respondidas
        if (e.key === 'Enter' && currentPage === 'checklist') {
            const validation = validateAllAnswered();
            if (validation.isComplete) {
                calculateResults();
            }
        }
        
        // Ctrl+P para imprimir resultados
        if (e.ctrlKey && e.key === 'p' && currentPage === 'results') {
            e.preventDefault();
            printResults();
        }
    });
}

// Função para analytics básico (sem bibliotecas externas)
function trackEvent(eventName, eventData = {}) {
    // Implementação básica de tracking
    const event = {
        name: eventName,
        timestamp: new Date().toISOString(),
        page: currentPage,
        ...eventData
    };
    
    // Salvar no localStorage para análise posterior
    let events = JSON.parse(localStorage.getItem('lgpd_analytics') || '[]');
    events.push(event);
    
    // Manter apenas os últimos 100 eventos
    if (events.length > 100) {
        events = events.slice(-100);
    }
    
    localStorage.setItem('lgpd_analytics', JSON.stringify(events));
    
    console.log('Event tracked:', event);
}

// Função para feedback do usuário
function setupFeedbackSystem() {
    // Adicionar botão de feedback flutuante
    const feedbackButton = document.createElement('button');
    feedbackButton.className = 'feedback-button';
    feedbackButton.innerHTML = '<i class="fas fa-comment"></i>';
    feedbackButton.title = 'Enviar Feedback';
    feedbackButton.onclick = showFeedbackModal;
    
    document.body.appendChild(feedbackButton);
}

// Mostrar modal de feedback
function showFeedbackModal() {
    const modal = document.createElement('div');
    modal.className = 'feedback-modal';
    modal.innerHTML = `
        <div class="feedback-modal-content">
            <div class="feedback-header">
                <h3><i class="fas fa-comment"></i> Seu Feedback</h3>
                <button class="close-modal" onclick="this.parentElement.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="feedback-body">
                <p>Ajude-nos a melhorar a ferramenta:</p>
                <div class="rating-section">
                    <label>Como você avalia esta ferramenta?</label>
                    <div class="star-rating">
                        <i class="fas fa-star" data-rating="1"></i>
                        <i class="fas fa-star" data-rating="2"></i>
                        <i class="fas fa-star" data-rating="3"></i>
                        <i class="fas fa-star" data-rating="4"></i>
                        <i class="fas fa-star" data-rating="5"></i>
                    </div>
                </div>
                <div class="comment-section">
                    <label for="feedbackComment">Comentários (opcional):</label>
                    <textarea id="feedbackComment" rows="4" placeholder="Compartilhe sua experiência, sugestões ou problemas encontrados..."></textarea>
                </div>
                <div class="feedback-actions">
                    <button class="btn btn-secondary" onclick="this.closest('.feedback-modal').remove()">
                        Cancelar
                    </button>
                    <button class="btn btn-primary" onclick="submitFeedback()">
                        Enviar Feedback
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Adicionar funcionalidade de rating
    modal.querySelectorAll('.star-rating i').forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            const stars = modal.querySelectorAll('.star-rating i');
            
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
            
            modal.dataset.rating = rating;
        });
        
        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            const stars = modal.querySelectorAll('.star-rating i');
            
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('hover');
                } else {
                    s.classList.remove('hover');
                }
            });
        });
    });
    
    modal.querySelector('.star-rating').addEventListener('mouseleave', function() {
        modal.querySelectorAll('.star-rating i').forEach(s => s.classList.remove('hover'));
    });
}

// Enviar feedback
function submitFeedback() {
    const modal = document.querySelector('.feedback-modal');
    const rating = modal.dataset.rating || 0;
    const comment = modal.querySelector('#feedbackComment').value;
    
    if (rating === 0) {
        alert('Por favor, selecione uma avaliação.');
        return;
    }
    
    const feedback = {
        rating: parseInt(rating),
        comment: comment,
        page: currentPage,
        timestamp: new Date().toISOString(),
        userAgent: navigator.userAgent
    };
    
    // Salvar feedback localmente
    let feedbacks = JSON.parse(localStorage.getItem('lgpd_feedbacks') || '[]');
    feedbacks.push(feedback);
    localStorage.setItem('lgpd_feedbacks', JSON.stringify(feedbacks));
    
    // Aqui você enviaria para o servidor
    console.log('Feedback enviado:', feedback);
    
    // Mostrar confirmação
    alert('Obrigado pelo seu feedback! Suas sugestões são muito importantes para nós.');
    
    // Fechar modal
    modal.remove();
    
    // Track evento
    trackEvent('feedback_submitted', { rating: rating, hasComment: comment.length > 0 });
}

// Função para detectar e lidar com erros
function setupErrorHandling() {
    window.addEventListener('error', function(e) {
        console.error('Erro capturado:', e.error);
        
        // Salvar erro para análise
        const errorData = {
            message: e.message,
            filename: e.filename,
            lineno: e.lineno,
            colno: e.colno,
            stack: e.error?.stack,
            timestamp: new Date().toISOString(),
            page: currentPage,
            userAgent: navigator.userAgent
        };
        
        let errors = JSON.parse(localStorage.getItem('lgpd_errors') || '[]');
        errors.push(errorData);
        
        // Manter apenas os últimos 10 erros
        if (errors.length > 10) {
            errors = errors.slice(-10);
        }
        
        localStorage.setItem('lgpd_errors', JSON.stringify(errors));
        
        // Mostrar mensagem amigável ao usuário
        showErrorMessage('Ops! Algo deu errado. A página será recarregada automaticamente.');
        
        // Recarregar página após 3 segundos
        setTimeout(() => {
            window.location.reload();
        }, 3000);
    });
}

// Mostrar mensagem de erro
function showErrorMessage(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.innerHTML = `
        <i class="fas fa-exclamation-triangle"></i>
        ${message}
    `;
    
    document.body.appendChild(errorDiv);
    
    setTimeout(() => {
        if (errorDiv.parentNode) {
            errorDiv.remove();
        }
    }, 5000);
}

// Função para otimização de performance
function optimizePerformance() {
    // Lazy loading de imagens se houver
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Debounce para redimensionamento da janela
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            optimizeForMobile();
        }, 250);
    });
}

// Inicialização completa da aplicação
function initializeCompleteApp() {
    // Funcionalidades básicas
    initializeApp();
    
    // Funcionalidades avançadas
    optimizeForMobile();
    setupRealTimeValidation();
    setupAutoSave();
    setupKeyboardNavigation();
    setupFeedbackSystem();
    setupErrorHandling();
    optimizePerformance();
    
    // Lazy loading das categorias
    setTimeout(() => {
        lazyLoadCategories();
    }, 100);
    
    // Track página inicial
    trackEvent('page_loaded', { page: 'home' });
}

// Sobrescrever inicialização original
document.addEventListener('DOMContentLoaded', function() {
    initializeCompleteApp();
});

// Adicionar estilos para as novas funcionalidades
const additionalStyles = `
    .mobile-layout .question-item {
        padding: 1rem 0;
    }
    
    .mobile-layout .question-options {
        flex-direction: column;
        gap: 0.5rem;
        width: 100%;
    }
    
    .mobile-layout .option-text {
        text-align: center;
        padding: 0.75rem;
    }
    
    .question-item.answered .question-text {
        color: #28a745;
    }
    
    .check-icon {
        color: #28a745;
        margin-left: 0.5rem;
        font-size: 0.9rem;
    }
    
    .save-indicator {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-size: 0.9rem;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s ease;
        z-index: 1000;
    }
    
    .save-indicator.show {
        opacity: 1;
        transform: translateY(0);
    }
    
    .feedback-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #667eea;
        color: white;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
        z-index: 999;
    }
    
    .feedback-button:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
    }
    
    .feedback-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1001;
    }
    
    .feedback-modal-content {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
    }
    
    .feedback-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }
    
    .feedback-header h3 {
        margin: 0;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .rating-section {
        margin-bottom: 1.5rem;
    }
    
    .rating-section label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
    }
    
    .star-rating {
        display: flex;
        gap: 0.25rem;
        font-size: 1.5rem;
    }
    
    .star-rating i {
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    
    .star-rating i:hover,
    .star-rating i.hover {
        color: #ffc107;
    }
    
    .star-rating i.active {
        color: #ffc107;
    }
    
    .comment-section {
        margin-bottom: 1.5rem;
    }
    
    .comment-section label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
    }
    
    .comment-section textarea {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.9rem;
        resize: vertical;
        transition: border-color 0.3s ease;
    }
    
    .comment-section textarea:focus {
        outline: none;
        border-color: #667eea;
    }
    
    .feedback-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }
    
    .error-message {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: #dc3545;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9rem;
        z-index: 1002;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.3);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .category-section {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease;
    }
    
    .category-section.loaded {
        opacity: 1;
        transform: translateY(0);
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .btn-primary {
        background: #667eea;
        color: white;
    }
    
    .btn-primary:hover {
        background: #5a6fd8;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
    
    .btn-success {
        background: #28a745;
        color: white;
    }
    
    .btn-success:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    
    .btn-info {
        background: #17a2b8;
        color: white;
    }
    
    .btn-info:hover {
        background: #138496;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .feedback-button {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }
        
        .feedback-modal-content {
            padding: 1.5rem;
        }
        
        .feedback-actions {
            flex-direction: column;
        }
        
        .star-rating {
            justify-content: center;
        }
        
        .error-message {
            left: 10px;
            right: 10px;
            transform: none;
        }
        
        .save-indicator {
            right: 10px;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
    }
    
    @media print {
        .feedback-button,
        .save-indicator,
        .error-message {
            display: none !important;
        }
    }
`;

// Adicionar estilos adicionais
const additionalStyleSheet = document.createElement('style');
additionalStyleSheet.textContent = additionalStyles;
document.head.appendChild(additionalStyleSheet);

// Função para exportar dados para análise
function exportAnalyticsData() {
    const analytics = JSON.parse(localStorage.getItem('lgpd_analytics') || '[]');
    const feedbacks = JSON.parse(localStorage.getItem('lgpd_feedbacks') || '[]');
    const errors = JSON.parse(localStorage.getItem('lgpd_errors') || '[]');
    const history = JSON.parse(localStorage.getItem('lgpd_results_history') || '[]');
    
    const exportData = {
        analytics,
        feedbacks,
        errors,
        history,
        exportDate: new Date().toISOString(),
        version: '1.0.0'
    };
    
    const dataStr = JSON.stringify(exportData, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });
    
    const link = document.createElement('a');
    link.href = URL.createObjectURL(dataBlob);
    link.download = `lgpd-analytics-${new Date().toISOString().split('T')[0]}.json`;
    link.click();
    
    URL.revokeObjectURL(link.href);
}

// Função para limpar dados armazenados
function clearStoredData() {
    if (confirm('Tem certeza que deseja limpar todos os dados salvos? Esta ação não pode ser desfeita.')) {
        localStorage.removeItem('lgpd_checklist_progress');
        localStorage.removeItem('lgpd_results_history');
        localStorage.removeItem('lgpd_analytics');
        localStorage.removeItem('lgpd_feedbacks');
        localStorage.removeItem('lgpd_errors');
        
        alert('Dados limpos com sucesso!');
        
        // Recarregar página
        window.location.reload();
    }
}

// Função para mostrar estatísticas de uso
function showUsageStats() {
    const analytics = JSON.parse(localStorage.getItem('lgpd_analytics') || '[]');
    const history = JSON.parse(localStorage.getItem('lgpd_results_history') || '[]');
    
    const stats = {
        totalEvents: analytics.length,
        totalEvaluations: history.length,
        averageScore: history.length > 0 ? 
            Math.round(history.reduce((sum, result) => sum + result.overallPercentage, 0) / history.length) : 0,
        lastEvaluation: history.length > 0 ? 
            new Date(history[0].date).toLocaleDateString('pt-BR') : 'Nunca',
        mostCommonPage: analytics.length > 0 ? 
            analytics.reduce((acc, event) => {
                acc[event.page] = (acc[event.page] || 0) + 1;
                return acc;
            }, {}) : {}
    };
    
    const mostVisitedPage = Object.keys(stats.mostCommonPage).reduce((a, b) => 
        stats.mostCommonPage[a] > stats.mostCommonPage[b] ? a : b, 'home');
    
    alert(`Estatísticas de Uso:
    
📊 Total de eventos: ${stats.totalEvents}
🎯 Total de avaliações: ${stats.totalEvaluations}
📈 Pontuação média: ${stats.averageScore}%
📅 Última avaliação: ${stats.lastEvaluation}
📄 Página mais visitada: ${mostVisitedPage}
    
Obrigado por usar nossa ferramenta!`);
}

// Adicionar menu de desenvolvedor (apenas em desenvolvimento)
function addDeveloperMenu() {
    // Só mostrar em localhost ou quando há parâmetro debug
    const isDev = window.location.hostname === 'localhost' || 
                  window.location.search.includes('debug=true');
    
    if (!isDev) return;
    
    const devMenu = document.createElement('div');
    devMenu.className = 'dev-menu';
    devMenu.innerHTML = `
        <button class="dev-toggle">🔧</button>
        <div class="dev-options">
            <button onclick="showUsageStats()">📊 Estatísticas</button>
            <button onclick="exportAnalyticsData()">📤 Exportar Dados</button>
            <button onclick="clearStoredData()">🗑️ Limpar Dados</button>
            <button onclick="showResultsHistory()">📜 Histórico</button>
            <button onclick="console.log('Categories:', categories)">🏷️ Ver Categorias</button>
        </div>
    `;
    
    document.body.appendChild(devMenu);
    
    // Toggle do menu
    devMenu.querySelector('.dev-toggle').addEventListener('click', function() {
        devMenu.classList.toggle('open');
    });
}

// Estilos do menu de desenvolvedor
const devMenuStyles = `
    .dev-menu {
        position: fixed;
        bottom: 100px;
        right: 20px;
        z-index: 1000;
    }
    
    .dev-toggle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background: #333;
        color: white;
        cursor: pointer;
        font-size: 1rem;
    }
    
    .dev-options {
        position: absolute;
        bottom: 50px;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.5rem;
        display: none;
        flex-direction: column;
        gap: 0.25rem;
        min-width: 150px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .dev-menu.open .dev-options {
        display: flex;
    }
    
    .dev-options button {
        padding: 0.5rem;
        border: none;
        background: none;
        cursor: pointer;
        text-align: left;
        border-radius: 4px;
        font-size: 0.8rem;
    }
    
    .dev-options button:hover {
        background: #f8f9fa;
    }
`;

// Adicionar estilos do menu de desenvolvedor
const devStyleSheet = document.createElement('style');
devStyleSheet.textContent = devMenuStyles;
document.head.appendChild(devStyleSheet);

// Função final de inicialização
function finalizeInitialization() {
    // Adicionar menu de desenvolvedor se aplicável
    addDeveloperMenu();
    
    // Track inicialização completa
    trackEvent('app_initialized', {
        timestamp: new Date().toISOString(),
        userAgent: navigator.userAgent,
        screenSize: `${window.screen.width}x${window.screen.height}`,
        viewport: `${window.innerWidth}x${window.innerHeight}`
    });
    
    // Log de inicialização
    console.log('🚀 Conformidade em Foco - LGPD Checklist inicializado com sucesso!');
    console.log('📋 Categorias carregadas:', categories.length);
    console.log('❓ Total de perguntas:', categories.reduce((sum, cat) => sum + cat.questions.length, 0));
    
    // Verificar se há progresso salvo
    const savedProgress = localStorage.getItem('lgpd_checklist_progress');
    if (savedProgress) {
        console.log('💾 Progresso anterior encontrado e carregado');
    }
}

// Executar inicialização final após DOM estar pronto
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(finalizeInitialization, 500);
});

// Exportar funções principais para uso global
window.LGPDChecklist = {
    showPage,
    calculateResults,
    printResults,
    resetChecklist: () => {
        resetChecklist();
        showPage('checklist');
    },
    exportData: exportAnalyticsData,
    clearData: clearStoredData,
    showStats: showUsageStats,
    showHistory: showResultsHistory
};

// Service Worker para cache (opcional)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('SW registrado com sucesso:', registration.scope);
            })
            .catch(function(error) {
                console.log('Falha ao registrar SW:', error);
            });
    });
}
  



