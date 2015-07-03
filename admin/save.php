<?
  session_start();
  if(!isset($_SESSION['admin']['id'])){
    header("location:login.php");
    exit;
  }
  include('../bd/mnpBD2.class.php');
  //funciones para CRUD paises-----------------------------------------------------------------------
  if($_GET[action]=="paises"){
    if(isset($_GET[add])){
      
      $campos="pais";
      $datos=array(
        ($_POST[pais])
        
        );
      $usr=new mnpBD('paises');
      if($usr->insertar($campos,$datos)){
         if (isset($_FILES[bandera]) && !empty($_FILES[bandera]) ) {
          move_uploaded_file($_FILES['bandera']['tmp_name'],  "../banderas/bandera_".mysql_insert_id().".png"); 
         }
        header("location:./?action=paises&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="pais";
      $valores=array(
        ($_POST[pais])
        
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('paises');
      if($usr->actualizar($campos,$valores,$condicion)){
        // guardamos el cv y la foto a sus respectivas carpetas
        if (isset($_FILES[bandera]) && !empty($_FILES[bandera]) ) {
          move_uploaded_file($_FILES['bandera']['tmp_name'],  "../banderas/bandera_".$_POST[id].".png"); 
         }
        // end subida de pdf y png
         header("location:./?action=paises&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('paises');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=paises&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD salones-----------------------------------------------------------------------
  if($_GET[action]=="salones"){
    if(isset($_GET[add])){
     
      $campos="salon, instrucciones";
      $datos=array(
        ($_POST[salon]),
        ($_POST[instrucciones])
        );
      $usr=new mnpBD('salones');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=salones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="salon, instrucciones";
      $valores=array(
        ($_POST[salon]),
        ($_POST[instrucciones])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('salones');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=salones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('salones');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=salones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD patrocinadores-----------------------------------------------------------------------
  if($_GET['action']=="patrocinadores"){
    if(isset($_GET['add'])){
     
      $campos="patrocinador, pagina, descripcion";
      $datos=array(
        ($_POST['patrocinador']),
        ($_POST['pagina']),
        ($_POST['descripcion'])
        
        );
      $usr=new mnpBD('patrocinadores');
      if($usr->insertar($campos,$datos)){
        // guardamos el cv a la carpeta files
        if (isset($_FILES['logo_patrocinador']) && !empty($_FILES['logo_patrocinador'])) {
        move_uploaded_file($_FILES['logo_patrocinador']['tmp_name'],  "../logo_patrocinadores/logo_".mysql_insert_id().".png");  
       } 
        // end subida de pdf
        header("location:./?action=patrocinadores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET['edit'])){
      
      $campos="patrocinador, pagina, descripcion";
      $valores=array(
        ($_POST['patrocinador']),
        ($_POST['pagina']),
        ($_POST['descripcion'])
        );
      $condicion=" id=".$_POST['id'];
      $usr=new mnpBD('patrocinadores');
      if($usr->actualizar($campos,$valores,$condicion)){       
        // guardamos el cv a la carpeta files
        if (isset($_FILES['logo_patrocinador']) && !empty($_FILES['logo_patrocinador'])) {
        move_uploaded_file($_FILES['logo_patrocinador']['tmp_name'],  "../logo_patrocinadores/logo_". $_POST['id'].".png");  
       } 
        // end subida de pdf
         header("location:./?action=patrocinadores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET['delete'])){
      $usr=new mnpBD('patrocinadores');
      $condicion=" id=".$_GET['id'];
      if($usr->delete($condicion)){
         header("location:./?action=patrocinadores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD profesores-----------------------------------------------------------------------
  if($_GET[action]=="profesores"){
    if(isset($_GET[add])){
      if($_POST[activo]=="on"){
        $_POST[activo]=1;
      }else{
        $_POST[activo]=0;
      }
      if($_POST[emailpublico]=="on"){
        $_POST[emailpublico]=1;
      }else{
        $_POST[emailpublico]=0;
      }
      $campos="nombre, puesto, curriculum, pais_id, email, institucion, emailpublico, activo";
      $datos=array(
        ($_POST[nombre]),
        ($_POST[puesto]),
        ($_POST[curriculum]),
        ($_POST[pais_id]),
        ($_POST[email]),
        ($_POST[institucion]),
        ($_POST[emailpublico]),
        ($_POST[activo])
        );
      $usr=new mnpBD('profesores');
      if($usr->insertar($campos,$datos)){
        // guardamos el cv y la foto a sus respectivas carpetas
        if (isset($_FILES[cv]) && !empty($_FILES[cv]) ) {
          move_uploaded_file($_FILES['cv']['tmp_name'],  "../cvs/cv_".mysql_insert_id().".pdf"); 
         } 
       if (isset($_FILES[foto_profesor]) && !empty($_FILES[foto_profesor]) ) {
          move_uploaded_file($_FILES['foto_profesor']['tmp_name'],  "../foto_profesor/profesor_".mysql_insert_id().".png");
         } 
        // end subida de pdf y png
        header("location:./?action=profesores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      if($_POST[activo]=="on"){
        $_POST[activo]=1;
      }else{
        $_POST[activo]=0;
      }
      if($_POST[emailpublico]=="on"){
        $_POST[emailpublico]=1;
      }else{
        $_POST[emailpublico]=0;
      }
      $campos="nombre, puesto, curriculum, pais_id, email, institucion, emailpublico, activo";
      $valores=array(
        ($_POST[nombre]),
        ($_POST[puesto]),
        ($_POST[curriculum]),
        ($_POST[pais_id]),
        ($_POST[email]),
        ($_POST[institucion]),
        ($_POST[emailpublico]),
        ($_POST[activo])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('profesores');
      if($usr->actualizar($campos,$valores,$condicion)){
        // guardamos el cv y la foto a sus respectivas carpetas
        if (isset($_FILES[cv]) && !empty($_FILES[cv]) ) {
          move_uploaded_file($_FILES['cv']['tmp_name'],  "../cvs/cv_".$_POST[id].".pdf");
        }
        if (isset($_FILES[foto_profesor]) && !empty($_FILES[foto_profesor]) ) { 
          move_uploaded_file($_FILES['foto_profesor']['tmp_name'],  "../foto_profesor/profesor_".$_POST[id].".png"); 
        } 
        // end subida de pdf y png
         header("location:./?action=profesores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('profesores');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=profesores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------

  //funciones para CRUD actividades-----------------------------------------------------------------------
  if($_GET[action]=="actividades"){
    if(isset($_GET[add])){
      $ids="";
      foreach ($_POST[coordinadores] as &$coordinador) {
        $ids.=$coordinador.",";       
      }
      $ids = trim($ids, ',');
      $campos="actividad, descripcion, temario, fecha_hora_inicio, fecha_hora_fin, lugar, categoria_id, cupo, costo, coordinadores";
      $datos=array(
        ($_POST[actividad]),
        ($_POST[descripcion]),
        ($_POST[temario]),
        ($_POST[fecha_hora_inicio]),
        ($_POST[fecha_hora_fin]),
        ($_POST[lugar]),
        ($_POST[categoria_id]),
        ($_POST[cupo]),
        ($_POST[costo]),
        ($ids)
        );
      $usr=new mnpBD('actividades');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=actividades&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      $ids="";
      foreach ($_POST[coordinadores] as &$coordinador) {
        $ids.=$coordinador.",";       
      }
      $ids = trim($ids, ',');
      $campos="actividad, descripcion, temario, fecha_hora_inicio, fecha_hora_fin, lugar, categoria_id, cupo, costo, coordinadores";
      $valores=array(
        ($_POST[actividad]),
        ($_POST[descripcion]),
        ($_POST[temario]),
        ($_POST[fecha_hora_inicio]),
        ($_POST[fecha_hora_fin]),
        ($_POST[lugar]),
        ($_POST[categoria_id]),
        ($_POST[cupo]),
        ($_POST[costo]),
        ($ids)
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('actividades');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=actividades&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('actividades');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=actividades&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD agendas-----------------------------------------------------------------------
  if($_GET[action]=="agendas"){
    if(isset($_GET[add])){
      
      $campos="usuario_id, actividad_id";
      $datos=array(
        ($_POST[usuario_id]),
        ($_POST[actividad_id])
        );
      $usr=new mnpBD('agendas');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=agendas&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="usuario_id, actividad_id";
      $valores=array(
        ($_POST[usuario_id]),
        ($_POST[actividad_id])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('agendas');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=agendas&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('agendas');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=agendas&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD categorias-----------------------------------------------------------------------
  if($_GET[action]=="categorias"){
    if(isset($_GET[add])){
      
      $campos="categoria, inicio, fin, descripcion, activo";
      $datos=array(
        ($_POST[categoria]),
        ($_POST[fecha_hora_inicio]),
        ($_POST[fecha_hora_fin]),
        ($_POST[descripcion]),
        ($_POST[activo])
        );
      $usr=new mnpBD('categorias');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=categorias&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="categoria, inicio, fin, descripcion, activo";
      $valores=array(
        ($_POST[categoria]),
        ($_POST[fecha_hora_inicio]),
        ($_POST[fecha_hora_fin]),
        ($_POST[descripcion]),
        ($_POST[activo])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('categorias');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=categorias&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('categorias');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=categorias&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD coordinadores-----------------------------------------------------------------------
  if($_GET[action]=="coordinadores"){
    if(isset($_GET[add])){
       if(isset($_GET[profesor]) && $_GET[profesor]!=""){
        $query="SELECT * FROM profesores WHERE id=".$_GET[profesor];
        $profesores=$bd->ExecuteE($query);
        foreach ($profesores as &$profesorx) {
          $_POST[nombre]=utf8_encode($profesorx[nombre]); 
          $_POST[correo]=utf8_encode($profesorx[email]);
          $_POST[profesor_id]=utf8_encode($profesorx[id]);
        }
      }
      $campos="nombre, correo, profesor_id";
      $datos=array(
        ($_POST[nombre]),
        ($_POST[correo]),
        ($_POST[profesor_id])
        );
      $usr=new mnpBD('coordinadores');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=coordinadores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="nombre, correo, profesor_id";
      $datos=array(
        ($_POST[nombre]),
        ($_POST[correo]),
        ($_POST[profesor_id])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('coordinadores');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=coordinadores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('coordinadores');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=coordinadores&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD comite_organizador----------------------------------------------------------------------
  if($_GET[action]=="comite_organizador"){
    if(isset($_GET[add])){
      
      $campos="nombre, puesto";
      $datos=array(
        ($_POST[nombre]),
        ($_POST[puesto])
        );
      $usr=new mnpBD('comite_organizador');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=comite_organizador&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="nombre, puesto";
      $valores=array(
        ($_POST[nombre]),
        ($_POST[puesto])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('comite_organizador');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=comite_organizador&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('comite_organizador');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=comite_organizador&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD conferencias----------------------------------------------------------------------
  if($_GET[action]=="conferencias"){
    if(isset($_GET[add])){
      
      $campos="conferencia, fecha_hora_inicio, fecha_hora_fin, profesor_id, descripcion, actividad_id";
      $datos=array(
        ($_POST[conferencia]),
        ($_POST[fecha_hora_inicio]),
        ($_POST[fecha_hora_fin]),       
        ($_POST[profesor_id]),
        ($_POST[descripcion]),
        ($_POST[actividad])

        );
      $usr=new mnpBD('conferencias');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=conferencias&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="conferencia, fecha_hora_inicio, fecha_hora_fin, profesor_id, descripcion, actividad_id";
      $valores=array(
        ($_POST[conferencia]),
        ($_POST[fecha_hora_inicio]),
        ($_POST[fecha_hora_fin]),
        ($_POST[profesor_id]),
        ($_POST[descripcion]),
        ($_POST[actividad])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('conferencias');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=conferencias&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('conferencias');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=conferencias&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
    //funciones para CRUD logeos----------------------------------------------------------------------
  if($_GET[action]=="logeos"){
    if(isset($_GET[add])){
      
      $campos="usuario_id, fecha_hora, ip, dispositivo";
      $datos=array(
        ($_POST[usuario_id]),
        ($_POST[fecha_hora]),
        ($_POST[ip]),
        ($_POST[dispositivo])
        );
      $usr=new mnpBD('logeos');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=logeos&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="usuario_id, fecha_hora, ip, dispositivo";
      $valores=array(
        ($_POST[usuario_id]),
        ($_POST[fecha_hora]),
        ($_POST[ip]),
        ($_POST[dispositivo])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('logeos');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=logeos&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('logeos');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=logeos&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
   //funciones para CRUD publicidades----------------------------------------------------------------------
  if($_GET[action]=="publicidades"){
    if(isset($_GET[add])){
      
      $campos="publicidad";
      $datos=array(
        ($_POST[publicidad])
        );
      $usr=new mnpBD('publicidades');
      if($usr->insertar($campos,$datos)){
        // guardamos el cv a la carpeta files
        if (isset($_FILES[img_publicidad]) && !empty($_FILES[img_publicidad])) {
        move_uploaded_file($_FILES['img_publicidad']['tmp_name'],  "../banner_publicidad/banner_".mysql_insert_id().".png");  
       } 
        // end subida de pdf
        header("location:./?action=publicidades&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="publicidad";
      $valores=array(
        ($_POST[publicidad])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('publicidades');
      if($usr->actualizar($campos,$valores,$condicion)){
        // guardamos el cv a la carpeta files
        if (isset($_FILES[img_publicidad]) && !empty($_FILES[img_publicidad])) {
        move_uploaded_file($_FILES['img_publicidad']['tmp_name'],  "../banner_publicidad/banner_".$_POST[id].".png");  
       } 
        // end subida de pdf
         header("location:./?action=publicidades&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('publicidades');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=publicidades&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
   //funciones para CRUD sociedad----------------------------------------------------------------------
  if($_GET[action]=="sociedad"){
    if(isset($_GET[add])){
      
      $campos="sociedad, prefijo nombre_sistema, evento, direccion, telefonos, email, web, correo_envio, nombre_correo_envio, correo_respuesta, correo_soporte";
      $datos=array(
        ($_POST[sociedad]),
        ($_POST[prefijo]),
        ($_POST[sistema]),
        ($_POST[evento]),
        ($_POST[direccion]),
        ($_POST[telefonos]),
        ($_POST[email]),
        ($_POST[web]),
        ($_POST[correo_envio]),
        ($_POST[nombre_correo_envio]),
        ($_POST[correo_respuesta]),
        ($_POST[correo_soporte])
        );
      $usr=new mnpBD('sociedad');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=sociedad&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="sociedad, prefijo, nombre_sistema,evento, direccion, telefonos, email, web, correo_envio, nombre_correo_envio, correo_respuesta, correo_soporte";
      $valores=array(
        ($_POST[sociedad]),
        ($_POST[prefijo]),
        ($_POST[sistema]),
        ($_POST[evento]),
        ($_POST[direccion]),
        ($_POST[telefonos]),
        ($_POST[email]),
        ($_POST[web]),
        ($_POST[correo_envio]),
        ($_POST[nombre_correo_envio]),
        ($_POST[correo_respuesta]),
        ($_POST[correo_soporte])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('sociedad');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=sociedad&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('sociedad');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=sociedad&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD ubicaciones----------------------------------------------------------------------
  if($_GET[action]=="ubicaciones"){
    if(isset($_GET[add])){
      
      $campos="ubicacion, latitud, longitud, icono";
      $datos=array(
        ($_POST[ubicacion]),
        ($_POST[latitud]),
        ($_POST[longitud]),
        ($_POST[icono])
        );
      $usr=new mnpBD('ubicaciones');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=ubicaciones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="ubicacion, latitud, longitud, icono";
      $valores=array(
        ($_POST[ubicacion]),
        ($_POST[latitud]),
        ($_POST[longitud]),
        ($_POST[icono])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('ubicaciones');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=ubicaciones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('ubicaciones');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=ubicaciones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD usuarios----------------------------------------------------------------------
  if($_GET[action]=="usuarios"){
    if(isset($_GET[add])){
      
      $campos="nombre, apellidos, usuario, password, sas_id";
      $datos=array(
        ($_POST[nombre]),
        ($_POST[apellidos]),
        ($_POST[usuario]),
        ($_POST[password]),
        ($_POST[sas_id])
        );
      $usr=new mnpBD('usuarios');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=usuarios&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="nombre, apellidos, usuario, password, sas_id";
      $valores=array(
        ($_POST[nombre]),
        ($_POST[apellidos]),
        ($_POST[usuario]),
        ($_POST[password]),
        ($_POST[sas_id])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('usuarios');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=usuarios&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('usuarios');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=usuarios&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD redes_sociales----------------------------------------------------------------------
  if($_GET[action]=="redes_sociales"){
    if(isset($_GET[add])){
      
      $campos="id_usuario, red_social, id_red_social";
      $datos=array(
        ($_POST[id_usuario]),
        ($_POST[red_social]),
        ($_POST[id_red_social])
        
        );
      $usr=new mnpBD('redes_sociales');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=redes_sociales&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      
      $campos="id_usuario, red_social, id_red_social";
      $valores=array(
        ($_POST[id_usuario]),
        ($_POST[red_social]),
        ($_POST[id_red_social])
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('redes_sociales');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=redes_sociales&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('redes_sociales');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=redes_sociales&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
  //funciones para CRUD pregutnas rapidas-----------------------------------------------------------------------
  if($_GET[action]=="votaciones"){
    if(isset($_GET[add])){
      if($_POST[activo]=="on"){
        $_POST[activo]=1;
        $campos="activo";
        $valores=array(0);
        $condicion=" activo=1";
        $usr=new mnpBD('votaciones');
        $usr->actualizar($campos,$valores,$condicion);
      }else{
        $_POST[activo]=0;
      }
      $campos="titulo, conferencia_id, profesor_id, activo";
      $datos=array(
        ($_POST[titulo]),
        ($_POST[conferencia_id]),
        ($_SESSION['admin']['id']),
        $_POST[activo]
        );
      $usr=new mnpBD('votaciones');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=votaciones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      if($_POST[activo]=="on"){
        $_POST[activo]=1;
        $campos="activo";
        $valores=array(0);
        $condicion=" id!=".$_POST[id];
        $usr=new mnpBD('votaciones');
        $usr->actualizar($campos,$valores,$condicion);
      }else{
        $_POST[activo]=0;
      }
      $campos="titulo, conferencia_id, activo";
      $valores=array(
        ($_POST[titulo]),
        ($_POST[conferencia_id]),
        $_POST[activo]
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('votaciones');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=votaciones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('votaciones');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=votaciones&view");
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------
   //funciones para CRUD opciones votaciones-----------------------------------------------------------------------
  if($_GET[action]=="candidatos"){
    if(isset($_GET[add])){
      if($_POST[correcta]=="on"){
        $_POST[correcta]=1;
      }else{
        $_POST[correcta]=0;
      }
      $campos="votacion_id, opcion, correcta";
      $datos=array(
        ($_POST[votacion_id]),
        ($_POST[opcion]),
        $_POST[correcta]
        );
      $usr=new mnpBD('opciones_votacion');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=candidatos&view&votacion=".$_POST[votacion_id]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      if($_POST[correcta]=="on"){
        $_POST[correcta]=1;
      }else{
        $_POST[correcta]=0;
      }
      $campos="votacion_id, opcion, correcta";
      $valores=array(
        ($_POST[votacion_id]),
        ($_POST[opcion]),
        $_POST[correcta]
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('opciones_votacion');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=candidatos&view&votacion=".$_POST[votacion_id]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('opciones_votacion');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=candidatos&view&votacion=".$_GET[votacion]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----------------------------------------------------------------------------------------------------

  //funciones para CRUD preguntas de examen-----------------------------------------------------------------------
  if($_GET[action]=="preguntas"){
    if(isset($_GET[add])){
      if($_POST[multiple]=="on"){
        $_POST[multiple]=1;
      }else{
        $_POST[multiple]=2;
      }
      $campos="pregunta, examen_id, profesor, tipo, activo ";
      $datos=array(
        $_POST[pregunta],
        $_POST[examen_id],
        $_POST[profesor_id],
        $_POST[multiple],
        1
        );
      $usr=new mnpBD('preguntas');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=preguntas&view&examen=".$_POST['examen_id']);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      if($_POST[multiple]=="on"){
        $_POST[multiple]=1;
      }else{
        $_POST[multiple]=2;
      }
      $campos="pregunta, examen_id, profesor, tipo ";
      $valores=array(
        $_POST[pregunta],
        $_POST[examen_id],
        $_POST[profesor_id],
        $_POST[multiple]
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('preguntas');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=preguntas&view&examen=".$_POST['examen_id']);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('preguntas');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=preguntas&view&examen=".$_GET[id]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
   //funciones para CRUD opciones preguntas de examenes-----------------------------------------------------------------------
  if($_GET[action]=="opciones"){
    if(isset($_GET[add])){
      if($_POST[correcta]=="on"){
        $_POST[correcta]=1;
      }else{
        $_POST[correcta]=0;
      }
      $campos="pregunta_id, opcion, correcta";
      $datos=array(
        ($_POST[pregunta_id]),
        ($_POST[opcion]),
        $_POST[correcta]
        );
      $usr=new mnpBD('opciones');
      if($usr->insertar($campos,$datos)){
        header("location:./?action=opciones&view&pregunta=".$_POST[pregunta_id]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[edit])){
      if($_POST[correcta]=="on"){
        $_POST[correcta]=1;
      }else{
        $_POST[correcta]=0;
      }
      $campos="pregunta_id, opcion, correcta";
      $valores=array(
        ($_POST[pregunta_id]),
        ($_POST[opcion]),
        $_POST[correcta]
        );
      $condicion=" id=".$_POST[id];
      $usr=new mnpBD('opciones');
      if($usr->actualizar($campos,$valores,$condicion)){
         header("location:./?action=opciones&view&pregunta=".$_POST[pregunta_id]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
    if(isset($_GET[delete])){
      $usr=new mnpBD('opciones');
      $condicion=" id=".$_GET[id];
      if($usr->delete($condicion)){
         header("location:./?action=opciones&view&pregunta=".$_GET[pregunta]);
      }else{
        echo "ocurrio un error";
        exit;
      }
    }
  }
  //----
?>