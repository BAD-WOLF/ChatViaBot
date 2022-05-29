<?php


require_once "bot_telegram.php";

class myMethod {
	public function if_true(){
		$a=func_get_args();
		$b=func_num_args();
    $array=[];
    foreach($a as $kay => $value){
      if(!empty($value)){
      $array[]=True;
      }
    }
        	if(count($array)==$b) return True;
	}

	public function file_clear(){
		$f=func_get_args();
		foreach($f as $value){
			if(file_exists($value)){
				$file=fopen($value, "w");
				fclose($file);
			}else return False;
		}
	}
  public function is_token(){
    $t=func_get_args();
    $n=func_num_args();
    $array=[];
    foreach($t as $var){
      
    }
  }
}
?>
