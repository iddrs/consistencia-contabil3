<?php

namespace App\Test\Mensal;

use App\TestBase;

class SituacaoFinanceiraOrcamentariaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Situação financeira x situação orçamentária';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82111%');
        
        $direito[] = sprintf("SELECT SUM(SALDO_INICIAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'", $this->remessa, $this->entidadesIn, '1%');
        $direito[] = sprintf("SELECT SUM(SALDO_INICIAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'", $this->remessa, $this->entidadesIn, '21%');
        $direito[] = sprintf("SELECT SUM(SALDO_INICIAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'", $this->remessa, $this->entidadesIn, '22%');
        $direito[] = sprintf("SELECT SUM(SALDO_INICIAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '82112%');
        $direito[] = sprintf("SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '4511%');
        $direito[] = sprintf("SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '451220103%');
        $direito[] = sprintf("SELECT SUM(RECEITA_REALIZADA)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A'", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(VALOR_EMPENHADO * -1)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
        $direito[] = sprintf("SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '3511%');
        $direito[] = sprintf("SELECT SUM(RP_CANCELADO)::DECIMAL FROM PAD.RESTOS_PAGAR WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn, '3511%');
        $direito[] = sprintf("SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '361710802%');
        $direito[] = sprintf("SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'", $this->remessa, $this->entidadesIn, '361719902%');
               
        $this->execute($esquerdo, $direito);
    }
}
