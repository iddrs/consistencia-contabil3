<?php

namespace App\Test\Mensal;

use App\TestBase;

class ContribuicaoPrevidenciariaRppsAReceberPatronalNormalTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Contribuição previdenciária patronal normal a receber pelo RPPS';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $ano = (int) substr($this->remessa, 0, 4);
        $mes  = substr($this->remessa, 4, 5);
        $data_inicial = "$ano-01-01";
        $data_final = self::getLastDayFromRemessa($this->remessa);
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '11362010101%');
                
        $direito[] = sprintf("SELECT SUM(VALOR_LIQUIDACAO)::DECIMAL FROM PAD.LIQUIDACAO WHERE REMESSA = %d AND RUBRICA LIKE '%s' AND DATA_LIQUIDACAO BETWEEN '%s' AND '%s'", $this->remessa, '31911308%', $data_inicial, $data_final);
        $direito[] = sprintf("SELECT SUM(VALOR_PAGAMENTO)::DECIMAL * -1 FROM PAD.PAGAMENTO WHERE REMESSA = %d AND RUBRICA LIKE '%s' AND DATA_PAGAMENTO BETWEEN '%s' AND '%s'", $this->remessa, '31911308%', $data_inicial, $data_final);
        $direito[] = sprintf("SELECT SUM(VALOR_LIQUIDACAO)::DECIMAL FROM PAD.LIQUIDACAO WHERE REMESSA = %d AND RUBRICA LIKE '%s' AND DATA_LIQUIDACAO BETWEEN '%s' AND '%s'", $this->remessa, '31911310%', $data_inicial, $data_final);
        $direito[] = sprintf("SELECT SUM(VALOR_PAGAMENTO)::DECIMAL * -1 FROM PAD.PAGAMENTO WHERE REMESSA = %d AND RUBRICA LIKE '%s' AND DATA_PAGAMENTO BETWEEN '%s' AND '%s'", $this->remessa, '31911310%', $data_inicial, $data_final);
                
        $this->execute($esquerdo, $direito);
    }

    private static function getLastDayFromRemessa(int $remessa): string {
        $dt = date_create_from_format('Ym', $remessa);
        $dt->modify('last day of this month');
        return $dt->format('Y-m-d');
    }
}
