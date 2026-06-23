<?php

class Produto {
    private string $nome;
    private int $quantidadeEstoque;
    private float $valorUnitario;

    public function __construct(string $nome, int $quantidadeEstoque, float $valorUnitario) {
        $this->nome = $nome;
        $this->quantidadeEstoque = $quantidadeEstoque;
        $this->valorUnitario = $valorUnitario;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getQuantidadeEstoque(): int {
        return $this->quantidadeEstoque;
    }

    public function getValorUnitario(): float {
        return $this->valorUnitario;
    }

    // Entrada de itens no estoque
    public function entrada(int $quantidade): void {
        if ($quantidade > 0) {
            $this->quantidadeEstoque += $quantidade;
        }
    }

    // Saída de itens do estoque (não deixa ficar negativo)
    public function saida(int $quantidade): bool {
        if ($quantidade > 0 && $quantidade <= $this->quantidadeEstoque) {
            $this->quantidadeEstoque -= $quantidade;
            return true;
        }
        return false; // estoque insuficiente
    }

    // Valor total em estoque (quantidade x valor unitário)
    public function calcularValorTotalEstoque(): float {
        return $this->quantidadeEstoque * $this->valorUnitario;
    }

    private function formatarMoeda(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function exibirDetalhes(): string {
        return "
        <ul>
            <li>Produto: {$this->nome}</li>
            <li>Quantidade em estoque: {$this->quantidadeEstoque}</li>
            <li>Valor unitário: " . $this->formatarMoeda($this->valorUnitario) . "</li>
            <li><strong>Valor total em estoque: " . $this->formatarMoeda($this->calcularValorTotalEstoque()) . "</strong></li>
        </ul>
        ";
    }
}
?>