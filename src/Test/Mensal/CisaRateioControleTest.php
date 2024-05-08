<?php

namespace App\Test\Mensal;

use App\TestBase;

class CisaRateioControleTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'CISA: pagamento de rateio vs conta de controle';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $ano = (int) substr($this->remessa, 0, 4);
        $data_inicial = "$ano-01-01";
        $data_final = self::getLastDayFromRemessa($this->remessa);
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8531006%');
                
        $direito[] = sprintf("SELECT SUM(VALOR_PAGAMENTO)::DECIMAL FROM PAD.PAGAMENTO WHERE REMESSA = %d AND RUBRICA LIKE '%s' AND DATA_PAGAMENTO BETWEEN '%s' AND '%s' AND CREDOR = %d", $this->remessa, '__71%', $data_inicial, $data_final, 8283);
                
        $this->execute($esquerdo, $direito);
    }

    private static function getLastDayFromRemessa(int $remessa): string {
        $dt = date_create_from_format('Ym', $remessa);
        $dt->modify('last day of this month');
        return $dt->format('Y-m-d');
    }
}
