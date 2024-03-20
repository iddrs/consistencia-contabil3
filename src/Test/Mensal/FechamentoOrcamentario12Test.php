<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoOrcamentario12Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas orçamentárias [5/6].1.2';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '512%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '612%');
                
        $this->execute($esquerdo, $direito);
    }
}
