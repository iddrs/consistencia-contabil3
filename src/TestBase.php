<?php

namespace App;

/**
 * Classe Base para os testes.
 *
 * @author Everton
 */
abstract class TestBase {
    
    private readonly string $testName;
    protected readonly int $remessa;
    private readonly array $entidades;
    private array $valorDireito = [];
    private array $valorEsquerdo = [];
    private array $resumo = [];
    protected readonly string $entidadesIn;


    
    public function __construct(string $testName, int $remessa, array $entidades) {
        $this->remessa = $remessa;
        $this->entidades = $entidades;
        $this->testName = $testName;
        $this->resumo = [
            'teste' => $testName,
            'valor_esquerdo' => 0.0,
            'valor_direito' => 0.0,
            'diferenca' => 0.0,
        ];
        $this->entidadesIn = $this->setEntidadesForInClause();
    }
    
    public function showResult(): void {
        echo PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
        echo $this->getTestName(), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'VALOR ESQUERDO:', PHP_EOL;
        echo '....................................................................................................', PHP_EOL;
        foreach ($this->valorEsquerdo as $sql => $valor){
            echo $sql, ' -> [', number_format($valor, 2, ',', '.'), ']', PHP_EOL;
        }
        echo '....................................................................................................', PHP_EOL;
        echo 'Total Esquerdo: ', number_format($this->resumo['valor_esquerdo'], 2, ',', '.'), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'VALOR DIREITO:', PHP_EOL;
        echo '....................................................................................................', PHP_EOL;
        foreach ($this->valorDireito as $sql => $valor){
            echo $sql, ' -> [', number_format($valor, 2, ',', '.'), ']', PHP_EOL;
        }
        echo '....................................................................................................', PHP_EOL;
        echo 'Total Direito: ', number_format($this->resumo['valor_direito'], 2, ',', '.'), PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        echo 'DIFERENÇA: ', number_format($this->resumo['diferenca'], 2, ',', '.'), PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
    }
    
    public function getResumo(): array {
        return $this->resumo;
    }
    
    public function getTestName(): string {
        return $this->testName;
    }
    
    private function setEntidadesForInClause(): string {
        $entidades = [];
        foreach ($this->entidades as $entidade){
            $entidades[] = "'$entidade'";
        }
        return join(', ', $entidades);
    }
    
    protected function salvaValorEsquerdo(string $sql, float $valor): void {
        $this->valorEsquerdo[$sql] = $valor;
        $this->resumo['valor_esquerdo'] += $valor;
        $this->resumo['diferenca'] += $valor;
    }
    
    protected function salvaValorDireito(string $sql, float $valor): void {
        $this->valorDireito[$sql] = $valor;
        $this->resumo['valor_direito'] += $valor;
        $this->resumo['diferenca'] -= $valor;
    }
    
    protected function calculaValor($sql): float {
        $result = DB::query($sql);
        if($result === false){
            trigger_error("Erro ao executar [$sql]", E_USER_ERROR);
        }
        $valor = pg_fetch_all_columns($result, 0);
        return (float) array_sum($valor);
    }
    
    abstract public function run(): void;
    
    protected function execute(array $esquerdo, array $direito): void {
        foreach ($esquerdo as $sql) {
            $this->salvaValorEsquerdo($sql, $this->calculaValor($sql));
        }
        
        foreach ($direito as $sql) {
            $this->salvaValorDireito($sql, $this->calculaValor($sql));
        }
    }
}
