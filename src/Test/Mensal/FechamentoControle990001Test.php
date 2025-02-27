<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoControle990001Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas de controle [7/8].9.9.0.0.01';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '7990001%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8990001%');
                
        $this->execute($esquerdo, $direito);
    }
}
