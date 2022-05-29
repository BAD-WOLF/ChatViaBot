<?php 

function if_true(){
    $parametros = func_get_args();
    foreach($parametros as $parametro){
        
        if(!$parametro){
            return false;
        }
        
    }
    
    return true;
}

?>
<!DOCTYPE html>

<html lang="en">

        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="template HTML padrão">
                <title>template HTML padrão</title>
                <meta name="author" content="Matheu">
                <meta name="theme-color" content="#4285f4"/>
                <link rel="stylesheet" href="/style/style.css"/>
        </head>

        <body>

		<?php
			require_once "myMethods.php";
			
			if(isset($_POST["token"], $_POST["id"], $_POST["text"])){	
				if(if_true($_POST["token"], $_POST["id"], $_POST["text"])){
					$token=$_POST["token"];
          $id=$_POST["id"];
          $text=$_POST["text"];
					require_once "bot_telegram.php";
					$bot = new Bot;
					if(is_object($bot)){
						$bot->token=$token;
						$bot->sendMSG($id, $text);
 						if(method_exists($bot, 'getIFNO')){
							$a=$bot->getINFO();
							echo !empty($a["chatMSG"])? $a["chatMSG"] : Null;
						}
					}
				}
			}
		?>

		
		<script type="text/javascript">

                        function transition(){
                                document.getElementById('form').method='GET';
                                document.getElementById('form').action='api.php';
                        }

		</script>
          <div class="container">
		        <form action="" method="post" id="form">
			        <div class="row">
                <div class="col-100">
			            <input type="submit" class="start" value="START API" onclick="transition()"/>
                </div>
              </div>
              <div class="row">
                <div class="col-25">
			            <p>Digite o id do chat da pessoa cuja você quer enviar mensagem</p>
                </div>
               <div class="col-75">
			            <input type="number" name="id" placeholder="User ID"/>
                </div>
              </div>
              <div class="row">
                <div class="col-25">
			            <p>Token do bot</p>
                </div>
                <div class="col-75">  
						      <input type="text" name="token" placeholder="TOKEN"/>
                </div>
              </div>
              <div class="row">
                <div class="col-25">
			            <p>Mensagem pra enviar</p>
                </div>
                <div class="col-75">
						      <input style="height:100px;" type="text" name="text" placeholder="Mensagem..."/>
                </div>
              </div>
              <div class="row">
			          <input type="submit"/>
              </div>  
			
		        </form>
          </div>
		<p id="demo"><p>
        </body>
</html>
