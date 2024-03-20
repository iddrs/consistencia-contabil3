<?php

namespace App;

/**
 * Controlador do processo de teste.
 *
 * @author Everton
 */
class Tester {

    private readonly int $remessa;
    private readonly array $entidades;
    private array $testes;
    private array $resumo = [];
    protected ?int $indexOfTest = null;

    public function __construct(int $remessa, array $entidades) {
        $this->remessa = $remessa;
        $this->entidades = $entidades;
    }

    public function setIndexOfTest(?int $index): void {
        $this->indexOfTest = $index;
    }

    public function addTest(TestBase $teste): Tester {
        $this->testes[] = $teste;
        return $this;
    }

    public function execute(): void {
        foreach ($this->testes as $index => $teste) {
            if (is_null($this->indexOfTest) || $index === $this->indexOfTest) {
                $teste->run();
                $this->resumo[] = $teste->getResumo();
                $teste->showResult();
            }
        }
        $this->showResumo();
    }

    private function showResumo(): void {
        $testes_totais = 0;
        $passou = 0;
        $falhou = 0;
        echo PHP_EOL;
        echo '====================================================================================================', PHP_EOL;
        echo 'RESUMO', PHP_EOL;
        echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        foreach ($this->resumo as $i => $teste) {
            $testes_totais++;
            if (round($teste['diferenca'], 2) == 0.0) {
                $passou++;
                continue;
            }
            $falhou++;
            echo $i, "\t", $teste['teste'], PHP_EOL;
            echo "Valor Esquerdo : ", number_format($teste['valor_esquerdo'], 2, ',', '.'), PHP_EOL;
            echo "Valor Direito  : ", number_format($teste['valor_direito'], 2, ',', '.'), PHP_EOL;
            echo "Diferença      : ", number_format($teste['diferenca'], 2, ',', '.'), PHP_EOL;
            echo '----------------------------------------------------------------------------------------------------', PHP_EOL;
        }
        echo '====================================================================================================', PHP_EOL, PHP_EOL;
        echo 'Total de testes realizados : ', $testes_totais, PHP_EOL;
        echo 'Testes que passaram        : ', $passou, PHP_EOL;
        echo 'Total que falharam         : ', $falhou, PHP_EOL;
        echo '====================================================================================================', PHP_EOL, PHP_EOL;
    }
}
