<?php

namespace App\Test\Mensal;

use App\TestBase;

class RestosAPagarNaoProcessadosALiquidarTest extends TestBase{
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Restos a Pagar Não Processados a liquidar';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6311%');
        
        $direito[] = sprintf("SELECT SUM(SALDO_INICIAL_NAO_PROCESSADO)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(RP_LIQUIDADO * -1)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(NAO_PROCESSADO_CANCELADO * -1)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
