<?php

namespace App\Test\Mensal;

use App\TestBase;

class DdrUtilizadaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'DDR utilizada';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82114%');
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6221304%');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6314%');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6322%');
        
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '113%');
        
        $sql = "SELECT SUM(MOVIMENTO_CREDOR * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1192101%');
        
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2188%');
        
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '218810499%');
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '3511%');

        // Necessário para considerar os estornos de extra-orçamentário.
        $sql = "SELECT SUM(MOVIMENTO_DEVEDOR * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82114020869%');
        
        $this->execute($esquerdo, $direito);
    }
}
