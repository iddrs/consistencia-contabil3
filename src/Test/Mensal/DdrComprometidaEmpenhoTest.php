<?php

namespace App\Test\Mensal;

use App\TestBase;

class DdrComprometidaEmpenhoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'DDR comprometida por empenhos';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82112%');
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6221301%');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6311%');
        
        $this->execute($esquerdo, $direito);
    }
}
