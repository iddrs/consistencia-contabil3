<?php

namespace App\Test\Mensal;

use App\TestBase;

class PrevisaoInicialDeducaoRenunciaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Previsão inicial da dedução de renúncia de receita';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5211202%');
        
        $sql = "SELECT SUM(RECEITA_ORCADA)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A' AND CARACTERISTICA_PECULIAR_RECEITA = %d";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 101);
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 103);
                
        $this->execute($esquerdo, $direito);
    }
}
