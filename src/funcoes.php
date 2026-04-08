<?php

include __DIR__ . "/modelo/Filme.php";
function criarfilme (
       string $nome ,
        int $ano,
        float $nota,
        string $genero) : Filme {

            $filme = new Filme();
            $filme->nome = $nome;
            $filme->anoLancamento = $ano;
            $filme->nota = $nota;
            $filme->genero = $genero;
            return $filme;
        

        } 
function e_lancamento($ano) {
if ($ano > 2022) {
    echo "Esse filme é um lançamento\n";
} elseif($ano > 2020 && $ano <= 2022) {
    echo "Esse filme ainda é novo\n";
} else {
    echo "Esse filme não é um lançamento\n";
}

}

function e_plano_prime(bool $planoPrime , int $ano) {
  
If ($planoPrime && $ano > 2020) {
    echo "Esse filme é um lançamento e está disponível no plano prime\n";
} elseif ($planoPrime && $ano <= 2020) {
    echo "Esse filme não é um lançamento, mas está disponível no plano prime\n";
} elseif (!$planoPrime && $ano > 2020) {
    echo "Esse filme é um lançamento, mas não está disponível no plano prime\n";
} else {
    echo "Esse filme não é um lançamento e não está disponível no plano prime\n";
}
}
