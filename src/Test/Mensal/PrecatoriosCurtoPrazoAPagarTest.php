<?php

namespace App\Test\Mensal;

use App\TestBase;

class PrecatoriosCurtoPrazoAPagarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Precatórios de curto prazo a pagar: passivo x controle';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2111105%', 'C');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2131108%', 'C');
        
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8990001%', 'C');
        
        $this->execute($esquerdo, $direito);
    }
}
