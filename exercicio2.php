<?php
class Aluno {
    private string $nomeAluno;
    private float $nota1;
    private float $nota2;
    private float $nota3;


    public function __construct($nomeAluno, $nota1, $nota2, $nota3) {
        $this->nomeAluno = $nomeAluno;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
        $this->nota3 = $nota3;
    }


    public function calcularMedia(){
        return ($this->nota1 + $this->nota2 + $this->nota3) / 3;
    }
    

    public function verificarSituacao(){
        $media = $this->calcularMedia();
        if ($media >= 7) {
            return "Aprovado";
        } elseif ($media >= 5) {
            return "Recuperação";
        } else {
            return "Reprovado";
        }
    }

    public function exibirDetalhes(){
        $media = $this->calcularMedia();
        $situacao = $this->verificarSituacao();
        if ($this->nota1 < 0 || $this->nota1 > 10 || $this->nota2 < 0 || $this->nota2 > 10 || $this->nota3 < 0 || $this->nota3 > 10) {
            return "<p>Erro: As notas devem estar entre 0 e 10.</p>";
        }
        return "
        <ul>

            <li>Nome do Aluno: {$this->nomeAluno}</li>
            <li>Nota 1: {$this->nota1}</li>
            <li>Nota 2: {$this->nota2}</li>
            <li>Nota 3: {$this->nota3}</li>
            <li>Média: " . number_format($media, 2, ',', '.') . "</li>
            <li>Situação: {$situacao}</li>
        </ul>
        ";
    }
}
?> 
