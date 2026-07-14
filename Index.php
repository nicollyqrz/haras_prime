<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haras Prime - Sistema Interno</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            color: #2d3748;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.2em;
        }
        
        .subtitle {
            text-align: center;
            color: #718096;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .section {
            background: #f7fafc;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 5px solid #667eea;
        }
        
        .section h2 {
            color: #2d3748;
            font-size: 1.3em;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1em;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .form-group small {
            color: #a0aec0;
            font-size: 0.9em;
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-get {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }
        
        .btn-get:hover {
            box-shadow: 0 10px 20px rgba(72, 187, 120, 0.3);
        }
        
        .btn-post {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        }
        
        .btn-post:hover {
            box-shadow: 0 10px 20px rgba(66, 153, 225, 0.3);
        }
        
        .divider {
            border-top: 2px dashed #e2e8f0;
            margin: 30px 0;
        }
        
        .result-area {
            background: #edf2f7;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            display: none;
        }
        
        .result-area.show {
            display: block;
        }
        
        .result-area h3 {
            color: #2d3748;
            margin-bottom: 10px;
        }
        
        .result-area pre {
            background: white;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            color: #2d3748;
            font-family: 'Courier New', monospace;
            font-size: 0.95em;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐴 Haras Prime</h1>
        <p class="subtitle">Sistema Interno de Gestão</p>
        
        <!-- Seção 1: Buscar Cavalo no Plantel (GET) -->
        <div class="section">
            <h2>🔍 Buscar Cavalo no Plantel</h2>
            <form action="processa.php" method="GET">
                <div class="form-group">
                    <label for="txt_busca">Nome ou Raça do Animal:</label>
                    <input type="text" id="txt_busca" name="txt_busca" placeholder="Ex: Quarto de Milha" required>
                    <small>Digite o nome ou raça do cavalo que deseja buscar</small>
                </div>
                <button type="submit" class="btn btn-get">Pesquisar (GET)</button>
            </form>
        </div>
        
        <div class="divider"></div>
        
        <!-- Seção 2: Simulador de Financiamento Equino (POST) -->
        <div class="section">
            <h2>💰 Simulador de Financiamento Equino</h2>
            <form action="processa.php" method="POST">
                <div class="form-group">
                    <label for="nome_proponente">Nome do Proponente:</label>
                    <input type="text" id="nome_proponente" name="nome_proponente" placeholder="Digite seu nome completo" required>
                </div>
                
                <div class="form-group">
                    <label for="idade_proponente">Idade do Proponente:</label>
                    <input type="number" id="idade_proponente" name="idade_proponente" placeholder="Ex: 25" min="0" max="120" required>
                </div>
                
                <div class="form-group">
                    <label for="valor_cavalo">Valor do Cavalo (R$):</label>
                    <input type="number" id="valor_cavalo" name="valor_cavalo" placeholder="Ex: 45000" min="0" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="parcelas">Quantidade de Parcelas:</label>
                    <select id="parcelas" name="parcelas" required>
                        <option value="1">À vista (Sem Juros)</option>
                        <option value="12">12x (5% de juros)</option>
                        <option value="24">24x (12% de juros)</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-post">Processar Simulação (POST)</button>
            </form>
        </div>
    </div>
</body>
</html>