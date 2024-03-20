<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoContasOrcamentariasTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento da movimentação das contas de natureza orçamentária';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(VALOR_LANCAMENTO)::DECIMAL FROM PAD.TCE_4111 WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND TIPO_LANCAMENTO LIKE '%s'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5%', 'D');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6%', 'D');
        
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '6%', 'C');
                
        $this->execute($esquerdo, $direito);
    }
}
