<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoControle113104Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas de controle [7/8].1.1.3.1.04';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '7113104%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8113104%');
                
        $this->execute($esquerdo, $direito);
    }
}
