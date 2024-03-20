<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoControle121101Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas de controle [7/8].1.2.1.1.01';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '7121101%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8121101%');
                
        $this->execute($esquerdo, $direito);
    }
}
