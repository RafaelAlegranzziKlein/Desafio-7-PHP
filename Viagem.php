<?php
class Viagem {
   private string $origem;
    private string $destino;
    private float $distanciaKm;
    private float $tempoHoras;
    private float $consumoKmPorLitro; // consumo do veículo escolhido

    public function __construct(string $origem, string $destino, float $distanciaKm, float $tempoHoras, float $consumoKmPorLitro) {
        $this->origem = $origem;
        $this->destino = $destino;
        $this->distanciaKm = $distanciaKm;
        $this->tempoHoras = $tempoHoras;
        $this->consumoKmPorLitro = $consumoKmPorLitro;
    }
    
    // Velocidade média = distância / tempo
    public function calcularVelocidadeMedia(): float {
        if ($this->tempoHoras <= 0) {
            return 0.0;
        }
        return $this->distanciaKm / $this->tempoHoras;
    }

    // Litros de combustível estimados para a viagem
    public function calcularConsumoEstimado(): float {
        if ($this->consumoKmPorLitro <= 0) {
            return 0.0;
        }
        return $this->distanciaKm / $this->consumoKmPorLitro;
    }

    // Custo total da viagem, dado o preço do combustível
    public function calcularCustoViagem(float $precoCombustivel): float {
        return $this->calcularConsumoEstimado() * $precoCombustivel;
    }

    private function formatarMoeda(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function exibirDetalhes(float $precoCombustivel): string {
        return "
        <ul>
            <li>Origem: {$this->origem}</li>
            <li>Destino: {$this->destino}</li>
            <li>Distância: " . number_format($this->distanciaKm, 2, ',', '.') . " km</li>
            <li>Tempo estimado: " . number_format($this->tempoHoras, 2, ',', '.') . " h</li>
            <li>Velocidade média: " . number_format($this->calcularVelocidadeMedia(), 2, ',', '.') . " km/h</li>
            <li>Consumo estimado: " . number_format($this->calcularConsumoEstimado(), 2, ',', '.') . " litros</li>
            <li><strong>Custo estimado da viagem: " . $this->formatarMoeda($this->calcularCustoViagem($precoCombustivel)) . "</strong></li>
        </ul>
        ";
    }
}
?>