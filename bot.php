<?php


function checkCommand($message, $comm){
	$m1 = strcmp(strtolower($message), $comm );
	$m2 = strcmp(strtolower($message), $comm.strtolower($GLOBALS[botname]));
   if ($m1==0 || $m2==0){ return true; }
    else return false;
}


function sendMessage ($chatId, $message) {	
	$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
	file_get_contents($url);
}

function reply_msg($chatId, $message, $id){
  $url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".urlencode($message)."&reply_to_message_id=".$id;
	file_get_contents($url);	
}

function sendVideo ($chatId, $message) {
	$url = $GLOBALS[website]."/sendVideo?chat_id=".$chatId."&video=".$message;
	file_get_contents($url);
	
}

function sendAudio ($chatId, $message) {
	$url = $GLOBALS[website]."/sendAudio?chat_id=".$chatId."&caption=audio&audio=".urlencode($message);
	file_get_contents($url);	
}

function sendImage ($chatId, $message){
	$url = $GLOBALS[website]."/sendPhoto?chat_id=".$chatId."&photo=".$message;
	file_get_contents($url);	
}

?>
