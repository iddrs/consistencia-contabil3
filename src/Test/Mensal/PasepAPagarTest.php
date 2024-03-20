<?php

namespace App\Test\Mensal;

use App\TestBase;

class PasepAPagarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'PASEP a pagar: passivo x despesa';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '214131102%', 'C');
        
        $direito[] = sprintf("SELECT SUM(VALOR_LIQUIDACAO)::DECIMAL FROM PAD.LIQUIDACAO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND RUBRICA LIKE '%s'", $this->remessa, $this->entidadesIn, '33904712%');
        $direito[] = sprintf("SELECT SUM(VALOR_PAGAMENTO * -1)::DECIMAL FROM PAD.PAGAMENTO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND RUBRICA LIKE '%s'", $this->remessa, $this->entidadesIn, '33904712%');
                
        $this->execute($esquerdo, $direito);
    }
}
