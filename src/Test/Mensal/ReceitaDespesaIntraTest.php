<?php

namespace App\Test\Mensal;

use App\TestBase;

class ReceitaDespesaIntraTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Receita x Despesa: intra-orçamentária';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(RECEITA_REALIZADA)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CATEGORIA_RECEITA LIKE 'intra' AND TIPO_NIVEL_RECEITA LIKE 'A'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn);
        
        $direito[] = sprintf("SELECT SUM(VALOR_PAGO)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s) AND ELEMENTO LIKE '%s'", $this->remessa, $this->entidadesIn, '__91%');
                
        $this->execute($esquerdo, $direito);
    }
}
