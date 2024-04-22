<?php

$tester = new \App\Tester($remessa, $entidades);
$tester->setIndexOfTest($teste);

$tester
        ->addTest(new App\Test\Mensal\FechamentoContasPatrimoniaisTest($remessa, $entidades))
        ->addTest(new App\Test\Mensal\FechamentoContasOrcamentariasTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoContasControleTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\SuprimentoDeFundosAApropriarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\ParceriasAApropriarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\PrecatoriosCurtoPrazoAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\ContribuicaoPrevidenciariaAoRgpsAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FgtsAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\PassivoRestosAPagarProcessadosTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\SaldoRestosAPagarProcessadosTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\PasepAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DotacaoInicialTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoSuplementarAbertoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoEspecialAbertoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoExtraordinarioAbertoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\AnulacaoDotacaoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\EmissaoEmpenhosTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosInscritosUltimoAnoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosInscritosAnosAnterioresTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosInscritosNoExercicioTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\SaldoInicialRestosAPagarNaoProcessadosInscritosNoExercicioTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarProcessadosInscritosUltimoAnoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarProcessadosInscritosAnosAnterioresTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarProcessadosInscritosNoExercicioTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\SaldoInicialRestosAPagarProcessadosInscritosNoExercicioTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoEmpenhadoALiquidarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoDisponivelTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\EmpenhosALiquidarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoLiquidadoAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\EmpenhadoLiquidadoAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoPagoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\EmpenhadoPagoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosALiquidarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosLiquidadoAPagarTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosPagoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarNaoProcessadosCanceladoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarProcessadosPagoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\RestosAPagarProcessadosCanceladoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario11Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario12Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario21Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario221Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario222Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario223Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario229Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario31Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoOrcamentario32Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111103Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111104Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111201Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111202Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111203Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111204Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111301Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111302Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111303Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111304Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111401Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111402Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111403Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111404Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111501Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111502Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111503Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle111504Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle112101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle112102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle112199Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113103Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113104Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113105Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113108Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113112Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113113Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle113199Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1141Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1142Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1143Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1144Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1145Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle119101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle119102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle119103Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle119104Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle119105Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121103Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121104Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121201Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121202Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121203Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121204Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121301Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121302Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121303Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121304Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121401Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121402Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121403Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121404Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121501Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121502Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121503Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle121504Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle122101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle122102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle122199Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123103Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123104Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123105Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123106Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123107Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123108Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123109Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123110Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123111Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123112Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123113Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle123199Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1241Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1242Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1243Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1244Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1245Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle129101Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle129102Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1292Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle1293Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle21Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle22Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle23Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle24Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle31Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle32Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4111Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4112Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4113Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4114Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4115Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4119Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4211Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4212Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4213Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle4214Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle52Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle531Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle532Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle533Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle534Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle535Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle536Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle537Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle611Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle612Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle613Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle619Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle62Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle631Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle632Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle633Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle8Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9111Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9112Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9113Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9114Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9115Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9119Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9121Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9122Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9124Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9125Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle912901Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle925Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle926Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle929Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9991Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9992Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9993Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9994Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\FechamentoControle9995Test($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DisponibilidadesTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\ResultadoFinanceiroTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\ResultadoPeriodoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\SituacaoFinanceiraOrcamentariaTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DdrDisponivelTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DdrComprometidaEmpenhoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DdrComprometidaLiquidacaoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\DdrUtilizadaTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoAdicionalPorAnulacaoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoEspecialReabertoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoAdicionalPorExcessoArrecadacaoTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoAdicionalPorReaberturaTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\CreditoAdicionalPorSuperavitTest($remessa, $entidades))
        ->addTest(new \App\Test\Mensal\SaldoInvertidoTest($remessa, $entidades))
;

$tester->execute();
