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
$from = isset($message['from']) ? $message['from'] : "";
$from_user_firstname = isset($from['first_name']) ? $from['first_name'] : "";
$from_user_lastname = isset($from['last_name']) ? $from['last_name'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);


$ciao_array= array(
"Ciao a sto cazzo, salutami tua madre ",
"Awe $from_user_firstname, mi hanno detto che tua madre fa i pompini",
"Oh $from_user_firstname, che bello averti qui, mi piacerebbe se fossi morto",
"E' proprio una fantastica gioranta per succhiare cazzi, $from_user_firstname",
"Ma le sembra normale che la metafisica renda impossibile l'eterogiunzione abitativa della realtà, $from_user_lastname?"
);

$diocane_array= array(
"https://hugelolcdn.com/i/273952.gif",
"http://m.memegen.com/zgf0u5.jpg",
"https://cdn.meme.am/cache/instances/folder920/27294920.jpg"
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
	$image_link = $diocane_array[rand(0,count($diocane_array)-1)];
	$parameters = array('chat_id' => $chatId, "photo" => $image_link, "caption" => "Un dioporco anche a te, caro $from_user_firstname");
	$parameters["method"] = "sendPhoto";
}
else
{
	$response = "Message = $message; Messageid = $messageId; chatID = $chatId; Firstname =  $firstname; LastName = $lastname; Username = $username; Date= $date; Text = $text ; From_User = $from_user_firstname $from_user_lastname";
	$parameters = array('chat_id' => $chatId, "text" => $response);
	$parameters["method"] = "sendMessage";

}

echo json_encode($parameters);
