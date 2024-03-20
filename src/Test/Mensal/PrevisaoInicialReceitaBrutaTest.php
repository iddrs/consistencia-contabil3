<?php

namespace App\Test\Mensal;

use App\TestBase;

class PrevisaoInicialReceitaBrutaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Previsão inicial da receita bruta';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '52111%');
        
        $direito[] = sprintf("SELECT SUM(RECEITA_ORCADA)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A' AND CARACTERISTICA_PECULIAR_RECEITA = 0", $this->remessa, $this->entidadesIn);
                
        $this->execute($esquerdo, $direito);
    }
}
