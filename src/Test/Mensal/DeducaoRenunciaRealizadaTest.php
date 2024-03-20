<?php

namespace App\Test\Mensal;

use App\TestBase;

class DeducaoRenunciaRealizadaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Dedução por renúncia de receita realizada';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '62132%');
        
        $sql = "SELECT SUM(RECEITA_REALIZADA * -1)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A' AND CARACTERISTICA_PECULIAR_RECEITA = %d";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 101);
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 103);
                
        $this->execute($esquerdo, $direito);
    }
}
