<?php

// Função para redirecionar com segurança
function redirectToIndex() {
    header('Location: index.php');
    exit;
}

// Função para formatar valores monetários
function formatMoney($value) {
    return 'R$ ' . number_format($value, 2, ',', '.');
}

// Função para verificar se o usuário é VIP
function isVipCustomer($idade, $valor_cavalo) {
    return ($idade >= 18 && $valor_cavalo > 30000.00);
}

// Início do conteúdo principal
echo '<div style="padding: 20px 0;">';

// ============================================
// PROCESSAMENTO DE REQUISIÇÕES GET
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['txt_busca'])) {
    
    $termo_busca = trim($_GET['txt_busca']);
    
    // Verifica se o termo de busca está vazio
    if (empty($termo_busca)) {
        echo '<div class="error">';
        echo '   <strong>⚠️ Erro:</strong> O campo de busca não pode estar vazio.';
        echo '   <br><a href="index.php" class="btn-back" style="margin-top:10px;">Voltar para o Início</a>';
        echo '</div>';
        redirectToIndex(); // Redireciona após exibir mensagem
    }
    
    // Busca simulada no plantel (dados mock)
    $plantel = [
        ['nome' => 'Trovão Negro', 'raca' => 'Quarto de Milha', 'idade' => 5, 'valor' => 45000.00],
        ['nome' => 'Estrela Dourada', 'raca' => 'Puro Sangue Inglês', 'idade' => 4, 'valor' => 68000.00],
        ['nome' => 'Vento Forte', 'raca' => 'Árabe', 'idade' => 6, 'valor' => 52000.00],
        ['nome' => 'Lua Cheia', 'raca' => 'Quarto de Milha', 'idade' => 3, 'valor' => 38000.00],
        ['nome' => 'Raio de Sol', 'raca' => 'Puro Sangue Inglês', 'idade' => 7, 'valor' => 72000.00],
        ['nome' => 'Sombra Negra', 'raca' => 'Frisian', 'idade' => 4, 'valor' => 55000.00],
        ['nome' => 'Céu Azul', 'raca' => 'Árabe', 'idade' => 2, 'valor' => 25000.00],
    ];
    
    // Filtra os cavalos que correspondem à busca
    $resultados = array_filter($plantel, function($cavalo) use ($termo_busca) {
        return stripos($cavalo['nome'], $termo_busca) !== false || 
               stripos($cavalo['raca'], $termo_busca) !== false;
    });
    
    // Exibe os resultados
    echo '<div class="result-box">';
    echo '   <h2>🔍 Resultados da Busca</h2>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Termo pesquisado:</span>';
    echo '       <span class="value">"' . htmlspecialchars($termo_busca) . '"</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Total de resultados:</span>';
    echo '       <span class="value">' . count($resultados) . ' cavalo(s)</span>';
    echo '   </div>';
    
    if (count($resultados) > 0) {
        echo '<div style="margin-top: 20px;">';
        echo '   <table style="width: 100%; border-collapse: collapse;">';
        echo '       <thead>';
        echo '           <tr style="background: #667eea; color: white;">';
        echo '               <th style="padding: 10px; text-align: left;">Nome</th>';
        echo '               <th style="padding: 10px; text-align: left;">Raça</th>';
        echo '               <th style="padding: 10px; text-align: left;">Idade</th>';
        echo '               <th style="padding: 10px; text-align: left;">Valor</th>';
        echo '           </tr>';
        echo '       </thead>';
        echo '       <tbody>';
        
        foreach ($resultados as $cavalo) {
            echo '       <tr style="border-bottom: 1px solid #e2e8f0;">';
            echo '           <td style="padding: 10px;">' . htmlspecialchars($cavalo['nome']) . '</td>';
            echo '           <td style="padding: 10px;">' . htmlspecialchars($cavalo['raca']) . '</td>';
            echo '           <td style="padding: 10px;">' . $cavalo['idade'] . ' anos</td>';
            echo '           <td style="padding: 10px; font-weight: 600;">' . formatMoney($cavalo['valor']) . '</td>';
            echo '       </tr>';
        }
        
        echo '       </tbody>';
        echo '   </table>';
        echo '</div>';
    } else {
        echo '<div style="margin-top: 20px; padding: 15px; background: #fefcbf; border-radius: 10px;">';
        echo '   <strong>ℹ️ Informação:</strong> Nenhum cavalo encontrado com o termo "' . htmlspecialchars($termo_busca) . '"';
        echo '</div>';
    }
    
    echo '   <div style="margin-top: 20px;">';
    echo '       <a href="index.php" class="btn-back">Voltar para o Início</a>';
    echo '   </div>';
    echo '</div>';
}

// ============================================
// PROCESSAMENTO DE REQUISIÇÕES POST
// ============================================
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_proponente'])) {
    
    // Captura as variáveis do formulário
    $nome_proponente = trim($_POST['nome_proponente']);
    $idade_proponente = intval($_POST['idade_proponente']);
    $valor_cavalo = floatval(str_replace(',', '.', $_POST['valor_cavalo']));
    $parcelas = intval($_POST['parcelas']);
    
    // Validação dos dados
    if (empty($nome_proponente) || $idade_proponente <= 0 || $valor_cavalo <= 0) {
        echo '<div class="error">';
        echo '   <strong>⚠️ Erro:</strong> Todos os campos devem ser preenchidos corretamente.';
        echo '   <br><a href="index.php" class="btn-back" style="margin-top:10px;">Voltar para o Início</a>';
        echo '</div>';
        redirectToIndex();
    }
    
    // Cálculo do financiamento
    $juros = 0;
    $taxa_descricao = '';
    
    switch ($parcelas) {
        case 1:
            $juros = 0;
            $taxa_descricao = 'À vista (Sem Juros)';
            break;
        case 12:
            $juros = 0.05; // 5%
            $taxa_descricao = '12x com 5% de juros';
            break;
        case 24:
            $juros = 0.12; // 12%
            $taxa_descricao = '24x com 12% de juros';
            break;
        default:
            $juros = 0;
            $taxa_descricao = 'Plano inválido';
    }
    
    $valor_total = $valor_cavalo * (1 + $juros);
    $valor_parcela = ($parcelas > 0) ? $valor_total / $parcelas : $valor_total;
    
    // Verifica se o cliente é elegível para o Cupom VIP
    $elegivel_vip = isVipCustomer($idade_proponente, $valor_cavalo);
    
    // Exibe os resultados
    echo '<div class="result-box">';
    echo '   <h2>💰 Simulação de Financiamento</h2>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Nome do Proponente:</span>';
    echo '       <span class="value">' . htmlspecialchars($nome_proponente) . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Idade:</span>';
    echo '       <span class="value">' . $idade_proponente . ' anos</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Valor do Cavalo:</span>';
    echo '       <span class="value">' . formatMoney($valor_cavalo) . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Plano de Pagamento:</span>';
    echo '       <span class="value">' . $taxa_descricao . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Valor Total com Juros:</span>';
    echo '       <span class="value" style="font-weight: bold; color: #2b6cb0;">' . formatMoney($valor_total) . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Valor de cada Parcela:</span>';
    echo '       <span class="value" style="font-weight: bold; color: #2b6cb0;">' . formatMoney($valor_parcela) . '</span>';
    echo '   </div>';
    
    // Exibe o Cupom VIP se elegível
    if ($elegivel_vip) {
        echo '<div class="vip-cupom">';
        echo '   🎉 <strong>Cupom VIP de R$ 1.000,00</strong> 🎉';
        echo '   <br><span style="font-size: 0.9em;">Parabéns! Você ganhou um desconto especial por ser maior de idade e adquirir um cavalo de alto valor!</span>';
        echo '</div>';
    }
    
    echo '   <div style="margin-top: 20px;">';
    echo '       <a href="index.php" class="btn-back">Voltar para o Início</a>';
    echo '   </div>';
    echo '</div>';
}

// ============================================
// REQUISIÇÃO INVÁLIDA
// ============================================
else {
    echo '<div class="error">';
    echo '   <strong>⚠️ Erro:</strong> Requisição inválida. Por favor, utilize os formulários disponíveis.';
    echo '   <br><a href="index.php" class="btn-back" style="margin-top:10px;">Voltar para o Início</a>';
    echo '</div>';
}

echo '</div>';

// Fecha o body e html (iniciado no cabecalho.php)
?>
</body>
</html>