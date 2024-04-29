# Sistema para testes de consistência contábil

*Sistema destinado a execução de testes de consistência contábil.*

Os testes de consistência contábil tem o objetivo de verificar a consistência dos registros contábeis 
através da comparação entre os valores dos registros contábeis com algum outro valor que represente o valor registrado.

Por exemplo, pode-se testar o saldo final da conta contábil que registra a receita arrecadada com o valor efetivamente arrecadado
registrado no balancete da receita.

Cada teste de consistência compara dois valores -- `$esquerdo` e `$direito`. Caso os valores sejam iguais, o teste passa; caso contrário, 
o teste indica possível inconsistência ou erro de registro contábil.

Eventualmente pode-se checar também valores que não envolvem contas contábeis. Um exemplo é o teste que verifica se a receita intra-orçamentária arrecadada é igual à despesa intra-orçamentária paga.

Ambos os valores `$esquerdo` e `$direito` são apurados a partir da soma de algum campo em alguma tabela aplicando algum filtro, como no exemplo:

```php
$sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";        

$esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '5221904%');
  
$direito[] = sprintf("SELECT SUM(REDUCAO_DOTACAO)::DECIMAL FROM PAD.BAL_DESP WHERE REMESSA = %d AND ENTIDADE IN (%s)", $this->remessa, $this->entidadesIn);
```

No exemplo acima, `$esquerdo` é obtido a partir da soma do campo `SALDO_ATUAL`, invertendo-se o saldo (por isso o `* -1`), da tabela `PAD.BAL_VER` com os seguintes filtros:

- `REMESSA = %d`: o campo `REMESSA` é um campo específico da base de dados utilizada que indica de cual competência são os dados;
- `ENTIDADE`: lista das entidades abrangidas pelo teste. Cada teste pode ser executado em uma, várias ou de forma agregada nas entidades. Este também é um campo específico do banco de dados utilizado;
- `CONTA_CONTABIL`: é o código da conta contábil utilizada;
- `ESCRITURAÇÃO LIKE 'S'`: filtra apenas as contas escrituráreis (analíticas);

Por sua vez, `$direito` é calculado a partir da soma do campo `REDUCAO_DOTACAO` da tabela `PAD.BAL_DESP` é obtido a partir dos seguintes filtros:

- `REMESSA = %d`: o campo `REMESSA` é um campo específico da base de dados utilizada que indica de cual competência são os dados;
- `ENTIDADE`: lista das entidades abrangidas pelo teste. Cada teste pode ser executado em uma, várias ou de forma agregada nas entidades. Este também é um campo específico do banco de dados utilizado;

Os dados utilizados pelos testes são os dados gerados para o SIAPC/PAD do TCE-RS, convertidos para o PostgreSql.

Alguns testes podem utilizar mais de uma consulta SQL para chegar aos valores `$esquerdo` e `$direito`, como em:

```php
$sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
$esquerdo[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82111%');

$sql = "SELECT SUM(SALDO_ATUAL)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
$direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '1%');

$sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S' AND INDICADOR_SUPERAVIT_FINANCEIRO LIKE 'F'";
$direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '21%');
$direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '22%');

$sql = "SELECT SUM(SALDO_ATUAL * -1)::DECIMAL FROM PAD.BAL_VER WHERE REMESSA = %d AND ENTIDADE IN (%s) AND CONTA_CONTABIL LIKE '%s' AND ESCRITURACAO LIKE 'S'";
$direito[] = sprintf($sql, $this->remessa, $this->entidadesIn, '82112%');
```

Nesse caso, a soma de todas as SQLs atribuídas a `$esquerdo` será considerada na comparação. O mesmo se aplica a `$direito`.

Todos os testes estão no diretório `src\Test\Mensal` e são organizados em perfis que estão disponíveis em `/perfil/`.

Atualmente existem 4 perfis:

- `cm`: executa os testes apenas para a entidade da Câmara de Vereadores;
- `pm`: executa os testes apenas para a entidade da Prefeitura;
- `rpps`: executa os testes apenas para a entidade do RPPS;
- `agregado`: executa os testes agrupando os dados para todas as entidades.

