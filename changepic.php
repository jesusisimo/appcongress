                  <?
                    if(isset($_POST['nombre']) && $_POST['nombre']!=""){
                      //actualizamos
    
                      $campos="nombre, apellidos, email, usuario, telefono, pais_id, estado_id, especialidad, institucion";
                      $valores=array($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['email'], $_POST['telefono'], $_POST['pais'], $_POST['estado'], $_POST['especialidad'], $_POST['institucion']);
                      $condicion=" id=".$_SESSION['usuario']['id'];
                      $usr=new mnpBD('usuarios');
                      if($usr->actualizar($campos,$valores,$condicion)){
                        $_SESSION['mensaje']="Datos actualizados conrrectamente";
                      }else{
                        $_SESSION['mensaje']="No se pudo actualizar";
                      }
                    }
                  //subir fotos del movil---------------------------------------
                  if (isset($_POST["upload"]) && esMobil()) {
                      #########################################################################################################
                      $upload_dir = "fotos_usuario";        // The directory for the images to be saved in
                      $upload_path = $upload_dir."/";       // The path to where the image will be saved
                      $large_image_prefix = "resize_";      // The prefix name to large image
                      $thumb_image_prefix = "";     // The prefix name to the thumb image
                      $large_image_name = $large_image_prefix.$_SESSION['usuario']['id'];     // New name of the large image (append the timestamp to the filename)
                      $thumb_image_name = $thumb_image_prefix.$_SESSION['usuario']['id'];     // New name of the thumbnail image (append the timestamp to the filename)
                      $max_file = "3";              // Maximum file size in MB
                      $max_width = "500";             // Max width allowed for the large image
                      $thumb_width = "140";           // Width of thumbnail image
                      $thumb_height = "140";            // Height of thumbnail image
                      // Only one of these image types should be allowed for upload
                      $allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg");
                      $allowed_image_ext = array_unique($allowed_image_types); // do not change this
                      $image_ext = "";  // initialise variable, do not change this.
                      foreach ($allowed_image_ext as $mime_type => $ext) {
                          $image_ext.= strtoupper($ext)." ";
                      }
                      $userfile_name = $_FILES['image']['name'];
                      $userfile_tmp = $_FILES['image']['tmp_name'];
                      $userfile_size = $_FILES['image']['size'];
                      $userfile_type = $_FILES['image']['type'];
                      $filename = basename($_FILES['image']['name']);
                      $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
                      
                  //Only process if the file is a JPG, PNG or GIF and below the allowed limit
                  if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
                    
                    foreach ($allowed_image_types as $mime_type => $ext) {
                      //loop through the specified image types and if they match the extension then break out
                      //everything is ok so go and check file size
                      if($file_ext==$ext && $userfile_type==$mime_type){
                        $_SESSION['mensaje'] = "";
                        break;
                      }else{
                        $_SESSION['mensaje'] = "Solo se permiten extensiones <strong>".$image_ext."</strong><br />";
                      }
                    }
                    //check if the file size is above the allowed limit
                    if ($userfile_size > ($max_file*1048576)) {
                      $_SESSION['mensaje'].= "La imagen debe pesar menos de ".$max_file."MB";
                    }
                    
                  }else{
                    $_SESSION['mensaje']= "Seleccione una imagen para subir";
                  }
                  //Everything is ok, so we can upload the image.
                  if (strlen($_SESSION['mensaje'])==0){
                    
                    if (isset($_FILES['image']['name'])){
                      //this file could now has an unknown file extension (we hope it's one of the ones set above!)
                      $cadena_de_texto = $large_image_location;
                      $cadena_buscada   = '.jpg';
                      $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
                       
                      //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
                      if ($posicion_coincidencia === false) {
                          $large_image_location = $large_image_location.".".$file_ext;
                          }else{
                            $large_image_location = $large_image_location;
                          }
                      
                      $thumb_image_location = $thumb_image_location.".".$file_ext;
                      
                      //put the file ext in the session so we know what file to look for once its uploaded
                      
                      move_uploaded_file($userfile_tmp, $large_image_location);
                      chmod($large_image_location, 0777);
                    }
                    //Refresh the page to show the new uploaded image
                    echo "<script>window.location.href='./?action=changepic';</script>";
                  }
                }
                  //---------------------------------------------------------------------------
                  
                  $query="SELECT *FROM usuarios as u INNER JOIN campos_visibles as c on c.usuario_id=u.id WHERE u.id=".$_SESSION['usuario']['id'];
                  $usuarios=$bd->ExecuteE($query);
                  foreach ($usuarios as &$usuario){
            
                  }
                  ?>
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="./?action=changepic">
                                  <img src="<?=$_SESSION['usuario']['foto']?>" alt="">
                              </a>
                              <h1> <?=$usuario['nombre']." ".$usuario['apellidos'];?></h1>
                              <p> <?=$usuario['usuario'];?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="./?action=changepic"> <i class="fa  fa-picture-o"></i> Cambiar foto</a></li>
                              <li><a href="./?action=descubrir&view"> <i class="fa fa-bell-o"></i> Notificaciones <?if($hay_mensajes!=0){?> <span class="label label-danger pull-right r-activity"><?=$hay_mensajes?></span> <?}?></a></li>
                              <li ><a href="./?action=perfil"> <i class="fa fa-user"></i> Perfil</a></li>
                              <li ><a href="./?action=edit-perfil"> <i class="fa fa-edit"></i> Editar perfil</a></li>
                              <li><a href="./?action=configuracion"> <i class="fa fa-cog"></i> Configuración</a></li>
                          </ul>

                      </section>
                  </aside>
                   <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              <h3><i class="fa fa-edit"></i> Cambiar foto </h3>
                          </div>
                          <div class="panel-body bio-graph-info">
                              
                              <?if(isset($_SESSION['mensaje'])){?>
                              <div class="alert alert-success fade in">
                                <button class="close close-sm" type="button" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                                </button>
                                <strong>Mensaje!</strong>
                                <?=$_SESSION['mensaje'];
                                unset($_SESSION['mensaje']);
                                ?>
                              </div>
                                <?}?>
                             
                            <!--  aqui todo el codigo -->










<?php
if (esMobil()) {// si es movil enviar mensaje que no se puede cambiar su foto
  ?>


  <div class="alert alert-success alert-block fade in">
    <button class="close close-sm" type="button" data-dismiss="alert">
    <i class="fa fa-times"></i>
    </button>
    <h4>
    <i class="fa fa-ok-sign"></i>
    Ups!
    </h4>
    <p>El cambio de foto de perfil no se puede hacer con este dispositivo.<br>Inicia sesión desde su computadora o laptop para poder cambiar su foto </p>
  </div>

  <?
}else{


//only assign a new timestamp if the session variable is empty
if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==""){
    $_SESSION['random_key'] =$_SESSION['usuario']['id']; //assign the timestamp to the session variable
  $_SESSION['user_file_ext']= "";
}
#########################################################################################################
# CONSTANTS                                               #
# You can alter the options below                                   #
#########################################################################################################
$upload_dir = "fotos_usuario";        // The directory for the images to be saved in
$upload_path = $upload_dir."/";       // The path to where the image will be saved
$large_image_prefix = "resize_";      // The prefix name to large image
$thumb_image_prefix = "";     // The prefix name to the thumb image
$large_image_name = $large_image_prefix.$_SESSION['usuario']['id'];     // New name of the large image (append the timestamp to the filename)
$thumb_image_name = $thumb_image_prefix.$_SESSION['usuario']['id'];     // New name of the thumbnail image (append the timestamp to the filename)
$max_file = "3";              // Maximum file size in MB
$max_width = "500";             // Max width allowed for the large image
$thumb_width = "140";           // Width of thumbnail image
$thumb_height = "140";            // Height of thumbnail image
// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg");
$allowed_image_ext = array_unique($allowed_image_types); // do not change this
$image_ext = "";  // initialise variable, do not change this.
foreach ($allowed_image_ext as $mime_type => $ext) {
    $image_ext.= strtoupper($ext)." ";
}
##########################################################################################################
# IMAGE FUNCTIONS                                            #
# You do not need to alter these functions                                 #
##########################################################################################################
function resizeImage($image,$width,$height,$scale) {
  list($imagewidth, $imageheight, $imageType) = getimagesize($image);
  $imageType = image_type_to_mime_type($imageType);
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  switch($imageType) {
    case "image/gif":
      $source=imagecreatefromgif($image); 
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $source=imagecreatefromjpeg($image); 
      break;
      case "image/png":
    case "image/x-png":
      $source=imagecreatefrompng($image); 
      break;
    }
  imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
  
  switch($imageType) {
    case "image/gif":
        imagegif($newImage,$image); 
      break;
        case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
        imagejpeg($newImage,$image,100); 
      break;
    case "image/png":
    case "image/x-png":
      imagepng($newImage,$image);  
      break;
    }
  
  chmod($image, 0777);
  return $image;
}
//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
  list($imagewidth, $imageheight, $imageType) = getimagesize($image);
  $imageType = image_type_to_mime_type($imageType);
  
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  switch($imageType) {
    case "image/gif":
      $source=imagecreatefromgif($image); 
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $source=imagecreatefromjpeg($image); 
      break;
      case "image/png":
    case "image/x-png":
      $source=imagecreatefrompng($image); 
      break;
    }
  imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
  switch($imageType) {
    case "image/gif":
        imagegif($newImage,$thumb_image_name); 
      break;
        case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
        imagejpeg($newImage,$thumb_image_name,100); 
      break;
    case "image/png":
    case "image/x-png":
      imagepng($newImage,$thumb_image_name);  
      break;
    }
  chmod($thumb_image_name, 0777);
  return $thumb_image_name;
}
//You do not need to alter these functions
function getHeight($image) {
  $size = getimagesize($image);
  $height = $size[1];
  return $height;
}
//You do not need to alter these functions
function getWidth($image) {
  $size = getimagesize($image);
  $width = $size[0];
  return $width;
}

//Image Locations
$large_image_location="";
if(isset($_SESSION['user_file_ext'])){
$large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
$thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];
}

//Create the upload directory with the right permissions if it doesn't exist
if(!is_dir($upload_dir)){
  mkdir($upload_dir, 0777);
  chmod($upload_dir, 0777);
}

//Check to see if any images with the same name already exist
if (file_exists($large_image_location)){
  if(file_exists($thumb_image_location)){
    $thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name.$_SESSION['user_file_ext']."\" alt=\"Thumbnail Image\"/>";
  }else{
    $thumb_photo_exists = "";
  }
    $large_photo_exists = "<img src=\"".$upload_path.$large_image_name.$_SESSION['user_file_ext']."\" alt=\"Large Image\"/>";
} else {
    $large_photo_exists = "";
  $thumb_photo_exists = "";
}

if (isset($_POST["upload"]) && !esMobil()) {
    $_SESSION['user_file_ext']=""; 
  //Get the file information
  $userfile_name = $_FILES['image']['name'];
  $userfile_tmp = $_FILES['image']['tmp_name'];
  $userfile_size = $_FILES['image']['size'];
  $userfile_type = $_FILES['image']['type'];
  $filename = basename($_FILES['image']['name']);
  $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
  
  //Only process if the file is a JPG, PNG or GIF and below the allowed limit
  if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
    
    foreach ($allowed_image_types as $mime_type => $ext) {
      //loop through the specified image types and if they match the extension then break out
      //everything is ok so go and check file size
      if($file_ext==$ext && $userfile_type==$mime_type){
        $error = "";
        break;
      }else{
        $error = "Solo se permiten extensiones <strong>".$image_ext."</strong><br />";
      }
    }
    //check if the file size is above the allowed limit
    if ($userfile_size > ($max_file*1048576)) {
      $error.= "La imagen debe pesar menos de ".$max_file."MB";
    }
    
  }else{
    $error= "Seleccione una imagen para subir";
  }
  //Everything is ok, so we can upload the image.
  if (strlen($error)==0){
    
    if (isset($_FILES['image']['name'])){
      //this file could now has an unknown file extension (we hope it's one of the ones set above!)
      $cadena_de_texto = $large_image_location;
      $cadena_buscada   = '.jpg';
      $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
       
      //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
      if ($posicion_coincidencia === false) {
          $large_image_location = $large_image_location.".".$file_ext;
          }else{
            $large_image_location = $large_image_location;
          }
      
      $thumb_image_location = $thumb_image_location.".".$file_ext;
      
      //put the file ext in the session so we know what file to look for once its uploaded
      
      $_SESSION['user_file_ext']=".".$file_ext;
      move_uploaded_file($userfile_tmp, $large_image_location);
      chmod($large_image_location, 0777);
      
      $width = getWidth($large_image_location);
      $height = getHeight($large_image_location);
      //Scale the image if it is greater than the width set above
      if ($width > $max_width){
        $scale = $max_width/$width;
        $uploaded = resizeImage($large_image_location,$width,$height,$scale);
      }else{
        $scale = 1;
        $uploaded = resizeImage($large_image_location,$width,$height,$scale);
      }
      //Delete the thumbnail file so the user can create a new one
      if (file_exists($thumb_image_location)) {
        //unlink($thumb_image_location);
      }
    }
    //Refresh the page to show the new uploaded image
    echo "<script>window.location.href='./?action=changepic';</script>";
  }
}

if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
  //Get the new coordinates to crop the image.
  $x1 = $_POST["x1"];
  $y1 = $_POST["y1"];
  $x2 = $_POST["x2"];
  $y2 = $_POST["y2"];
  $w = $_POST["w"];
  $h = $_POST["h"];
  //Scale the image to the thumb_width set above
  $scale = $thumb_width/$w;
  $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
  //Reload the page again to view the thumbnail
  unlink($large_image_location);
  $_SESSION['mensaje']="Foto de perfil actualizada";
  $_SESSION['usuario']['foto']="fotos_usuario/".$_SESSION['usuario']['id'].$_SESSION['user_file_ext']."?".date("H:i:s");
  unset($_SESSION['user_file_ext']);
  unset($_SESSION['random_key']);
  echo "<script>window.location.href='./?action=edit-perfil';</script>";
  
}


if (isset($_GET['a']) && $_GET['a']=="delete" && strlen($_GET['t'])>0){
//get the file locations 
  $large_image_location = $upload_path.$large_image_prefix.$_GET['t'];
  $thumb_image_location = $upload_path.$thumb_image_prefix.$_GET['t'];
  if (file_exists($large_image_location)) {
    unlink($large_image_location);
  }
  if (file_exists($thumb_image_location)) {
    unlink($thumb_image_location);
  }
  echo "<script>window.location.href='./?action=changepic';</script>";
}
?>

<h3 class="text-info text-center">Subir foto</h3>
<?php
//Display error message if there are any
if(isset($error) && strlen($error)>0){
  echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";
}
// if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
//   echo $large_photo_exists."&nbsp;".$thumb_photo_exists;
//   echo "<p><a href=\"./?action=changepic&a=delete&t=".$_SESSION['random_key'].$_SESSION['user_file_ext']."\">Eliminar fotos</a></p>";
//   echo "<p><a href=\"?action=changepic&\">Subir otra foto</a></p>";
//   //Clear the time stamp session and user file extension
//   $_SESSION['random_key']= "";
//   $_SESSION['user_file_ext']= "";
// }else{
    if(strlen($large_photo_exists)>0){?>
    
    <div class="alert alert-info fade in">
    <button class="close close-sm" type="button" data-dismiss="alert">
    <i class="fa fa-times"></i>
    </button>
    <strong>Paso 2</strong><br/>
    Termine de crear su foto de perfil (Seleccione un área de la imagen y de clic en el boton "Guardar foto de perfil")
    </div>
    <div align="center">
      <form name="thumbnail" action="./?action=changepic" method="post">
        <input type="hidden" name="x1" value="" id="x1" />
        <input type="hidden" name="y1" value="" id="y1" />
        <input type="hidden" name="x2" value="" id="x2" />
        <input type="hidden" name="y2" value="" id="y2" />
        <input type="hidden" name="w" value="" id="w" />
        <input type="hidden" name="h" value="" id="h" />
        <input type="submit" class="btn btn-primary btn-sm" name="upload_thumbnail" autofocus value="Guardar foto de perfil" id="save_thumb" />
        
      </form>
      <img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?><?="?".date('H:i:s')?>" style=" margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
      <div style="border:1px #e5e5e5 solid; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
        <img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?><?="?".date('H:i:s')?>" style="position: relative;" alt="Thumbnail Preview" />
      </div>
      <br style="clear:both;"/>
    </div>
  <hr />
  <?php   } ?>
  <div class="alert alert-info fade in">
  <button class="close close-sm" type="button" data-dismiss="alert">
  <i class="fa fa-times"></i>
  </button>
  <strong>Paso 1</strong>
  Selecciona una foto de tu dispositivo para crear tu foto de perfil
  </div>
  <form name="photo" enctype="multipart/form-data" action="./?action=changepic" method="post">
    <div class="form-group">
      <label for="image">Foto</label>
      <input type="file" name="image" size="30" required autofocus /> 
      <input type="submit" class="btn btn-primary btn-sm" name="upload" value="Cargar" />
    </div>
  </form>
<?php 

}


?>















                          </div>
                      </section>
                      
                  </aside>
