<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
</head>
<link rel="stylesheet" href="/lgpd/assets/css/teste.css">
<body>
     <!-- Home Page -->
    <div id="home" class="page active">
        <!-- Hero Section -->
        <section class="hero" id="inicio">
            <div class="container">
                <h1>Avalie sua Conformidade LGPD</h1>
                <p>Ferramenta completa para avaliar o nível de conformidade da sua organização com a Lei Geral de Proteção de Dados</p>
                
                <button class="cta-button" onclick="showPage('checklist')">
                    <i class="fas fa-play"></i> Iniciar Avaliação
                </button>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="sobre">
            <div class="container">
                <h2>Por que usar nossa ferramenta?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Avaliação Completa</h3>
                        <p>Análise detalhada de 8 categorias essenciais da LGPD com mais de 40 critérios de conformidade</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Resultado Imediato</h3>
                        <p>Obtenha seu relatório de conformidade instantaneamente com recomendações personalizadas</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Fácil de Usar</h3>
                        <p>Interface intuitiva que permite avaliação rápida sem conhecimento técnico avançado</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Preview -->
        <section class="categories-preview" id="categorias">
            <div class="container">
                <h2>Categorias Avaliadas</h2>
                <div class="categories-grid">
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-users-cog category-icon"></i>
                            <h3>Governança e Organização</h3>
                        </div>
                        <p>Estrutura organizacional e responsabilidades</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-balance-scale category-icon"></i>
                            <h3>Base Legal e Consentimento</h3>
                        </div>
                        <p>Fundamentos legais para tratamento de dados</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-user-shield category-icon"></i>
                            <h3>Direitos dos Titulares</h3>
                        </div>
                        <p>Atendimento aos direitos dos proprietários dos dados</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-shield-alt category-icon"></i>
                            <h3>Segurança Técnica</h3>
                        </div>
                        <p>Medidas de proteção e segurança da informação</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-exclamation-triangle category-icon"></i>
                            <h3>Gestão de Incidentes</h3>
                        </div>
                        <p>Preparação e resposta a vazamentos de dados</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-handshake category-icon"></i>
                            <h3>Gestão de Fornecedores</h3>
                        </div>
                        <p>Controle de terceiros que processam dados</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-graduation-cap category-icon"></i>
                            <h3>Treinamento e Conscientização</h3>
                        </div>
                        <p>Capacitação da equipe em proteção de dados</p>
                    </div>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas fa-file-alt category-icon"></i>
                            <h3>Documentação e Registros</h3>
                        </div>
                        <p>Mapeamento e documentação de processos</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <h3>40+</h3>
                        <p>Perguntas de Avaliação</p>
                    </div>
                    <div class="stat-item">
                        <h3>8</h3>
                        <p>Categorias LGPD</p>
                    </div>
                    <div class="stat-item">
                        <h3>15</h3>
                        <p>Minutos para Completar</p>
                    </div>
                    <div class="stat-item">
                        <h3>95%</h3>
                        <p>Precisão na Avaliação</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer" id="contato">
            <div class="container">
                <p>&copy; 2025 Conformidade em Foco. Todos os direitos reservados.</p>
                <p>Ferramenta desenvolvida para auxiliar na conformidade com a LGPD</p>
            </div>
        </footer>
    </div>

    <!-- Checklist Page -->
    <div id="checklist" class="page">
        <div class="checklist-container">
            <div class="container">
                <div class="checklist-header">
                    <h1><i class="fas fa-clipboard-check"></i> Checklist de Conformidade LGPD</h1>
                    <p>Responda todas as perguntas para obter sua avaliação de conformidade</p>
                </div>

                <form id="checklistForm" class="checklist-form">
                    <!-- As categorias serão inseridas aqui pelo JavaScript -->
                </form>

                <div class="submit-section">
                    <button type="button" class="submit-button" onclick="calculateResults()">
                        <i class="fas fa-calculator"></i> Calcular Resultado
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Page -->
    <div id="results" class="page">
        <div class="result-container">
            <div class="container">
                <div class="result-header">
                    <h1><i class="fas fa-chart-bar"></i> Resultado da Avaliação LGPD</h1>
                    <p id="evaluationDate"></p>
                </div>

                <div class="score-card">
                    <div id="scoreCircle" class="score-circle">
                        <span id="scorePercentage">0%</span>
                    </div>
                    <div id="scoreLevel" class="score-level">Calculando...</div>
                    <div id="scoreDescription" class="score-description">Aguarde o resultado...</div>
                </div>

                <div id="categoriesResult" class="categories-result">
                    <!-- Resultados por categoria serão inseridos aqui -->
                </div>

                <div class="action-buttons">
                    <button class="btn btn-secondary" onclick="showPage('home')">
                        <i class="fas fa-home"></i> Voltar ao Início
                    </button>
                    <button class="btn btn-primary" onclick="showPage('checklist')">
                        <i class="fas fa-redo"></i> Nova Avaliação
                    </button>
                    <button class="btn btn-success" onclick="printResults()">
                        <i class="fas fa-print"></i> Imprimir Resultado
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dados do checklist LGPD
        const CHECKLIST_DATA = {
            'governanca': {
                'titulo': 'Governança e Organização',
                'icone': 'fas fa-users-cog',
                'perguntas': [
                    'A organização possui um Encarregado de Proteção de Dados (DPO) designado?',
                    'Existe uma política de privacidade clara e acessível?',
                    'A organização possui um comitê ou equipe responsável pela proteção de dados?',
                    'Há procedimentos documentados para tratamento de dados pessoais?',
                    'A alta direção está comprometida com a conformidade LGPD?'
                ]
            },
                       'base_legal': {
                'titulo': 'Base Legal e Consentimento',
                'icone': 'fas fa-balance-scale',
                'perguntas': [
                    'A organização identifica e documenta a base legal para cada tratamento?',
                    'O consentimento é obtido de forma clara e específica quando necessário?',
                    'Existe processo para revogação de consentimento?',
                    'As finalidades do tratamento são específicas e informadas?',
                    'A organização verifica a idade dos titulares quando necessário?'
                ]
            },
            'direitos_titulares': {
                'titulo': 'Direitos dos Titulares',
                'icone': 'fas fa-user-shield',
                'perguntas': [
                    'Existe canal específico para solicitações dos titulares?',
                    'A organização atende solicitações em até 15 dias?',
                    'Há processo para confirmação de identidade do solicitante?',
                    'A organização consegue fornecer dados em formato estruturado?',
                    'Existe processo para correção e exclusão de dados?'
                ]
            },
            'seguranca_tecnica': {
                'titulo': 'Segurança e Medidas Técnicas',
                'icone': 'fas fa-shield-alt',
                'perguntas': [
                    'Os dados são criptografados em trânsito e em repouso?',
                    'Existe controle de acesso baseado em funções?',
                    'São realizados backups seguros regularmente?',
                    'Os sistemas são mantidos atualizados com patches de segurança?',
                    'Há monitoramento de atividades suspeitas?'
                ]
            },
            'gestao_incidentes': {
                'titulo': 'Gestão de Incidentes',
                'icone': 'fas fa-exclamation-triangle',
                'perguntas': [
                    'Existe plano de resposta a incidentes documentado?',
                    'A organização consegue notificar a ANPD em até 72 horas?',
                    'Há critérios definidos para comunicação aos titulares?',
                    'Incidentes são registrados e analisados?',
                    'Existe processo de lições aprendidas pós-incidente?'
                ]
            },
            'fornecedores': {
                'titulo': 'Gestão de Fornecedores',
                'icone': 'fas fa-handshake',
                'perguntas': [
                    'Contratos incluem cláusulas de proteção de dados?',
                    'É realizada due diligence de privacidade em fornecedores?',
                    'Há monitoramento da conformidade de terceiros?',
                    'Existem salvaguardas para transferências internacionais?',
                    'Fornecedores são classificados por nível de risco?'
                ]
            },
            'treinamento': {
                'titulo': 'Treinamento e Conscientização',
                'icone': 'fas fa-graduation-cap',
                'perguntas': [
                    'Existe programa de conscientização em LGPD?',
                    'Treinamentos são específicos por área/função?',
                    'Há cronograma de atualizações periódicas?',
                    'São realizados testes de conhecimento?',
                    'Novos funcionários recebem treinamento sobre LGPD?'
                ]
            },
            'documentacao': {
                'titulo': 'Documentação e Registros',
                'icone': 'fas fa-file-alt',
                'perguntas': [
                    'Existe inventário completo de dados pessoais?',
                    'Fluxos de dados estão mapeados e documentados?',
                    'É mantido registro de atividades de tratamento (Art. 37)?',
                    'São realizados relatórios de impacto quando necessário?',
                    'A documentação é mantida atualizada?'
                ]
            }
        };

        // Dicas de melhoria por categoria
        const IMPROVEMENT_TIPS = {
            'governanca': [
                'Designe um DPO qualificado e com autonomia',
                'Crie políticas claras e acessíveis aos usuários',
                'Estabeleça comitê multidisciplinar de privacidade',
                'Documente todos os procedimentos de tratamento',
                'Garanta apoio da alta direção com recursos adequados'
            ],
            'base_legal': [
                'Mapeie e documente todas as bases legais utilizadas',
                'Implemente mecanismos claros de coleta de consentimento',
                'Facilite a revogação do consentimento',
                'Seja específico sobre as finalidades do tratamento',
                'Implemente verificação de idade quando necessário'
            ],
            'direitos_titulares': [
                'Crie canal dedicado para solicitações (email, formulário)',
                'Estabeleça processo para atender em até 15 dias',
                'Implemente verificação segura de identidade',
                'Prepare sistemas para exportação de dados',
                'Documente processos de correção e exclusão'
            ],
            'seguranca_tecnica': [
                'Implemente criptografia end-to-end',
                'Configure controles de acesso baseados em função',
                'Estabeleça rotina de backups seguros',
                'Mantenha sistemas sempre atualizados',
                'Implemente monitoramento de segurança 24/7'
            ],
            'gestao_incidentes': [
                'Desenvolva plano detalhado de resposta a incidentes',
                'Estabeleça processo para notificação em 72h',
                'Defina critérios claros para comunicação aos titulares',
                'Implemente sistema de registro de incidentes',
                'Conduza análises pós-incidente regularmente'
            ],
            'fornecedores': [
                'Inclua cláusulas específicas de LGPD em contratos',
                'Realize auditoria de privacidade em fornecedores',
                'Monitore conformidade de terceiros regularmente',
                'Implemente salvaguardas para transferências internacionais',
                'Classifique fornecedores por nível de risco'
            ],
            'treinamento': [
                'Desenvolva programa abrangente de conscientização',
                'Customize treinamentos por área/função',
                'Estabeleça cronograma de atualizações regulares',
                'Implemente testes de conhecimento periódicos',
                'Inclua LGPD no onboarding de novos funcionários'
            ],
            'documentacao': [
                'Crie inventário completo de dados pessoais',
                'Mapeie todos os fluxos de dados',
                'Mantenha registro atualizado de atividades (Art. 37)',
                'Realize DPIA quando necessário',
                'Estabeleça processo de atualização da documentação'
            ]
        };

        // Variável global para armazenar respostas
        let respostas = {};

        // Função para mostrar páginas
        function showPage(pageId) {
            // Esconder todas as páginas
            const pages = document.querySelectorAll('.page');
            pages.forEach(page => page.classList.remove('active'));
            
            // Mostrar página selecionada
            document.getElementById(pageId).classList.add('active');
            
            // Se for a página do checklist, gerar o formulário
            if (pageId === 'checklist') {
                generateChecklist();
            }
            
            // Scroll para o topo
            window.scrollTo(0, 0);
        }

        // Função para gerar o checklist
        function generateChecklist() {
            const form = document.getElementById('checklistForm');
            form.innerHTML = '';
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                
                const categorySection = document.createElement('div');
                categorySection.className = 'category-section';
                
                categorySection.innerHTML = `
                    <h2 class="category-title">
                        <i class="${categoria.icone}"></i>
                        ${categoria.titulo}
                    </h2>
                    <div class="questions-container">
                        ${categoria.perguntas.map((pergunta, index) => `
                            <div class="question-item">
                                <div class="question-text">${pergunta}</div>
                                <div class="question-options">
                                    <button type="button" class="option-button sim" onclick="selectOption('${categoriaId}', ${index}, 'sim', this)">
                                        <i class="fas fa-check"></i> Sim
                                    </button>
                                    <button type="button" class="option-button parcial" onclick="selectOption('${categoriaId}', ${index}, 'parcial', this)">
                                        <i class="fas fa-minus"></i> Parcialmente
                                    </button>
                                    <button type="button" class="option-button nao" onclick="selectOption('${categoriaId}', ${index}, 'nao', this)">
                                        <i class="fas fa-times"></i> Não
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;
                
                form.appendChild(categorySection);
            });
        }

        // Função para selecionar opção
        function selectOption(categoriaId, perguntaIndex, valor, button) {
            // Remover seleção anterior
            const questionItem = button.closest('.question-item');
            const buttons = questionItem.querySelectorAll('.option-button');
            buttons.forEach(btn => btn.classList.remove('selected'));
            
            // Adicionar seleção atual
            button.classList.add('selected');
            
            // Armazenar resposta
            if (!respostas[categoriaId]) {
                respostas[categoriaId] = {};
            }
            respostas[categoriaId][perguntaIndex] = valor;
        }

        // Função para calcular resultados
        function calculateResults() {
            // Verificar se todas as perguntas foram respondidas
            let totalPerguntas = 0;
            let perguntasRespondidas = 0;
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                totalPerguntas += categoria.perguntas.length;
                
                if (respostas[categoriaId]) {
                    perguntasRespondidas += Object.keys(respostas[categoriaId]).length;
                }
            });
            
            if (perguntasRespondidas < totalPerguntas) {
                alert(`Por favor, responda todas as perguntas. Faltam ${totalPerguntas - perguntasRespondidas} respostas.`);
                return;
            }
            
            // Calcular pontuação por categoria
            const categoriasResultado = {};
            let pontuacaoTotal = 0;
            let pesoTotal = 0;
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                let pontosCategoria = 0;
                const totalCategoria = categoria.perguntas.length;
                
                categoria.perguntas.forEach((pergunta, index) => {
                    const resposta = respostas[categoriaId][index];
                    if (resposta === 'sim') {
                        pontosCategoria += 1;
                    } else if (resposta === 'parcial') {
                        pontosCategoria += 0.5;
                    }
                });
                
                const percentualCategoria = Math.round((pontosCategoria / totalCategoria * 100));
                
                categoriasResultado[categoriaId] = {
                    titulo: categoria.titulo,
                    icone: categoria.icone,
                    pontos: pontosCategoria,
                    total: totalCategoria,
                    percentual: percentualCategoria
                };
                
                pontuacaoTotal += pontosCategoria;
                pesoTotal += totalCategoria;
            });
            
            // Calcular percentual geral
            const percentualGeral = Math.round((pontuacaoTotal / pesoTotal * 100));
            
            // Determinar nível de conformidade
            let nivel, cor, icone, descricao;
            
            if (percentualGeral >= 90) {
                nivel = "Excelente";
                cor = "score-excellent";
                icone = "fas fa-check-circle";
                descricao = "Parabéns! Sua organização demonstra excelente conformidade com a LGPD.";
            } else if (percentualGeral >= 80) {
                nivel = "Muito Bom";
                cor = "score-excellent";
                icone = "fas fa-check-circle";
                descricao = "Muito bom! Sua organização está bem alinhada com os requisitos da LGPD.";
            } else if (percentualGeral >= 70) {
                nivel = "Bom";
                cor = "score-good";
                icone = "fas fa-thumbs-up";
                descricao = "Bom nível de conformidade, mas há espaço para melhorias.";
            } else if (percentualGeral >= 60) {
                nivel = "Adequado";
                cor = "score-warning";
                icone = "fas fa-exclamation-triangle";
                descricao = "Nível adequado, mas recomendamos atenção a alguns pontos importantes.";
            } else if (percentualGeral >= 40) {
                nivel = "Insuficiente";
                cor = "score-warning";
                icone = "fas fa-exclamation-triangle";
                descricao = "Nível insuficiente. É necessário implementar melhorias significativas.";
            } else {
                nivel = "Crítico";
                cor = "score-danger";
                icone = "fas fa-times-circle";
                descricao = "Situação crítica. Ação imediata é necessária para conformidade com a LGPD.";
            }
            
            // Exibir resultados
            displayResults({
                pontuacaoTotal,
                pesoTotal,
                percentualGeral,
                nivel,
                cor,
                icone,
                descricao,
                categorias: categoriasResultado
            });
            
            // Mostrar página de resultados
            showPage('results');
        }

        // Função para exibir resultados
        function displayResults(resultado) {
            // Atualizar data da avaliação
            const now = new Date();
            const dataFormatada = now.toLocaleDateString('pt-BR') + ' às ' + now.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
            document.getElementById('evaluationDate').textContent = `Avaliação realizada em: ${dataFormatada}`;
            
            // Atualizar score principal
            const scoreCircle = document.getElementById('scoreCircle');
            const scorePercentage = document.getElementById('scorePercentage');
            const scoreLevel = document.getElementById('scoreLevel');
            const scoreDescription = document.getElementById('scoreDescription');
                        
            scoreCircle.className = `score-circle ${resultado.cor}`;
            scorePercentage.textContent = `${resultado.percentualGeral}%`;
            scoreLevel.innerHTML = `<i class="${resultado.icone}"></i> ${resultado.nivel}`;
            scoreDescription.textContent = resultado.descricao;
            
            // Atualizar resultados por categoria
            const categoriesResult = document.getElementById('categoriesResult');
            categoriesResult.innerHTML = '';
            
            Object.keys(resultado.categorias).forEach(categoriaId => {
                const categoria = resultado.categorias[categoriaId];
                
                const categoryCard = document.createElement('div');
                categoryCard.className = 'category-result-card';
                
                // Determinar se precisa de dicas de melhoria (menos de 80%)
                const needsImprovement = categoria.percentual < 80;
                const improvementTipsHtml = needsImprovement ? `
                    <div class="improvement-tips">
                        <h4><i class="fas fa-lightbulb"></i> Dicas de Melhoria</h4>
                        <ul>
                            ${IMPROVEMENT_TIPS[categoriaId].slice(0, 3).map(tip => `<li>${tip}</li>`).join('')}
                        </ul>
                    </div>
                ` : '';
                
                categoryCard.innerHTML = `
                    <div class="category-result-header">
                        <i class="${categoria.icone}"></i>
                        <h3>${categoria.titulo}</h3>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${categoria.percentual}%"></div>
                    </div>
                    <div class="category-score">
                        <span>${categoria.percentual}%</span>
                        <span>${categoria.pontos} / ${categoria.total} pontos</span>
                    </div>
                    ${improvementTipsHtml}
                `;
                
                categoriesResult.appendChild(categoryCard);
            });
            
            // Animar barras de progresso
            setTimeout(() => {
                const progressBars = document.querySelectorAll('.progress-fill');
                progressBars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                });
            }, 100);
        }

        // Função para imprimir resultados
        function printResults() {
            window.print();
        }

        // Função para resetar avaliação
        function resetEvaluation() {
            respostas = {};
            const buttons = document.querySelectorAll('.option-button');
            buttons.forEach(btn => btn.classList.remove('selected'));
        }

        // Função para salvar progresso
        function saveProgress() {
            try {
                localStorage.setItem('lgpd_checklist_progress', JSON.stringify(respostas));
                localStorage.setItem('lgpd_checklist_timestamp', new Date().toISOString());
                
                // Mostrar feedback visual
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> Salvo!';
                button.style.background = '#28a745';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.background = '';
                }, 2000);
                
            } catch (error) {
                alert('Erro ao salvar progresso. Verifique se o navegador permite armazenamento local.');
            }
        }

        // Função para carregar progresso
        function loadProgress() {
            try {
                const savedProgress = localStorage.getItem('lgpd_checklist_progress');
                const timestamp = localStorage.getItem('lgpd_checklist_timestamp');
                
                if (savedProgress) {
                    respostas = JSON.parse(savedProgress);
                    
                    // Mostrar informação sobre quando foi salvo
                    if (timestamp) {
                        const saveDate = new Date(timestamp);
                        const dateStr = saveDate.toLocaleDateString('pt-BR') + ' às ' + saveDate.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
                        alert(`Progresso carregado com sucesso!\nÚltimo salvamento: ${dateStr}`);
                    } else {
                        alert('Progresso carregado com sucesso!');
                    }
                    
                    // Recriar seleções visuais se estivermos na página do checklist
                    if (document.getElementById('checklist').classList.contains('active')) {
                        restoreVisualSelections();
                    }
                } else {
                    alert('Nenhum progresso salvo encontrado.');
                }
            } catch (error) {
                alert('Erro ao carregar progresso.');
            }
        }

        // Função para restaurar seleções visuais
        function restoreVisualSelections() {
            Object.keys(respostas).forEach(categoriaId => {
                Object.keys(respostas[categoriaId]).forEach(perguntaIndex => {
                    const valor = respostas[categoriaId][perguntaIndex];
                    
                    // Encontrar o botão correspondente
                    const categorySection = document.querySelector(`[data-category="${categoriaId}"]`);
                    if (categorySection) {
                        const questionItems = categorySection.querySelectorAll('.question-item');
                        const questionItem = questionItems[parseInt(perguntaIndex)];
                        if (questionItem) {
                            const buttons = questionItem.querySelectorAll('.option-button');
                            buttons.forEach(btn => btn.classList.remove('selected'));
                            
                            const targetButton = questionItem.querySelector(`.option-button.${valor}`);
                            if (targetButton) {
                                targetButton.classList.add('selected');
                            }
                        }
                    }
                });
            });
        }

        // Função para exportar resultados (implementação básica)
        function exportResults() {
            if (!document.getElementById('results').classList.contains('active')) {
                alert('Execute uma avaliação primeiro para exportar os resultados.');
                return;
            }
            
            // Criar conteúdo para exportação
            const now = new Date();
            const dataFormatada = now.toLocaleDateString('pt-BR') + ' às ' + now.toLocaleTimeString('pt-BR');
            
            let exportContent = `RELATÓRIO DE CONFORMIDADE LGPD\n`;
            exportContent += `Data da Avaliação: ${dataFormatada}\n`;
            exportContent += `Organização: [Nome da Organização]\n\n`;
            
            // Adicionar score geral
            const scorePercentage = document.getElementById('scorePercentage').textContent;
            const scoreLevel = document.getElementById('scoreLevel').textContent;
            const scoreDescription = document.getElementById('scoreDescription').textContent;
            
            exportContent += `RESULTADO GERAL\n`;
            exportContent += `Pontuação: ${scorePercentage}\n`;
            exportContent += `Nível: ${scoreLevel}\n`;
            exportContent += `Descrição: ${scoreDescription}\n\n`;
            
            exportContent += `RESULTADOS POR CATEGORIA\n`;
            exportContent += `${'='.repeat(50)}\n`;
            
            // Adicionar resultados por categoria
            const categoryCards = document.querySelectorAll('.category-result-card');
            categoryCards.forEach(card => {
                const title = card.querySelector('h3').textContent;
                const score = card.querySelector('.category-score span').textContent;
                const points = card.querySelector('.category-score span:last-child').textContent;
                
                exportContent += `\n${title}\n`;
                exportContent += `Pontuação: ${score}\n`;
                exportContent += `Pontos: ${points}\n`;
                
                // Adicionar dicas se existirem
                const tips = card.querySelector('.improvement-tips');
                if (tips) {
                    exportContent += `Dicas de Melhoria:\n`;
                    const tipsList = tips.querySelectorAll('li');
                    tipsList.forEach(tip => {
                        exportContent += `- ${tip.textContent}\n`;
                    });
                }
                exportContent += `${'-'.repeat(30)}\n`;
            });
            
            // Criar e baixar arquivo
            const blob = new Blob([exportContent], { type: 'text/plain;charset=utf-8' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `relatorio-lgpd-${now.getFullYear()}-${(now.getMonth()+1).toString().padStart(2,'0')}-${now.getDate().toString().padStart(2,'0')}.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        // Função para adicionar botões de ação no checklist
        function addChecklistActions() {
            const submitSection = document.querySelector('.submit-section');
            if (submitSection && !submitSection.querySelector('.progress-actions')) {
                const actionsDiv = document.createElement('div');
                actionsDiv.className = 'progress-actions';
                actionsDiv.style.marginTop = '2rem';
                actionsDiv.innerHTML = `
                    <button type="button" class="btn btn-secondary" onclick="saveProgress()" style="margin-right: 1rem;">
                        <i class="fas fa-save"></i> Salvar Progresso
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="loadProgress()">
                        <i class="fas fa-upload"></i> Carregar Progresso
                    </button>
                `;
                submitSection.appendChild(actionsDiv);
            }
        }

        // Função para adicionar botão de exportação nos resultados
        function addExportButton() {
            const actionButtons = document.querySelector('#results .action-buttons');
            if (actionButtons && !actionButtons.querySelector('.btn-export')) {
                const exportButton = document.createElement('button');
                exportButton.className = 'btn btn-success btn-export';
                exportButton.onclick = exportResults;
                exportButton.innerHTML = '<i class="fas fa-download"></i> Exportar Relatório';
                actionButtons.insertBefore(exportButton, actionButtons.lastElementChild);
            }
        }

        // Atualizar a função generateChecklist para incluir data attributes
        function generateChecklistUpdated() {
            const form = document.getElementById('checklistForm');
            form.innerHTML = '';
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                
                const categorySection = document.createElement('div');
                categorySection.className = 'category-section';
                categorySection.setAttribute('data-category', categoriaId);
                
                categorySection.innerHTML = `
                    <h2 class="category-title">
                        <i class="${categoria.icone}"></i>
                        ${categoria.titulo}
                    </h2>
                    <div class="questions-container">
                        ${categoria.perguntas.map((pergunta, index) => `
                            <div class="question-item">
                                <div class="question-text">${pergunta}</div>
                                <div class="question-options">
                                    <button type="button" class="option-button sim" onclick="selectOption('${categoriaId}', ${index}, 'sim', this)">
                                        <i class="fas fa-check"></i> Sim
                                    </button>
                                    <button type="button" class="option-button parcial" onclick="selectOption('${categoriaId}', ${index}, 'parcial', this)">
                                        <i class="fas fa-minus"></i> Parcialmente
                                    </button>
                                    <button type="button" class="option-button nao" onclick="selectOption('${categoriaId}', ${index}, 'nao', this)">
                                        <i class="fas fa-times"></i> Não
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;
                
                form.appendChild(categorySection);
            });
            
            // Adicionar botões de ação
            addChecklistActions();
        }

        // Substituir a função generateChecklist original
        function generateChecklist() {
            generateChecklistUpdated();
        }

        // Atualizar a função displayResults para incluir botão de exportação
        function displayResultsUpdated(resultado) {
            // Código existente da função displayResults...
            displayResults(resultado);
            
            // Adicionar botão de exportação
            setTimeout(() => {
                addExportButton();
            }, 100);
        }

        // Inicializar aplicação
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar página inicial
            showPage('home');
            
            // Adicionar event listeners para navegação suave
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Verificar se há progresso salvo ao carregar a página
            const savedProgress = localStorage.getItem('lgpd_checklist_progress');
            if (savedProgress) {
                // Mostrar notificação discreta sobre progresso salvo
                setTimeout(() => {
                    const notification = document.createElement('div');
                    notification.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: #17a2b8;
                        color: white;
                        padding: 1rem;
                        border-radius: 8px;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                        z-index: 1000;
                        font-size: 0.9rem;
                        max-width: 300px;
                        cursor: pointer;
                    `;
                    notification.innerHTML = `
                        <i class="fas fa-info-circle"></i> 
                        Progresso salvo encontrado. 
                        <br><small>Clique para carregar ou ignore esta mensagem.</small>
                    `;
                    notification.onclick = () => {
                        loadProgress();
                        document.body.removeChild(notification);
                    };
                    
                    document.body.appendChild(notification);
                    
                    // Remover automaticamente após 10 segundos
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            notification.style.opacity = '0';
                            setTimeout(() => {
                                if (document.body.contains(notification)) {
                                    document.body.removeChild(notification);
                                }
                            }, 300);
                        }
                    }, 10000);
                }, 2000);
            }
        });

        // Adicionar atalhos de teclado
                document.addEventListener('keydown', function(e) {
            // Ctrl + S para salvar progresso
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                if (document.getElementById('checklist').classList.contains('active')) {
                    saveProgress();
                }
            }
            
            // Ctrl + L para carregar progresso
            if (e.ctrlKey && e.key === 'l') {
                e.preventDefault();
                if (document.getElementById('checklist').classList.contains('active')) {
                    loadProgress();
                }
            }
            
            // Ctrl + P para imprimir resultados
            if (e.ctrlKey && e.key === 'p') {
                if (document.getElementById('results').classList.contains('active')) {
                    e.preventDefault();
                    printResults();
                }
            }
            
            // Ctrl + E para exportar resultados
            if (e.ctrlKey && e.key === 'e') {
                e.preventDefault();
                if (document.getElementById('results').classList.contains('active')) {
                    exportResults();
                }
            }
            
            // Escape para voltar à página inicial
            if (e.key === 'Escape') {
                showPage('home');
            }
        });

        // Função para validar progresso antes de sair da página
        window.addEventListener('beforeunload', function(e) {
            if (document.getElementById('checklist').classList.contains('active')) {
                const totalPerguntas = Object.keys(CHECKLIST_DATA).reduce((total, categoriaId) => {
                    return total + CHECKLIST_DATA[categoriaId].perguntas.length;
                }, 0);
                
                const perguntasRespondidas = Object.keys(respostas).reduce((total, categoriaId) => {
                    return total + (respostas[categoriaId] ? Object.keys(respostas[categoriaId]).length : 0);
                }, 0);
                
                if (perguntasRespondidas > 0 && perguntasRespondidas < totalPerguntas) {
                    const message = 'Você tem respostas não salvas. Deseja realmente sair?';
                    e.returnValue = message;
                    return message;
                }
            }
        });

        // Função para mostrar estatísticas em tempo real
        function updateProgressStats() {
            if (!document.getElementById('checklist').classList.contains('active')) return;
            
            const totalPerguntas = Object.keys(CHECKLIST_DATA).reduce((total, categoriaId) => {
                return total + CHECKLIST_DATA[categoriaId].perguntas.length;
            }, 0);
            
            const perguntasRespondidas = Object.keys(respostas).reduce((total, categoriaId) => {
                return total + (respostas[categoriaId] ? Object.keys(respostas[categoriaId]).length : 0);
            }, 0);
            
            const percentualCompleto = Math.round((perguntasRespondidas / totalPerguntas) * 100);
            
            // Atualizar ou criar barra de progresso
            let progressBar = document.querySelector('.checklist-progress');
            if (!progressBar) {
                progressBar = document.createElement('div');
                progressBar.className = 'checklist-progress';
                progressBar.style.cssText = `
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    background: white;
                    padding: 1rem;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                    z-index: 1000;
                    min-width: 200px;
                    border-left: 4px solid #667eea;
                `;
                document.body.appendChild(progressBar);
            }
            
            progressBar.innerHTML = `
                <div style="font-weight: 600; margin-bottom: 0.5rem; color: #333;">
                    <i class="fas fa-tasks"></i> Progresso da Avaliação
                </div>
                <div style="background: #e9ecef; height: 8px; border-radius: 4px; overflow: hidden; margin-bottom: 0.5rem;">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 100%; width: ${percentualCompleto}%; transition: width 0.3s ease;"></div>
                </div>
                <div style="font-size: 0.9rem; color: #666;">
                    ${perguntasRespondidas} de ${totalPerguntas} perguntas respondidas (${percentualCompleto}%)
                </div>
            `;
            
            // Remover barra se não estivermos na página do checklist
            if (!document.getElementById('checklist').classList.contains('active')) {
                if (document.body.contains(progressBar)) {
                    document.body.removeChild(progressBar);
                }
            }
        }

        // Atualizar a função selectOption para incluir estatísticas
        function selectOptionUpdated(categoriaId, perguntaIndex, valor, button) {
            // Código original da função
            const questionItem = button.closest('.question-item');
            const buttons = questionItem.querySelectorAll('.option-button');
            buttons.forEach(btn => btn.classList.remove('selected'));
            
            button.classList.add('selected');
            
            if (!respostas[categoriaId]) {
                respostas[categoriaId] = {};
            }
            respostas[categoriaId][perguntaIndex] = valor;
            
            // Atualizar estatísticas
            updateProgressStats();
            
            // Feedback visual
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = '';
            }, 150);
        }

        // Substituir função original
        function selectOption(categoriaId, perguntaIndex, valor, button) {
            selectOptionUpdated(categoriaId, perguntaIndex, valor, button);
        }

        // Atualizar função showPage para gerenciar barra de progresso
        function showPageUpdated(pageId) {
            const pages = document.querySelectorAll('.page');
            pages.forEach(page => page.classList.remove('active'));
            
            document.getElementById(pageId).classList.add('active');
            
            if (pageId === 'checklist') {
                generateChecklist();
                setTimeout(updateProgressStats, 100);
            } else {
                // Remover barra de progresso se não estivermos no checklist
                const progressBar = document.querySelector('.checklist-progress');
                if (progressBar && document.body.contains(progressBar)) {
                    document.body.removeChild(progressBar);
                }
            }
            
            if (pageId === 'results') {
                setTimeout(() => {
                    addExportButton();
                }, 100);
            }
            
            window.scrollTo(0, 0);
        }

        // Substituir função original
        function showPage(pageId) {
            showPageUpdated(pageId);
        }

        // Função para gerar relatório detalhado
        function generateDetailedReport() {
            if (!document.getElementById('results').classList.contains('active')) {
                alert('Execute uma avaliação primeiro para gerar o relatório detalhado.');
                return;
            }
            
            const now = new Date();
            const dataFormatada = now.toLocaleDateString('pt-BR');
            const horaFormatada = now.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
            
            // Calcular estatísticas detalhadas
            let totalSim = 0, totalParcial = 0, totalNao = 0;
            const detalhesCategoria = {};
            
            Object.keys(respostas).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                let simCategoria = 0, parcialCategoria = 0, naoCategoria = 0;
                
                Object.keys(respostas[categoriaId]).forEach(perguntaIndex => {
                    const resposta = respostas[categoriaId][perguntaIndex];
                    if (resposta === 'sim') {
                        simCategoria++;
                        totalSim++;
                    } else if (resposta === 'parcial') {
                        parcialCategoria++;
                        totalParcial++;
                    } else {
                        naoCategoria++;
                        totalNao++;
                    }
                });
                
                detalhesCategoria[categoriaId] = {
                    titulo: categoria.titulo,
                    sim: simCategoria,
                    parcial: parcialCategoria,
                    nao: naoCategoria,
                    total: categoria.perguntas.length
                };
            });
            
            // Gerar HTML do relatório
            const reportHtml = `
                <!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Relatório Detalhado LGPD - ${dataFormatada}</title>
                    <style>
                        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 0 auto; padding: 20px; }
                        .header { text-align: center; border-bottom: 3px solid #667eea; padding-bottom: 20px; margin-bottom: 30px; }
                        .score-summary { background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 30px; text-align: center; }
                        .category-detail { margin-bottom: 25px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
                        .category-header { background: #667eea; color: white; padding: 15px; font-weight: bold; }
                        .category-content { padding: 15px; }
                        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin: 15px 0; }
                        .stat-item { text-align: center; padding: 10px; background: #f8f9fa; border-radius: 5px; }
                        .recommendations { background: #e8f4f8; padding: 15px; border-radius: 5px; margin-top: 15px; }
                        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; }
                        @media print { body { margin: 0; padding: 15px; } }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>🛡️ Relatório de Conformidade LGPD</h1>
                        <p><strong>Data da Avaliação:</strong> ${dataFormatada} às ${horaFormatada}</p>
                        <p><strong>Organização:</strong> [Nome da Organização]</p>
                    </div>
                    
                    <div class="score-summary">
                        <h2>Resumo Geral</h2>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <strong>${totalSim}</strong><br>
                                <small>Conformes</small>
                            </div>
                            <div class="stat-item">
                                <strong>${totalParcial}</strong><br>
                                <small>Parciais</small>
                            </div>
                            <div class="stat-item">
                                <strong>${totalNao}</strong><br>
                                <small>Não Conformes</small>
                            </div>
                        </div>
                        <p><strong>Pontuação Geral:</strong> ${document.getElementById('scorePercentage').textContent}</p>
                        <p><strong>Nível:</strong> ${document.getElementById('scoreLevel').textContent.replace(/.*\s/, '')}</p>
                    </div>
                    
                    ${Object.keys(detalhesCategoria).map(categoriaId => {
                        const cat = detalhesCategoria[categoriaId];
                        const percentual = Math.round(((cat.sim + cat.parcial * 0.5) / cat.total) * 100);
                        return `
                            <div class="category-detail">
                                <div class="category-header">${cat.titulo}</div>
                                <div class="category-content">
                                    <div class="stats-grid">
                                        <div class="stat-item">
                                            <strong>${cat.sim}</strong><br>
                                            <small>Sim</small>
                                        </div>
                                        <div class="stat-item">
                                            <strong>${cat.parcial}</strong><br>
                                            <small>Parcial</small>
                                        </div>
                                        <div class="stat-item">
                                            <strong>${cat.nao}</strong><br>
                                            <small>Não</small>
                                        </div>
                                    </div>
                                    <p><strong>Conformidade:</strong> ${percentual}%</p>
                                    ${percentual < 80 ? `
                                        <div class="recommendations">
                                            <strong>💡 Recomendações:</strong>
                                            <ul>
                                                ${IMPROVEMENT_TIPS[categoriaId].slice(0, 3).map(tip => `<li>${tip}</li>`).join('')}
                                            </ul>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                    }).join('')}
                    
                    <div class="footer">
                        <p>Relatório gerado por <strong>Conformidade em Foco</strong></p>
                        <p><small>Este relatório é uma ferramenta de autoavaliação e não substitui consultoria jurídica especializada.</small></p>
                    </div>
                </body>
                </html>
            `;
            
            // Abrir relatório em nova janela
            const reportWindow = window.open('', '_blank');
            reportWindow.document.write(reportHtml);
            reportWindow.document.close();
        }

        // Adicionar botão de relatório detalhado
        function addDetailedReportButton() {
            const actionButtons = document.querySelector('#results .action-buttons');
            if (actionButtons && !actionButtons.querySelector('.btn-detailed-report')) {
                const detailedReportButton = document.createElement('button');
                detailedReportButton.className = 'btn btn-primary btn-detailed-report';
                detailedReportButton.onclick = generateDetailedReport;
                detailedReportButton.innerHTML = '<i class="fas fa-file-alt"></i> Relatório Detalhado';
                actionButtons.appendChild(detailedReportButton);
            }
        }

        // Atualizar função para adicionar todos os botões nos resultados
        function addAllResultButtons() {
            addExportButton();
            addDetailedReportButton();
        }

        // Função final para calcular e exibir resultados
                // Função final para calcular e exibir resultados
        function calculateAndDisplayResults() {
            // Verificar se todas as perguntas foram respondidas
            let totalPerguntas = 0;
            let perguntasRespondidas = 0;
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                totalPerguntas += categoria.perguntas.length;
                
                if (respostas[categoriaId]) {
                    perguntasRespondidas += Object.keys(respostas[categoriaId]).length;
                }
            });
            
            if (perguntasRespondidas < totalPerguntas) {
                // Mostrar modal personalizado em vez de alert
                showCustomAlert(`Por favor, responda todas as perguntas. Faltam ${totalPerguntas - perguntasRespondidas} respostas.`, 'warning');
                return;
            }
            
            // Calcular pontuação por categoria
            const categoriasResultado = {};
            let pontuacaoTotal = 0;
            let pesoTotal = 0;
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                let pontosCategoria = 0;
                const totalCategoria = categoria.perguntas.length;
                
                categoria.perguntas.forEach((pergunta, index) => {
                    const resposta = respostas[categoriaId][index];
                    if (resposta === 'sim') {
                        pontosCategoria += 1;
                    } else if (resposta === 'parcial') {
                        pontosCategoria += 0.5;
                    }
                });
                
                const percentualCategoria = Math.round((pontosCategoria / totalCategoria * 100));
                
                categoriasResultado[categoriaId] = {
                    titulo: categoria.titulo,
                    icone: categoria.icone,
                    pontos: pontosCategoria,
                    total: totalCategoria,
                    percentual: percentualCategoria
                };
                
                pontuacaoTotal += pontosCategoria;
                pesoTotal += totalCategoria;
            });
            
            // Calcular percentual geral
            const percentualGeral = Math.round((pontuacaoTotal / pesoTotal * 100));
            
            // Determinar nível de conformidade
            let nivel, cor, icone, descricao;
            
            if (percentualGeral >= 90) {
                nivel = "Excelente";
                cor = "score-excellent";
                icone = "fas fa-check-circle";
                descricao = "Parabéns! Sua organização demonstra excelente conformidade com a LGPD.";
            } else if (percentualGeral >= 80) {
                nivel = "Muito Bom";
                cor = "score-excellent";
                icone = "fas fa-check-circle";
                descricao = "Muito bom! Sua organização está bem alinhada com os requisitos da LGPD.";
            } else if (percentualGeral >= 70) {
                nivel = "Bom";
                cor = "score-good";
                icone = "fas fa-thumbs-up";
                descricao = "Bom nível de conformidade, mas há espaço para melhorias.";
            } else if (percentualGeral >= 60) {
                nivel = "Adequado";
                cor = "score-warning";
                icone = "fas fa-exclamation-triangle";
                descricao = "Nível adequado, mas recomendamos atenção a alguns pontos importantes.";
            } else if (percentualGeral >= 40) {
                nivel = "Insuficiente";
                cor = "score-warning";
                icone = "fas fa-exclamation-triangle";
                descricao = "Nível insuficiente. É necessário implementar melhorias significativas.";
            } else {
                nivel = "Crítico";
                cor = "score-danger";
                icone = "fas fa-times-circle";
                descricao = "Situação crítica. Ação imediata é necessária para conformidade com a LGPD.";
            }
            
            // Exibir resultados
            displayResults({
                pontuacaoTotal,
                pesoTotal,
                percentualGeral,
                nivel,
                cor,
                icone,
                descricao,
                categorias: categoriasResultado
            });
            
            // Mostrar página de resultados
            showPage('results');
            
            // Adicionar todos os botões após um pequeno delay
            setTimeout(() => {
                addAllResultButtons();
            }, 200);
        }

        // Função para mostrar alertas customizados
        function showCustomAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 10000;
                max-width: 400px;
                text-align: center;
                border-left: 5px solid ${type === 'warning' ? '#ffc107' : '#17a2b8'};
            `;
            
            const iconClass = type === 'warning' ? 'fas fa-exclamation-triangle' : 'fas fa-info-circle';
            const iconColor = type === 'warning' ? '#ffc107' : '#17a2b8';
            
            alertDiv.innerHTML = `
                <div style="color: ${iconColor}; font-size: 3rem; margin-bottom: 1rem;">
                    <i class="${iconClass}"></i>
                </div>
                <p style="margin-bottom: 1.5rem; font-size: 1.1rem; color: #333;">${message}</p>
                <button onclick="this.parentElement.remove()" style="
                    background: ${iconColor};
                    color: white;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: 25px;
                    cursor: pointer;
                    font-weight: 600;
                    transition: all 0.3s ease;
                " onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                    Entendi
                </button>
            `;
            
            // Criar overlay
            const overlay = document.createElement('div');
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 9999;
            `;
            overlay.onclick = () => {
                document.body.removeChild(overlay);
                document.body.removeChild(alertDiv);
            };
            
            document.body.appendChild(overlay);
            document.body.appendChild(alertDiv);
            
            // Remover automaticamente após 10 segundos
            setTimeout(() => {
                if (document.body.contains(alertDiv)) {
                    document.body.removeChild(overlay);
                    document.body.removeChild(alertDiv);
                }
            }, 10000);
        }

        // Substituir a função calculateResults original
        function calculateResults() {
            calculateAndDisplayResults();
        }

        // Função para adicionar tooltips informativos
        function addTooltips() {
            const questionTexts = document.querySelectorAll('.question-text');
            questionTexts.forEach((questionText, index) => {
                questionText.style.position = 'relative';
                questionText.style.cursor = 'help';
                
                questionText.addEventListener('mouseenter', function(e) {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    tooltip.style.cssText = `
                        position: absolute;
                        bottom: 100%;
                        left: 0;
                        background: #333;
                        color: white;
                        padding: 0.5rem;
                        border-radius: 5px;
                        font-size: 0.8rem;
                        white-space: nowrap;
                        z-index: 1000;
                        opacity: 0;
                        transition: opacity 0.3s ease;
                    `;
                    tooltip.textContent = 'Clique em uma das opções para responder';
                    
                    this.appendChild(tooltip);
                    setTimeout(() => tooltip.style.opacity = '1', 10);
                });
                
                questionText.addEventListener('mouseleave', function() {
                    const tooltip = this.querySelector('.tooltip');
                    if (tooltip) {
                        tooltip.style.opacity = '0';
                        setTimeout(() => {
                            if (this.contains(tooltip)) {
                                this.removeChild(tooltip);
                            }
                        }, 300);
                    }
                });
            });
        }

        // Função para adicionar animações suaves
        function addSmoothAnimations() {
            // Animar entrada das seções de categoria
            const categorySection = document.querySelectorAll('.category-section');
            categorySection.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }

        // Atualizar função generateChecklist para incluir melhorias
        function generateChecklistEnhanced() {
            const form = document.getElementById('checklistForm');
            form.innerHTML = '';
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                
                const categorySection = document.createElement('div');
                categorySection.className = 'category-section';
                categorySection.setAttribute('data-category', categoriaId);
                
                categorySection.innerHTML = `
                    <h2 class="category-title">
                        <i class="${categoria.icone}"></i>
                        ${categoria.titulo}
                    </h2>
                    <div class="questions-container">
                        ${categoria.perguntas.map((pergunta, index) => `
                            <div class="question-item">
                                <div class="question-text">${pergunta}</div>
                                <div class="question-options">
                                    <button type="button" class="option-button sim" onclick="selectOption('${categoriaId}', ${index}, 'sim', this)">
                                        <i class="fas fa-check"></i> Sim
                                    </button>
                                    <button type="button" class="option-button parcial" onclick="selectOption('${categoriaId}', ${index}, 'parcial', this)">
                                        <i class="fas fa-minus"></i> Parcialmente
                                    </button>
                                    <button type="button" class="option-button nao" onclick="selectOption('${categoriaId}', ${index}, 'nao', this)">
                                        <i class="fas fa-times"></i> Não
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;
                
                form.appendChild(categorySection);
            });
            
            // Adicionar botões de ação
            addChecklistActions();
            
            // Adicionar melhorias visuais
            setTimeout(() => {
                addTooltips();
                addSmoothAnimations();
                updateProgressStats();
            }, 100);
        }

        // Substituir função generateChecklist
        function generateChecklist() {
            generateChecklistEnhanced();
        }

        // Função para scroll suave até pergunta não respondida
        function scrollToFirstUnanswered() {
            const unansweredQuestions = [];
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                categoria.perguntas.forEach((pergunta, index) => {
                    if (!respostas[categoriaId] || !respostas[categoriaId][index]) {
                        const categorySection = document.querySelector(`[data-category="${categoriaId}"]`);
                        if (categorySection) {
                            const questionItems = categorySection.querySelectorAll('.question-item');
                            const questionItem = questionItems[index];
                            if (questionItem) {
                                unansweredQuestions.push(questionItem);
                            }
                        }
                    }
                });
            });
            
            if (unansweredQuestions.length > 0) {
                unansweredQuestions[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                
                // Destacar pergunta não respondida
                unansweredQuestions[0].style.background = '#fff3cd';
                unansweredQuestions[0].style.border = '2px solid #ffc107';
                unansweredQuestions[0].style.borderRadius = '8px';
                unansweredQuestions[0].style.padding = '1rem';
                
                setTimeout(() => {
                    unansweredQuestions[0].style.background = '';
                    unansweredQuestions[0].style.border = '';
                    unansweredQuestions[0].style.borderRadius = '';
                    unansweredQuestions[0].style.padding = '';
                }, 3000);
            }
        }

        // Atualizar função calculateResults para incluir scroll
        function calculateResultsWithScroll() {
            // Verificar se todas as perguntas foram respondidas
            let totalPerguntas = 0;
            let perguntasRespondidas = 0;
            
            Object.keys(CHECKLIST_DATA).forEach(categoriaId => {
                const categoria = CHECKLIST_DATA[categoriaId];
                totalPerguntas += categoria.perguntas.length;
                
                if (respostas[categoriaId]) {
                    perguntasRespondidas += Object.keys(respostas[categoriaId]).length;
                }
            });
            
            if (perguntasRespondidas < totalPerguntas) {
                showCustomAlert(`Por favor, responda todas as perguntas. Faltam ${totalPerguntas - perguntasRespondidas} respostas.`, 'warning');
                setTimeout(scrollToFirstUnanswered, 1000);
                return;
            }
            
            // Continuar com o cálculo normal
            calculateAndDisplayResults();
        }

        // Substituir função calculateResults final
        function calculateResults() {
            calculateResultsWithScroll();
        }

    </script>
</body>
</html>

<?php include('includes/footer.php'); ?>