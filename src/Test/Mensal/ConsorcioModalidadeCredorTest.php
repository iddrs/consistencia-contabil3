<?php

namespace App\Test\Mensal;

use App\TestBase;

class ConsorcioModalidadeCredorTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Credores de consórcio apenas com modalidades 71 e 93';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $ano = (int) substr($this->remessa, 0, 4);
        $sql = "SELECT SUM(VALOR_EMPENHO)::DECIMAL
                FROM PAD.EMPENHO
                WHERE REMESSA = %d
                    AND ENTIDADE IN (%s)
                    AND ANO_EMPENHO = %d
                    AND (RUBRICA NOT LIKE '__71%%' OR RUBRICA NOT LIKE '__93%%')
                    AND CREDOR IN (451, 912, 8283)";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, $ano);
                
        $direito[] = 'select 0';
                
        $this->execute($esquerdo, $direito);
    }

    private static function getLastDayFromRemessa(int $remessa): string {
        $dt = date_create_from_format('Ym', $remessa);
        $dt->modify('last day of this month');
        return $dt->format('Y-m-d');
    }
}
