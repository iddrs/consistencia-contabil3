<?php

namespace App\Test\Mensal;

use App\TestBase;

class CreditoEmpenhadoALiquidarTest extends TestBase
{

    public function __construct(int $remessa, array $entidades)
    {
        $testName = 'Crédito empenhado a liquidar';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void
    {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6221301%');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6221305%');

        $direito[] = sprintf("SELECT SUM(EMPENHADO_A_LIQUIDAR)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);

        $this->execute($esquerdo, $direito);
    }
}
