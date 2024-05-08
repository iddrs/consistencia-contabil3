<?php

namespace App\Test\Mensal;

use App\TestBase;

class ContribuicaoPrevidenciariaRppsAReceberServidorTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Contribuição previdenciária do servidor a receber pelo RPPS';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '113620102%');
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, '21882010101%');
                
        $this->execute($esquerdo, $direito);
    }
}
