<?php

namespace App\Test\Mensal;

use App\TestBase;

class SaldoPLIntraTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Saldo do Patrimônio Líquido Intra-OFSS';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '23712%%' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn);
                
        $direito[] = 'SELECT 0.0';
                
        $this->execute($esquerdo, $direito);
    }
}
