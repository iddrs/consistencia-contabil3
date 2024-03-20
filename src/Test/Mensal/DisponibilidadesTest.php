<?php

namespace App\Test\Mensal;

use App\TestBase;

class DisponibilidadesTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Disponibilidades: Ativo x Controle';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '7211%');
        
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82114%');
                
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '111%');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '114%');
                
        $this->execute($esquerdo, $direito);
    }
}
