<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoControle9125Test extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento das contas de controle [7/8].9.1.2.5';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '79125%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '89125%');
                
        $this->execute($esquerdo, $direito);
    }
}