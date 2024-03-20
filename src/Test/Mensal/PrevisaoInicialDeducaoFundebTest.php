<?php

namespace App\Test\Mensal;

use App\TestBase;

class PrevisaoInicialDeducaoFundebTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Previsão inicial da dedução para o Fundeb';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '521120101%');
        
        $direito[] = sprintf("SELECT SUM(RECEITA_ORCADA)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A' AND CARACTERISTICA_PECULIAR_RECEITA = %d", $this->remessa, $this->entidadesIn, 105);
                
        $this->execute($esquerdo, $direito);
    }
}
