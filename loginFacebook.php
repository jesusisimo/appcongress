<?php
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
 
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php' );

require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookOtherException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphSessionInfo.php' );
// added in v4.0.0
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
 
// init app with app id and secret
FacebookSession::setDefaultApplication( '431132157054056','d9fc8a29e1310e86d6cd2d585965a68d' );
 
// login helper with redirect_uri
 $ruta="http://"."www.actualizacionmedica.net".$_SERVER['PHP_SELF'];

$helper = new FacebookRedirectLoginHelper( $ruta );
 
// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
  // validate the access_token to make sure it's still valid
  try {
    if ( !$session->validate() ) {
      $session = null;
    }
  } catch ( Exception $e ) {
      // catch any exceptions
      $session = null;
    }
}
 
if ( !isset( $session ) || $session === null ) {
  // no session exists
  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
  // handle this better in production code
  //print_r( $ex );
  } catch( Exception $ex ) {
    // When validation fails or other local issues
    // handle this better in production code
    //print_r( $ex );
  }
}
 
// see if we have a session
if ( isset( $session ) ) {
  // save the session
  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject()->asArray();
  // print profile data
  //  '<pre>' . print_r( $graphObject, 1) . '</pre>';

  //Buscar si no esta en la base de datos
  $campo="id_red_social";
  $valor=$graphObject['id'];
  $usr=new mnpBD('redes_sociales');
  $repetido=$usr->repetido($campo, $valor);
  if(!$repetido){// Es usuario nuevo mediante facebook
        //-----------------------------------------------------------------------
        //foto----------------------------------------------
        $request_foto = new FacebookRequest(
          $session,
          'GET',
          '/me/picture',
          array (
            'redirect' => false,
            'type' => 'normal',
          )
        );
        $response_foto = $request_foto->execute();
        $graphObject_foto = $response_foto->getGraphObject()->asArray();
        //  '<pre>' . print_r( $graphObject2, 1) . '</pre>';
        //Insertamos en la base de datos
        $campos="email,usuario,nombre,apellidos, estado_id, pais_id, url_foto_fb, fecha_registro";
        $datos=array($graphObject['email'],$graphObject['email'],$graphObject['first_name'],$graphObject['last_name'],2545,156, $graphObject_foto['url'], date("Y-m-d H:i:s"));
        $usr=new mnpBD('usuarios');
        $usr->insertar($campos,$datos);

        $_SESSION['usuario']['id']=mysql_insert_id();
        $_SESSION['usuario']['nombre']=$graphObject['first_name'];
        $_SESSION['usuario']['foto']=$graphObject_foto['url'];
        $_SESSION['usuario']['tipo']="0";
        $campos="id_usuario,red_social,id_red_social";
        $datos=array($_SESSION['usuario']['id'],'facebook',$graphObject['id']);
        $usr=new mnpBD('redes_sociales');
        $usr->insertar($campos,$datos);

        $campos="usuario_id, nombre_v, apellidos_v, email_v, telefono_v, especialidad_v, pais_v, estado_v, institucion_v";
        $datos=array($_SESSION['usuario']['id'],1,1,0,1,1,1,1,1);
        $usr=new mnpBD('campos_visibles');
        $usr->insertar($campos,$datos);
        //---------------------------------------------------------------------
        $logout= $helper->getLogoutUrl( $session, 'http://www.actualizacionmedica.net/logout.php' );
      
        //-------------establecemos cookie----------------------------------------------------
        mt_srand(time());
        $rand = mt_rand(1000000,9999999);
        setcookie("id", $_SESSION['usuario']['id'], time()+(60*60*24*365));
        setcookie("marca", $rand, time()+(60*60*24*365));

        $campos="cookie";
        $valores=array($rand);
        $condicion=" id=".$_SESSION['usuario']['id'];
        $usr=new mnpBD('usuarios');
        $usr->actualizar($campos,$valores,$condicion);
        //---------------------------------------------------------------------------------------

        $campos='usuario_id, ip, dispositivo, fecha_hora'; 
        $datos=array($_SESSION['usuario']['id'],get_real_ip(),strtolower($_SERVER['HTTP_USER_AGENT']),date("Y-m-d H:i:s"));
        $usr=new mnpBD('logeos');
        $usr->insertar($campos,$datos);
        include 'envioRegistroF.php';
        header("location: ./");
        exit;
    }else{ //-------------Ya es usuario 
       

      $qry="SELECT *FROM redes_sociales as r INNER JOIN usuarios as u on u.id=r.id_usuario WHERE r.id_red_social='".$graphObject['id']."'";

      $datos=$bd->ExecuteE($qry);
      $_SESSION['usuario']['id']=$datos[0]['id'];
      $_SESSION['usuario']['tipo']="0";
      $_SESSION['usuario']['nombre']=$datos[0]['nombre'];
        //foto----------------------------------------------
          $request = new FacebookRequest(
          $session,
          'GET',
          '/me/picture',
          array (
            'redirect' => false,
            'type' => 'normal',
          )
        );
        $response = $request->execute();
        $graphObject2 = $response->getGraphObject()->asArray();
        // '<pre>' . print_r( $graphObject2, 1) . '</pre>';
         if(file_exists("fotos_usuario/".$datos[0]['id'].".jpg")){
            $_SESSION['usuario']['foto']="fotos_usuario/".$datos[0]['id'].".jpg";
          }else{
            $_SESSION['usuario']['foto']=$graphObject2['url'];
          }
        //-------------establecemos cookie----------------------------------------------------
        mt_srand(time());
        $rand = mt_rand(1000000,9999999);
        setcookie("id", $_SESSION['usuario']['id'], time()+(60*60*24*365));
        setcookie("marca", $rand, time()+(60*60*24*365));

        $campos="cookie";
        $valores=array($rand);
        $condicion=" id=".$_SESSION['usuario']['id'];
        $usr=new mnpBD('usuarios');
        $usr->actualizar($campos,$valores,$condicion);
        //---------------------------------------------------------------------------------------

        $campos='usuario_id, ip, dispositivo, fecha_hora'; 
        $datos=array($_SESSION['usuario']['id'],get_real_ip(),strtolower($_SERVER['HTTP_USER_AGENT']),date("Y-m-d H:i:s"));
        $usr=new mnpBD('logeos');
        $usr->insertar($campos,$datos);

        header("location: ./");
        exit;
    }
  //--------------------------------------------------
} else {
  // Generar url de registro mediante facebook
  $login= $helper->getLoginUrl( array( 'email', 'user_friends', 'user_likes', 'user_location', 'user_photos', 'user_about_me', 'user_birthday' ) );
}
if(isset($login) && isset($_GET['code']) && $_GET['code']!=""){
  header("location: ".$login);
  exit;
}
  ?>
