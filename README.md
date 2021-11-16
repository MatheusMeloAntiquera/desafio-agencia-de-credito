# Desafio Agência de Crédito

Esse projeto tem com objetivo solucionar uma demanda desejada por uma agência que necessita realizar consultas de dados de consumidores para análise de crédito.

> :warning: **Esse projeto não foi finalizado, por isso as aplicações poderam não funcionarem corretamente**
## Arquitetura do Projeto

A arquitetura foi planejada tentando atender todos os requisitos solicitados pela agência, sendo assim os dados serão consumidos de 3 bases externas, sendo elas definidas de acordo com as suas características de velocidade e segurança. Usaremos o CPF como chave principal para consultar dados dessas bases.

Para consumir e tratar esses dados serão criadas 3 serviços, sendo eles:

#### Serviço de Busca Dados Sensíveis
  - Consultará a Base A (Postgres) e disponibiliza os dados usando GraphQL(https://webonyx.github.io/graphql-php/) e Doctrine ORM (https://www.doctrine-project.org/projects/doctrine-orm/en/2.10/index.html)
#### Serviço de Análise de Score de Crédito
  - Consultará a Base B (Mongodb) e poderá determinar o score do consumidor de acordo com as informações obtidas
  - O resultado do score será disponibilizado através de uma API REST
#### Serviço de Rastreamento de Eventos atrelado ao CPF
  - Esse serviço consultará a Base C (MongoDB)
  - Irá retornar detalhes de movimentações financeiras feitas pelo CPF e quando foi a última pesquisa feita em Bureau de Crédito para aquele CPF
  - Caso os dados sejam encontrados, será criado um cache usando **Redis**, para que as próximas busca sejam realizadas nesse cache, dentro do periodo para expiração do mesmo.

O desenho abaixo exemplifica como seria esse cenário:

![image](https://user-images.githubusercontent.com/33763956/141885753-19837039-29ea-4406-bd64-0fa381d6ae57.png)

## Detalhes sobre o Desenho

Todos os serviços descritos acima estarão em ambientes clusterizados na nuvem (como por exemplo Cloud AWS) para garantir uma alta disponibilidade dos mesmos, escalonamento de recursos e balanceamento de cargas.

Todos os serviços terão que passar por um API gateway (https://konghq.com/kong/) para garantir o roteamento dos serviços e também um **autenticação** para acessar os mesmos. 

Escolhi usar **autentificação para todos os serviços**, pois acredito que todos os dados são sensíveis.

No desenho há uma aplicação web externa que seria um exemplo de plataforma utilizado pela agência para disponibilizar essas informações para clientes, mas esses serviços poderiam muito bem serem consumidos por outras aplicações, incluindo de terceiros.

### Tecnologias Escolhidas

#### Postgres:

Escolhi o Postgres como possível opção para base A pois é um banco relacional que de certa forma oferece uma estrutura para conter os dados de um consumidor, já que a tendencia dos dados informações não é escalar muito

#### Mongodb:

A escolha do Mongodb para base B e C se da pelo fato de ser "relativamente mais rápida" que um banco relacional e também parece ser muito utilizada para Machine Learning (carente de fontes).

#### Redis:

O Redis foi a estratégia escolhida para trazer desempenho para esse serviço. A vida útil do cache criado é pequena nesse exemplo garantir que qualquer atualiação recente seja exibida a aplicação que consume o serviço.
#### GraphQL

Acredito que o primeiro serviço deve ser bem flexível na hora de ser consumido, possíbilitando quem consumi-lo escolher os dados, por isso a escolha dessa ferramenta
## Como rodar o projeto

```shell
docker-compose up -d
```

A ideia aqui seria que ao rodar o docker-composer na raiz do projeto, todos os serviços e suas dependencias fossem instanciadas sem a necessidade de rodar mais comandos, tais como comandos de migrations por exemplo.
