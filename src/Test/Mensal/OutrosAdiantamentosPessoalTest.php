<?php

namespace App\Test\Mensal;

use App\TestBase;

class OutrosAdiantamentosPessoalTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Conta extra de outros adiantamentos a pessoal com saldo zero';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '113110199%');
                
        $direito[] = 'select 0';
                
        $this->execute($esquerdo, $direito);
    }
}
