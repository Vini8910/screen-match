<?php 

$filme = [
    "nome" => $_POST['nome'],
    "genero" => $_POST['genero'],
    "ano" => $_POST['ano'],
    "nota" => $_POST['nota']
];

file_put_contents('filme.json' , json_encode($filme));

header(
    'Location: sucesso.php?filme=' . urlencode($filme['nome']) .
    '&genero=' . urlencode($filme['genero'])
);
exit;
