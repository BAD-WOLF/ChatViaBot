<?php

// header("Content-Type: application/json");



class Bot {

	// TOKEN
	public $token;

	// FUNÇÃO QUE RETORNA (chatID, chatINFO, all)
	public function getINFO(){

		// PEGANDO JSON RETORNADO PELA API
		$json=file_get_contents("https://api.telegram.org/bot$this->token/getUpdates");
		
		// DECODIFICANDO JSON PARA ARRAY
		$array=json_decode($json);

		if($array->result){

			
			// CONTANDO ITENS ASSOCIADOS AO PARÂMETRO RESET DA ARRAY
			$i=count($array->result);

			// RETORNANDO (cahtID, chatMSG, all)

			return [
				"chatID" => $array->result[$i-1]->message->chat->id,
				"chatMSG" => $array->result[$i-1]->message->text,
				"all" => $array
			];

		}else{
      $r=file_get_contents("https://api.telegram.org/bot$this->token/getUpdates");
      return $r;
    }
	}

	// FUNÇÃO QUE ENVIA (chatMSG)  DE ACORDO COM (chatID)
	public function sendMSG($chatID, $chatMSG){

		$parameters = [
			"chat_id" => $chatID,
			"text" => $chatMSG,
			"disable_web_page_preview" => "true",
			"parse_mode" => "Markdown"
		];

		// URL
		$url = "https://api.telegram.org/bot$this->token/sendMessage";

		// INSTANCIANDO O $curl COM curl_init() QUE ESTÁ SENDO INICIADO DE ACORDO COM A URL
		if (!$curl = curl_init($url))
		{
			// CASO DE ERRO ELE FALA QUAL FOI E SAI
			print curl_error($curl);
			exit();
		}

		// PARÂMETROS/ESPECIFICAÇÕES DA REQUISIÇÃO
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		
		// EXECUTANDO A REQUISIÇÃO E RETORNANDO O RESULTADO
		$outpot = curl_exec($curl);
		return $outpot;
	}
}
$bot = new Bot;

// $bot->token="5135456621:AAFLlThgyklkKZTznbXo3E_rKawZBs_r3-E";

// $bot->sendMSG(2130696887, "chublait blait");

?>
