<?php

namespace App\Test\Mensal;

use App\TestBase;

class DeducaoOutrasRealizadaTest extends TestBase {
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Dedução por outros motivos realizada';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        
        $esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '62139%');
        
        $sql = "SELECT SUM(RECEITA_REALIZADA * -1)::DECIMAL FROM PAD.BAL_REC WHERE REMESSA = %d AND ENTIDADE IN (%s) AND TIPO_NIVEL_RECEITA LIKE 'A' AND CARACTERISTICA_PECULIAR_RECEITA = %d";
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 102);
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 106);
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 107);
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 108);
        $direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, 109);
                
        $this->execute($esquerdo, $direito);
    }
}
