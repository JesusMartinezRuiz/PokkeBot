<?php
$token = '6272645117:AAGczzUxb79w2LkjpH4dwUMKod15NxpSrQM';
//mi token de telegram
$website = 'https://api.telegram.org/bot'.$token;

$input = file_get_contents('php://input');
$update = json_decode($input, TRUE);

$chatId = $update['message']['chat']['id'];
$message = $update['message']['text'];

switch($message) {
    case '/start':
        //Simplemente una respuesta hardcodeada
        $response = 'Me has iniciado';
        sendMessage($chatId, $response);
        break;
    case '/info':
        //Simplemente una respuesta hardcodeada
        $response = 'Hola! Soy @PokkeMedacBot';
        sendMessage($chatId, $response);
        break;
    default:

        get_poke_bby_id($chatId,$message);
        break;
}

function sendMessage($chatId, $response) {
    $url = $GLOBALS['website'].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response);
    file_get_contents($url);
}


function get_poke_bby_id($chatId,$id){
    //Coge lo escrito y busca el nombre del pokemon, ademas lo muestra
    $url = "https://pokeapi.co/api/v2/pokemon/$id/";
    $response = json_decode(file_get_contents($url));
    $output = $response->species->name;
    sendMessage($chatId,$output);
}

?>