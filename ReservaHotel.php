<?php
class ReservaHotel {

 private string $nomeHospede;
    private int $numeroNoites;
    private string $tipoQuarto; // "simples", "luxo" ou "suite"

    private const PRECOS_QUARTO = [
        'simples' => 120.00,
        'luxo'    => 200.00,
        'suite'   => 350.00,
    ];

    private const NOITES_PARA_DESCONTO = 5;
    private const PERCENTUAL_DESCONTO = 0.15; // 15% de desconto

    public function __construct(string $nomeHospede, int $numeroNoites, string $tipoQuarto) {
        $this->nomeHospede = $nomeHospede;
        $this->numeroNoites = $numeroNoites;
        $this->tipoQuarto = strtolower($tipoQuarto);
    }

    // Preço da diária de acordo com o tipo de quarto escolhido
    public function getValorDiaria(): float {
        return self::PRECOS_QUARTO[$this->tipoQuarto] ?? 0.0;
    }

    // Valor total sem considerar descontos
    public function calcularValorBruto(): float {
        return $this->getValorDiaria() * $this->numeroNoites;
    }

    // Desconto aplicado para estadias acima de 5 noites
    public function temDesconto(): bool {
        return $this->numeroNoites > self::NOITES_PARA_DESCONTO;
    }

    public function calcularDesconto(): float {
        if ($this->temDesconto()) {
            return $this->calcularValorBruto() * self::PERCENTUAL_DESCONTO;
        }
        return 0.0;
    }

    public function calcularValorFinal(): float {
        return $this->calcularValorBruto() - $this->calcularDesconto();
    }

    private function formatarMoeda(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

  public function exibirDetalhes(): string {
        $nomeQuartoLabel = ucfirst($this->tipoQuarto);
        $mensagemDesconto = $this->temDesconto()
            ? 'Desconto especial aplicado por estadia longa (acima de 5 noites)!'
            : 'Sem desconto (estadia de até 5 noites).';

        return "
        <p>Olá, <strong>{$this->nomeHospede}</strong>! Seja bem-vindo(a) ao nosso hotel.</p>
        <ul>
            <li>Tipo de quarto: {$nomeQuartoLabel}</li>
            <li>Valor da diária: " . $this->formatarMoeda($this->getValorDiaria()) . "</li>
            <li>Número de noites: {$this->numeroNoites}</li>
            <li>Valor bruto: " . $this->formatarMoeda($this->calcularValorBruto()) . "</li>
            <li>Desconto: " . $this->formatarMoeda($this->calcularDesconto()) . " ({$mensagemDesconto})</li>
            <li><strong>Valor final da hospedagem: " . $this->formatarMoeda($this->calcularValorFinal()) . "</strong></li>
        </ul>
        ";
    }
}
?>