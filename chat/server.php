<?php
ini_set("display_errors", 1);
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
// prevent the server from timing out
set_time_limit(0);
// include the web sockets server script (the server is started at the far bottom of this file)
require 'class.PHPWebSocket.php';
class mensaje {
	   public $msg;
	   public $tx;
	   public $tipo;
	   public $hora;
	}
// when a client sends data to the server
function wsOnMessage($clientID, $message, $messageLength, $binary) {
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	// check if message length is 0
	if ($messageLength == 0) {
		$Server->wsClose($clientID);
		return;
	}

	$messageObj = json_decode($message);


	if(isset($messageObj->action) && $messageObj->action=="asignar"){
		$Server->wsClients[$clientID][12]=$messageObj->id_usuario;

		$mensaje = new mensaje();
		$mensaje->tx = $Server->wsClients[$clientID][12];
		$mensaje->msg = null;
		$mensaje->tipo = 1;
		$message=json_encode($mensaje);

		//enviar mensaje de conexion
		$id_usuarios="0";
		foreach ( $Server->wsClients as $id => $client ){
			if ( $id != $clientID )
				$id_usuarios.=",".$client[12];
				$Server->wsSend($id, $message);
		}

		
		$mensaje2 = new mensaje();
		$mensaje2->tx = $Server->wsClients[$clientID][12];
		$mensaje2->msg = $id_usuarios;
		$mensaje2->tipo = 4;
		$message2=json_encode($mensaje2);
		$Server->wsSend($clientID, $message2);

		return;
	}
	if($messageObj->rx==null && $messageObj->tx==1){//mensaje enviado por el administrador
		
		foreach ( $Server->wsClients as $id => $client ){
			$de = $messageObj->tx;
			$para = $client[12];
			$mensaje = new mensaje();
			$mensaje->tx = $de;
			$mensaje->msg = $messageObj->message;
			$mensaje->tipo = 2;
			$mensaje->hora = ucfirst(utf8_encode(strftime("%b %e %H:%M:%S",strtotime(date("Y-m-d H:i:s")))));
			$message=json_encode($mensaje);
			$Server->wsSend($id, $message);
		}
	}else{
		$de = $messageObj->tx;
		$para = $messageObj->rx;
		$mensaje = new mensaje();
		$mensaje->tx = $de;
		$mensaje->msg = $messageObj->message;
		$mensaje->tipo = 2;
		$mensaje->hora = ucfirst(utf8_encode(strftime("%b %e %H:%M:%S",strtotime(date("Y-m-d H:i:s")))));
		$message=json_encode($mensaje);
	    //------------------funcion ctual
	    if ( sizeof($Server->wsClients) == 1 )
			//$Server->wsSend($clientID, "Enviar notificación porque no esta conectado");
			return;
		else
			//Send the message to everyone but the person who said it
			foreach ( $Server->wsClients as $id => $client )
				if ( $id != $clientID && $client[12] == $para)
					$Server->wsSend($id, $message);
	    //--------------------------------
	}


	//The speaker is the only person in the room. Don't let them feel lonely.
	//----------------------------anterior-----------------------------------------
	//if ( sizeof($Server->wsClients) == 1 )
	//	$Server->wsSend($clientID, "No hay nadie mas conectado");
	//else
		//Send the message to everyone but the person who said it
	//	foreach ( $Server->wsClients as $id => $client )
	//		if ( $id != $clientID )
	//			$Server->wsSend($id, "Visitante $clientID ($ip) dice: \"$message\"");
	//---------------fin anterior------------------------------------------------------------
}

// when a client connects
function wsOnOpen($clientID)
{
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip ($clientID) esta conectado." );

	//Send a join notice to everyone but the person who joined
	//foreach ( $Server->wsClients as $id => $client )
	//	if ( $id != $clientID )
	//		$Server->wsSend($id, "Visitante $clientID ($clientID) Se ha unido al chat.");
}


// when a client closes or lost connection
function wsOnClose($clientID, $status) {
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip ($clientID) Esta conectado." );
	//enviar mensaje de desconexion
	$mensaje = new mensaje();
	$mensaje->tx = $Server->wsClients[$clientID][12];
	$mensaje->msg = "se desconecto ".$clientID;
	$mensaje->tipo = 3;
	$message=json_encode($mensaje);
	//Send a user left notice to everyone in the room
	foreach ( $Server->wsClients as $id => $client )
		$Server->wsSend($id, $message);
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
$Server->wsStartServer('75.98.173.239', 9300);

?>