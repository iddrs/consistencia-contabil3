<?php

namespace App\Test\Mensal;

use App\TestBase;

class DdrUtilizadaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'DDR utilizada';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        /*
         * Este teste tem gerado diferença no executivo em virtude estornos de receita e despesa extra que não estão sendo capturados pelo teste adequadamente.
         * 
         * Aparentemente, o estorno está sendo contabilizado duplamente pelo teste, mas revisando os lançamentos contábeis, parece tudo certo.
         * 
         * Concluo provisoriamente que isso se deve a incapacidade de isolar esses lançamentos durante o teste.
         * 
         * Como é uma conta que será zerada no encerramento, opto por deixar como está, tendo em vista que esses estornos são bastante esporádicos.
         * 
         */
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82114%');
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6221304%');//empenhos pagos
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6314%');//rpnp pagos
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6322%');//rpp pagos
        
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '113%');//receita extra recebida
        
        $sql = "SELECT SUM(MOVIMENTO_CREDOR * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1192101%');//rendimentos do legislativo
        
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2188%');//despesa extra paga
        
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '218810499%');//rendimentos do legislativo
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '3511%');// transf financeira concedida

        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '361710802%');//perdas de investimentos do rpps sem execução orçamentária

        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '361719902%');//perdas de investimentos sem execução orçamentária

        // Necessário para considerar os estornos de despesa extra-orçamentária.
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82114020869%');
        
        $this->execute($esquerdo, $direito);
    }
}
