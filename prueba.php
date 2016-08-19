<?php 
define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
	
// read incoming info and grab the chatID
$content = file_get_contents(API_URL . 'getUpdates');
$update = json_decode($content, true);

$results = $update['result'];

foreach ($results as $result){
	
	// compose reply
	$reply =  sendMessage();

	$chatID = $result["message"]["chat"]["id"];
	
	// send reply
	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
	file_get_contents($sendto);
}



function sendMessage(){
	$message = "Respuesta para Tomas.";
return $message;
}
