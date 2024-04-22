<?php

namespace App\Test\Mensal;

use App\TestBase;
use App\DB;

class SaldoInvertidoTest extends TestBase {
    
    private \PgSql\Result $resultEsquerdo;
    private \PgSql\Result $resultDireito;
    
    public function __construct(int $remessa, array $entidades) {
        $testName = 'Saldos invertidos';
        parent::__construct($testName, $remessa, $entidades);
    }


    public function run(): void {
        $sql = "SELECT CONTA_CONTABIL
                FROM PAD.BAL_VER
                WHERE REMESSA = %d
                        AND ENTIDADE IN (%s)
                        AND SALDO_ATUAL::numeric < 0
                        AND (CONTA_CONTABIL like '2%%'
                                OR CONTA_CONTABIL like '4%%'
                                OR CONTA_CONTABIL like '6%%'
                                OR CONTA_CONTABIL like '8%%')
                        AND NOT EXISTS
                                (SELECT CONTA_CONTABIL
                                        FROM AUXILIAR.SALDO_INVERTIDO_EXCECOES
                                        WHERE PAD.BAL_VER.CONTA_CONTABIL LIKE CONTA_CONTABIL || '%%' )
                UNION
                SELECT CONTA_CONTABIL
                FROM PAD.BAL_VER
                WHERE REMESSA = %d
                        AND ENTIDADE IN (%s)
                        AND SALDO_ATUAL::numeric > 0
                        AND CONTA_CONTABIL not like '23%%'
                        AND CONTA_CONTABIL not like '6211%%'
                        AND CONTA_CONTABIL not like '8211%%'
                        AND (CONTA_CONTABIL like '2%%'
                                OR CONTA_CONTABIL like '4%%'
                                OR CONTA_CONTABIL like '6%%'
                                OR CONTA_CONTABIL like '8%%')
                        AND EXISTS
                                (SELECT CONTA_CONTABIL
                                        FROM AUXILIAR.SALDO_INVERTIDO_EXCECOES
                                        WHERE PAD.BAL_VER.CONTA_CONTABIL LIKE CONTA_CONTABIL || '%%' )"
        ;
        $query = sprintf($sql, $this->remessa, $this->entidadesIn, $this->remessa, $this->entidadesIn);
        $this->resultEsquerdo = DB::query($query);
        if($this->resultEsquerdo === false){
            trigger_error("Erro ao executar [$query]", E_USER_ERROR);
        }
        $this->valorEsquerdo[$query] = pg_num_rows($this->resultEsquerdo);
        $this->resumo['valor_esquerdo'] += pg_num_rows($this->resultEsquerdo);
        $this->resumo['diferenca'] += pg_num_rows($this->resultEsquerdo);
        
                
        $sql = "SELECT CONTA_CONTABIL
                FROM PAD.BAL_VER
                WHERE REMESSA = %d
                        AND ENTIDADE IN (%s)
                        AND SALDO_ATUAL::numeric < 0
                        AND (CONTA_CONTABIL like '1%%'
                                OR CONTA_CONTABIL like '3%%'
                                OR CONTA_CONTABIL like '5%%'
                                OR CONTA_CONTABIL like '7%%')
                        AND NOT EXISTS
                                (SELECT CONTA_CONTABIL
                                        FROM AUXILIAR.SALDO_INVERTIDO_EXCECOES
                                        WHERE PAD.BAL_VER.CONTA_CONTABIL LIKE CONTA_CONTABIL || '%%' )
                UNION
                SELECT CONTA_CONTABIL
                FROM PAD.BAL_VER
                WHERE REMESSA = %d
                        AND ENTIDADE IN (%s)
                        AND SALDO_ATUAL::numeric > 0
                        AND CONTA_CONTABIL not like '23%%'
                        AND CONTA_CONTABIL not like '6211%%'
                        AND CONTA_CONTABIL not like '8211%%'
                        AND (CONTA_CONTABIL like '1%%'
                                OR CONTA_CONTABIL like '3%%'
                                OR CONTA_CONTABIL like '5%%'
                                OR CONTA_CONTABIL like '7%%')
                        AND EXISTS
                                (SELECT CONTA_CONTABIL
                                        FROM AUXILIAR.SALDO_INVERTIDO_EXCECOES
                                        WHERE PAD.BAL_VER.CONTA_CONTABIL LIKE CONTA_CONTABIL || '%%' )"
        ;
        $query = sprintf($sql, $this->remessa, $this->entidadesIn, $this->remessa, $this->entidadesIn);
        $this->resultDireito = DB::query($query);
        if($this->resultDireito === false){
            trigger_error("Erro ao executar [$query]", E_USER_ERROR);
        }
        $this->valorDireito[$query] = pg_num_rows($this->resultEsquerdo);
        $this->resumo['valor_direito'] += pg_num_rows($this->resultEsquerdo);
        $this->resumo['diferenca'] += pg_num_rows($this->resultEsquerdo);
    }
    
    public function showResult(): void {
        echo PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
        echo $this->getTestName(), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'CONTAS CREDORAS COM SALDO DEVEDOR:', PHP_EOL;
        echo '....................................................................................................', PHP_EOL;
        foreach (pg_fetch_all($this->resultEsquerdo, PGSQL_ASSOC) as $cc){
            echo "\t->\t", $this->formataCC($cc['conta_contabil']), PHP_EOL;
        }
        echo '....................................................................................................', PHP_EOL;
        echo 'Total de contas credoras com saldo devedor: ', number_format($this->resumo['valor_esquerdo'], 0, ',', '.'), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'CONTAS DEVEDORAS COM SALDO CREDOR:', PHP_EOL;
        echo '....................................................................................................', PHP_EOL;
        foreach (pg_fetch_all($this->resultDireito, PGSQL_ASSOC) as $cc){
            echo "\t->\t", $this->formataCC($cc['conta_contabil']), PHP_EOL;
        }
        echo '....................................................................................................', PHP_EOL;
        echo 'Total de contas devedoras com saldo credor: ', number_format($this->resumo['valor_direito'], 0, ',', '.'), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'TOTAL DE CONTAS COM SALDO INVERTIDO: ', number_format($this->resumo['diferenca'], 0, ',', '.'), PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
    }
    
    private function formataCC(string $cc): string {
        $n1 = $cc[0];
        $n2 = $cc[1];
        $n3 = $cc[2];
        $n4 = $cc[3];
        $n5 = $cc[4];
        $n6 = $cc[5].$cc[6];
        $n7 = $cc[7].$cc[8];
        $n8 = $cc[9].$cc[10];
        $n9 = $cc[11].$cc[12];
        $n10 = $cc[13].$cc[14];
        return sprintf('%s.%s.%s.%s.%s.%s.%s.%s.%s.%s', $n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8, $n9, $n10);
    }
}
