<?php

namespace App\Test\Mensal;

use App\TestBase;

class ReestimativaReceitaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Reestimativa da receita';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5212101%');
        
        $direito[] = sprintf("SELECT SUM(PREVISAO_ATUALIZADA)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A'", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(RECEITA_ORCADA * -1)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A'", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
