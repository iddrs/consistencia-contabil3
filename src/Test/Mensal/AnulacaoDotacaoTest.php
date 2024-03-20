<?php

namespace App\Test\Mensal;

use App\TestBase;

class AnulacaoDotacaoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Anulação de dotações';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5221904%');
        
        $direito[] = sprintf("SELECT SUM(REDUCAO_DOTACAO)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
