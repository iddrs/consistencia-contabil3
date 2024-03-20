<?php

namespace App\Test\Mensal;

use App\TestBase;

class CreditoLiquidadoAPagarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Crédito liquidado a pagar';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6221303%');
        
        $direito[] = sprintf("SELECT SUM(LIQUIDADO_A_PAGAR)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
