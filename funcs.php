<?php

function escolha($frase ){
    $opcoes = substr($frase, 17, strlen($frase));
    $arr = explode(" ou ",$opcoes);
    return $arr[rand(0, count($arr) - 1)];
}

$newsUrl = $_ENV['NEWS_URL'];

function noticias(){


$news = file_get_contents($newsUrl);

$news = json_decode($news, true);

$titles = null;

foreach($news['articles'] as &$item){
 $titles = $titles."\n".$item['title']."\n";

}

return $titles;

    
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


?>
