<?php
class Bot{
    private $update = null;
    private $chatId = null;
    private $message = null;
    private $id = null;
    private $token = 0;
    private $website = "boturl";

    function __construct() {
    $this->$update = file_get_contents('php://input');
    $this->$update = json_decode($update, TRUE);
    $this-> $chatId = $update["message"]["chat"]["id"];
    $this->$message = $update["message"]["text"];
    $this->$id = $update["message"]["message_id"];
    }

    function checkCommand($command, $func){
        if(strcmp($command, $this->$message ) == 0){
            $func();
        } 
    }

    function sendMessage($text){
        $url = $this->$website."/sendMessage?chat_id=".$chatId."&text=".urlencode($text);
	      file_get_contents($url);
    }

    function replyMessage($text){
       $url = $this->$website."/sendMessage?chat_id=".$chatId."&text=".urlencode($message)."&reply_to_message_id=".$id;
	     file_get_contents($url);	
    }

    function sendAudio($text){
        $url = $this->$website."/sendAudio?chat_id=".$chatId."&caption=audio&audio=".urlencode($message);
	      file_get_contents($url);
    }

    function sendVideo($text){
        $url = $this->$website."/sendVideo?chat_id=".$chatId."&video=".$message;
	      file_get_contents($url);
    }
    
    function sendImage ($chatId, $message){
      $url = $this->$website."/sendPhoto?chat_id=".$chatId."&photo=".$message;
      file_get_contents($url);	
    }
}
?>
