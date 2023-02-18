# Um Honeypot simples em PHP
Honeypot simples e eficaz pra detectar por onde um invasor humano ou robotizado está acessando seu site.

## Instalação

Baixe os arquivos e coloque dentro de um diretório que você quer que seja utilizado como isca para o invasor humano ou robotizado;  
P.ex: crie um diretório chamado "wp-content", "admin", "financeiro";

Descomente as linhas do arquivo htaccess.txt e renomeie-o para .htaccess
```
#Options -Indexes
#ErrorDocument 403 /erro-403
#ErrorDocument 404 /erro-404
#ErrorDocument 500 /erro-500
#RewriteCond %{HTTP_USER_AGENT} (GrabNet|Grafula|GetRight|Robozao|OutroRobozao|Rambler|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby|bot|crawl|spider|mediapartners|curl|fetch|Baiduspider|ia_archiver|R6_FeedFetcher|NetcraftSurveyAgent|bingbot|PrintfulBot|Twitterbot|UnwindFetchor|urlresolver) [NC]
#RewriteRule (.*) - [F,L]

#IPS Bloqueados
#Order allow,deny
#allow from all
```
