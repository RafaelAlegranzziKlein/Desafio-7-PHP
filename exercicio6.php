<?php 
class exercicio6 {

  private float $valorEmReais;
    private string $moedaDestino; // "USD" ou "EUR"
    private float $cotacao;

    public function __construct(float $valorEmReais, string $moedaDestino, float $cotacao) {
        $this->valorEmReais = $valorEmReais;
        $this->moedaDestino = strtoupper($moedaDestino);
        $this->cotacao = $cotacao;
    }

    // Converte reais para a moeda destino com base na cotação informada
    public function converter(): float {
        if ($this->cotacao <= 0) {
            return 0.0;
        }
        return $this->valorEmReais / $this->cotacao;
    }
    // Retorna o símbolo da moeda de destino
    private function getSimbolo(): string {
        switch ($this->moedaDestino) {
            case 'USD':
                return '$';
            case 'EUR':
                return '€';
            default:
                return $this->moedaDestino;
        }
    }
    private function formatarValorInternacional(float $valor): string {
        // Formato internacional: ponto para milhar, vírgula... na verdade
        // padrão US/EUR usa ponto decimal; usamos number_format "internacional" (en-US)
        return number_format($valor, 2, '.', ',');
    }
    public function exibirDetalhes(): string {
        $simbolo = $this->getSimbolo();

        return "
        <ul>
            <li>Valor original: R$ " . number_format($this->valorEmReais, 2, ',', '.') . "</li>
            <li>Moeda de destino: {$this->moedaDestino}</li>
            <li>Cotação utilizada: " . $this->formatarValorInternacional($this->cotacao) . "</li>
            <li><strong>Valor convertido: {$simbolo} " . $this->formatarValorInternacional($this->converter()) . "</strong></li>
        </ul>
        ";
    }
}
?>