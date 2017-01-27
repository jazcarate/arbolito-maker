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


$valores = explode(" ", htmlspecialchars($_GET["text"]));
$tamanio = $valores[0]+5;
$ancho = $valores[1];
$icono = $valores[2];
$centro = $valores[3];

$data = array(
    'text' => dibjar(triangular($tamanio, $ancho), $icono, $centro),
    'response_type' => 'in_channel',
);
header('Content-Type: application/json');
echo json_encode($data);


function triangular($tamanio, $ancho){
    $n = $i = $tamanio;
    $ret = "";
    while ($i--){
        $ret .= tabear($i * $ancho);
        
        if($i == floor($n/2)){
            $tmp = str_repeat('* ', $n - $i)."\n";
            $tmp[($n-$i)/2+1]='c';
            $ret .= $tmp;
        } else {
            $ret .= str_repeat('* ', $n - $i)."\n";
        }
    }
    $ret .= tabear($n*$ancho).'*';
    return $ret;
}

function tabear($i){
    return '.'.str_repeat(' ', $i);
}

function dibjar($txt, $icono, $centro){
    return str_replace('c', $centro, str_replace('*', $icono, $txt));
}
?>