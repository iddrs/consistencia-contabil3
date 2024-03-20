<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoContasControleTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento da movimentação das contas de natureza de controle';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(VALOR_LANCAMENTO)::DECIMAL FROM PAD.TCE_4111 WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND TIPO_LANCAMENTO LIKE '%s'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '7%', 'D');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8%', 'D');
        
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '7%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '8%', 'C');
        
        $this->execute($esquerdo, $direito);
    }
}
