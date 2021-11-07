# Desafio Agência de Crédito

Esse projeto tem com objetivo solucionar uma demanda desejada por uma agência que necessita realizar consultas de dados de consumidores para análise de crédito.

## Arquitetura do Projeto

A arquitetura foi planejada tentando atender todos os requisitos solicitados pela agência, sendo assim os dados serão consumidos de 3 bases externas, sendo elas definidas de acordo com as suas características de velocidade e segurança. Usaremos o CPF como chave principal para consultar dados dessas bases.

Para consumir e tratar esses dados serão criadas 3 serviços, sendo eles:
* Serviço de Busca Dados Sensíveis
  * Consultará a Base A (Postgres) e disponibiliza os dados usando GraphQL
  * Para consultar esses dados será necessário ter acesso via autentificação
* Serviço de Análise de Score de Crédito
  * Consultará a Base B (Mongodb) e poderá determinar o score do consumidor de acordo com as informações obtidas
  * Não há necessidade de autentificação
  * O resultado do score será disponibilizado através de uma API REST
* Serviço de Rastreamento de Eventos atrelado ao CPF
  * Esse serviço consultará a Base C (Elasticsearch)
  * Irá retornar detalhes de movimentações financeiras feitas pelo CPF e quando foi a última pesquisa feita em Bureau de Crédito para aquele CPF

O desenho abaixo exemplifica como seria esse cenário:

![image](https://user-images.githubusercontent.com/33763956/140627506-40d16b28-2616-434d-b02f-ca7c17dcad2c.png)

### Detalhes sobre o Desenho

Todos os serviços descritos acima estarão em ambientes clusterizados na nuvem (como por exemplo Cloud AWS) para garantir uma alta disponibilidade dos mesmos, escalonamento de recursos e balanceamento de cargas.

No desenho há uma aplicação web dentro desse ecossistema que seria um exemplo de plataforma utilizado pela agência para disponibilizar essas informações para clientes, mas esses serviços poderiam muito bem serem consumidos por outras aplicações, incluindo de terceiros.

### Tecnologias Escolhidas

#### Postgres:
Escolhi o Postgres como possível opção para base A pois é um banco relacional que de certa forma oferece uma estrutura para conter os dados de um consumidor, já que a tendencia dos dados informações não é escalar muito

#### Mongodb: 
A escolha do Mongodb para base B se da pelo fato de ser relativamente mais rápida que um banco relacional e também parece ser muito utilizada para Machine Learning

### Elasticsearch:
O Elasticsearch foi escolhido por causa da sua velocidade de acesso, isso devido a sua indexação e os dados informados parecem se encaixar com essa tecnologia

### GraphQL
Acredito que o primeiro serviço deve ser bem flexivel na hora de ser consumido, possíbilitando a aplicação escolher os dados, por isso a escolha dessa ferramenta
