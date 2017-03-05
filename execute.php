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
$firstname = isset($message['user']['first_name']) ? $message['user']['first_name'] : ""; /*ho cambiato chat con user per vedere se funziona sui gruppi*/
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$ciao_array= array(
"Ciao a sto cazzo, salutami tua madre ",
"Awe $firstname, mi hanno detto che tua madre fa i pompini",
"Oh $firstname, che bello averti qui, mi piacerebbe se fossi morto",
"E' proprio una fantastica gioranta per succhiare cazzi, $firstname",
"Ma le sembra normale che la metafisica renda impossibile l'eterogiunzione abitativa della realtà, $lastname?"
);

$photolink_array= array(
"https://hugelolcdn.com/i/273952.gif",
"http://m.memegen.com/zgf0u5.jpg"
);


header("Content-Type: application/json");
if(strpos($text, "/start") === 0 )
{
	$response = "Ciao $firstname, benvenuto!";
	$parameters = array('chat_id' => $chatId, "text" => $response);
	$parameters["method"] = "sendMessage";
}
elseif($text=="ciao")
{
	$response = $ciao_array[rand(0,count($ciao_array)-1)];
	$parameters = array('chat_id' => $chatId, "text" => $response);
	$parameters["method"] = "sendMessage";
}
elseif($text=="massetti")
{
	$response = "Massetti è un coglionazzone e veramente succhia il cazzone";
	$parameters = array('chat_id' => $chatId, "text" => $response);
	$parameters["method"] = "sendMessage";
}
elseif($text=="vaffanculo")
{
	$response = "A te e mammt";
	$parameters = array('chat_id' => $chatId, "text" => $response);
	$parameters["method"] = "sendMessage";
}
elseif($text=="dio cane")
{
	$image_link = $photolink_array[rand(0,count($photolink_array)-1)];
	$parameters = array('chat_id' => $chatId, "photo" => $image_link, "caption" => "Porcoddio");
	$parameters["method"] = "sendPhoto";
}
else
{
	$response = "Suca, non sono ancora pronto per risponderti a dovere, fatti un giro tra poco";
	$parameters = array('chat_id' => $chatId, "text" => $response);
	$parameters["method"] = "sendMessage";
}

echo json_encode($parameters);
