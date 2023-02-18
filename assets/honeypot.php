<?php
/**
 *  @param       : Honeypot simples e eficaz pra detectar por onde um invasor humano ou robotizado está acessando seu site  
 *  @link        : Sérgio Madrollan <sergio.madrolan@gmail.com> https://github.com/madrollan
 *  @copyright   : Todos os direitos reservados aos autores
 *
 *************************************************************************************/

	/**
    *   Função original do geoplugin para detectar bots, e evitar a sobrecarga do servidor em planos free
    *   @param $user_agent string recebe o valor do navegador ou cURL
    *   @return booleano
    * 	@author geoplugin.net
    **/
    function is_bot($user_agent) {
 
        $botRegexPattern = "(googlebot\/|Googlebot\-Mobile|Googlebot\-Image|Google favicon|Mediapartners\-Google|bingbot|slurp|java|wget|curl|Commons\-HttpClient|Python\-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST\-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub\.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum\.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips\-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail\.RU_Bot|discobot|heritrix|findthatfile|europarchive\.org|NerdByNature\.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb\-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web\-archive\-net\.com\.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks\-robot|it2media\-domain\-crawler|ip\-web\-crawler\.com|siteexplorer\.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki\-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e\.net|GrapeshotCrawler|urlappendbot|brainobot|fr\-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf\.fr_bot|A6\-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive\.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j\-asr|Domain Re\-Animator Bot|AddThis|YisouSpider|BLEXBot|YandexBot|SurdotlyBot|AwarioRssBot|FeedlyBot|Barkrowler|Gluten Free Crawler|Cliqzbot)";      
        return preg_match("/{$botRegexPattern}/", $user_agent);

        if ( !is_bot($_SERVER['HTTP_USER_AGENT']) ) {
            return true;
        } else {
            return false;
        }
    }
	
	/**
    *   Gera um arquivo de Log com níveis críticos - original no Imasters 
    *   @param $mensagem string que recebe o valor da mensagem do log
    *   @param $nivel string que recebe o valor do nível crítico da mensagem do log
    *   @param $arquivo string recebe o valor do nome do arquivo de log
    *   @return array com os dados das mensagens
    **/
	function logMsg( $mensagem, $nivel = 'info', $arquivo = 'CURRICULO_RECEBIDO_COM_SUCESSO.log' ){

	    // variável que vai armazenar o nível do log (INFO, WARNING ou ERROR)
	    $levelStr = '';
	 
	    // caso o $level seja
	    switch ( $level ){
	        case 'info':
	            // nível de informação
	            $levelStr = 'INFO';
            break;
	 
	        case 'warning':
	            // nível de aviso
	            $levelStr = 'WARNING';
	            break;
	 
	        case 'error':
            	// nível de erro
            	$levelStr = 'ERROR';
            break;
	    }
	 
	    // data atual
	    $date = date( 'Y-m-d H:i:s' );
	 
	    // formata a mensagem do log
	    // 1o: data atual
	    // 2o: nível da mensagem (INFO, WARNING ou ERROR)
	    // 3o: a mensagem propriamente dita
	    // 4o: uma quebra de linha
	    $mensagem = sprintf( "[%s] [%s]: %s%s", $date, $levelStr, $mensagem, PHP_EOL );
	 
	    // escreve o log no arquivo
	    // é necessário usar FILE_APPEND para que a mensagem seja escrita no final do arquivo, preservando o conteúdo antigo do arquivo
	    file_put_contents( $arquivo, $mensagem, FILE_APPEND );
	}

	// Recebe o UserAgente do navegador ou cURL
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	// Chama a função is_bot() e verifica se é um Bot, passando o agente como parâmetro
    $bot = is_bot($user_agent);

    // SE não for um bot, consulta o geoplugin
    if($bot==0){

		// lê o json diretamente dos dados enviados no POST (input)
		$json = file_get_contents('http://www.geoplugin.net/json.gp');
		$obj = json_decode($json);

		// Retorna os dados do array json em variáveis php
		$ip = $obj->geoplugin_request;
	    $cidade = $obj->geoplugin_city;
	    $uf = $obj->geoplugin_regionCode;
	    $ufNome = $obj->geoplugin_regionName;
	    $paisCodigo = $obj->geoplugin_countryCode;
	    $pais = $obj->geoplugin_countryName;
	    $continenteCodigo = $obj->geoplugin_continentCode;
	    $continenteNome = $obj->geoplugin_continentName;
	    $latitude = $obj->geoplugin_latitude;
	    $longitude = $obj->geoplugin_longitude;
	    $raio = $obj->geoplugin_locationAccuracyRadius;
	    $fusoHorario = $obj->geoplugin_timezone;
	    
	    // Salva o cabeçalho do Log
	    logMsg("Invasor tentando acessar área restrita", 'warning');
	    logMsg("Tentativa de burlar o sistema");
	    
    } else {
        
        // Salva o cabeçalho do Log
        logMsg("Bot detectado", 'warning');
    	logMsg("Um Bot, Webcrawler ou Spammer está rastreando o sistema");
    }
    
    // Salva os dados do Log
	logMsg("Referência : ".$_SERVER['HTTP_REFERER']);// link de referência do acesso caso haja
	logMsg("Agente : ".$user_agent);
	logMsg("IP : ".$ip);
	logMsg("Cidade : ".$cidade);
	logMsg("UF : ".$uf);
	logMsg("UF Nome : ".$ufNome);
	logMsg("País Código : ".$paisCodigo);
	logMsg("País : ".$pais);
	logMsg("Continente Nome : ".$continenteNome);
	logMsg("Continente Código : ".$continenteCodigo);
	logMsg("Latitude : ".$latitude);
	logMsg("Longitude : ".$longitude);
	logMsg("Raio : ".$raio);
	logMsg("Fuso Horário : ".$fusoHorario);
	logMsg("==================================================");

	// Aqui você implementa a lógica de bloqueio do ip
	// P.ex: grava o IP e um banco de dados ou salva no htaccess

	// Aqui você decide o que vai fazer com o vagabundo
	// P.ex: Depois de bloquear, redireciona á página de acesso restrito

	$url = 'https://meu-site-bem-seguro.com.br/te-bloqueei-otario';
	header('Location:'.$url);
	
