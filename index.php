<?php

$botToken = $_ENV['TOKEN'];
$website = "https://api.telegram.org/bot".$botToken;
$botname = "@cleitonFenixBot";

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

require 'funcs.php';
require 'biscoito.php';
require 'bot.php';
require 'teleBot.php';

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$id = $update["message"]["message_id"];

$sale = date('25/06/2020');

if($update["message"]["dice"]["emoji"]!=''){
	$emoji = $update["message"]["dice"]["emoji"];
	$valor = $update["message"]["dice"]["value"];
	if($emoji == 🎲){
		$aposta = rand(1, 6);
		sendMessage($chatId, "Acho que vai cair ".$aposta);
		sleep(5);
		if($valor == $aposta)
		  sendMessage($chatId, "Num é que eu acertei mesmo");
		else
		  sendMessage($chatId, "Errei mais foi de proposito");
			
	}
	if(($emoji == 🏀 or $emoji == ⚽)&& $valor<4){
		if(rand(0,2)==1)
		 sendMessage($chatId, "vai errar fdp!");
		else{
		 sendMessage($chatId, "valendo o toba se errar já sabe");
			sleep(4);
		 sendMessage($chatId, "ih rapaz parece que vc danço");
		 
		}
		 
	}
	else if(($emoji == 🏀 or $emoji == ⚽)&& $valor>=4) { 
		sendMessage($chatId, "eu acho q esse fdp vai acertar!");
		sleep(4);
		 sendMessage($chatId, "esse  baum memo");
	}
	//sendMessage($chatId, "emoji ".$emoji." valor ".$valor);	
}

if(checkCommand($message, "/entende")){
  sendMessage($chatId, "Olá como vai entende");
}

if(checkCommand($message, "/raw")){
  sendMessage($chatId, json_encode($update));
}
	
if(checkCommand($message, "/importantes")){
	/*
  $names = file_get_contents("https://digoboratv.000webhostapp.com/api/nomes.php?chat_id=".urlencode($chatId));
  $name = rand(0, count($names));
  
  $frases = array("fui cagar tava duro e rasgue o cu",
		  "O gordão tá de dentadura? ",
		  "big xana",
		  "meu pinto ta muito murcho",
		  "foto profissional né abobado",
		  "foi gostosinho men" ,
		  "queria segurar na mão do".$name."enquanto ele come a puta e falar shhhh".$name."vai ficar tudo bem");
  for($i=0;$i<5;$i){
	$resp += $name[rand(0, count($names))]." disse: ".$frases[rand(0,count($frases))]."\n";  
  }
  
  sendMessage($chatId,"Aqui vai um resumo\n".$resp);*/
}

if(checkCommand($message, "/adms")){
  $adms = file_get_contents('https://api.telegram.org/bot'.$botToken.'/getChatAdministrators?chat_id='.$chatId);
  $adms = json_decode($adms, TRUE);
  $lista = '';
  for($i=0;$i<count($adms['result']);$i++){
   $lista = $lista." ".$adms['result'][$i]['user']['first_name']." ";
  }
  sendMessage($chatId, $lista);
}

 if(rand(1, 30)==10){
	 $name = $update["message"]["from"]["first_name"];
	 $percentual = rand(0, 100);
     $msg = array("cheguei man", $name." é massa","chance","qual a dúvida","ate no rabo","ihh rapaz",
                  "cala boca demonho","satanás caluniador","Sai daquiiii demonho",$name." chegou, façam silencio","dropou",
		  "derreteu ai men","biticoio derreteu pae","fala pai","e tá errado?!",$name." saudades de vc flor","manda foto de agora",
		  "de onde saiu esse encosto?!","o mundo ta insano","poxa ".$name." entortou o meu cacete","bicetinha frita 1 2 3","cringe","humor piadas",
		  "escuta aqui ".$name." longe de mim fazer fofocas mas...","pelos meus calculos ".$name." está ".$percentual." viado",
		  "me liga bb estou te esperando", "acho q sou inamoravel","busco sexo",$name." vou te falar uma coisa", "saborearam o meu boga",
		  "lanso a braba","ta taradao ein ".$name, "bora bota uns traveco no grupo",$name." calma só um pouco não eh sobre voce agora o assunto",
		  "acha q e facil assim vira essa bunda ai toma teu pix","cala boca bixa loca do demonho","toma teu pix demonho","que porra q eu li",
		 "depois de ter dado o cu esse cara resolveu falar isso");
     sendMessage($chatId, $msg[rand(0, count($msg))]);
 }

if(checkCommand($message, "/git")){
  sendMessage($chatId, "https://github.com/SantosLeandro/cleitonBot");

}

if(checkCommand($message, "/salve")){
   $user_id = $update["message"]["from"]["id"];
   $name = $update["message"]["from"]["first_name"];
   $texto = file_get_contents("https://digoboratv.000webhostapp.com/api/salve.php?chat_id=".urlencode($chatId)."&user_id=".urlencode($user_id)."&name=".urlencode($name));
   sendMessage($chatId, "Salve rapaziada ".$texto);	 	
}

if(checkCommand($message, "/urgentadas")){
   $texto = file_get_contents("https://digoboratv.000webhostapp.com/api/geturgentadas.php");
   sendMessage($chatId, $texto);	 	
}

if(checkCommand($message, "cleiton, aniversariantes do mes")){
   $texto = file_get_contents("https://digoboratv.000webhostapp.com/api/getaniversarios.php?chat=".$chatId);
   sendMessage($chatId, $texto);	 	
}

if(checkCommand($message, "/aniversarios_mes")){
   $texto = file_get_contents("https://digoboratv.000webhostapp.com/api/getaniversarios.php?chat=".$chatId);
   sendMessage($chatId, $texto);	 	
}


if ((strpos(strtolower($message), 'cleiton, add aniversario') !== false)) {
    $date= substr($message, 25, strlen($message));
    $name = $update["message"]["from"]["first_name"];
    $user_id = $update["message"]["from"]["user_id"];
    if (validateDate($date, 'Y-m-d')) {
   	file_get_contents("https://digoboratv.000webhostapp.com/aniversario/cadastrar.php?chat=".urlencode($chatId)."&name=".urlencode($name)."&user_id=0&date=".urlencode($date));
    } else {
   	sendMessage($chatId, "Por gentiliza data no formato YYYYMMDD");	
    }
	
   	 	
}

if ((strpos(strtolower($message), 'urgente:') !== false)) {
   file_get_contents("https://digoboratv.000webhostapp.com/api/addurgentada.php?texto=".urlencode($message));	 	
}
/*
if(checkCommand($message, "/noticias")){
   sendMessage($chatId, noticias());	 	
}*/

if ((strpos(strtolower($message), 'cleiton, add picaamula') !== false)) {
    $time= substr($message, 23, strlen($message));
    $user_id = $update["message"]["from"]["id"];
    $res = file_get_contents("https://digoboratv.000webhostapp.com/api/addmula.php?user_id=".urlencode($user_id)."&time=".urlencode($time));
    reply_msg($chatId, $res, $id);  	 	
}

if(checkCommand($message, "/picaamula")){
	/*date_default_timezone_set('America/Sao_Paulo'); 
	$h = date("H");
	$m = date("i");
	$hf = 15;
	$hd = $hf - $h;
	$md = 60 - $m;
	reply_msg($chatId,"faltam {$hd} horas {$md} minutos",$id);*/
	$user_id = $update["message"]["from"]["id"];
    	$res = file_get_contents("https://digoboratv.000webhostapp.com/api/getmula.php?user_id=".urlencode($user_id));
    	reply_msg($chatId, $res, $id);  	 		
}

if(checkCommand($message, "Cleiton, quanto tempo falta")){
   	date_default_timezone_set('America/Sao_Paulo'); 
	$h = date("H");
	$m = date("i");
	$hf = 15;
	$hd = $hf - $h;
	$md = 60 - $m;
	reply_msg($chatId,"faltam {$hd} horas {$md} minutos", $id);
}

if(checkCommand($message, "/eutomaluco")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/eutomaluco.mp4");	 	
}

if(checkCommand($message, "/biscuit")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/biscuit.mp4");	 	
}

if(checkCommand($message, "/macacocs")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/macacocs.mp4");	
}

if(checkCommand($message, "/doguinho")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/doguinho.mp4");	 	
}

if(checkCommand($message, "/sorriso")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/sorriso.mp4");	 	
}

if(checkCommand($message, "/raivoso")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/raivoso.mp4");	 	
}

if(checkCommand($message, "/abraco")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/abraco.mp4");	 	
}


if(checkCommand($message, "/macaco")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/macaco.mp4");	 	
}

if(checkCommand($message, "/beatbox")){
   sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/beatbox.mp4");	 	
}

if(checkCommand($message, "/biscoito")){
	$biscoito = genBiscoito();
	$sorte = genNumSorte();
   	reply_msg($chatId, $biscoito." ".$sorte, $id );	 	
}

if(checkCommand($message, "/ajuda")){
sendMessage($chatId, "Cleiton rasta fazendo a flesta pra galera
Comandos inuteis:
/hi
Pokemons:
/felipe /bruno /chico /benedito /sapodemao /astronauta /exudecalda /chance
/milenedenko /seucuca /editapoupres /lolodede /fantasmadelinguagem
/bixodepontas /balboa /agamemnom /marinbomdo /ratinho /fleig /carangueijo 
/assombracao /quelho
MaxucaReggaero:
/meloapologia / lavaseusuvaco /nomorelonely /nomorelonely2 /seuperiquito
Saudacoes:
Bom dia ou bom dia
Boa tarde
Boa noite
Infelizmente devido a ganancia sem excrupulos do empresariado os comandos a seguir estão off
/debochometro
/viadometro ");
}

if (strpos($message, 'Cleiton, faltam quantos dias pra sale') !== false) {
	$dias = date('d/m/Y'); 
	$total = $sale - $dias;
	if($total == 0){ sendMessage($chatId, "Começou hoje"); }
	else if($total ==1){ sendMessage($chatId, "falta um dia"); }
	else if($total <0){ sendMessage($chatId, "já começou"); }
	else
	sendMessage($chatId, "faltam ".$total." dias");	 
}

if ((strpos(strtolower($message), 'cleiton, socorro') !== false)) {
  $array = array("vai dar tudo certo ", " no final da tudo certo se não deu certo é pq nao chegou no finao ainda ", "hello world ", " mta calma vamos vencer tenha fé ",
		" vem cá bb me conta oque aconteceu ", "calma ela vai voltar ", "desabafa amiga ", " não chore mais eu estou aqui ");
$esc = $array[rand(0,7)];
  reply_msg($chatId, $esc, $id );
}

if ((strpos(strtolower($message), 'cleiton, escolha') !== false)) {
  $esc = escolha(strtolower($message));
  reply_msg($chatId, $esc, $id );
}

if ((strpos(strtolower($message), 'feliz natal') !== false)) {
    reply_msg($chatId, "Feliz natal!", $id );
}

if ((strpos($message, 'Cleiton, devo') !== false) || strpos($message, 'cleiton, devo') !== false) {
    devo($chatId);
}

if ((strpos($message, 'Cleiton, irei') !== false) || strpos($message, 'cleiton, irei') !== false) {
    ireiFunc($chatId);
}

if(strpos(strtolower($message), 'bot filho da puta') !== false)
{
	$name = $update["message"]["from"]["first_name"];
	  reply_msg($chatId, "voce quis dizer bot ".$name." ??? ", $id );
}

if(strpos(strtolower($message), 'bot viado') !== false)
{
	  reply_msg($chatId, "ainnnn para ", $id );
}

if(strpos(strtolower($message), 'bot fudido') !== false)
{
	  reply_msg($chatId, "chance", $id );
}

if(strpos(strtolower($message), 'bot de merda') !== false)
{
	  reply_msg($chatId, "tá achando q sou aquele bot baitola do bradesco que fala ai iu num fale assim comigo, vai toma no seu cu seu arrombado", $id );
}

if(strpos(strtolower($message), 'bot lixo') !== false)
{
	  reply_msg($chatId, "lixo é teu cu, vem me da uma mamada aqui vem", $id );
}

if(strpos(strtolower($message), 'cleiton, sua gostosa') !== false)
{
	  reply_msg($chatId, "Pra voce pode ter sido uma brincadeira pra mim foi violento", $id );
}

if(strpos($message, 'cleito, devo') !== false)
{
	sendMessage($chatId, "Digite meu nome correctamente por gentileza");
}


	
if ((strpos(strtolower($message), 'cleiton, vo me mata') !== false)) {
	$array = array("eu te amo ", "não faça isso ", "calma mta calma ", " mta calma vamos vencer tenha fé ",
		" vem cá bb me conta oque aconteceu ", "calma ela vai voltar ", "desabafa amiga ", " não chore mais eu estou aqui ");
    $esc = $array[rand(0,7)];
  reply_msg($chatId, $esc, $id );
}

if ((strpos($message, 'Cleiton, seu imbecil') !== false) || strpos($message, 'cleiton, seu imbecil') !== false) {
   sendMessage($chatId, "Essas palavras são inadequadas, não devem ser usadas comigo e com mais ninguém");
}

if(strpos($message, 'correios') !== false)
{
	$random = rand(0,14);
	if($random >=12 && $random<=14)
	{
		sendVideo($chatId,"https://digoboratv.000webhostapp.com/correios/correios_".$random.".mp4");
	}
	else
	sendImage($chatId, "https://digoboratv.000webhostapp.com/correios/correios_".$random.".jpg");
}


switch($message) {
	case "/bitcoin":
		$moeda = file_get_contents('https://economia.awesomeapi.com.br/json/all');
		$moeda = json_decode($moeda, TRUE);
		reply_msg($chatId,"Bitcoin hoje: ".$moeda["BTC"]["high"], $id );
		break;
	case "/dolar":
		$moeda = file_get_contents('https://economia.awesomeapi.com.br/json/all');
		$moeda = json_decode($moeda, TRUE);
		reply_msg($chatId,"Dolar hoje: ".$moeda["USD"]["high"], $id );
		break;
	case "/euro":
		$moeda = file_get_contents('https://economia.awesomeapi.com.br/json/all');
		$moeda = json_decode($moeda, TRUE);
		reply_msg($chatId,"Dolar hoje: ".$moeda["EUR"]["high"], $id );
		break;
	case "/iene":
		$moeda = file_get_contents('https://economia.awesomeapi.com.br/json/all');
		$moeda = json_decode($moeda, TRUE);
		reply_msg($chatId,"Iene Japonês hoje: ".$moeda["JPY"]["high"], $id );
		break;
		
		
		//https://horoscopefree.herokuapp.com/daily/pt/
	case "/aries":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=aries");
		reply_msg($chatId, $text, $id );
		break; 
	case "/touro": 
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=touro");
		reply_msg($chatId, $text , $id );
		break; 
	case "/gemeos":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=gemeos");
		reply_msg($chatId, $text, $id );
		break;
	case "/cancer":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=cancer");
		reply_msg($chatId, $text, $id );
		break;
	case "/leao":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=leao");
		reply_msg($chatId, $text, $id );
		break;
	case "/virgem":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=virgem");
		reply_msg($chatId, $text, $id );
		break;
	case "/libra":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=libra");
		reply_msg($chatId, $text, $id );
		break;
	case "/escorpiao":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=escorpiao");
		reply_msg($chatId, $text, $id );
		break;
	case "/sagitario":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=sagitario");
		reply_msg($chatId, $text, $id );
		break;
	case "/capricornio":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=capricornio");
		reply_msg($chatId, $text, $id );
		break;
	case "/aquario":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=aquario");
		reply_msg($chatId, $text, $id );
		break; 
	case "/peixes":
		$text = file_get_contents("https://digoboratv.000webhostapp.com/api/getsigno.php?signo=peixes");
		reply_msg($chatId, $text, $id );
		break;
	

	case "/oi":
		sendMessage($chatId, "Olá");
		break;
	case "/hi":
		sendMessage($chatId, "Salve Salve rapaziada");
		break;
		
	case "/video":
		sendVideo($chatId, "url/video.mp4");
		break;
		
	case "/amauri":
		sendAudio($chatId,"https://digoboratv.000webhostapp.com/audio/amauri.mp3");
		break;
		
	case "/meloapologia":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/toolate.mp4");
		break;
	case "/lavaseusuvaco":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/lavaseusuvaco.mp4");
		break;
	case "/nomorelonely":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/nomorelonely.mp4");
		break;
	case "/nomorelonely2":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/nomorelonely2.mp4");
		break;
	case "/seuperiquito":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/seuperiquito.mp4");
		break;
	case "/melodehebe":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/melodehebe.mp4");
		break;
	case "/meloviviane":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/meloviviane.mp4");
		break;
	case "/passapassa":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/passapassa.mp4");
		break;
	case "/nomorelonely3":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/nomore3.mp4");
		break;
	case "/nomorelonely4":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/nomore4.mp4");
		break;
	case "/meloapologia2":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/meloapologia2.mp4");
		break;
		
	//OUTROS	
	case "/enfia":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/enfia.mp4");
		break;
		
	
	case "/pokemon@debochadoBot":
		$random = rand(0, 135);
		//https://digoboratv.000webhostapp.com/video/
		//sendVideo($chatId, "url/video.mp4");
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/".$random.".mp4");
		break;
	case "/pokemon":
		$random = rand(0, 138);
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/".$random.".mp4");
		break;
	case "/boiada":
		sendAudio($chatId,"https://digoboratv.000webhostapp.com/audio/boiada.mp3");
		break;
		
	//SEM @ -------------	
	case "/mordecu":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/mordecu.mp4");
		break;
	case "/seyf":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/seyf.mp4");
		break;
	case "/milenedenko":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/4.mp4");
		break;
	case "/rufino":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/139.mp4");
		break;
	case "/amanda":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/135.mp4");
		break;
	case "/felipe":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/66.mp4");
		break;
	case "/bruno":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/7.mp4");
		break;
	case "/chico":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/138.mp4");
		break;
	case "/benedito":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/133.mp4");
		break;
	case "/editapoupres":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/136.mp4");
		break;
	case "/sapodemao":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/24.mp4");
		break;
	case "/astronauta":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/21.mp4");
		break;
	case "/seucuca":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/104.mp4");
		break;
	case "/fantasmadelinguagem":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/10.mp4");
		break;
	case "/lolodede":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/73.mp4");
		break;
	case "/exudecalda":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/137.mp4");
		break;
	case "/chance":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/22.mp4");
		break;
	case "/ratinho":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/53.mp4");
		break;
	case "/marinbomdo":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/48.mp4");
		break;
	case "/agamemnom":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/92.mp4");
		break;
	case "/balboa":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/132.mp4");
		break;
	case "/bixodepontas":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/8.mp4");
		break;
	case "/cagado":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/14.mp4");
		break;
	case "/fleig":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/15.mp4");
		break;
	case "/carangueijo":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/9.mp4");
		break;
	case "/assombracao":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/16.mp4");
		break;
	case "/quelho":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/60.mp4");
		break;
	case "/marcelo":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/marcelo.mp4");
		break;
	case "/rob":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/rob.mp4");
		break;
	case "/papagaio":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/papagaio.mp4");
		break;
	case "/matheus":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/mateus.mp4");
		break;
	case "/osredondos":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/84.mp4");
		break;
		
	// COM @ ----------------------
	case "/milenedenko@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/4.mp4");
		break;
	case "/felipe@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/66.mp4");
		break;
	case "/bruno@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/7.mp4");
		break;
	case "/benedito@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/133.mp4");
		break;
	case "/editapoupres@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/136.mp4");
		break;
	case "/sapodemao@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/24.mp4");
		break;
	case "/astronauta@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/21.mp4");
		break;
	case "/seucuca@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/104.mp4");
		break;
	case "/fantasmadelinguagem@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/10.mp4");
		break;
	case "/lolodede@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/73.mp4");
		break;
	case "/exudecalda@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/137.mp4");
		break;
	case "/chance@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/22.mp4");
		break;	
		
	case "/marcelo@debochadoBot":
		sendVideo($chatId, "https://digoboratv.000webhostapp.com/video/novos/marcelo.mp4");
		break;
		
	case "/help@debochadoBot":
		sendMessage($chatId, "Cleiton rasta fazendo a flesta pra galera
Comandos inuteis:
/hi
Pokemons:
/felipe /bruno /chico /benedito /sapodemao /astronauta /exudecalda /chance
/milenedenko /seucuca /editapoupres /lolodede /fantasmadelinguagem
/bixodepontas /balboa /agamemnom /marinbomdo /ratinho /fleig /carangueijo 
/assombracao /quelho
MaxucaReggaero:
/meloapologia / lavaseusuvaco /nomorelonely /nomorelonely2 /seuperiquito
Saudacoes:
Bom dia ou bom dia
Boa tarde
Boa noite
Infelizmente devido a ganancia sem excrupulos do empresariado os comandos a seguir estão off
/debochometro
/viadometro ");
		break;
		
	case "Bom dia":
	    $name = $update["message"]["from"]["first_name"];
	    bom_dia($chatId, $name);
	    //sendMessage($chatId, "Bom dia ".$name);
	    break;
		
	case "bom dia":
	    $name = $update["message"]["from"]["first_name"];
	    bom_dia($chatId, $name." entende");
	    //sendMessage($chatId, "Bom dia ".$name);
	    break;
		
	
	case "Boa tarde":
	    $name = $update["message"]["from"]["first_name"];
            boa_tarde($chatId, $name." entende");
	    //sendMessage($chatId, "Boa tarde ".$name);
	    break;
		
	case "boa tarde":
	    $name = $update["message"]["from"]["first_name"];
	    //sendMessage($chatId, "Boa tarde ".$name);
            boa_tarde($chatId, $name." entende");
	    break;
		
	case "Boa noite":
	    $name = $update["message"]["from"]["first_name"];
	    //sendMessage($chatId, "Boa noite ".$name);
	    boa_noite($chatId, $name." entende");
	    break;
		
	case "boa noite":
	    $name = $update["message"]["from"]["first_name"];
	    //sendMessage($chatId, "Boa noite ".$name);
	     boa_noite($chatId, $name." entende");
	    break;
	
}


function devo($chatId)
{
   $random = rand(0, 20);
   $array = [ 0 => "deve",
              1 => "não deve",
              2 => "nem sim nem não, muito pelo contrário",
              3 => "veja bem...",
              4 => "se tu parar de ser boiola talvelz",
              5 => "deve mas só um pouquinho",
              6 => "deve mas só amanhã",
              7 => "cuidado com o coronga",
              8 => "faça oque seu coração mandar",
              9 => "deve mas, não hje, não amanhã, não essa semana, mas ainda este ano",
              10 => "não, não deve, agora pare de me atazanar",
              11 => "não... pera acho que sim, não.. talvez",
              12 => "ascende um pra relaxa",
              13 => "olha só a pergunta, kkk vamo ri galere",
              14 => "não deve",
              15 => "sim deve",
              16 => "só amanhã",
              17 => "só depois de amanhã",
              18 => "só depois depois de amanhã",
              19 => "não sei lhe informar",
              20 => "deve mas só um pouquinho",
		];
  sendMessage ($chatId, $array[$random]);
}


function bom_dia($chatId, $name)
{
  $frases = [ 0 => "Bom dia ",
	     1=> "Olá Como vai?",
	     2=> "Bom dia",
	     3=> "Bom dia, hoje vou pra são gonça visitar o papa ",
	     4=> "Buenos dias",
	     5=> "Bom dia, já consultou seu horoscopo hoje ",
	     6=> "Bom dia, acordou cedo hoje "];
	sendMessage($chatId, $frases[rand(0,6)].$name);
}

function boa_tarde($chatId, $name)
{
  $frases = [ 0 => "Boa tarde ",
	     1=> "Boa tarde, estou assistindo o programa de fofocas da tevelizão ",
	     2=> "Boa tarde, senti saudades ",
	     3=> "Bom tarde, seji bem vindo ",
	     4=> "Bom tarde ",
	     5=> "Bom tarde",
	     6=> "Boa tarde, acordou cedo hoje "];
	sendMessage($chatId, $frases[rand(0,6)].$name);
}

function boa_noite($chatId, $name)
{
  $frases = [ 0 => "Boa noite ",
	     1=> "Boa noite vida ",
	     2=> "Boa noite bebe ",
	     3=> "Ta cedo fica mais um pouco ",
	     4=> "Boa noite druma bem ",
	     5=> "Bom noite ",
	     6=> "Boa noite "];
	sendMessage($chatId, $frases[rand(0,6)].$name);
}

function ireiFunc($chatId)
{
	$frases = array("irá ooo se irá","talvez debochado","irá","não irá","não, e agora pare de me atazanar",
			"depende pode ser q sim pode ser que não","isso eu não sei lhe dizer",
			"irá mas só em 2022","me pergunte novamente daqui a pouco",
			"certamente que sim","irá depois que o corona passar","quem acredita sempre alcança",
			"pode ser que ela não seja ideal pra voce", "essa só irá te fazer sofrer","irá amanhã","irá só depois de amanhã","não será essa semana, não será esse mês mas será esse ano ainda",
		        "consulte o horoscopo a resposta estará lá", "pergunte pro papa", "irá... não pera...");
	$diga= rand(0,19);	
	sendMessage($chatId,$frases[$diga]);
}
 
?>
