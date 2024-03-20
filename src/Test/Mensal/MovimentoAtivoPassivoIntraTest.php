<?php

namespace App\Test\Mensal;

use App\TestBase;

class MovimentoAtivoPassivoIntraTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Movimentação intra-OFSS do ativo e passivo';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1___2%');
                
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '21__2%');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '22__2%');
                
        $this->execute($esquerdo, $direito);
    }
}
