<?php

namespace App\Test\Mensal;

use App\TestBase;

class AspsFrCoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'FR do ASPS x CO 1002';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $ano = (int) substr($this->remessa, 0, 4);
        $sql = "SELECT SUM(VALOR_EMPENHO)::DECIMAL
        FROM PAD.EMPENHO
        WHERE REMESSA = %d
            AND ENTIDADE IN (%s)
            AND CODIGO_ACOMPANHAMENTO_ORCAMENTARIO = 1002
            AND (FUNCAO != 10
                OR (FUNCAO = 10
                    AND FONTE_RECURSO NOT IN (500, 502)))";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, $ano);
        
        $direito[] = 'select 0';
                
        $this->execute($esquerdo, $direito);
    }
}
