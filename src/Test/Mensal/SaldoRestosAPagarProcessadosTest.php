<?php

namespace App\Test\Mensal;

use App\TestBase;

class SaldoRestosAPagarProcessadosTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Saldo de Restos a Pagar Processados';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6321%');
        
        $direito[] = sprintf("SELECT SUM(SALDO_FINAL_PROCESSADO)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(RP_LIQUIDADO * -1)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(NAO_PROCESSADO_PAGO)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
