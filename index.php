<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Haras Prime - Painel Administrativo</title>

     <style>
       
        body {

            background-color: #f4f1ea; 
            color: #2c1d11;
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 20px;             
        }

        .container {

            max-width: 600px;
            margin: 0 auto;            
            background: #fff;
            padding: 30px;             
            border-radius: 8px;        
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {

            color: #5c3a21; 
            text-align: center; 
        }

        h2 {

            border-bottom: 2px solid #8c7863;
            padding-bottom: 5px;
            margin-top: 30px;
        }

        .form-group {

            margin-bottom: 15px;
            display: flex; 
            flex-direction: column;
        }

        label {

            font-weight: bold;
            margin-bottom: 5px;
            color: #5c3a21; 
        }

        input, select {

            padding: 10px;
            border: 1px solid #8c7863;
            border-radius: 4px;
            font-size: 14px; 
        }

        button {

            background-color: #5c3a21;
            color: white; 
            padding: 12px;
            border: none; 
            border-radius: 4px;
            cursor: pointer; 
            font-size: 16px;
            font-weight: bold;         
            width: 100%; 
        }

        button:hover {

            background-color: #8c7863;

        }

        .search-box {

            background: #fbfaf8; 
            border: 1px dashed #8c7863;
            padding: 15px; 
            border-radius: 6px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

  
    <div class="container">
            <h1>Haras Prime - Sistema Interno</h1>
      
        <div class="search-box">
            <h2>Buscar Cavalo no Plantel</h2>
          
            <form action="processa.php" method="GET">
        <div class="form-group">
                    <label for="busca">Nome ou Raça do Animal:</label>
                    <input type="text" id="busca" name="txt_busca" placeholder="Ex: Quarto de Milha...">
                </div>
                <button type="submit">Pesquisar (GET)</button>
            </form>

        </div>

        <h2>Simulador de Financiamento Equino</h2>

        <form action="processa.php" method="POST">

            <div class="form-group">
                <label for="nome">Nome do Proponente:</label>
                <input type="text" id="nome" name="txt_nome" required>
            </div>

            <div class="form-group">
                <label for="idade">Idade do Proponente:</label>
                <input type="number" id="idade" name="num_idade" required>
            </div>

            <div class="form-group">
                <label for="valor">Valor do Cavalo (R$):</label>
                <input type="number" step="0.01" id="valor" name="num_valor" required>
            </div>

            <div class="form-group">
                <label for="parcelas">Quantidade de Parcelas:</label>
                <select id="parcelas" name="sel_parcelas">
                    <option value="1">À vista (Sem Juros)</option>
                    <option value="12">12 parcelas (Adicional de 5%)</option>
                    <option value="24">24 parcelas (Adicional de 12%)</option>
                </select>
            </div>

            <button type="submit">Processar Simulação (POST)</button>
        </form>
    </div>

</body>

</html>
