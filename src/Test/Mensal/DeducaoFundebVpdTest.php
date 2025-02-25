<?php

namespace App\Test\Mensal;

use App\TestBase;

class DeducaoFundebRealizadaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Dedução para o Fundeb realizada';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6213101%');
        
        $direito[] = sprintf("SELECT SUM(RECEITA_REALIZADA * -1)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A' AND CARACTERISTICA_PECULIAR_RECEITA = %d", $this->remessa, $this->entidadesIn, 105);
                
        $this->execute($esquerdo, $direito);
    }
}
