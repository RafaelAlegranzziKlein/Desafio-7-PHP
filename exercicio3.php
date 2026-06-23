<?php

class exercicio3 {
    private string $produto;
    private int $quantidade;
    private float $precoUnitario;
    private string $tipoCliente; // "normal" ou "premium"

    private const DESCONTO_PREMIUM = 0.10; // 10%
    private const TAXA_IMPOSTO = 0.08;     // 8%

    public function __construct(string $produto, int $quantidade, float $precoUnitario, string $tipoCliente) {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->precoUnitario = $precoUnitario;
        $this->tipoCliente = strtolower($tipoCliente);
    }

    // Total bruto = quantidade x preço unitário
    public function calcularTotalBruto(): float {
        return $this->quantidade * $this->precoUnitario;
    }

    // Desconto só se for cliente premium
    public function calcularDesconto(): float {
        if ($this->tipoCliente === 'premium') {
            return $this->calcularTotalBruto() * self::DESCONTO_PREMIUM;
        }
        return 0.0;
    }

    // Imposto incide sobre o total já com desconto
    public function calcularImposto(): float {
        $baseComDesconto = $this->calcularTotalBruto() - $this->calcularDesconto();
        return $baseComDesconto * self::TAXA_IMPOSTO;
    }

    public function calcularTotalFinal(): float {
        $bruto = $this->calcularTotalBruto();
        $desconto = $this->calcularDesconto();
        $imposto = $this->calcularImposto();
        return $bruto - $desconto + $imposto;
    }

    private function formatarMoeda(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function exibirDetalhes(): string {
        $tipoClienteLabel = $this->tipoCliente === 'premium' ? 'Premium' : 'Normal';

        return "
        <ul>
            <li>Produto: {$this->produto}</li>
            <li>Quantidade: {$this->quantidade}</li>
            <li>Preço unitário: " . $this->formatarMoeda($this->precoUnitario) . "</li>
            <li>Tipo de cliente: {$tipoClienteLabel}</li>
            <li>Total bruto: " . $this->formatarMoeda($this->calcularTotalBruto()) . "</li>
            <li>Desconto: " . $this->formatarMoeda($this->calcularDesconto()) . "</li>
            <li>Imposto (8%): " . $this->formatarMoeda($this->calcularImposto()) . "</li>
            <li><strong>Total final: " . $this->formatarMoeda($this->calcularTotalFinal()) . "</strong></li>
        </ul>
        ";
    }
}
?>