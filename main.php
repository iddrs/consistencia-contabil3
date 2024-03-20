<?php

require_once 'vendor/autoload.php';

echo PHP_EOL, '================================================================================', PHP_EOL;
echo 'TESTES DE CONSISTÊNCIA CONTÁBIL';
echo PHP_EOL, '================================================================================', PHP_EOL, PHP_EOL;

do {
    echo PHP_EOL, '================================================================================', PHP_EOL, PHP_EOL;
    echo 'Seleção de perfil:', PHP_EOL, PHP_EOL;
    $perfis = [
        0 => 'Câmara',
        1 => 'RPPS',
        2 => 'Prefeitura',
        3 => 'Agrupado (CM + RPPS + PM)'
    ];
    foreach ($perfis as $i => $label) {
        echo $i, "\t", $label, PHP_EOL;
    }
    echo 'Selecione um perfil: ';
    $perfil = (int) fgets(STDIN);
//    $perfil = 3;
    switch ($perfil) {
        case 0:
            $entidades = ['cm'];
            $selecao = true;
            break;
        case 1:
            $entidades = ['fpsm'];
            $selecao = true;
            break;
        case 2:
            $entidades = ['pm'];
            $selecao = true;
            break;
        case 3:
            $entidades = ['cm', 'fpsm', 'pm'];
            $selecao = true;
            break;
        default :
            $selecao = false;
    }
} while ($selecao === false);

echo PHP_EOL, '================================================================================', PHP_EOL, PHP_EOL;
echo 'Selecione a competência:', PHP_EOL, PHP_EOL;
echo 'Ano [AAAA]: ';
$ano = (int) fgets(STDIN);
//$ano = 2024;
echo 'Mês [1 ~ 12]: ';
$mes = (int) fgets(STDIN);
//$mes = '2';
$remessa = (int) ($ano . str_pad($mes, 2, '0', STR_PAD_LEFT));

echo PHP_EOL, '================================================================================', PHP_EOL, PHP_EOL;
echo 'Selecione o teste desejado (ou ENTER pra todos):', PHP_EOL;
$teste = trim(fgets(STDIN));
//$teste = '';

if($teste === ''){
    $teste = null;
}else{
    $teste = (int) $teste;
}

echo PHP_EOL, '================================================================================', PHP_EOL;
echo 'Iniciando os testes', PHP_EOL;
echo '================================================================================', PHP_EOL, PHP_EOL;

switch ($perfil) {
    case 0:
        require 'perfil/cm.php';
        break;
    case 1:
        require 'perfil/rpps.php';
        break;
    case 2:
        require 'perfil/pm.php';
        break;
    case 3:
        require 'perfil/agregado.php';
        break;
}
