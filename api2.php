<?php
header('Content-Type:application/json');

require_once "myMethods.php";
require_once "bot_telegram.php";
$bot = new \connect\Bot;
$obj = new \my\myMethod;

if(isset($_GET["id"], $_GET["token"], $_GET["text"])){
	if($obj->if_true($_GET["id"], $_GET["token"], $_GET["text"])){
		$id=$_GET["id"];
		$token=$_GET["token"];
		$text=$_GET["text"];
		$file=fopen($token.".json", "a+");
		if(filesize($token.".json") == 0){
			fwrite($file, '{"result":[]}');
			$strJSON=file_get_contents($token.".json");
		}else if(json_decode(file_get_contents($token.".json"))){
			$strJSON=file_get_contents($token.".json"); 
		}
		
		$obj->file_clear($token.".json");
		$Darray=json_decode($strJSON, True);
		

		$i=count($Darray["result"]);
		$Darray["result"][$i]=["request" => $_GET];
		$ENstrJSON=json_encode($Darray);
		fwrite($file, $ENstrJSON);
		fclose($file);
		$strJSON=file_get_contents($token.".json");
		$Darray=json_decode($strJSON);
		echo file_get_contents($token.".json");
		
		
		if(is_object($bot)){
			$bot->token=$token;
			$bot->sendMSG($id, $text);
			if(method_exists($bot, "getINFO")){
				// $a=$bot->getINFO();
				// echo !empty($a["chatMSG"])? $a["chatID"] : Null;
			}
		}
	}


// print_r($_SERVER);
// echo $_SERVER["
// echo $_SERVER["
// echo $_SERVER["
// echo $_SERVER["
?>
