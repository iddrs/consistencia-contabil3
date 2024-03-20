<?php

namespace App\Test\Mensal;

use App\TestBase;

class CreditoAdicionalPorReducaoEmOutraEntidadeTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Crédito adicional por redução em outra entidade';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $esquerdo[] = sprintf("SELECT SUM(VALOR_CREDITO_ADICIONAL)::DECIMAL FROM PAD.DECRETO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND ORIGEM_RECURSO = 6", $this->remessa, $this->entidadesIn);
        
        $direito[] = sprintf("SELECT SUM(VALOR_REDUCAO_DOTACAO)::DECIMAL FROM PAD.DECRETO WHERE REMESSA = %d AND ENTIDADE IN (%s) AND ORIGEM_RECURSO = 6", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
