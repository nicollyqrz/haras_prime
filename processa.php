<?php

include 'cabecalho.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['txt_busca'])) {
    
    $termo_busca = trim($_GET['txt_busca']);
    if (empty($termo_busca)) {
        header('Location: index.html');
        exit;
    }
    
    echo '<div class="result-box">';
    echo '   <h2>🔍 Resultado da Busca</h2>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Termo pesquisado:</span>';
    echo '       <span class="value">"' . htmlspecialchars($termo_busca) . '"</span>';
    echo '   </div>';
    echo '   <p style="margin-top: 20px; color: #27ae60;"> Busca realizada com sucesso!</p>';
    echo '   <a href="index.html" class="btn-back">Voltar para o Início</a>';
    echo '</div>';
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_proponente'])) {
    
    $nome = trim($_POST['nome_proponente']);
    $idade = intval($_POST['idade_proponente']);
    $valor = floatval(str_replace(',', '.', $_POST['valor_cavalo']));
    $parcelas = intval($_POST['parcelas']);
    
    if (empty($nome) || $idade <= 0 || $valor <= 0) {
        echo '<div class="error">';
        echo '   <strong>Erro:</strong> Todos os campos devem ser preenchidos corretamente.';
        echo '   <br><a href="index.html" class="btn-back" style="margin-top:10px;">Voltar para o Início</a>';
        echo '</div>';
        exit;
    }
  
    if ($parcelas == 12) {
        $total = $valor * 1.05;
        $descricao = '12x com 5% de juros';
    } elseif ($parcelas == 24) {
        $total = $valor * 1.12; 
        $descricao = '24x com 12% de juros';
    } else {
        $total = $valor;
        $descricao = 'À vista (Sem Juros)';
    }
    
    $valor_parcela = ($parcelas > 0) ? $total / $parcelas : $total;
  
    $elegivel_vip = ($idade >= 18 && $valor > 30000.00);
    
    echo '<div class="result-box">';
    echo '   <h2> Simulação de Financiamento</h2>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Nome do Proponente:</span>';
    echo '       <span class="value">' . htmlspecialchars($nome) . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Idade:</span>';
    echo '       <span class="value">' . $idade . ' anos</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Valor do Cavalo:</span>';
    echo '       <span class="value">R$ ' . number_format($valor, 2, ',', '.') . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Plano de Pagamento:</span>';
    echo '       <span class="value">' . $descricao . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Valor Total com Juros:</span>';
    echo '       <span class="value" style="font-weight: bold; color: #2b6cb0;">R$ ' . number_format($total, 2, ',', '.') . '</span>';
    echo '   </div>';
    echo '   <div class="info-item">';
    echo '       <span class="label">Valor de cada Parcela:</span>';
    echo '       <span class="value" style="font-weight: bold; color: #2b6cb0;">R$ ' . number_format($valor_parcela, 2, ',', '.') . '</span>';
    echo '   </div>';
    
    if ($elegivel_vip) {
        echo '<div class="vip-cupom">';
        echo '    <strong>Cupom VIP de R$ 1.000,00</strong> ';
        echo '   <br><span style="font-size: 0.9em;">Parabéns! Você ganhou um desconto especial!</span>';
        echo '</div>';
    }
    
    echo '   <a href="index.html" class="btn-back">Voltar para o Início</a>';
    echo '</div>';
}

else {
    echo '<div class="error">';
    echo '   <strong> Erro:</strong> Requisição inválida.';
    echo '   <br><a href="index.html" class="btn-back" style="margin-top:10px;">Voltar para o Início</a>';
    echo '</div>';
}

</div>
</body>
</html>
