<?php

namespace App\Test\Mensal;

use App\TestBase;

class DuodecimoDesincorporacaoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Duodecimo: desincorporação de VPA e VPD';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE LIKE '%s' AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, 'cm', '3651203%');
                
        $direito[] = sprintf($sql, $this->remessa, 'pm', '4641203%');
                
        $this->execute($esquerdo, $direito);
    }
}
