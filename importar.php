<?php

$json = __DIR__ . '/filme.json';
$conteudo = file_get_contents($json);
$filme = json_decode($conteudo);
var_dump($filme);