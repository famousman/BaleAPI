<?php 
/**
 * Bale.ai Bot V2 Class .
 * 
 * @author1 Saeb Khanzadeh <saeb.bnam@gmail.com>
 * first editation: 2019/07/15
 */
/*
{"update_id":7,"message":{
	"message_id":-2058249854,
	"from":{
		"id":356885670,"is_bot":false,"first_name":"Saeb Khanzadeh","username":"saebkhanzadeh"
	},
	"date":1563026174,
	"chat":{
		"id":5485449280,"type":"group","title":"dfgdf","username":""
	},
	"reply_to_message":{
		"message_id":265538325,
		"from":{
				"id":1459726601,"is_bot":false,"first_name":""
			},"date":1563026164,
			"chat":{
				"id":1459726601,"type":"private"
			},
		"text":"knamooooone"
	},
	"text":"خنششششششششع"
}}
{"update_id":9,"message":{
	"message_id":-55360282,
	"from":{
		"id":356885670,"is_bot":false,"first_name":"Saeb Khanzadeh","username":"saebkhanzadeh"
	},"date":1563050844,"chat":{
		"id":356885670,"type":"private"
	},
	"photo":[
	{"file_id":"356885670:7821767390326164994:1","width":504,"height":512,"file_size":67011}
	],"caption":""
	}}
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
	public function getData()
	{
		//if (empty($this->data)) {
            $rawData = file_get_contents('php://input');
            return json_decode($rawData, true);
        //} else {
        //    return $this->data;
        //}
    }
	public function username()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('from',$this->data['message']))
		if(array_key_exists('username',$this->data['message']['from']))
			return $this->data['message']['from']['username'];
    }
	public function FirstName()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('from',$this->data['message']))
		if(array_key_exists('first_name',$this->data['message']['from']))
			return $this->data['message']['from']['first_name'];
    }
	public function LastName()
    {
        //$type = $this->getUpdateType();
        return "";
    }
	public function UserID()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('from',$this->data['message']))
		if(array_key_exists('id',$this->data['message']['from']))
			return $this->data['message']['from']['id'];
    }
	public function ChatID()
    {
        //$type = $this->getUpdateType();
        return $this->data['message']['chat']['id'];
    }
	public function ChatTitle()
    {
        //$type = $this->getUpdateType();
        return $this->data['message']['chat']['title'];
    }
	public function ChatTYPE()
    {
        //$type = $this->getUpdateType();
        return $this->data["message"]["chat"]['type'];
    }
	public function MessageTYPE()
    {
		if(array_key_exists('message',$this->data))
		if(array_key_exists('photo',$this->data['message']))
        return 'photo';
		elseif(array_key_exists('video',$this->data['message']))
        return 'video';
		elseif(array_key_exists('gif',$this->data['message']))
        return 'gif';
		elseif(array_key_exists('file',$this->data['message']))
        return 'file';
		elseif(array_key_exists('audio',$this->data['message']))
        return 'audio';
		elseif(array_key_exists('sound',$this->data['message']))
        return 'sound';
		elseif(array_key_exists('document',$this->data['message']))
        return 'document';
		elseif(array_key_exists('voice',$this->data['message']))
        return 'voice';
		elseif(array_key_exists('latitude',$this->data['message']))
        return 'location';
		elseif(array_key_exists('phone_number',$this->data['message']))
        return 'contact';
		elseif(array_key_exists('text',$this->data['message']))
        return 'text';
		else
        return 'null';
    }
	public function randomId()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('randomId',$this->data['message']))
			return $this->data["message"]["randomId"];
    }
	public function accessHash()
    {
        //$type = $this->getUpdateType();
        return $this->data["update_id"];
    }
	public function MessageID()
    {
        //$type = $this->getUpdateType();
        return $this->data["message"]["message_id"];
    }
	public function ReplyToMessageID()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('reply_to_message',$this->data['message']))
		if(array_key_exists('message_id',$this->data['message']['reply_to_message']))
        return $this->data["message"]["reply_to_message"]["message_id"];
    }
	public function ReplyToUserID()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('reply_to_message',$this->data['message']))
		if(array_key_exists('from',$this->data['message']['reply_to_message']))
        return $this->data["message"]["reply_to_message"]["from"]["id"];
    }
	public function ReplyToText()
    {
		if(array_key_exists('message',$this->data))
		if(array_key_exists('reply_to_message',$this->data['message']))
		if(array_key_exists('text',$this->data['message']['reply_to_message']))
			return $this->data["message"]["reply_to_message"]["text"];
		elseif(array_key_exists('caption',$this->data['message']['reply_to_message']))
			return ($this->data["message"]["reply_to_message"]["caption"]);
    }
	public function Text()
    {
        //$type = $this->getUpdateType();
		if(array_key_exists('message',$this->data))
		if(array_key_exists('text',$this->data['message']))
			return $this->data['message']['text'];
    }
	public function deleteMessage($chat_id,$message_id)
    {
		$data=array('chat_id' => $chat_id,'message_id' => $message_id , 'command'=>'deleteMessage');
		return $this->sendrequest($data);
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
	public function getMe()
	{
		$arr["command"]='getMe';
		$return=$this->sendrequest($arr);
	}
	public function buildInlineKeyBoard(array $options)
    {
        $replyMarkup = [
            'inline_keyboard' => $options,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
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
            $replyMarkup['pay'] = $pay;
        }
        return $replyMarkup;
    }
	public function getChat($chat_id)
	{
		$arr["command"]='getChat';
		$arr["chat_id"]=$chat_id;
		$return=$this->sendrequest($arr);
	}
	public function getFile($fileid)
	{
		$arr["command"]='getFile';
		$arr["file_id"]=$fileid;
		$return=$this->sendrequest($arr);
	}
	public function sendText($arr)
	{
		if(is_array($arr)){
			if(isset($arr["chat_id"]) and isset($arr["text"])){
				$arr["command"]='sendMessage';
				$return=$this->sendrequest($arr);
			}else{
				$return="undefined chatid or text or randomId or message_id";
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
				$return="undefined chatid or title or randomId or message_id";
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
		}
	
}


?>
