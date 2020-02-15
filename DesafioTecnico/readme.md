<h1>Desafio Técnico</h1>

Um projeto que utiliza requisições de API e banco de dados.

<h2>Prequisitos</h2>

<ul>
<li>Wampserver ou algo que desempenhe a mesma função.</li>
<li>SGBD que utilize mySQL.</li>
</ul>

<h2>Observações</h2>

<ul>
<li>Para mudar as configurações da conexão com o banco de dados, <b>mude as propriedades da conexão</b> em "config/Conexao.php".</li>
<li>A primeira linha do script "banco.sql" está comentada. Para reiniciar o banco de dados, <b>descomente a linha</b> e execute
o script.</li>
</ul>

<h2>Execução</h2>

<ul>
<li>Inicie o Wampserver ou o que estiver utilizando.</li>
<li><b>Execute o script</b> "banco.sql" no banco de dados para criar o banco e as tabelas.</li>
<li>Acesse localhost/ pelo navegador e navegue até o projeto, por exemplo "localhost/desafiotecnico".</li>
<li><b>Execute o script</b> "popular_banco.php", para consumir dados da API e armazenar no banco de dados.</li>
<li><b>Após a execução do script</b>, vá para "localhost/desafiotecnico/ranking" para fazer a requisição do ranking das redes
sociais mais utilizadas dentre os deputados em ordem decrescente, e para "localhost/desafiotecnico/reembolso" para
mostrar os top 5 deputados que mais pediram reembolso de verbas indenizatórias registradas no banco de dados.</li>
</ul>

<h2>Arquivos</h2>

<ul>
<li>"localhost/desafiotecnico/reembolso" para obter os top 5 deputados que mais pediram reembolso de verbas
indenizatórias.</li>
<li>"localhost/desafiotecnico/ranking" para obter o ranking das redes sociais mais utilizadas dentre os deputados.</li>
<li>"localhost/desafiotecnico/popular_banco.php" para popular o banco de dados.</li>
<li>"banco.sql" script do banco de dados.</li>
<li>"config/Conexao.php" classe de conexão com o banco de dados.</li>
<li>"config/Deputado.php" classe deputado.</li>
<li>"config/RedeSocial.php" classe rede social.</li>
<li>"config/VerbaIndenizatoria.php" classe verba indenizatoria.</li>
</ul>

<h2>Importante</h2>

<ul>
<li>Com a <b>execução correta</b> do script "popular_banco.php", o banco terá <b>77 itens na tabela "deputados"</b> e <b>222 itens na
tabela "redes_sociais"</b>.</li>
<li><b>Por padrão</b>, o script "popular_banco.php" irá pegar dados dos meses 4 e 5 para cada candidato (haverá <b>785 itens na
tabela "verbas_indenizatorias" caso o script execute com sucesso</b>). <b>Para mudar os meses</b> que o script usará para buscar
informações na API, <b>mude o parâmetro da função da linha 19 do arquivo "popular_banco.php"</b>.</li>
<li>Para cada mês existente na lista de meses da linha 19 do arquivo "popular_banco.php", serão feitas 77 requisições de
API simultâneas, e <b>caso essa lista seja muito grande (mais que 2 meses), haverá a chance do script falhar pois divido
ao número de requisições, a API pode rejeitar as requisições e prejudicar o funcionamento do sistema inteiro</b>. Em meus
testes, <b>2 meses</b> não causaram rejeição de requisições, algo que aconteceu somente com 3 ou mais meses.</li>
<li>O objetivo era pegar informações dos 77 deputados nos 12 meses do ano, porém as requisições sempre acabavam
rejeitadas, devido ao fato de serem 924 (77 * 12) requisições simultâneas à API. O único jeito que achei para resolver
este problema foi limitar a quantidade de meses a serem verificados.</li>
<li>Caso o script "popular_banco.php" não execute corretamente, <b>reinicie o banco de dados rodando o script "banco.sql"
novamente</b> e execute o script "popular_banco.php" novamente.</li>
<li><b>Não execute</b> o script "popular_banco.php" uma segunda vez <b>sem antes reiniciar</b> o banco de dados.</li>
</ul>

<hr>

Autor: Lucas Vinícius<br>
Dados Abertos ALMG: http://dadosabertos.almg.gov.br/ws/ajuda/sobre<br>
Link para obter lista de deputados: https://dadosabertos.almg.gov.br/ws/deputados/ajuda#Lista%20Telef%C3%B4nica%20de%20Deputados<br>
Link para obter informações de verbas: https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/ajuda#Lista%20de%20Datas%20de%20Verbas%20Indenizat%C3%B3rias%20de%20um%20Deputado%20na%20legislatura%20atual<br>
fevereiro de 2020
