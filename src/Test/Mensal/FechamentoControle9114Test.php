<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoControle9114Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas de controle [7/8].9.1.1.4';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '79114%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '89114%');
                
        $this->execute($esquerdo, $direito);
    }
}