<?php
class exercicio9 {
    private string $nome;
    private float $pesoKg;
    private float $alturaM;

    public function __construct(string $nome, float $pesoKg, float $alturaM) {
        $this->nome = $nome;
        $this->pesoKg = $pesoKg;
        $this->alturaM = $alturaM;
    }

    // IMC = peso / altura²
    public function calcularImc(): float {
        if ($this->alturaM <= 0) {
            return 0.0;
        }
        return $this->pesoKg / ($this->alturaM ** 2);
    }

    // Classificação segundo as faixas usuais de IMC
    public function classificarImc(): string {
        $imc = $this->calcularImc();

        if ($imc < 18.5) {
            return 'Abaixo do peso';
        } elseif ($imc < 25) {
            return 'Peso normal';
        } elseif ($imc < 30) {
            return 'Sobrepeso';
        } else {
            return 'Obesidade';
        }
    }

 public function exibirDetalhes(): string {
        $imcFormatado = number_format($this->calcularImc(), 2, ',', '.');

        return "
        <ul>
            <li>Nome: {$this->nome}</li>
            <li>Peso: " . number_format($this->pesoKg, 1, ',', '.') . " kg</li>
            <li>Altura: " . number_format($this->alturaM, 2, ',', '.') . " m</li>
            <li>IMC: {$imcFormatado}</li>
            <li><strong>Classificação: {$this->classificarImc()}</strong></li>
        </ul>
        ";
    }
}
?>