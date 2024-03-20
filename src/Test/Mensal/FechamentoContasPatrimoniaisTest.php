<?php

namespace App\Test\Mensal;

use App\TestBase;

class FechamentoContasPatrimoniaisTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Fechamento da movimentação das contas de natureza patrimonial';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(VALOR_LANCAMENTO)::DECIMAL FROM PAD.TCE_4111 WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND TIPO_LANCAMENTO LIKE '%s'";
        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1%', 'D');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2%', 'D');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '3%', 'D');
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '4%', 'D');
        
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '2%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '3%', 'C');
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '4%', 'C');
        
        $this->execute($esquerdo, $direito);
    }
}
