<?php

namespace App\Test\Mensal;

use App\TestBase;

class RestosAPagarNaoProcessadosInscritosUltimoAnoTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Restos a Pagar Não Processados inscritos no último ano';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5311%');
        
        $direito[] = sprintf("SELECT SUM(NAO_PROCESSADO_INSCRITOS_ULTIMO_EXERCICIO)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
