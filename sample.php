<?php 
include("BaleAPIv2.php");
$token="{token}";
$bot=new balebot($token);
$chat_id=$bot->ChatID();
$Text="Ta Da";
$content=array("chat_id" =>$chat_id,"text" =>$Text);
$bot->sendText($content);
?>
