<?php

namespace App\Test\Mensal;

use App\TestBase;

class DuodecimoRepasseTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Duodecimo: repasses';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE LIKE '%s' AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, 'pm', '3511202%');
                
        $direito[] = sprintf($sql, $this->remessa, 'cm', '4511202%');
                
        $this->execute($esquerdo, $direito);
    }
}
