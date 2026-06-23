<?php
require_once 'exercicio1.php';
require_once 'exercicio2.php';
require_once 'exercicio3.php';
require_once 'exercicio4.php';
require_once 'exercicio5.php';
require_once 'exercicio6.php';
require_once 'exercicio7.php';
require_once 'exercicio8.php';
require_once 'exercicio9.php';
require_once 'exercicio10.php';
require_once 'exercicio11.php';

// Cada form tem um campo oculto "formulario" para sabermos qual foi enviado.
// Assim cada bloco só processa quando o seu próprio form é submetido.
$formEnviado = $_POST['formulario'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Exercícios PHP OO</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="page-header">
        <p class="page-header__eyebrow">php / orientação a objetos</p>
        <h1>Exercícios de Classes em PHP</h1>
        <p class="page-header__sub">11 formulários independentes, cada um instanciando sua própria classe para calcular e exibir o resultado.</p>
    </header>

    <div class="container">

        <!-- 1. FUNCIONARIO -->
        <div class="card">
            <h2><span class="idx">[01]</span> Funcionário</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="funcionario">
                <label>Nome: <input type="text" name="nome" required></label>
                <label>Cargo: <input type="text" name="cargo" required></label>
                <label>Salário: <input type="number" step="0.01" name="salario" required></label>
                <label>Carga Horária Semanal: <input type="number" name="carga" required></label>
                <label>Bônus: <input type="number" step="0.01" name="bonus" required></label>
                <label>Horas Extras: <input type="number" name="extras" required></label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'funcionario'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $func = new exercicio1(
                        $_POST['nome'],
                        $_POST['cargo'],
                        (float)$_POST['salario'],
                        (int)$_POST['carga']
                    );
                    echo $func->exibirDetalhes((float)$_POST['bonus'], (int)$_POST['extras']);
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 2. ALUNO -->
        <div class="card">
            <h2><span class="idx">[02]</span> Aluno – Média e Status</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="aluno">
                <label>Nome: <input type="text" name="nomeAluno" required></label>
                <label>Nota 1: <input type="number" step="0.1" name="nota1" required></label>
                <label>Nota 2: <input type="number" step="0.1" name="nota2" required></label>
                <label>Nota 3: <input type="number" step="0.1" name="nota3" required></label>
                <button type="submit">Calcular Média</button>
            </form>

            <?php if ($formEnviado === 'aluno'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $aluno = new exercicio2(
                        $_POST['nomeAluno'],
                        (float)$_POST['nota1'],
                        (float)$_POST['nota2'],
                        (float)$_POST['nota3']
                    );
                    echo $aluno->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 3. PEDIDO -->
        <div class="card">
            <h2><span class="idx">[03]</span> Pedido – Total, Desconto e Imposto</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="pedido">
                <label>Produto: <input type="text" name="produto" required></label>
                <label>Quantidade: <input type="number" name="quantidade" min="1" required></label>
                <label>Preço unitário: <input type="number" step="0.01" name="preco" required></label>
                <label>Tipo de cliente:
                    <select name="tipoCliente">
                        <option value="normal">Normal</option>
                        <option value="premium">Premium</option>
                    </select>
                </label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'pedido'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $pedido = new exercicio3(
                        $_POST['produto'],
                        (int)$_POST['quantidade'],
                        (float)$_POST['preco'],
                        $_POST['tipoCliente']
                    );
                    echo $pedido->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 4. CARRO -->
        <div class="card">
            <h2><span class="idx">[04]</span> Carro – Autonomia e Revisão</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="carro">
                <label>Modelo: <input type="text" name="modelo" required></label>
                <label>Combustível:
                    <select name="combustivel">
                        <option value="gasolina">Gasolina</option>
                        <option value="etanol">Etanol</option>
                    </select>
                </label>
                <label>Tanque cheio (litros): <input type="number" step="0.01" name="tanque" required></label>
                <label>Consumo (km/l): <input type="number" step="0.01" name="consumo" required></label>
                <label>Km já rodados: <input type="number" name="kmRodados" required></label>
                <label>Preço do combustível (R$/litro): <input type="number" step="0.01" name="precoCombustivel" required></label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'carro'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $carro = new exercicio4(
                        $_POST['modelo'],
                        $_POST['combustivel'],
                        (float)$_POST['tanque'],
                        (float)$_POST['consumo'],
                        (int)$_POST['kmRodados']
                    );
                    echo $carro->exibirDetalhes((float)$_POST['precoCombustivel']);
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 5. PRODUTO (ESTOQUE) -->
        <div class="card">
            <h2><span class="idx">[05]</span> Produto – Controle de Estoque</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="produto">
                <label>Nome do produto: <input type="text" name="nomeProduto" required></label>
                <label>Quantidade em estoque: <input type="number" name="quantidadeEstoque" required></label>
                <label>Valor unitário: <input type="number" step="0.01" name="valorUnitario" required></label>
                <label>Movimentar:
                    <select name="tipoMovimento">
                        <option value="nenhuma">Nenhuma (apenas consultar)</option>
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </label>
                <label>Quantidade a movimentar: <input type="number" name="quantidadeMovimento" value="0"></label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'produto'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $produto = new exercicio5(
                        $_POST['nomeProduto'],
                        (int)$_POST['quantidadeEstoque'],
                        (float)$_POST['valorUnitario']
                    );

                    $tipoMov = $_POST['tipoMovimento'];
                    $qtdMov = (int)$_POST['quantidadeMovimento'];

                    if ($tipoMov === 'entrada') {
                        $produto->entrada($qtdMov);
                        echo "<p><em>Entrada de {$qtdMov} unidade(s) registrada.</em></p>";
                    } elseif ($tipoMov === 'saida') {
                        $sucesso = $produto->saida($qtdMov);
                        echo $sucesso
                            ? "<p><em>Saída de {$qtdMov} unidade(s) registrada.</em></p>"
                            : "<p class='erro'>Estoque insuficiente para essa saída!</p>";
                    }

                    echo $produto->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 6. CONVERSOR DE MOEDA -->
        <div class="card">
            <h2><span class="idx">[06]</span> Conversor de Moeda</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="conversor">
                <label>Valor em reais (R$): <input type="number" step="0.01" name="valorReais" required></label>
                <label>Moeda destino:
                    <select name="moedaDestino">
                        <option value="USD">Dólar (USD)</option>
                        <option value="EUR">Euro (EUR)</option>
                    </select>
                </label>
                <label>Cotação atual: <input type="number" step="0.0001" name="cotacao" required></label>
                <button type="submit">Converter</button>
            </form>

            <?php if ($formEnviado === 'conversor'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $conversor = new exercicio6(
                        (float)$_POST['valorReais'],
                        $_POST['moedaDestino'],
                        (float)$_POST['cotacao']
                    );
                    echo $conversor->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 7. VIAGEM -->
        <div class="card">
            <h2><span class="idx">[07]</span> Viagem – Planejamento e Custos</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="viagem">
                <label>Origem: <input type="text" name="origem" required></label>
                <label>Destino: <input type="text" name="destino" required></label>
                <label>Distância (km): <input type="number" step="0.01" name="distancia" required></label>
                <label>Tempo estimado (horas): <input type="number" step="0.01" name="tempo" required></label>
                <label>Consumo do veículo (km/l): <input type="number" step="0.01" name="consumoViagem" required></label>
                <label>Preço do combustível (R$/litro): <input type="number" step="0.01" name="precoCombustivelViagem" required></label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'viagem'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $viagem = new exercicio7(
                        $_POST['origem'],
                        $_POST['destino'],
                        (float)$_POST['distancia'],
                        (float)$_POST['tempo'],
                        (float)$_POST['consumoViagem']
                    );
                    echo $viagem->exibirDetalhes((float)$_POST['precoCombustivelViagem']);
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 8. CALCULADORA FINANCEIRA -->
        <div class="card">
            <h2><span class="idx">[08]</span> Parcelamento e Juros</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="financeira">
                <label>Valor da compra: <input type="number" step="0.01" name="valorCompra" required></label>
                <label>Número de parcelas: <input type="number" name="parcelas" min="1" required></label>
                <label>Taxa de juros mensal (%): <input type="number" step="0.01" name="juros" required></label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'financeira'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $calculadora = new exercicio8(
                        (float)$_POST['valorCompra'],
                        (int)$_POST['parcelas'],
                        ((float)$_POST['juros']) / 100
                    );
                    echo $calculadora->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 9. PESSOA (IMC) -->
        <div class="card">
            <h2><span class="idx">[09]</span> Pessoa – IMC e Classificação</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="pessoa">
                <label>Nome: <input type="text" name="nomePessoa" required></label>
                <label>Peso (kg): <input type="number" step="0.01" name="peso" required></label>
                <label>Altura (m): <input type="number" step="0.01" name="altura" required></label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'pessoa'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $pessoa = new exercicio9(
                        $_POST['nomePessoa'],
                        (float)$_POST['peso'],
                        (float)$_POST['altura']
                    );
                    echo $pessoa->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 10. RESERVA HOTEL -->
        <div class="card">
            <h2><span class="idx">[10]</span> Reserva de Hotel</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="hotel">
                <label>Nome do hóspede: <input type="text" name="nomeHospede" required></label>
                <label>Número de noites: <input type="number" name="noites" min="1" required></label>
                <label>Tipo de quarto:
                    <select name="tipoQuarto">
                        <option value="simples">Simples (R$ 120/noite)</option>
                        <option value="luxo">Luxo (R$ 200/noite)</option>
                        <option value="suite">Suíte (R$ 350/noite)</option>
                    </select>
                </label>
                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'hotel'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $reserva = new exercicio10(
                        $_POST['nomeHospede'],
                        (int)$_POST['noites'],
                        $_POST['tipoQuarto']
                    );
                    echo $reserva->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 11. CALCULADORA GEOMÉTRICA -->
        <div class="card">
            <h2><span class="idx">[11]</span> Área de Figuras Geométricas</h2>
            <form method="post">
                <input type="hidden" name="formulario" value="geometria">
                <label>Figura:
                    <select name="figura">
                        <option value="quadrado">Quadrado</option>
                        <option value="retangulo">Retângulo</option>
                        <option value="circulo">Círculo</option>
                    </select>
                </label>

                <p class="hint">Preencha apenas as medidas da figura escolhida acima.</p>

                <div class="grupo-medida">
                    <span class="grupo-medida__titulo">Quadrado</span>
                    <label>Lado: <input type="number" step="0.01" name="lado"></label>
                </div>
                <div class="grupo-medida">
                    <span class="grupo-medida__titulo">Retângulo</span>
                    <label>Base: <input type="number" step="0.01" name="base"></label>
                    <label>Altura: <input type="number" step="0.01" name="alturaFigura"></label>
                </div>
                <div class="grupo-medida">
                    <span class="grupo-medida__titulo">Círculo</span>
                    <label>Raio: <input type="number" step="0.01" name="raio"></label>
                </div>

                <button type="submit">Calcular</button>
            </form>

            <?php if ($formEnviado === 'geometria'): ?>
                <div class="resultado">
                    <h3>Resultado:</h3>
                    <?php
                    $medidas = [
                        'lado'   => (float)($_POST['lado'] ?? 0),
                        'base'   => (float)($_POST['base'] ?? 0),
                        'altura' => (float)($_POST['alturaFigura'] ?? 0),
                        'raio'   => (float)($_POST['raio'] ?? 0),
                    ];
                    $calculadoraGeo = new exercicio11($_POST['figura'], $medidas);
                    echo $calculadoraGeo->exibirDetalhes();
                    ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>
