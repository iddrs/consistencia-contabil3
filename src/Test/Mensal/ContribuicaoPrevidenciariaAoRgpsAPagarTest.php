<?php

namespace App\Test\Mensal;

use App\TestBase;

class ContribuicaoPrevidenciariaAoRgpsAPagarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Contribuição previdenciária ao RGPS a pagar: passivo x despesa';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2114301%', 'C');
        
        $direito[] = sprintf("SELECT SUM(VALOR_LIQUIDACAO)::DECIMAL FROM PAD.LIQUIDACAO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND RUBRICA LIKE '%s'", $this->remessa, $this->entidadesIn, '31901302%');
        $direito[] = sprintf("SELECT SUM(VALOR_PAGAMENTO * -1)::DECIMAL FROM PAD.PAGAMENTO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND RUBRICA LIKE '%s'", $this->remessa, $this->entidadesIn, '31901302%');
        $direito[] = sprintf("SELECT SUM(VALOR_LIQUIDACAO)::DECIMAL FROM PAD.LIQUIDACAO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND RUBRICA LIKE '%s'", $this->remessa, $this->entidadesIn, '339004718%');
        $direito[] = sprintf("SELECT SUM(VALOR_PAGAMENTO * -1)::DECIMAL FROM PAD.PAGAMENTO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND RUBRICA LIKE '%s'", $this->remessa, $this->entidadesIn, '339004720%');
        
        $this->execute($esquerdo, $direito);
    }
}
