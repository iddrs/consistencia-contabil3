<?php

namespace App\Test\Mensal;

use App\TestBase;

class CreditoEspecialReabertoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Crédito especial reaberto';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $esquerdo[] = sprintf("SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '522120202%');
        
        $direito[] = sprintf("SELECT SUM(VALOR_SALDO_REABERTO)::DECIMAL FROM PAD.DECRETO WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
        
        $this->execute($esquerdo, $direito);
    }
}
