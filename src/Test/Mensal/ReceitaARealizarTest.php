<?php

namespace App\Test\Mensal;

use App\TestBase;

class ReceitaARealizarTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Receita a realizar';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6211%');
        
        $direito[] = sprintf("SELECT SUM(A_ARRECADAR_ATUALIZADO)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A'", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
