<?php

namespace App\Test\Mensal;

use App\TestBase;

class CreditoDisponivelTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Crédito disponível';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '62211%');
        
        $direito[] = sprintf("SELECT SUM(SALDO_A_EMPENHAR)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
