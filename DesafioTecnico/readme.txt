Desafio Técnico

Um projeto que utiliza requisições de API e banco de dados.

-- Prequisitos

> Wampserver ou algo que desempenhe a mesma função.
> SGBD que utilize mySQL.

-- Observações

> Para mudar as configurações da conexão com o banco de dados, mude as propriedades da conexão em "config/Conexao.php".
> A primeira linha do script "banco.sql" está comentada. Para reiniciar o banco de dados, descomente a linha e execute
o script.

-- Execução

> Inicie o Wampserver ou o que estiver utilizando.
> Execute o script "banco.sql" no banco de dados para criar o banco e as tabelas.
> Acesse localhost/ pelo navegador e navegue até o projeto, por exemplo "localhost/desafiotecnico".
> Execute o script "popular_banco.php", para consumir dados da API e armazenar no banco de dados.
> Após a execução do script, vá para "localhost/desafiotecnico/ranking" para fazer a requisição do ranking das redes
sociais mais utilizadas dentre os deputados em ordem decrescente, e para "localhost/desafiotecnico/reembolso" para
mostrar os top 5 deputados que mais pediram reembolso de verbas indenizatórias registradas no banco de dados.

-- Arquivos

> "localhost/desafiotecnico/reembolso" para obter os top 5 deputados que mais pediram reembolso de verbas
indenizatórias.
> "localhost/desafiotecnico/ranking" para obter o ranking das redes sociais mais utilizadas dentre os deputados.
> "localhost/desafiotecnico/popular_banco.php" para popular o banco de dados.
> "banco.sql" script do banco de dados.
> "config/Conexao.php" classe de conexão com o banco de dados.
> "config/Deputado.php" classe deputado.
> "config/RedeSocial.php" classe rede social.
> "config/VerbaIndenizatoria.php" classe verba indenizatoria.

-- Importante

> Com a execução correta do script "popular_banco.php", o banco terá 77 itens na tabela "deputados" e 222 itens na
tabela "redes_sociais".
> Por padrão, o script "popular_banco.php" irá pegar dados dos meses 4 e 5 para cada candidato (haverá 785 itens na
tabela "verbas_indenizatorias" caso o script execute com sucesso). Para mudar os meses que o script usará para buscar
informações na API, mude o parâmetro da função da linha 19 do arquivo "popular_banco.php".
> Para cada mês existente na lista de meses da linha 19 do arquivo "popular_banco.php", serão feitas 77 requisições de
API simultâneas, e caso essa lista seja muito grande (mais que 2 meses), haverá a chance do script falhar pois divido
ao número de requisições, a API pode rejeitar as requisições e prejudicar o funcionamento do sistema inteiro. Em meus
testes, 2 meses não causaram rejeição de requisições, algo que aconteceu somente com 3 ou mais meses.
> O objetivo era pegar informações dos 77 deputados nos 12 meses do ano, porém as requisições sempre acabavam
rejeitadas, devido ao fato de serem 924 (77 * 12) requisições simultâneas à API. O único jeito que achei para resolver
este problema foi limitar a quantidade de meses a serem verificados.
> Caso o script "popular_banco.php" não execute corretamente, reinicie o banco de dados rodando o script "banco.sql"
novamente e execute o script "popular_banco.php" novamente.
> Não execute o script "popular_banco.php" uma segunda vez sem antes reiniciar o banco de dados.

Autor: Lucas Vinícius
Dados Abertos ALMG: http://dadosabertos.almg.gov.br/ws/ajuda/sobre
Link para obter lista de deputados: https://dadosabertos.almg.gov.br/ws/deputados/ajuda#Lista%20Telef%C3%B4nica%20de%20Deputados
Link para obter informações de verbas: https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/ajuda#Lista%20de%20Datas%20de%20Verbas%20Indenizat%C3%B3rias%20de%20um%20Deputado%20na%20legislatura%20atual
fevereiro de 2020
