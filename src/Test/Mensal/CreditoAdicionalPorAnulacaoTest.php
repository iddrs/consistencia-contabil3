<?php

namespace App\Test\Mensal;

use App\TestBase;

class CreditoAdicionalPorAnulacaoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Crédito adicional por fonte: anulação de dotação';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $esquerdo[] = sprintf("SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '5221303%');
        
        $direito[] = sprintf("SELECT SUM(VALOR_CREDITO_ADICIONAL)::DECIMAL FROM PAD.DECRETO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND ORIGEM_RECURSO IN (5, 6)", $this->remessa, $this->entidadesIn);
        
        $this->execute($esquerdo, $direito);
    }
}
