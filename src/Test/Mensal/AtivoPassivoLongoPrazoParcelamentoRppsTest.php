<?php

namespace App\Test\Mensal;

use App\TestBase;

class AtivoPassivoLongoPrazoParcelamentoRppsTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Parcelamento do Executivo com o FPSM: ativos e passivos de longo prazo';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE LIKE '%s' AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, 'fpsm', '12112060401%');
                
        $direito[] = sprintf($sql, $this->remessa, 'pm', '2214201%');
                
        $this->execute($esquerdo, $direito);
    }
}
