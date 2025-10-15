Nome: Ryan dos Santos Rodrigiues
RA: 2018710
Curso: Análise e Desenvolvimento de Sistemas
Disciplina: Desing Patterns & Clean Code
Professor: Valdir Amancio Pereira Junior

Nome: Leonardo dos Santos da Silva
RA: 2034122
Curso: Análise e Desenvolvimento de Sistemas
Disciplina: Desing Patterns & Clean Code
Professor: Valdir Amancio Pereira Junior

Projeto Cadastro e Listagem de Produtos (PHP puro + Composer + XAMPP)

Descrição

Este projeto consiste em um sistema simples para cadastro e listagem de produtos, desenvolvido do zero aplicando os princípios de Single Responsibility Principle (SRP), PSR-4 para autoload via Composer, além de organizar o código em camadas claras. 

A persistência dos dados é feita em arquivo texto JSON por linha, sem uso de banco de dados.

Requisitos funcionais

- Entidade Produto: { id:int, name:string, price:float }
- Cadastro:
  - name não vazio, entre 2 e 100 caracteres
  - price numérico, maior ou igual a zero
- Persistência:
  - Produto salvo em storage/products.txt como JSON por linha
  - id incremental (lê último id do arquivo para calcular próximo)
- Listagem:
  - Exibe tabela simples com id, name e price
  - Lê do arquivo (somente leitura)
- Sem banco de dados, sem frameworks
- Código seguindo PSR-12 e SRP obrigatórios

Regras de negócio

- id incremental simples (começa em 1 se arquivo vazio)
- name não precisa ser único
- price deve ser numérico e não negativo

Como executar

1. Clone o projeto na pasta do servidor XAMPP (exemplo: htdocs/products-srp-demo)
2. Execute composer install para instalar o autoload PSR-4
3. Configure o servidor Apache via XAMPP para servir a pasta public
4. Acesse via navegador:  
   http://localhost/products-srp-demo/public/

Fluxo entre classes

- public/create.php recebe dados do formulário via POST (name, price)
- Cria instância de ProductService passando:
  - FileProductRepository (persistência)
  - SimpleProductValidator (validação)
- Chama ProductService::create($input):
  - Valida dados via validator->validate($input)
  - Se inválido, retorna erro (HTTP 422 e mensagem)
  - Se válido, cria produto com id incremental e chama repo->save($product)
- public/products.php cria ProductService e chama list() para obter produtos via repo->findAll() e renderiza tabela HTML

Casos de uso e testes manuais

| Caso              | Entrada                        | Resultado esperado                                      |
| Cadastro válido   | name="Teclado", price=120.50   | Produto criado, aparece na listagem, HTTP 201           |
| Nome curto        | name="T", price=50             | Rejeitado, mensagem de validação, HTTP 422              |
| Preço negativo    | name="Mouse", price=-10        | Rejeitado, mensagem de validação, HTTP 422              |
| Lista vazia       | arquivo products.txt vazio     | Exibe "Nenhum produto cadastrado"                       |
| Múltiplos produtos| Cadastro de 3 produtos         | Produtos aparecem na ordem correta com IDs incrementais |

Critérios de aceite

- Projeto roda corretamente em http://localhost/products-srp-demo/public/
- ProductService orquestra sem realizar I/O direto (sem echo)
- FileProductRepository realiza toda leitura e escrita no arquivo
- SimpleProductValidator é responsável somente por validação
- Código segue PSR-12 e organização em camadas
- README contém instruções e casos de teste descritos