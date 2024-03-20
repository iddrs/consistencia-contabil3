<?php

namespace App\Test\Mensal;

use App\TestBase;

class EmpenhadoPagoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Empenhado pago';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '622920104%');
        
        $direito[] = sprintf("SELECT SUM(VALOR_PAGO)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
