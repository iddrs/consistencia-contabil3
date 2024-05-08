<?php

namespace App\Test\Mensal;

use App\TestBase;

class FrReceitasImpostosTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Receitas de impostos com fonte de recursos 500';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT NATUREZA_RECEITA
                FROM PAD.BAL_REC
                WHERE REMESSA = %d
                    AND ENTIDADE IN (%s)
                    AND NATUREZA_RECEITA NOT LIKE '111%%'
                    AND NATUREZA_RECEITA NOT LIKE '1711%%'
                    AND NATUREZA_RECEITA NOT LIKE '1721%%'
                    AND NATUREZA_RECEITA NOT LIKE '1321%%'
                    AND TIPO_NIVEL_RECEITA LIKE 'A'
                    AND FONTE_RECURSO IN (500, 502)";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn);
        
        $direito[] = 'SELECT 0';
                
        $this->execute($esquerdo, $direito);
    }
}
