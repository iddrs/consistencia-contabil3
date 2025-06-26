<?php

namespace App\Test\Mensal;

use App\TestBase;

class SuprimentoDeFundosAApropriarTest extends TestBase
{

    public function __construct(int $remessa, array $entidades)
    {
        $testName = 'Suprimentos de fundos a apropriar: ativo x controle';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void
    {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";

        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1131102%', 'D');

        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8912101%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8912105%', 'C');

        $this->execute($esquerdo, $direito);
    }
}
