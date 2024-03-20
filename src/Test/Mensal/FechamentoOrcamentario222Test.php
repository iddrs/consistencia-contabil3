<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoOrcamentario222Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas orçamentárias [5/6].2.2.2';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5222%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6222%');
                
        $this->execute($esquerdo, $direito);
    }
}
