



<?php




require __DIR__  . "/src/funcoes.php";

echo "Bem-vindo(a) ao screen match!\n";



$nomeFilme = "Top Gun - Maverick";

$anoLancamento = 2022;

$quantidadeDeNotas = $argc - 1;
$notas = [];

for ($contador = 1; $contador < $argc; $contador++) {
    $notas[] = (float) $argv[$contador];
}

$notaFilme = array_sum($notas) / $quantidadeDeNotas;
$planoPrime = true;

echo "Nome do filme: " . $nomeFilme . "\n";
echo "Nota do filme: $notaFilme\n";
echo "Ano de lançamento: $anoLancamento\n";
e_lancamento($anoLancamento);

$genero = match ($nomeFilme) {
    "Top Gun - Maverick" => "ação",
    "Thor: Ragnarok" => "super-herói",
    "Se beber não case" => "comédia",
    default => "gênero desconhecido",
 };

echo "O gênero do filme é: $genero\n";

$filme = criarfilme(
    nome: "Bob Sponja", 
    ano: 1999 , 
    nota: 8.7 , 
    genero: "Animação");
e_lancamento($filme->anoLancamento);

e_plano_prime($planoPrime, $filme->anoLancamento);

$filmeJson = json_encode($filme);
file_put_contents (__DIR__ . '/filme.json' , $filmeJson);
var_dump($filme);
