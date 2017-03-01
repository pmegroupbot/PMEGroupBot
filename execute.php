<?php

/* define("BOT_TOKEN", "MKE INSERISCI QUI IL TOKEN"); */

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$ciao_array={
"Ciao a sto cazzo, salutami tua madre ",
"Awe $firstname, mi hanno detto che tua madre fa i pompini",
"Oh $firstname, che bello averti qui, mi piacerebbe se fossi morto",
"E' proprio una fantastica gioranta per succhiare cazzi, $firstname",
"Ma le sembra normale che la metafisica renda impossibile l'eterogiunzione abitativa della realtà, $lastname?"
)
	


header("Content-Type: application/json");
if(strpos($text, "/start") === 0 )
{
	$response = "Ciao $firstname, benvenuto!";
}
elseif($text=="ciao")
{
	$response = $ciao_array[rand(0,count($ciao_array)-1)];
}
elseif($text=="massetti")
{
	$response = "Massetti è un coglionazzone e veramente succhia il cazzone";
}
elseif($text=="vaffanculo")
{
	$response = "A te e mammt";
}
else
{
	$response = "Suca, non sono ancora pronto per risponderti a dovere, fatti un giro tra poco";
}
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
