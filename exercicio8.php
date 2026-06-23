<?php
class CalculadoraFinanceira {
 private float $valorCompra;
    private int $numeroParcelas;
    private float $taxaJurosMensal; // ex: 0.02 para 2% ao mês

    public function __construct(float $valorCompra, int $numeroParcelas, float $taxaJurosMensal) {
        $this->valorCompra = $valorCompra;
        $this->numeroParcelas = $numeroParcelas;
        $this->taxaJurosMensal = $taxaJurosMensal;
    }

    public function calcularValorParcela(): float {
        if ($this->numeroParcelas <= 0 ) {
            return 0.0;
        }$montante = $this->valorCompra * pow(1 + $this->taxaJurosMensal, $this->numeroParcelas);

        return $montante / $this->numeroParcelas;
    }

      // Total a pagar somando todas as parcelas
    public function calcularTotalAPagar(): float {
        return $this->calcularValorParcela() * $this->numeroParcelas;
    }

    // Diferença entre o total pago e o valor original (juros pagos)
    public function calcularJurosPagos(): float {
        return $this->calcularTotalAPagar() - $this->valorCompra;
    }

    private function formatarMoeda(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

      public function exibirDetalhes(): string {
        $taxaPercentual = number_format($this->taxaJurosMensal * 100, 2, ',', '.');

        return "
        <ul>
            <li>Valor da compra: " . $this->formatarMoeda($this->valorCompra) . "</li>
            <li>Número de parcelas: {$this->numeroParcelas}x</li>
            <li>Taxa de juros mensal: {$taxaPercentual}%</li>
            <li>Valor de cada parcela: " . $this->formatarMoeda($this->calcularValorParcela()) . "</li>
            <li>Total a pagar: " . $this->formatarMoeda($this->calcularTotalAPagar()) . "</li>
            <li><strong>Juros pagos: " . $this->formatarMoeda($this->calcularJurosPagos()) . "</strong></li>
        </ul>
        ";
    }
}
?>