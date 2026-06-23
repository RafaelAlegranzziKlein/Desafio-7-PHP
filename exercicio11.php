<?php
class CalculadoraGeometrica {

    private string $figura; // "quadrado", "retangulo" ou "circulo"
    private array $medidas;  // medidas necessárias para cada figura

    public function __construct(string $figura, array $medidas) {
        $this->figura = strtolower($figura);
        $this->medidas = $medidas;
    }

 // Calcula a área de acordo com a figura escolhida
    public function calcularArea(): float {
        switch ($this->figura) {
            case 'quadrado':
                $lado = $this->medidas['lado'] ?? 0;
                return $lado ** 2;

            case 'retangulo':
                $base = $this->medidas['base'] ?? 0;
                $altura = $this->medidas['altura'] ?? 0;
                return $base * $altura;

            case 'circulo':
                $raio = $this->medidas['raio'] ?? 0;
                return M_PI * ($raio ** 2);

            default:
                return 0.0;
        }
    }

    private function getNomeFigura(): string {
        $nomes = [
            'quadrado'  => 'Quadrado',
            'retangulo' => 'Retângulo',
            'circulo'   => 'Círculo',
        ];
        return $nomes[$this->figura] ?? 'Figura desconhecida';
    }

    private function getDescricaoMedidas(): string {
        switch ($this->figura) {
            case 'quadrado':
                return "Lado: " . number_format($this->medidas['lado'] ?? 0, 2, ',', '.');

            case 'retangulo':
                $base = number_format($this->medidas['base'] ?? 0, 2, ',', '.');
                $altura = number_format($this->medidas['altura'] ?? 0, 2, ',', '.');
                return "Base: {$base} | Altura: {$altura}";

            case 'circulo':
                return "Raio: " . number_format($this->medidas['raio'] ?? 0, 2, ',', '.');

            default:
                return '-';
        }
    }

    public function exibirDetalhes(): string {
        $areaFormatada = number_format($this->calcularArea(), 2, ',', '.');

        return "
        <ul>
            <li>Figura: {$this->getNomeFigura()}</li>
            <li>Medidas informadas: {$this->getDescricaoMedidas()}</li>
            <li><strong>Área calculada: {$areaFormatada}</strong></li>
        </ul>
        ";
    }
}
?>