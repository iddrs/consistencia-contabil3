<?php

namespace App\Test\Mensal;

use App\TestBase;

class RestosAPagarProcessadosInscritosAnosAnterioresTest extends TestBase{
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Restos a Pagar Processados inscritos em anos anteriores';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5322%');
        
        $direito[] = sprintf("SELECT SUM(saldo_PROCESSADO_INSCRITOS_EXERCICIOS_ANTERIORES)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
