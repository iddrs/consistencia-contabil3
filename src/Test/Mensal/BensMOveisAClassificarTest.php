<?php

namespace App\Test\Mensal;

use App\TestBase;

class BensMoveisAClassificarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Conta de bens móveis a classificar com saldo zero';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '123119908%');
                
        $direito[] = 'select 0';
                
        $this->execute($esquerdo, $direito);
    }
}
