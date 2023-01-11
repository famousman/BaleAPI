<?php 
/**
 * Bale.ai Bot V2 Class .
 * 
 * @author1 Saeb Khanzadeh <saeb.bnam@gmail.com>
 * first editation: 2019/07/15
 * second editation: 2019/09/01
 * third editation: 2019/10/09
 * fourth editaton: 2022/12/10
 */
class balebot{
	private $token;
	private $apiurl;
	private $hasdata;
    private $data = [];
	public function __construct($token)
    {
        $this->token = $token;
        $this->apiurl = "https://tapi.bale.ai/bot".$token;
        $this->data = $this->getData();
    }
	public function setWebhook($url) // return all infromation by array.
	{
		$rawData = file_get_contents("https://tapi.bale.ai/".$this->token.'/setwebhook?url='.$url);
		return json_decode($rawData, true);
    }
	public function deleteWebhook() // return all infromation by array.
	{
		$rawData = file_get_contents("https://tapi.bale.ai/".$this->token.'/deleteWebhook');
		return json_decode($rawData, true);
    }
	public function getupdate() // return all infromation by array.
	{
		$rawData = file_get_contents("https://tapi.bale.ai/".$this->token.'/getupdate');
		 $this->data =json_decode($rawData, true);
		return $this->data;
    }
	public function getData() // return all infromation by array.
	{
		$rawData = file_get_contents('php://input');
		return json_decode($rawData, true);
    }
	public function username() // return username (without @) of the User.
    {
		$value=null;
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$value= $tmp_data['callback_query']['from']['username'];
		elseif(!is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('from',$tmp_data['message']))
		if(array_key_exists('username',$tmp_data['message']['from']))
			$value= $tmp_data['message']['from']['username'];
			return $value;
    }
	public function FirstName() // return FirstName of the User.
    {
		$value=null;
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data)){
			$value= $tmp_data['callback_query']['from']['first_name'];
		}elseif(!is_null($tmp_data) and array_key_exists('message',$tmp_data))
			if(array_key_exists('from',$tmp_data['message']))
				if(array_key_exists('first_name',$tmp_data['message']['from']))
					$value=$tmp_data['message']['from']['first_name'];
		return $value;
    }
	public function LastName() // return Nothing only for skip wrong codes about lastname.
    {
		$value=null;
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		return $value;
    }
	public function UserID() // return ID of the User.
    {
		$value=null;
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data)){
			$value= $tmp_data['callback_query']['from']['id'];
		}elseif(!is_null($tmp_data) and array_key_exists('message',$tmp_data)){
			if(array_key_exists('successful_payment',$tmp_data['message'])){
				if(array_key_exists('order_info',$tmp_data['message']['successful_payment'])){
					if(array_key_exists('user_id',$tmp_data['message']['successful_payment']['order_info'])){
						$value= $tmp_data['message']['successful_payment']['order_info']['user_id'];
					}
				}
			}
			elseif(array_key_exists('from',$tmp_data['message'])){
				if(array_key_exists('id',$tmp_data['message']['from'])){
					$value= $tmp_data['message']['from']['id'];
				}
			}
			elseif(array_key_exists('left_chat_member',$tmp_data['message'])){
				if(array_key_exists('id',$tmp_data['message']['left_chat_member'])){
					$value= $tmp_data['message']['left_chat_member']['id'];
				}
			}
		}
		elseif(!is_null($tmp_data) and array_key_exists('edited_message',$tmp_data)){
			if(array_key_exists('from',$tmp_data['edited_message']))
			if(array_key_exists('id',$tmp_data['edited_message']['from']))
				$value=  $tmp_data['edited_message']['from']['id'];
		}
		return $value;
    }
	public function ChatID() // return ID of the Chat.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data)){
			return $tmp_data['callback_query']['message']['chat']['id'];
		}elseif(!is_null($tmp_data) and array_key_exists('message',$tmp_data)){
			if(array_key_exists('chat',$tmp_data['message']))
			if(array_key_exists('id',$tmp_data['message']['chat']))
				return $tmp_data['message']['chat']['id'];
		}elseif(!is_null($tmp_data) and array_key_exists('edited_message',$tmp_data)){
			if(array_key_exists('chat',$tmp_data['edited_message']))
			if(array_key_exists('id',$tmp_data['edited_message']['chat']))
				return $tmp_data['edited_message']['chat']['id'];
		}
    }
	public function MessageDate() // return ID of the Chat.
    {
		$value=time();
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data)){
			$value= $tmp_data['callback_query']['date'];
		}elseif(!is_null($tmp_data) and array_key_exists('message',$tmp_data)){
			if(array_key_exists('date',$tmp_data['message']))
				$value= $tmp_data['message']['date'];
		}elseif(!is_null($tmp_data) and array_key_exists('edited_message',$tmp_data)){
			if(array_key_exists('date',$tmp_data['edited_message']))
				$value= $tmp_data['edited_message']['date'];
		}
		return $value;
    }
	public function ChatTitle() // return title of the Chat.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
        return $tmp_data['message']['chat']['title'];
    }
	public function ChatTYPE() // return Type of the Chat.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
        return $tmp_data["message"]["chat"]['type'];
    }
	public function MessageTYPE() // return Type of the message. 
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			return 'text';
		if(!is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('animation',$tmp_data['message']))
        return 'animation';
		elseif(array_key_exists('photo',$tmp_data['message']))
        return 'photo';
		elseif(array_key_exists('video',$tmp_data['message']))
        return 'video';
		elseif(array_key_exists('gif',$tmp_data['message']))
        return 'gif';
		elseif(array_key_exists('file',$tmp_data['message']))
        return 'file';
		elseif(array_key_exists('audio',$tmp_data['message']))
        return 'audio';
		elseif(array_key_exists('sound',$tmp_data['message']))
        return 'sound';
		elseif(array_key_exists('document',$tmp_data['message']))
        return 'document';
		elseif(array_key_exists('sticker',$tmp_data['message']))
        return 'sticker';
		elseif(array_key_exists('voice',$tmp_data['message']))
        return 'voice';
		elseif(array_key_exists('location',$tmp_data['message']))
        return 'location';
		elseif(array_key_exists('phone_number',$tmp_data['message']))
        return 'contact';
		elseif(array_key_exists('contact',$tmp_data['message']))
        return 'contact';
		elseif(array_key_exists('text',$tmp_data['message']))
        return 'text';
		elseif(array_key_exists('left_chat_member',$tmp_data['message']))
        return 'left_chat_member';
		elseif(array_key_exists('new_chat_members',$tmp_data['message']))
        return 'new_chat_members';
		elseif(array_key_exists('new_chat_member',$tmp_data['message']))
        return 'new_chat_members';
		elseif(array_key_exists('successful_payment',$tmp_data['message']))
        return 'successful_payment';
		else
        return 'null';
    }
	public function MessageID() // return ID of the message.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(!is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('message_id',$tmp_data['message']))
			return ($tmp_data["message"]["message_id"]);
    }
	public function ReplyToMessageID() //if the message was replied to another one, it will return ID of message that replied to.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(!is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('reply_to_message',$tmp_data['message']))
		if(array_key_exists('message_id',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["message_id"];
		else
			return false;
    }
	public function ReplyToUserID() //if the message was replied to another one, it will return ID of member who replied to.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('reply_to_message',$tmp_data['message']))
		if(array_key_exists('from',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["from"]["id"];
		elseif(array_key_exists('chat',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["chat"]["id"];
		else
			return false;
    }
	public function ForwardFromID() //if the message was a forward message, it will return ID of member who sent.
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('message',$tmp_data))
       		if(array_key_exists('forward_from_chat',$tmp_data['message']) or array_key_exists('forward_from',$tmp_data['message']))
              		if(array_key_exists('id',$tmp_data['message']['forward_from_chat']))
              			return $tmp_data["message"]["forward_from_chat"]["id"];
              		elseif(array_key_exists('id',$tmp_data['message']['forward_from']))
              			return $tmp_data["message"]["forward_from"]["id"];
              		else
              			return null;
				else
					return null;
			else
				return null;
			
    }
	public function ReplyToText() // check is it a replied message or not. if it is, function will return the caption or the text
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('reply_to_message',$tmp_data['message']))
		if(array_key_exists('text',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["text"];
		elseif(array_key_exists('caption',$tmp_data['message']['reply_to_message']))
			return ($tmp_data["message"]["reply_to_message"]["caption"]);
    }
	public function Text() //return text or caption of the message
    {
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('message',$tmp_data))
		if(array_key_exists('text',$tmp_data['message']))
			return $tmp_data['message']['text'];
		elseif(!is_null($tmp_data) and array_key_exists('caption',$tmp_data['message']))
			return $tmp_data['message']['caption'];
		elseif(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('edited_message',$tmp_data))
		if(array_key_exists('text',$tmp_data['edited_message']))
			return $tmp_data['edited_message']['text'];
		elseif(!is_null($tmp_data) and array_key_exists('caption',$tmp_data['edited_message']))
			return $tmp_data['edited_message']['caption'];
    }
	public function CallBack_Data() //return content of the call back request
    {
		$return2=null;
		$tmp_data=$this->data;
		if(!is_null($tmp_data) and !is_null($tmp_data) and array_key_exists('callback_query',$tmp_data))
			if(array_key_exists('data',$tmp_data['callback_query']))
				$return2=$tmp_data['callback_query']['data'];
		return $return2;
    }
	public function deleteMessage($arr) //return result after delete the message
    {
		$arr['command']='deleteMessage';
		if(array_key_exists('message_id',$arr))
			return $this->sendrequest($arr);
		else
			return "undefined message_id";
		/*$data_json=json_encode($data);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->apiurl."/deleteMessage",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			 // CURLOPT_MAXREDIRS => 10,
			//CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data_json,
			CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}*/
    }
	public function editText($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["message_id"]) and isset($arr["text"])){
				$arr["command"]='editMessageText';
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or message_id or text or message_id";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function editMessageText($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["message_id"]) and isset($arr["text"])){
				$arr["command"]='editMessageText';
				$arr['text']=trim($arr['text']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or message_id or text or message_id";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendText($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["text"])){
				$arr["command"]='sendMessage';
				$arr['text']=trim($arr['text']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or text";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendMessage($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["text"])){
				$arr["command"]='sendMessage';
				$arr['text']=trim($arr['text']);
				$return=$this->sendrequest($arr);
			}
			else{
				$return="undefined chatid or text";
			}			
		}
		else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendPhoto($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["photo"])){
				$arr["command"]='sendPhoto';
				$arr['photo']=trim($arr['photo']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or photo";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendAudio($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["audio"])){
				$arr["command"]='sendAudio';
				$arr['audio']=trim($arr['audio']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or audio";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendVideo($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["video"])){
				$arr["command"]='sendVideo';
				$arr['video']=trim($arr['video']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or video";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendVoice($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["voice"])){
				$arr["command"]='sendVoice';
				$arr['voice']=trim($arr['voice']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or voice";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendDocument($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["document"])){
				$arr["command"]='sendDocument';
				$arr['document']=trim($arr['document']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or document";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendLocation($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["latitude"]) and isset($arr["longitude"])){
				$arr["command"]='sendLocation';
				$arr['latitude']=trim($arr['latitude']);
				$arr['longitude']=trim($arr['longitude']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or latitude or longitude";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendContact($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["phone_number"]) and isset($arr["first_name"])){
				$arr["command"]='sendLocation';
				$arr['phone_number']=trim($arr['phone_number']);
				$arr['first_name']=trim($arr['first_name']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or phone_number or first_name";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function sendInvoice($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["title"]) and isset($arr["description"]) and isset($arr["provider_token"]) and isset($arr["prices"]) and isset($arr["payload"])){
				$arr["command"]='sendInvoice';
				$arr['title']=trim($arr['title']);
				$arr['description']=trim($arr['description']);
				$arr['provider_token']=trim($arr['provider_token']);
				$arr['payload']=trim($arr['payload']);
if(is_string($arr['prices']) or is_int($arr['prices']) or is_integer($arr['prices'])  or is_double($arr['prices'])  or is_float($arr['prices']) )
					$arr['prices']=array(array("label" => "no lable", "amount" => $arr['prices']));
				$return="this".$this->sendrequest($arr);
			}else{
				$return="undefined chatid or title or description or provider_token or prices or payload";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function getFile($arr)
	{
		if(is_array($arr)){
			if(isset($arr["file_id"]) ){
				$arr["command"]='getFile';
				$arr['file_id']=trim($arr['file_id']);
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined file_id";
			}			
		}else{
			$return="it is not an array";
		}
	}
	public function getMe()
	{
		$arr["command"]='getMe';
		$return=$this->sendrequest($arr);
	}
	
    public function buildKeyBoard(array $options, $onetime = false, $resize = false, $selective = true)
    {
        $replyMarkup = [
            'keyboard'          => $options,
            'one_time_keyboard' => $onetime,
            'resize_keyboard'   => $resize,
            'selective'         => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }
	public function buildInlineKeyBoard(array $options)
    {
        $replyMarkup = array (
		  'inline_keyboard' => 
			array ( $options )
		);
        $encodedMarkup = ($replyMarkup);
        return $replyMarkup;
    }
	 public function buildInlineKeyboardButton($text, $url = '', $callback_data = '', $switch_inline_query = null, $switch_inline_query_current_chat = null, $callback_game = '', $pay = '')
    {
        $replyMarkup = [
            'text' => $text,
        ];
        if ($url != '') {
            $replyMarkup['url'] = $url;
        } elseif ($callback_data != '') {
            $replyMarkup['callback_data'] = $callback_data;
        } elseif (!is_null($switch_inline_query)) {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        } elseif (!is_null($switch_inline_query_current_chat)) {
            $replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        } elseif ($callback_game != '') {
            $replyMarkup['callback_game'] = $callback_game;
        } elseif ($pay != '') {
            $replyMarkup['payload'] = $pay;
        }
        return $replyMarkup;
    }
	public function getChat($chat_id)
	{
		$arr["command"]='getChat';
		$arr["chat_id"]=$chat_id;
		$return=$this->sendrequest($arr);
	}
	public function getChatAdministrators($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"])){
				$arr["command"]='GetChatAdministrators';
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function getChatMembersCount($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"])){
				$arr["command"]='GetChatMembersCount';
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	public function getChatMember($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"])){
				$arr["command"]='GetChatMember';
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}
	private function sendrequest($arr)
	{
		$command=$arr['command'];
		unset($arr['command']);
		$data_json=json_encode($arr);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->apiurl."/$command",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			 // CURLOPT_MAXREDIRS => 10,
			//CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data_json,
			CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			return array("ok"=>false,'description'=>"cURL Error #:" . $err);
		} else {
			return json_decode($response,true);
		}
			echo json_decode($response,true);
		}
}
?>
