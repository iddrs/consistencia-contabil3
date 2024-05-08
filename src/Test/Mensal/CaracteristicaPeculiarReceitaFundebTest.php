<?php

namespace App\Test\Mensal;

use App\TestBase;
use App\DB;

class CaracteristicaPeculiarReceitaFundebTest extends TestBase {
    
    private \PgSql\Result $resultEsquerdo;
    private \PgSql\Result $resultDireito;
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Características Peculiares da Receita do Fundeb';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT NATUREZA_RECEITA
                FROM PAD.BAL_REC
                WHERE REMESSA = %d
                    AND ENTIDADE IN (%s)
                    AND TIPO_NIVEL_RECEITA like 'A'
                    AND CODIGO_RECEITA like '9%%'
                    AND CARACTERISTICA_PECULIAR_RECEITA = 105
                    AND NATUREZA_RECEITA not like '17115111%%'
                    AND NATUREZA_RECEITA not like '17115201%%'
                    AND NATUREZA_RECEITA not like '17215001%%'
                    AND NATUREZA_RECEITA not like '17215101%%'
                    AND NATUREZA_RECEITA not like '17215201%%'"
        ;
        $query = sprintf($sql, $this->remessa, $this->entidadesIn);
        $this->resultEsquerdo = DB::query($query);
        if($this->resultEsquerdo === false){
                trigger_error("Erro ao executar [$query]", E_USER_ERROR);
        }
        $this->valorEsquerdo[$query] = pg_num_rows($this->resultEsquerdo);
        $this->resumo['valor_esquerdo'] += pg_num_rows($this->resultEsquerdo);
        $this->resumo['diferenca'] += pg_num_rows($this->resultEsquerdo);
        
                
        $this->valorDireito[$query] = 0;
        $this->resumo['valor_direito'] += 0;
        $this->resumo['diferenca'] += 0;
    }
    
    public function showResult(): void {
        echo PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
        echo $this->getTestName(), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'RECEITAS COM CP DO FUNDEB INDEVIDA:', PHP_EOL;
        echo '....................................................................................................', PHP_EOL;
        foreach (pg_fetch_all($this->resultEsquerdo, PGSQL_ASSOC) as $nro){
            echo "\t->\t", $this->formataNRO($nro['NATUREZA_RECEITA']), PHP_EOL;
        }
        echo '....................................................................................................', PHP_EOL;
        echo 'Total das receitas com CP do Fundeb Indevida: ', number_format($this->resumo['valor_esquerdo'], 0, ',', '.'), PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
    }
    
    private function formataNRO(string $nro): string {
        $n1 = $nro[0];
        $n2 = $nro[1];
        $n3 = $nro[2];
        $n4 = $nro[3];
        $n5 = $nro[4].$nro[5];
        $n6 = $nro[6];
        $n7 = $nro[7];
        $n8 = $nro[8].$nro[9];
        $n9 = $nro[10].$nro[11];
        $n10 = $nro[12].$nro[13].$nro[14];
        return sprintf('%s.%s.%s.%s.%s.%s.%s.%s.%s.%s', $n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8, $n9, $n10);
    }
}
