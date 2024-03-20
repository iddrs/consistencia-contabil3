<?php

namespace App\Test\Mensal;

use App\TestBase;

class DdrDisponivelTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'DDR disponível';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82111%');
        
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1%');
        
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '21%');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '22%');
        
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82112%');
                
        $this->execute($esquerdo, $direito);
    }
}
