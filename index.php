<?php
// token=eIkl8qxEQGNbBig6eo7o67Qq
// team_id=T0001
// team_domain=example
// channel_id=C2147483705
// channel_name=test
// user_id=U2147483697
// user_name=Steve
// command=/weather
// text=94070
// response_url=https://hooks.slack.com/commands/1234/5678

const ANCHO = 3;

const CENTRO = '/';
const PINO = '*';


$valores = explode(" ", htmlspecialchars($_GET["text"]));
$tamanio = min($valores[0]+5, 20);
$icono = $valores[1];
$centro = $valores[2];


$data = array(
    'text' => dibjar(triangular($tamanio), $icono, $centro),
    'response_type' => 'in_channel',
);
header('Content-Type: application/json');
echo json_encode($data);


function triangular($tamanio){
    $n = $i = $tamanio;
    $ret = "";
    while ($i--){
        $ret .= tabear($i*ANCHO);
        
        if($i == floor($n/2)){
            $tmp = str_repeat(PINO.' ', $n - $i)."\n";
            $tmp[$n-$i-($n-$i)%2]=CENTRO;
            $ret .= $tmp;
        } else {
            $ret .= str_repeat('* ', $n - $i)."\n";
        }
    }
    $ret .= tabear($n*ANCHO-2).'*';
    return $ret;
}

function tabear($i){
    return '.'.str_repeat(' ', $i);
}

function dibjar($txt, $icono, $centro){
    return str_replace(CENTRO, $centro, str_replace(PINO, $icono, $txt));
}
?>