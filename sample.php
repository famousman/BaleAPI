<?php 
include "BaleAPIv2.php";
$token="write token here";
$bot=new balebot($token);
$chat_id=$bot->ChatID();
$user_id=$bot->UserID();
$Text_orgi=$bot->Text();
// send a text message 
$content=array("chat_id" =>$chat_id,"text" =>"just text message");
$bot->sendText($content);
// send an invoice order
$content=array("chat_id" =>$chat_id,"title" =>"Order Title","description" =>"Order Description","provider_token" =>"Iran Credit Card Number","payload" => "value for return to bot", "prices" => 50000 );
$response=$bot->sendInvoice($content);
// send a audio message
$contenttmp = array('chat_id' => $chat_id, 'audio' => "file_id", 'caption' => "caption");
$bot->sendAudio($contenttmp);
// send a photo message
$contenttmp = array('chat_id' => $chat_id, 'photo' => "file_id", 'caption' => "caption");
$bot->sendPhoto($contenttmp);
// send a video message
$contenttmp = array('chat_id' => $chat_id, 'video' => "file_id", 'caption' => "caption");
$bot->sendVideo($contenttmp);
// send a voice message
$contenttmp = array('chat_id' => $chat_id, 'voice' => "file_id", 'caption' => "caption");
$bot->sendVoice($contenttmp);
// send a document message
$contenttmp = array('chat_id' => $chat_id, 'document' => "file_id", 'caption' => "caption");
$bot->sendDocument($contenttmp);
// send a Location message
$contenttmp = array('chat_id' => $chat_id, 'phone_number' => "phone_number", 'first_name' => "first_name");
$bot->sendContact($contenttmp);
// send a Type of message to the chat environment
$content=array("chat_id" =>$chat_id,"text" =>$bot->MessageTYPE());
$bot->sendText($content);
// send a text message with the keyboard
$Keyboard = [[ 'keyboard text' ]];
$Keyboard = $balebot->buildKeyBoard($Keyboard, true, true);
$contenttmp = array('chat_id' => $chat_id,"text"=>"text", 'reply_markup' =>$Keyboard);
$bot->sendText($contenttmp);


// send inline keyboard
$inlineKeyboardoption =	[
	$balebot->buildInlineKeyBoardButton("title", '','callback text' ),
];
$Keyboard = $balebot->buildInlineKeyBoard($inlineKeyboardoption);
$contenttmp = array('chat_id' => $chat_id,"text"=>"text", 'reply_markup' =>$Keyboard);
$balebot->sendText($contenttmp);


?>
