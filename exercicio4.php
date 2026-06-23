<?php

class exercicio4 {
    private string $modelo;
    private string $combustivel; // "etanol" ou "gasolina"
    private float $tanqueLitros;
    private float $consumoKmPorLitro;
    private int $kmRodados;

    private const KM_PARA_REVISAO = 10000; // revisão a cada 10.000 km

    public function __construct(string $modelo, string $combustivel, float $tanqueLitros, float $consumoKmPorLitro, int $kmRodados) {
        $this->modelo = $modelo;
        $this->combustivel = strtolower($combustivel);
        $this->tanqueLitros = $tanqueLitros;
        $this->consumoKmPorLitro = $consumoKmPorLitro;
        $this->kmRodados = $kmRodados;
    }

    // Quantos km o carro consegue rodar com o tanque cheio
    public function calcularAutonomia(): float {
        return $this->tanqueLitros * $this->consumoKmPorLitro;
    }

    // Custo por km rodado, dado o preço do combustível
    public function calcularCustoPorKm(float $precoCombustivel): float {
        return $precoCombustivel / $this->consumoKmPorLitro;
    }

    // Custo total para rodar uma certa distância
    public function calcularCustoViagem(float $precoCombustivel, float $distanciaKm): float {
        return $this->calcularCustoPorKm($precoCombustivel) * $distanciaKm;
    }

    // Verifica se já passou da km de revisão
    public function precisaRevisao(): bool {
        return $this->kmRodados >= self::KM_PARA_REVISAO;
    }

    // Quantos km faltam até a próxima revisão (0 se já passou)
    public function kmRestantesParaRevisao(): int {
        $restante = self::KM_PARA_REVISAO - ($this->kmRodados % self::KM_PARA_REVISAO);
        return $this->precisaRevisao() && $this->kmRodados % self::KM_PARA_REVISAO === 0 ? 0 : $restante;
    }

    private function formatarMoeda(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function exibirDetalhes(float $precoCombustivel): string {
        $statusRevisao = $this->precisaRevisao()
            ? '<strong style="color:red">Hora de fazer a revisão!</strong>'
            : "Faltam {$this->kmRestantesParaRevisao()} km para a próxima revisão";

        return "
        <ul>
            <li>Modelo: {$this->modelo}</li>
            <li>Combustível: {$this->combustivel}</li>
            <li>Autonomia com tanque cheio: " . number_format($this->calcularAutonomia(), 2, ',', '.') . " km</li>
            <li>Custo por km: " . $this->formatarMoeda($this->calcularCustoPorKm($precoCombustivel)) . "</li>
            <li>Km rodados: {$this->kmRodados} km</li>
            <li>Revisão: {$statusRevisao}</li>
        </ul>
        ";
    }
}
?>