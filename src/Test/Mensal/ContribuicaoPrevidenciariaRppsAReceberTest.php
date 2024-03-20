<?php

namespace App\Test\Mensal;

use App\TestBase;

class ContribuicaoPrevidenciariaRppsAReceberTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Contribuição previdenciária a receber pelo RPPS';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1136201%');
                
        $direito[] = sprintf("SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '21882%');
        $direito[] = sprintf("SELECT SUM(LIQUIDADO_A_PAGAR)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s) AND ELEMENTO LIKE '%s'", $this->remessa, $this->entidadesIn, '319113%');
                
        $this->execute($esquerdo, $direito);
    }
}
