<?php

namespace App\Test\Mensal;

use App\TestBase;

class ConsorcioModalidade71CredorTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Modalidade de Aplicação 71 e credores de consórcios';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $ano = (int) substr($this->remessa, 0, 4);
        $sql = "SELECT SUM(VALOR_EMPENHO)::DECIMAL
                FROM PAD.EMPENHO
                WHERE REMESSA = %d
                    AND ENTIDADE IN (%s)
                    AND ANO_EMPENHO = %d
                    AND RUBRICA LIKE '__71%%'
                    AND CREDOR NOT IN (451, 8283)";
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
