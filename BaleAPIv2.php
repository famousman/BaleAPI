<?php 
/**
 * Bale.ai Bot V2 Class .
 * 
 * @author1 Saeb Khanzadeh <saeb.bnam@gmail.com>
 * first editation: 2019/07/15
 * second editation: 2019/09/01
 * third editation: 2019/10/09
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
	public function getData() // return all infromation by array.
	{
		$rawData = file_get_contents('php://input');
		return json_decode($rawData, true);
    }
	public function username() // return username (without @) of the User.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('from',$tmp_data['message']))
		if(array_key_exists('username',$tmp_data['message']['from']))
			return $tmp_data['message']['from']['username'];
    }
	public function FirstName() // return FirstName of the User.
    {
		$tmp_data=$this->data;
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('from',$tmp_data['message']))
		if(array_key_exists('first_name',$tmp_data['message']['from']))
			return $tmp_data['message']['from']['first_name'];
    }
	public function LastName() // return Nothing only for skip wrong codes about lastname.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
        return "";
    }
	public function UserID() // return ID of the User.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data)){
			return $tmp_data['callback_query']['from']['id'];
		}elseif(array_key_exists('message',$tmp_data)){
			if(array_key_exists('from',$tmp_data['message']))
			if(array_key_exists('id',$tmp_data['message']['from']))
				return $tmp_data['message']['from']['id'];
		}
    }
	public function ChatID() // return ID of the Chat.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data)){
			return $this->UserID();
		}elseif(array_key_exists('message',$tmp_data)){
			if(array_key_exists('chat',$tmp_data['message']))
			if(array_key_exists('id',$tmp_data['message']['chat']))
				return $tmp_data['message']['chat']['id'];
		}
    }
	public function ChatTitle() // return title of the Chat.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
        return $tmp_data['message']['chat']['title'];
    }
	public function ChatTYPE() // return Type of the Chat.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
        return $tmp_data["message"]["chat"]['type'];
    }
	public function MessageTYPE() // return Type of the message. 
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('photo',$tmp_data['message']))
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
		elseif(array_key_exists('voice',$tmp_data['message']))
        return 'voice';
		elseif(array_key_exists('latitude',$tmp_data['message']))
        return 'location';
		elseif(array_key_exists('phone_number',$tmp_data['message']))
        return 'contact';
		elseif(array_key_exists('text',$tmp_data['message']))
        return 'text';
		else
        return 'null';
    }
	public function MessageID() // return ID of the message.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('message_id',$tmp_data['message']))
			return ($tmp_data["message"]["message_id"]);
    }
	public function ReplyToMessageID() //if the message was replied to another one, it will return ID of message that replied to.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('reply_to_message',$tmp_data['message']))
		if(array_key_exists('message_id',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["message_id"];
		else
			return false;
    }
	public function ReplyToUserID() //if the message was replied to another one, it will return ID of member who replied to.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('reply_to_message',$tmp_data['message']))
		if(array_key_exists('from',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["from"]["id"];
		else
			return false;
    }
	public function ForwardFromID() //if the message was a forward message, it will return ID of member who sent.
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('forward_from',$tmp_data['message']))
		if(array_key_exists('id',$tmp_data['message']['forward_from']))
			return $tmp_data["message"]["forward_from"]["id"];
		else
			return false;
    }
	public function ReplyToText() // check is it a replied message or not. if it is, function will return the caption or the text
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('reply_to_message',$tmp_data['message']))
		if(array_key_exists('text',$tmp_data['message']['reply_to_message']))
			return $tmp_data["message"]["reply_to_message"]["text"];
		elseif(array_key_exists('caption',$tmp_data['message']['reply_to_message']))
			return ($tmp_data["message"]["reply_to_message"]["caption"]);
    }
	public function Text() //return text or caption of the message
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			$tmp_data=$tmp_data['callback_query'];
		if(array_key_exists('message',$tmp_data))
		if(array_key_exists('text',$tmp_data['message']))
			return $tmp_data['message']['text'];
		elseif(array_key_exists('caption',$tmp_data['message']))
			return $tmp_data['message']['caption'];
    }
	public function CallBack_Data() //return content of the call back request
    {
		$tmp_data=$this->data;
		if(array_key_exists('callback_query',$tmp_data))
			if(array_key_exists('data',$tmp_data['callback_query']))
				return $tmp_data['callback_query']['data'];
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
				$return="undefined chatid or text or message_id";
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
				$return=$this->sendrequest($arr);
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
	/*public function sendInvoice($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["title"])){
				if(isset($arr["reply_to_message_id"]))
					$arr["reply_to_message_id"]=$arr["reply_to_message_id"];
				$arr["command"]='sendMessage';
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or title";
			}			
		}else{
			$return="it is not an array";
		}
		return $return;
	}*/
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
			return "cURL Error #:" . $err;
		} else {
			return $response;
		}
			echo $response;
		}
}
?>
