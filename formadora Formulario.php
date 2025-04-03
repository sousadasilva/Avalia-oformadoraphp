<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processamento dos dados
    $funcionarios = [
        'nomes' => $_POST['nome'],
        'matriculas' => $_POST['matricula'],
        'sexos' => $_POST['sexo'],
        'salarios' => $_POST['salario']
    ];

    $somaHomens = 0;
    $somaMulheres = 0;
    $totalMulheres = 0;
    
    // Primeira e última matrícula
    $primeira = $funcionarios['matriculas'][0];
    $ultima = end($funcionarios['matriculas']);

    // Calcula estatísticas
    for ($i = 0; $i < 50; $i++) {
        $sexo = strtoupper($funcionarios['sexos'][$i]);
        $salario = (float)$funcionarios['salarios'][$i];

        if ($sexo === 'F') {
            $somaMulheres += $salario;
            $totalMulheres++;
        } else {
            $somaHomens += $salario;
        }
    }

    // Calcula média
    $mediaMulheres = $totalMulheres > 0 ? $somaMulheres / $totalMulheres : 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .resultado { margin: 20px 0; padding: 15px; background: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Resultados da Análise</h1>
    
    <div class="resultado">
        <h3>Média Salarial Feminina:</h3>
        <p>R$ <?= number_format($mediaMulheres, 2, ',', '.') ?></p>
    </div>

    <div class="resultado">
        <h3>Soma Salarial Masculina:</h3>
        <p>R$ <?= number_format($somaHomens, 2, ',', '.') ?></p>
    </div>

    <div class="resultado">
        <h3>Matrículas:</h3>
        <p>Primeira: <?= $primeira ?></p>
        <p>Última: <?= $ultima ?></p>
    </div>
</body>
</html>
<?php
} else {
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionários</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .funcionario { border: 1px solid #ccc; padding: 15px; margin: 10px 0; }
        input, select { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Avaliação Formadora</h1>
    <form method="POST">
        <?php for ($i = 0; $i < 50; $i++): ?>
        <div class="funcionario">
            <h3>Funcionário <?= $i+1 ?></h3>
            
            <label>Nome:
                <input type="text" name="nome[]" required>
            </label><br>

            <label>Matrícula:
                <input type="text" name="matricula[]" required>
            </label><br>

            <label>Sexo:
                <select name="sexo[]" required>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </label><br>

            <label>Salário R$:
                <input type="number" name="salario[]" step="0.01" required>
            </label>
        </div>
        <?php endfor; ?>
        <button type="submit">Calcular Estatísticas</button>
    </form>
</body>
</html>
<?php
}
?>