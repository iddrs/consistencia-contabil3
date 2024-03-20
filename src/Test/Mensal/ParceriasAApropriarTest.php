<?php

namespace App\Test\Mensal;

use App\TestBase;

class ParceriasAApropriarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Parcerias a apropriar: ativo x controle';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1198101%', 'D');
        
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '812210102%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '812210103%', 'C');
        
        $this->execute($esquerdo, $direito);
    }
}
