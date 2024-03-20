<?php

$tester = new \App\Tester($remessa, $entidades);
$tester->setIndexOfTest($teste);

$tester
        ->addTest(new \App\Test\Mensal\ReceitaDespesaIntraTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\MovimentoAtivoPassivoIntraTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\MovimentoVpaVpdIntraTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\ContribuicaoPrevidenciariaRppsAReceberTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoAdicionalPorReducaoEmOutraEntidadeTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\AtivoPassivoCurtoPrazoParcelamentoRppsTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\AtivoPassivoLongoPrazoParcelamentoRppsTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\AtivoPassivoDuodecimoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\VpaVpdDuodecimoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DuodecimoRepasseTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DuodecimoDesincorporacaoTest($remessa, $entidades))
;

$tester->execute();
