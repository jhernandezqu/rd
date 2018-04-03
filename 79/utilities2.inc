<?php

function registra_visita($cliente)
{
   $qry = "insert into visita (num_cliente,id_paquete,fecha)";
   $qry .= " values($cliente,174,now())";
   $execqry = mysql_query($qry);
 }


function espaciosnum($campo, $numero){
      $caja = $campo;
      $largo = strlen($campo);
      If($largo < $numero){
         For($flag = $largo;$flag <= $numero - 1;$flag++){
           $caja = "0".$caja;
         }
      }
      else
         $caja = substr($campo, 0, $numero);
  
      return($caja);
}

   function existe_idcode($idcode){

       $query = mysql_query("select * from Cliente where id_cliente='$idcode'");
       if(@mysql_num_rows($query) > 0){
             return(true);
       }
       else{
            return(false);
       }
   }

   function busca_idcode($email){

       $qry = mysql_query("select id_cliente from control where email='$email'");
  if(mysql_num_rows($qry) > 0){
     $result = mysql_result($qry, 0, "id_cliente"); 
     return($result);
  }
   }


  function genera_idcode($randnum){
     $fecha = date('dms');
     $sesion = $randnum;   //rand(1,1000000).$fecha;
     $get_idc = mysql_query("INSERT INTO IDCODES (sesion) values('$sesion')");
     if(mysql_affected_rows()){
         $newidc = mysql_query("SELECT ID_CODE FROM IDCODES WHERE sesion = '$sesion'");
         if(mysql_num_rows($newidc) > 0){
             $idnew = mysql_result($newidc, 0, ID_CODE);

             for($i=strlen($idnew);$i<7;$i++){
                $idnew = "0".$idnew;
             }
             $prefix = Array("AT","AU","AV","AW","AX","AY","BA","BB","BC","BD","BE","BF","BG");
             $pfix = $prefix[substr($idnew, 0, 1)];
             $sfix = substr($idnew, 1, 6);
             $idcode = $pfix.$sfix;

             return($idcode);
         }
         else
            return("null");
     }
     else
        return("null");
  }

  /************************* Revisa si existe el cliente en la BD ********* ******************
   *******************************************************************************************/
   function existe_visita($idcode, $idpaquete, $cve_sorteo){

       $query = mysql_query("select id_cliente from visitapaquete where id_cliente='$idcode' and id_paquete='$idpaquete' and cve_sorteo='$cve_sorteo'");
//       echo mysql_error();
       if(@mysql_num_rows($query) > 0){
             return(true);
       }
       else{
            return(false);
       }
   }

/********************* clean_input ************************/
function clean_input($string){
$string=addslashes($string);
$string=str_replace(',','.',$string);
while(strpos($string,'  ')!==FALSE)
  $string=str_replace('  ',' ',$string);
return($string);
}

  /************************* Ingresa nombre, apellidos y email de un cliente ******************
   *******************************************************************************************/
   function registra_usuario($idcode, $nombre, $apellido, $email, $idpaquete){
     if(existe_cliente($idcode) == false){

  $idcode=addslashes($idcode);
  $idpaquete=addslashes($idpaquete);

  $nombre=clean_input($nombre);
  $apellido=clean_input($apellido);
  $email=clean_input($email);


       $nombre = trim(ucwords(strtolower($nombre)));
       $apellido = trim(ucwords(strtolower($apellido)));
       $email = trim(strtolower($email));
       $consulta="insert into Cliente (id_cliente, nombre, apellidos, email, creado, ip) values('$idcode','$nombre','$apellido','$email',now(), '$_SERVER[REMOTE_ADDR]')";
       $query = mysql_query($consulta) or die("Error al registrar el usuario $idcode:");
       if(mysql_affected_rows()){
            registra_sesion($idcode, $nombre, $apellido, $email, $idpaquete);
            return("true");
       }
       else{
          echo "Error al registrar en la base de datos al cliente: ";
          return("null");
       }
      }
      else{
    registra_sesion($idcode, $nombre, $apellido, $email, $idpaquete); 
    
    $nombre = (strtoupper($nombre)=='NULL')?'':$nombre;
    $idcode = (strtoupper($idcode)=='NULL')?'':$idcode;
    $apellido = (strtoupper($apellido)=='NULL')?'':$apellido;
    $qry = "update Cliente set ";
    if(trim($nombre)!=''&&trim($apellido)!=''&&trim($idcode)!='')
      $qry = $qry."nombre='$nombre', apellidos='$apellido', ip='$_SERVER[REMOTE_ADDR]'";
    elseif(trim($nombre)!=''&&trim($apellido)==''&&trim($idcode)!='')
      $qry = $qry."nombre='$nombre', ip='$_SERVER[REMOTE_ADDR]'";
    elseif(trim($nombre)==''&&trim($apellido)!=''&&trim($idcode)!='')
      $qry = $qry."apellidos='$apellido', ip='$_SERVER[REMOTE_ADDR]'";
    elseif(trim($idcode)!='')
      $qry = $qry."ip='$_SERVER[REMOTE_ADDR]'";
    $qry = $qry . " WHERE id_cliente = '$idcode'";
    if(preg_match('/(.*)(ip=)(.*)/',$qry,$matches)){
      $upd_qry = mysql_query($qry);
      return "true";      
    }
    else
      return "false";   
      }
   }

    /*********** Registra una sesion con el nombre, apellidos y email de un cliente **********
   *******************************************************************************************/
   function registra_sesion($idcodevar, $nombrevar, $apellidovar, $emailvar, $paquetevar){

  if(!isset($_SESSION))
        session_start();
      if (!isset($_SESSION['idcliente'])) {
           $_SESSION['idcliente'] = $idcodevar;
      }
      if (!isset($_SESSION['nombre'])) {
            $nombrevar=trim_name($nombrevar);
           $_SESSION['nombre'] = $nombrevar;
      }
      if (!isset($_SESSION['apellido'])) {
            $apellidovar=trim_name($apellidovar);
           $_SESSION['apellido'] = $apellidovar;
      }
      if (!isset($_SESSION['email'])) {
           $_SESSION['email'] = $emailvar;
      }
      if (!isset($_SESSION['idpaquete'])) {
           $_SESSION['idpaquete'] = $paquetevar;
      }
  if(!isset($_SESSION[fecha21])||!isset($_SESSION[fecha28])){
    $query="SELECT max(fecha_envio) as fecha_envio FROM `envios_paquete` where fecha_envio<=now() and id_paquete=$paquetevar";
    $result=mysql_query($query) ;
    $fecha_envio=mysql_result($result,0);
    $_SESSION[fecha21]=fechamasdias($fecha_envio,21);
    $_SESSION[fecha28]=fechamasdias($fecha_envio,28);
  }
  if (!isset($_SESSION['cve_envio'])) {
      if($_REQUEST['cve_envio']>0)
            $_SESSION['cve_envio']=$_REQUEST['cve_envio'];
      elseif($_REQUEST['idban']>0)
            $_SESSION['cve_envio']=$_REQUEST['idban'];
      else
    $_SESSION['cve_envio']=777;
      }

      return(true);
   }






   /*********** Despliega los paises de la republica mexicana **********
   *******************************************************************************************/
   function get_estados($sel){
     $edos = Array('Aguascalientes',
                  'Baja California Norte',
                  'Baja California Sur',
                  'Campeche',
                  'Coahuila',
                  'Colima',
                  'Chiapas',
                  'Chihuahua',
                  'Distrito Federal',
              'Durango',
              'Guanajuato',
              'Guerrero',
              'Hidalgo',
              'Jalisco',
              'Estado de Mexico',
              'Michoacan',
              'Morelos',
               'Nayarit',
              'Nuevo Le�n',
              'Oaxaca',
              'Puebla',
              'Quer�taro',
              'Quintana Roo',
              'San Luis Potos�',
              'Sinaloa',
              'Sonora',
              'Tabasco',
              'Tamaulipas',
              'Tlaxcala',
              'Veracruz',
              'Yucat�n',
              'Zacatecas');
     $i = 1;
     foreach($edos as $key){
        echo "<option value=$i ";
        if($i == $sel)
           echo "selected";
        echo ">$key</option>\n";
        $i++;
     }
   }

    /*********** Despliega los paises de la republica mexicana **********
   *******************************************************************************************/
   function get_estadosCol($sel){
     $edos = Array('Amazonas',
                  'Antioquia',
                  'Arauca',
                  'Atlantico',
                  'Bolivar',
                  'Boyac�',
                  'Caldas',
                  'Caquet�',
                  'Casanare',
              'Cauca',
              'Cesar',
              'Choco',
              'C�rdoba',
              'Cundinamarca',
              'Guaviare',
              'Huila',
              'La Guajira',
               'Magdalena',
              'Meta',
              'Nari�o',
              'Norte de Santander',
              'Putumayo',
              'Quind�o',
              'Risaralda',
              'San Andres',
              'Santander',
              'Sucre',
              'Tolima',
              'Valle del Cauca');

     $i = 1;
     foreach($edos as $key){
        echo "<option value=$i ";
        if($i == $sel)
           echo "selected";
        echo ">$key</option>\n";
        $i++;
     }
   }









    /*********** Despliega los nombres de los estados de la republica mexicana **********
   *******************************************************************************************/
   function get_nombre_estado($edo){
      $edos = Array('','Aguascalientes',
                  'Baja California Norte',
                  'Baja California Sur',
                  'Campeche',
                  'Coahuila',
                  'Colima',
                  'Chiapas',
                  'Chihuahua',
                  'Distrito Federal',
              'Durango',
              'Guanajuato',
              'Guerrero',
              'Hidalgo',
              'Jalisco',
              'Estado de Mexico',
              'Michoacan',
              'Morelos',
               'Nayarit',
              'Nuevo Le�n',
              'Oaxaca',
              'Puebla',
              'Quer�taro',
              'Quintana Roo',
              'San Luis Potos�',
              'Sinaloa',
              'Sonora',
              'Tabasco',
              'Tamaulipas',
              'Tlaxcala',
              'Veracruz',
              'Yucat�n',
              'Zacatecas');

     $resp = $edos[$edo];
     return($resp);
   }

     function get_nombre_estado_Col($edo){
      $edos = Array('','Amazonas',
                  'Antioquia',
                  'Arauca',
                  'Atlantico',
                  'Bolivar',
                  'Boyac�',
                  'Caldas',
                  'Caquet�',
                  'Casanare',
              'Cauca',
              'Cesar',
              'Choco',
              'C�rdoba',
              'Cundinamarca',
              'Guaviare',
              'Huila',
              'La Guajira',
               'Magdalena',
              'Meta',
              'Nari�o',
              'Norte de Santander',
              'Putumayo',
              'Quind�o',
              'Risaralda',
              'San Andres',
              'Santander',
              'Sucre',
              'Tolima',
              'Valle del Cauca');

     $resp = $edos[$edo];
     return($resp);
   }

   /*********** Actualiza los datos del usuario en la BD **********
   *******************************************************************************************/

   function update_usuario($idcode, $dir, $numext, $numint, $colonia, $poblacion, $zip, $edo, $tel, $email, $calle1, $calle2){
      $qry = "update Cliente set direccion='$dir', numext='$numext', numint='$numint', colonia='$colonia'";
      $qry .= ", poblacion = '$poblacion', codigo_postal='$zip', id_estado=$edo, telefono='$tel', email='$email'";
      $qry .= ", auxiliar1 = '$calle1', auxiliar2 = '$calle2' where id_cliente='$idcode'";
   if($_REQUEST[new_form]=='true'){
      $qry = "update Cliente set direccion='$dir', numext='$numext', numint='$numint', colonia='$colonia'";
      $qry .= ", poblacion = '$poblacion', codigo_postal='$zip', id_estado=$edo, telefono='$tel', email='$email'";
      $qry .= ", tipo_pago = '555', auxiliar2 = '$calle2' where id_cliente='$idcode'";
   }
      $execqry = mysql_query($qry);
      if(mysql_error()){
           return("null");
      }
      else
         return("true");
   }

   /*********** Actualiza los datos del usuario en la BD **********
   *******************************************************************************************/

   function update_usuario_new($idcode, $dir, $numext, $numint, $colonia, $poblacion, $zip, $edo, $tel, $email, $calle1, $calle2,
  $fecha_nac, $sexo){
      $qry = "update Cliente set direccion='$dir', numext='$numext', numint='$numint', colonia='$colonia'";
      $qry .= ", poblacion = '$poblacion', codigo_postal='$zip', id_estado=$edo, telefono='$tel', email='$email'";
      $qry .= ", auxiliar1 = '$calle1', auxiliar2 = '$calle2', fecha_nac='$fecha_nac', genero=$sexo where id_cliente='$idcode'";
   if($_REQUEST[new_form]=='true'){
      $qry = "update Cliente set direccion='$dir', numext='$numext', numint='$numint', colonia='$colonia'";
      $qry .= ", poblacion = '$poblacion', codigo_postal='$zip', id_estado=$edo, telefono='$tel', email='$email'";
      $qry .= ", tipo_pago = '555', auxiliar2 = '$calle2' where id_cliente='$idcode'";
   }
      $execqry = mysql_query($qry);
      if(mysql_error()){
           return("null");
      }
      else
         return("true");
   }

      /*********** Actualiza los datos del usuario en la BD **********
   *******************************************************************************************/
   function update_obsequiado($idcode, $idpaq, $nombre, $apellido, $dir, $numext, $numint, $colonia, $poblacion, $zip, $edo, $tel, $email){
      $qry = "update cliente_obsequiado set nombre='$nombre', apellidos='$apellido', direccion='$dir', numext='$numext', numint='$numint', colonia='$colonia'";
      $qry .= ", poblacion = '$poblacion', codigo_postal='$zip', id_estado=$edo, telefono='$tel', email='$email'";
      $qry .= "where id_cliente='$idcode' and id_paquete='$idpaq'";

      $execqry = mysql_query($qry);


      if(mysql_affected_rows() < 1){
         return(false);
    }
      else
         return(true);
   }


    /*********** Actualiza los datos del usuario en la BD **********
   *******************************************************************************************/
   function inserta_obsequiado($idcode, $idpaq, $nombre, $apellido, $dir, $numext, $numint, $colonia, $poblacion, $zip, $edo, $tel, $email, $calle1, $calle2){
      $qry = "insert into cliente_obsequiado (id_cliente, id_paquete, nombre, apellidos, direccion, numext, numint,";
      $qry .= " colonia, poblacion, codigo_postal, id_estado, telefono, email, calle1, calle2) values('$idcode', $idpaq, '$nombre', '$apellido'";
      $qry .= ",'$dir', '$numext', '$numint', '$colonia', '$poblacion', '$zip', $edo, '$tel', '$email', '$calle1', '$calle2')";

      $execqry = mysql_query($qry);
      if(mysql_affected_rows() < 1){
    $qry = "SELECT * FROM cliente_obsequiado WHERE id_paquete=$idpaq AND id_cliente='$idcode'";
    $execqry = @mysql_query($qry);
    if(mysql_num_rows($execqry)<=0)
      return("null");
    else
      return('registrado');
    }
      else
         return("ok");
   }


   /*********** Registra la orden en la BD **********
   *******************************************************************************************/
   function registra_orden($idcode, $id_paquete){
      if(!existe_orden($idcode, $id_paquete)){
         $qry = "insert into orden (id_cliente, fe_orden, id_paquete, id_banner) values('$idcode',now(),$id_paquete,'$_SESSION[cve_envio]')";
         $execqry = mysql_query($qry);
         if(mysql_affected_rows() > 0)
            return("true");
         else{
            return("null");
    }
      }
      else
     if(existe_orden_confirmada($idcode, $id_paquete)){
      $_SESSION['compra']=1;
           return("existe");
     }else
      return("existe");
   }

   /*********** Registra la orden en la BD OXXO **********
   *******************************************************************************************/
   function registra_orden_oxxo($idcode, $id_paquete){
         $qry = "insert into orden (id_cliente, fe_orden, id_paquete, id_banner) values('$idcode',now(),$id_paquete,1)";
         $execqry = mysql_query($qry);
         if(mysql_affected_rows() > 0){
              $idorden = mysql_insert_id();
    return($idorden);
    }
         else{
            return("null");
    }
   }


   /*********** Registra la orden en la BD **********
   *******************************************************************************************/
   function registra_orden_num($idcode, $id_paquete, $num_cte , $pr){
      if(!existe_orden($idcode, $id_paquete)){
         $qry = "insert into orden (id_cliente, fe_orden, id_paquete, id_banner, instant, compra) values('$idcode',now(),$id_paquete,'$_SESSION[cve_envio]', '$num_cte', '$pr')";
         $execqry = mysql_query($qry);
         if(mysql_affected_rows() > 0)
            return("true");
         else{
            return("null");
    }
      }
      else
     if(existe_orden_confirmada($idcode, $id_paquete)){
      $_SESSION['compra']=1;
           return("existe");
     }else
      return("existe");
   }
   
      /*********** Obtiene orden **********
   *******************************************************************************************/
   function obtiene_orden($idcode, $id_paquete){
  $qry = mysql_query("select id_orden from orden where id_paquete=$id_paquete and id_cliente='$idcode'");
  $result=mysql_fetch_array($qry);
  $orden = $result[0];
  $_SESSION['idorden']=$orden;
  return("true");
   }

  /*********** Registra datos para contacto por telefono **********
   *******************************************************************************************/
  function ingresa_tel_contacto($idcode, $id_paquete, $telefono, $horario){
  $qry = mysql_query("select id_orden from orden where id_paquete=$id_paquete and id_cliente='$idcode'");
  $result=mysql_fetch_array($qry);
  $orden = $result[0];

    $qry2 = "insert into contacto (id_orden, id_cliente, id_paquete, telefono, horario, creado) values($orden, '$idcode', $id_paquete, '$telefono', $horario, now())";
         $execqry = mysql_query($qry2);
         if(mysql_affected_rows() > 0)
            return("true");
         else{
            return("null");
    }
   }

   /*********** Valid si existe la orden en la BD **********
   *******************************************************************************************/
   function existe_orden($idcode, $id_paquete){
       $qry = mysql_query("select id_cliente from orden where id_cliente='$idcode' and id_paquete=$id_paquete");
       if(mysql_num_rows($qry)>0)
          return(true);
       else
          return(false);

   }
    /*********** Valid si existe la orden en la BD **********
   *******************************************************************************************/
   function existe_orden_confirmada($idcode, $id_paquete){
       $qry = mysql_query("select id_cliente from orden where id_cliente='$idcode' and id_paquete=$id_paquete and status_confirmada>0");
       if(mysql_num_rows($qry)>0)
          return(true);
       else
          return(false);

   }
   /*********** Registra al noes en la BD **********
   *******************************************************************************************/
   function registra_noes($idcode, $id_paquete){
    $qry = "insert into nocompra (id_cliente, fe_orden, id_paquete) values('$idcode',now(),$id_paquete)";
      $execqry = mysql_query($qry);
      if(mysql_affected_rows() > 0)
         return("true");
      else
         return("null");
   }

   /*********** Confirma la orden en la BD **********
   *******************************************************************************************/
   function cliente_confirma($idcode, $idpaquete, $tipoconf, $tipo_pago){ 
    if(existe_orden_confirmada($idcode, $idpaquete)){
    $qry = mysql_query("select id_orden from orden where id_paquete=$idpaquete and id_cliente='$idcode'");
    $result=mysql_fetch_array($qry);
    return $result[0];
  }
  if($_SESSION[id_confirmada]>0)
    $tipoconf=$_SESSION[id_confirmada];
  elseif($tipoconf<=0)
    $tipoconf=1;
    
    
     $qry = mysql_query("update orden set id_confirmada=$tipoconf, status_confirmada=$tipo_pago, fe_orden=NOW() where id_cliente='$idcode' and id_paquete=$idpaquete");
     $qry = mysql_query("select id_orden from orden where id_paquete=$idpaquete and id_cliente='$idcode'");
     $result=mysql_fetch_array($qry);
     return $result[0];      
   }

   /*********** Confirma la orden en la BD OXXO**********
   *******************************************************************************************/
   function cliente_confirma_oxxo($idorden, $idpaquete, $tipoconf, $tipo_pago){ 
     $qry = mysql_query("update orden set id_confirmada=$tipoconf, status_confirmada=$tipo_pago, fe_orden=NOW() where id_orden=$idorden and id_paquete=$idpaquete");
     return ("true");      
   }



   /*********** Confirma la orden BNK en la BD **********
   *******************************************************************************************/
   function cliente_confirma_bnk($idcode, $idpaquete, $tipoconf, $tipo_pago, $instant){ 
    if(existe_orden_confirmada($idcode, $idpaquete)){
    $qry = mysql_query("select id_orden from orden where id_paquete=$idpaquete and id_cliente='$idcode'");
    $result=mysql_fetch_array($qry);
    return $result[0];
  }
  if($_SESSION[id_confirmada]>0)
    $tipoconf=$_SESSION[id_confirmada];
  elseif($tipoconf<=0)
    $tipoconf=1;
     $qry = mysql_query("update orden set id_confirmada=$tipoconf, status_confirmada=$tipo_pago, fe_orden=NOW(), instant=$instant where id_cliente='$idcode' and id_paquete=$idpaquete");
     $qry = mysql_query("select id_orden from orden where id_paquete=$idpaquete and id_cliente='$idcode'");
     $result=mysql_fetch_array($qry);
     return $result[0];      
   }




/********************** Registra los productos comprados **********/
function agrega_producto_compra($id_paquete,$id_cliente,$productos,$id_orden){
  if(is_array($productos)){
    foreach($productos as $a =>$prod)
    {
      $query="INSERT INTO compra (id_paquete,id_cliente,id_orden,id_producto) VALUES ('$id_paquete','$id_cliente','$id_orden','$prod')"; 
      echo $query;
      mysql_query($query);
    }
     
  }
  else{
    $query="INSERT INTO compra (id_paquete,id_cliente,id_orden,id_producto) VALUES ('$id_paquete','$id_cliente','$id_orden','$productos')";
     echo $query;
    mysql_query($query);
  }
    
}


     /*********** Ingresa datos de la TDC en la BD **********
   *******************************************************************************************/
   function ingresa_tdc($idcode, $idpaquete, $name, $tel, $tipotdc, $numtdc, $numseg, $fechavenc){
     $qry = "insert into cliente_tarjeta (id_cliente, id_paquete, nombre, telefono, tipo_tarjeta,";
     $qry .= " num_tarjeta, num_seguridad, fecha_venc, ip) values('$idcode', $idpaquete, '$name',";
     $qry .= "'$tel',$tipotdc,'$numtdc','$numseg','$fechavenc', '$_SERVER[REMOTE_ADDR]')";
     $execqry = mysql_query($qry);
     if(mysql_affected_rows() > 0)
        return("true");
     else 
        return("null");

   }

    /*********** Ingresa datos de la TDC en la BD **********
   *******************************************************************************************/
   function ingresa_tdc1($idcode, $idpaquete, $name, $tel, $tipotdc, $numtdc, $numseg, $auth, $fechavenc){
     $qry = "insert into paquetes_j (id_cliente, id_paquete, nombre, telefono, tipo_tarjeta,";
     $qry .= " num_tarjeta, num_seguridad,autorizacion,fecha_venc, ip) values('$idcode', $idpaquete, '$name',";
     $qry .= "'$tel',$tipotdc,'$numtdc','$numseg','$auth','$fechavenc', '$_SERVER[REMOTE_ADDR]')";
     $execqry = mysql_query($qry);
     if(mysql_affected_rows() > 0)
        return("true");
     else 
        return("null");
   }

    /*********** Ingresa datos de la TDC en la BD **********
   *******************************************************************************************/
   function ingresa_tdc2($idcode, $idpaquete, $name, $tel, $tipotdc, $numtdc, $numseg, $auth, $fechavenc, $response){
    $qry = "insert into cliente_tarjeta (id_cliente, id_paquete, nombre, telefono, tipo_tarjeta,";
     $qry .= " num_tarjeta, num_seguridad, fecha_venc, ip) values('$idcode', $idpaquete, '$name',";
     $qry .= "'$tel',$tipotdc,'$numtdc','$numseg','$fechavenc', '$_SERVER[REMOTE_ADDR]')";
     $execqry = mysql_query($qry);
     if(mysql_affected_rows() > 0)
        return("true");
     else 
        return("null");
  
   }

    /*********** Ingresa datos de la TDC en la BD **********
   *******************************************************************************************/
   function ingresa_tdc3($idcode, $idpaquete, $name, $tel, $tipotdc, $numtdc, $numseg, $auth, $fechavenc, $tdc){
     $qry = "insert into cliente_tarjeta (id_cliente, id_paquete, nombre, telefono, tipo_tarjeta,";
     $qry .= " num_tarjeta, num_seguridad, fecha_venc, ip) values('$idcode', $idpaquete, '$name',";
     $qry .= "'$tel',$tipotdc,'$numtdc','$numseg','$fechavenc', '$_SERVER[REMOTE_ADDR]')";
     $execqry = mysql_query($qry);
     if(mysql_affected_rows() > 0)
        return("true");
     else 
        return("null");
    
   }

  /*********** Envia correo de confirmacion SafetyPay**********
   *******************************************************************************************/

  function envia_correo_safetypay($idorden){
      //Primero obtenemos los datos del cliente
      $qry = mysql_query("select * from Cliente c, orden o  where o.id_orden=$idorden and o.id_cliente=c.id_cliente ");

      if(mysql_num_rows($qry) > 0){
         $nombre = mysql_result($qry, 0, "nombre");
         $apellidos = mysql_result($qry, 0, "apellidos");
         $dir = mysql_result($qry, 0, "direccion");
    $direccion = $dir;
         $numext = mysql_result($qry, 0, "numext");
         $numint = mysql_result($qry, 0, "numint");
         $colonia = mysql_result($qry, 0, "colonia");
         $poblacion = mysql_result($qry, 0, "poblacion");
         $zip = mysql_result($qry, 0, "codigo_postal");
         $idedo = get_nombre_estado(mysql_result($qry, 0, "id_estado"));
    $estado = $idedo;
         $telefono = mysql_result($qry, 0, "telefono");
         //$idpaquete = mysql_result($qry, 0, "id_paquete");
         //$idcode = mysql_result($qry, 0, "id_cliente");
         $email = mysql_result($qry, 0, "email");
       }
       else
         return("null");

      //$bolmain = split(":", get_boletos($idcode, $idpaquete, 1));
      $printmain = "<table border=2 width=300><tr><td><font face=Arial, Helvetica, sans-serif size=2><b>";
      $i=1;
      foreach($bolmain as $key){
        if($i==3)
          $printmain .= "<br>";
        $printmain = $printmain ."&nbsp; $key &nbsp;";
        $i++;
      }
      $printmain .= "</td></tr></table>";


      //Obtenemos el mail de confirmacion
      $ruta = "/var/www/html/edm/safetypay/mail/";

          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
     $bolrubi = split(":", get_boletos($idcode, $idpaquete, 3));
          $bolyes2 = split(":", get_boletos($idcode, $idpaquete, 4));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_safetypay.php";
          include $ruta;

      $headers = "From: Reader's Digest <servicio.clientes@selecciones.etapafinal2.com.mx> \n";
      $headers .= "Content-Type: text/html; charset=iso-8859-1\n";

      if(isset($mailbody)){
       if(!mail($email, $subject, $mailbody, $headers))
          return false;
  }else
     return false;
   }


   /*********** Envia correo de confirmacion **********
   *******************************************************************************************/
   function envia_correo($idcode, $tipocorreo, $idpaquete){
  $id_paquete=$idpaquete;
      //Primero obtenemos los datos del cliente
      $qry = mysql_query("select * from Cliente where id_cliente='$idcode'");
      if(mysql_num_rows($qry) > 0){
         $nombre = mysql_result($qry, 0, "nombre");
         $apellidos = mysql_result($qry, 0, "apellidos");
         $dir = mysql_result($qry, 0, "direccion");
    $direccion = $dir;
         $numext = mysql_result($qry, 0, "numext");
         $numint = mysql_result($qry, 0, "numint");
         $colonia = mysql_result($qry, 0, "colonia");
         $poblacion = mysql_result($qry, 0, "poblacion");
         $zip = mysql_result($qry, 0, "codigo_postal");
         $idedo = get_nombre_estado(mysql_result($qry, 0, "id_estado"));
    $estado = $idedo;
         $telefono = mysql_result($qry, 0, "telefono");
         $email = mysql_result($qry, 0, "email");
         $cantidad = mysql_result($qry, 0, "auxiliar1");
       }
       else
         return("null");

      $bolmain = split(":", get_boletos($idcode, $idpaquete, 1));
      $printmain = "<table border=2 width=300><tr><td><font face=Arial, Helvetica, sans-serif size=2><b>";
      $i=1;
      foreach($bolmain as $key){
        if($i==3)
          $printmain .= "<br>";
        $printmain = $printmain ."&nbsp; $key &nbsp;";
        $i++;
      }
      $printmain .= "</td></tr></table>";


      //Obtenemos el mail de confirmacion
      $ruta = "/var/www/html/edm/paquete".$idpaquete."/mailbot/";
 if($tipocorreo == "si"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 5));
          $bol2 = split(":", get_boletos($idcode, $idpaquete, 4));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses.php";
          include $ruta;
      }
 if($tipocorreo == "bnk"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_banco.php";
          include $ruta;
      }
 if($tipocorreo == "bnk2"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_BNK2.php";
          include $ruta;
      }
 if($tipocorreo == "tdc"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_TDC.php";
          include $ruta;
      }
 if($tipocorreo == "tdc2"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_TDC2.php";
          include $ruta;
      }
 if($tipocorreo == "efe"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolyes2 = split(":", get_boletos($idcode, $idpaquete, 4));
     $url_oxxo = get_codigo_oxxo($idcode, $idpaquete);
     $url_seven = get_codigo_seven($idcode, $idpaquete);
     $num_oxxo = substr($url_oxxo, -26);
     $num_seven = substr($url_seven, -32);
          $vimiento = date("d-M-Y", mktime(0, 0, 0, date('m'), date('d')+15, date('Y')));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_efe.php";
          include $ruta;
      }
 if($tipocorreo == "meses"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolyes2 = split(":", get_boletos($idcode, $idpaquete, 4));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_tarjeta_meses.php";
          include $ruta;
      }   
 if($tipocorreo == "pr"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_pr.php";
          include $ruta;
      }   
 if($tipocorreo == "full"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolyes1 = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yes.php";
          include $ruta;
      }   
 if($tipocorreo == "contado"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
     $bolrubi = split(":", get_boletos($idcode, $idpaquete, 3));
          $bolyes2 = split(":", get_boletos($idcode, $idpaquete, 4));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_contado.php";
          include $ruta;
      }   
 if($tipocorreo == "abonos"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
     $bolrubi = split(":", get_boletos($idcode, $idpaquete, 3));
          $bolyes2 = split(":", get_boletos($idcode, $idpaquete, 4));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_abonos.php";
          include $ruta;
      }   
 if($tipocorreo == "tel"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
     $bolrubi = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_tel.php";
          include $ruta;
      }   
 if($tipocorreo == "tel2"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
     $bolrubi = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_tel2.php";
          include $ruta;
      }   
  if($tipocorreo == "DD"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yessesDD.php";
          include $ruta;
      }
      if($tipocorreo == "no"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));          
          $bolyes1 = split(":", get_boletos($idcode, $idpaquete, 3));          
          $subject = "Confirmaci�n de Participaci�n";
          $ruta = $ruta."mail_noes.php";
          include $ruta;
      }
      if($tipocorreo == "triple"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "$nombre, gracias por tu orden!!";
          $ruta = $ruta."mail_triple.php";
          @include $ruta;
      }
      if($tipocorreo == "datos"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "$nombre, gracias por favor completa los datos de tu obsequiado!!";
          $ruta = $ruta."mail_datos.php";
          @include $ruta;
      }
      if($tipocorreo == "BML"){
          $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
          $bolgiv = split(":", get_boletos($idcode, $idpaquete, 3));
          $subject = "$nombre, gracias por tu orden!!";
          $ruta = $ruta."mail_yes_BML.php";
          @include $ruta;
      }

      $headers = "From: Reader's Digest <servicio.clientes@selecciones.etapafinal2.com.mx> \n";
      $headers .= "Content-Type: text/html; charset=iso-8859-1\n";

      if(isset($mailbody)){
       if(!mail($email, $subject, $mailbody, $headers))
          return false;
  }else
     return false;
   }

    /*********** Envia correo de confirmacion de Banco**********
   *******************************************************************************************/
   function envia_correo_banco($idcode, $tipocorreo, $idpaquete, $ban, $inv, $serf, $hsbc, $bbva,$idorden){
  $id_paquete=$idpaquete;
  $id_orden=$idorden;
  $id_code=$idcode;
      //Primero obtenemos los datos del cliente
      $qry = mysql_query("select * from Cliente where id_cliente='$idcode'");
      if(mysql_num_rows($qry) > 0){
         $nombre = mysql_result($qry, 0, "nombre");
         $apellidos = mysql_result($qry, 0, "apellidos");
         $dir = mysql_result($qry, 0, "direccion");
    $direccion = $dir;
         $numext = mysql_result($qry, 0, "numext");
         $numint = mysql_result($qry, 0, "numint");
         $colonia = mysql_result($qry, 0, "colonia");
         $poblacion = mysql_result($qry, 0, "poblacion");
         $zip = mysql_result($qry, 0, "codigo_postal");
         $idedo = get_nombre_estado(mysql_result($qry, 0, "id_estado"));
  $estado = $idedo;
         $telefono = mysql_result($qry, 0, "telefono");
         $email = mysql_result($qry, 0, "email");
         $cantidad = mysql_result($qry, 0, "auxiliar1");
       }
       else
         return("null");

      $bolmain = split(":", get_boletos($idcode, $idpaquete, 1));
      $printmain = "<table border=2 width=300><tr><td><font face=Arial, Helvetica, sans-serif size=2><b>";
      $i=1;
      foreach($bolmain as $key){
        if($i==4)
          $printmain .= "<br>";
        $printmain = $printmain ."&nbsp; $key &nbsp;";
        $i++;
      }
      $printmain .= "</td></tr></table>";


      //Obtenemos el mail de confirmacion
      $ruta = "/var/www/html/edm/paquete".$idpaquete."/mailbot/";
 
 if($tipocorreo == "bnk"){
     $url_oxxo = get_codigo_oxxo($idcode, $idpaquete);
     $num_oxxo = substr($url_oxxo, -26);
          $vencimiento = date("d-M-Y", mktime(0, 0, 0, date('m'), date('d')+15, date('Y')));
        $lineaserf = $serf;
   $lineainv = $inv;
   $lineahsbc = $hsbc;
   $lineaban = $ban;
   $lineabbva = $bbva;
   $bolyes = split(":", get_boletos($idcode, $idpaquete, 2));
   $bolyes2 = split(":", get_boletos($idcode, $idpaquete, 4));
          $subject = "Confirmaci�n de Orden";
          $ruta = $ruta."mail_yesses_banco.php";
          @include $ruta;
      }
      $headers = "From: Reader's Digest <servicio.clientes@etapafinal2.com.mx> \n";
      $headers .= "Content-Type: text/html; charset=iso-8859-1\n";

      if(isset($mailbody)){
       if(!mail($email, $subject, $mailbody, $headers))
          return false;
  }else
     return false;
   }
   
   /**************************** Envia correo para home 2 *******************************************/

 function envia_correo2($idcode, $tipocorreo, $idpaquete){
return true;
}

/****************************************************************************************************/

   /*********** Genera numeros de sorteo solo uno **********
   *******************************************************************************************/
   function asigna_numeros_uno($tipo_sorteo, $id_paquete){
     //Primero buscamos el �ltimo n�mero asignado
     $qry = mysql_query("select id_campaign, num_actual, rango_final, prefijo, boletos, rango_inicial from sorteopaquete where id_paquete=$id_paquete and 
cve_sorteo=$tipo_sorteo");
      
     if(mysql_num_rows($qry) > 0){
        $prefix = mysql_result($qry, 0, "prefijo");
        $limite = mysql_result($qry, 0, "rango_final");
        $inicial = mysql_result($qry, 0, "rango_inicial");
        $numact = mysql_result($qry, 0, "num_actual");
        $ticket = 1; #mysql_result($qry, 0, "boletos");
        $id_campaign = mysql_result($qry, 0, "id_campaign");
     }else
      $boletos="null"; // si no encontro datos no puede dar boletos
        //Actualizar el �ltimo numero;
        $pnum = mysql_query("update sorteopaquete set num_actual=num_actual+1 where id_paquete=$id_paquete and cve_sorteo=$tipo_sorteo");
      if(mysql_affected_rows()<1)
        $boletos="null";

        $usados = ($numact-$inicial+1)/($limite-$inicial+1);
        $rest = $limite - $numact;

        $when=date("M-d h:i");

          if($usados>0.85&&$usados<=1&&(@round($rest/$ticket))%25==0&&$id_campaign<57){
    $pretty =substr($usados,0,5);
              //mail("santiago.velasco@rd.com","Aviso de EDM $pretty de los boletos usados en el sorteo $tipo_sorteo en el paquete $id_paquete  $when","Faltan $rest  numeros para que se acaben los numeros de sorteo $tipo_sorteo del paquete $id_paquete!");
           }
           if($usados>1&&(round($rest/$ticket))%50==0&&$id_campaign<57){
              //mail("santiago.velasco@rd.com","Aviso de EDM Boletos Agotados en el sorteo $tipo_sorteo en el paquete $id_paquete  $when","Faltaron $rest  n�meros de sorteo $tipo_sorteo del paquete $id_paquete!");
           }
      if($rest>=$ticket){
         for($i=0;$i<$ticket;$i++){
              $numaux = digitover($numact);
             $bol = $prefix.$numaux;
             $boletos[] = $bol;
             $numact++;
          }
      }elseif($id_campaign>0&&$id_campaign!='')
        $boletos = asigna_numeros_campaign($tipo_sorteo, $id_campaign, $ticket);

     return($boletos);
   }


   /*********** Genera numeros de sorteo **********
   *******************************************************************************************/
   function asigna_numeros($tipo_sorteo, $id_paquete){
     //Primero buscamos el �ltimo n�mero asignado
     $qry = mysql_query("select id_campaign, num_actual, rango_final, prefijo, boletos, rango_inicial from sorteopaquete where id_paquete=$id_paquete and 
cve_sorteo=$tipo_sorteo");
      
     if(mysql_num_rows($qry) > 0){
        $prefix = mysql_result($qry, 0, "prefijo");
        $limite = mysql_result($qry, 0, "rango_final");
        $inicial = mysql_result($qry, 0, "rango_inicial");
        $numact = mysql_result($qry, 0, "num_actual");
        $ticket = mysql_result($qry, 0, "boletos");
        $id_campaign = mysql_result($qry, 0, "id_campaign");
     }else
      $boletos="null"; // si no encontro datos no puede dar boletos
        //Actualizar el �ltimo numero;
        $pnum = mysql_query("update sorteopaquete set num_actual=num_actual+boletos where id_paquete=$id_paquete and cve_sorteo=$tipo_sorteo");
      if(mysql_affected_rows()<1)
        $boletos="null";

        $usados = ($numact-$inicial+1)/($limite-$inicial+1);
        $rest = $limite - $numact;

        $when=date("M-d h:i");

          if($usados>0.85&&$usados<=1&&(@round($rest/$ticket))%25==0&&$id_campaign<57){
    $pretty =substr($usados,0,5);
              //mail("santiago.velasco@rd.com","Aviso de EDM $pretty de los boletos usados en el sorteo $tipo_sorteo en el paquete $id_paquete  $when","Faltan $rest  numeros para que se acaben los numeros de sorteo $tipo_sorteo del paquete $id_paquete!");
           }
           if($usados>1&&(round($rest/$ticket))%50==0&&$id_campaign<57){
              //mail("santiago.velasco@rd.com","Aviso de EDM Boletos Agotados en el sorteo $tipo_sorteo en el paquete $id_paquete  $when","Faltaron $rest  n�meros de sorteo $tipo_sorteo del paquete $id_paquete!");
           }
      if($rest>=$ticket){
         for($i=0;$i<$ticket;$i++){
              $numaux = digitover($numact);
             $bol = $prefix.$numaux;
             $boletos[] = $bol;
             $numact++;
          }
      }elseif($id_campaign>0&&$id_campaign!='')
        $boletos = asigna_numeros_campaign($tipo_sorteo, $id_campaign, $ticket);

     return($boletos);
   }


   /*********** Genera numeros de sorteo **********
   *******************************************************************************************/
   function asigna_numeros_campaign($tipo_sorteo, $id_campaign ,$ticket){
     //Primero buscamos el �ltimo n�mero asignado

     $qry = mysql_query("select num_actual, rango_final, prefijo, rango_inicial from sorteo_campaign where id_campaign=$id_campaign and cve_sorteo=$tipo_sorteo and 
rango_final>num_actual order by creado asc");

     if(mysql_num_rows($qry) > 0){
        $prefix = mysql_result($qry, 0, "prefijo");
        $limite = mysql_result($qry, 0, "rango_final");
        $inicial = mysql_result($qry, 0, "rango_inicial");
        $numact = mysql_result($qry, 0, "num_actual");
     }else
      $boletos="null";

        //Actualizar el �ltimo numero;
        $pnum = mysql_query("update sorteo_campaign set num_actual=num_actual+$ticket where id_campaign=$id_campaign and cve_sorteo=$tipo_sorteo");
      if(mysql_affected_rows()<1)
        $boletos="null"; //Si no pudo actualizar no puede dar boletos

        $usados = ($numact-$inicial+1)/($limite-$inicial+1);
        $rest = $limite - $numact;

        $when=date("M-d h:i");

          if($usados>0.85&&$usados<=1&&((round($rest/$ticket))==0)){
        $pretty =substr($usados,0,5);
//              mail("santiago.velasco@rd.com","Aviso de EDM $pretty de los boletos usados en el sorteo $tipo_sorteo en la campa�a $id_campaign  $when","Faltan $rest  numeros para que se acaben los numeros de sorteo $tipo_sorteo en la campa�a $id_campaign!");
           }
           if($usados>1&&((round($rest/$ticket))==0)){
//              mail("santiago.velasco@rd.com","Aviso de EDM Boletos Agotados en el sorteo $tipo_sorteo en la campa�a $id_campaign  $when","Faltaron $rest  n�meros de sorteo $tipo_sorteo en la campa�a $id_campaign!");
      return $boletos;
           }

      if($rest>=$ticket){
         for($i=0;$i<$ticket;$i++){
              $numaux = digitover($numact);
             $bol = $prefix.$numaux;
             $boletos[] = $bol;
             $numact++;
          }
      }else // si no hay suficientes boletos;
        $boletos="null";

     return($boletos);
   }


    /*********** Devuelve num sorteo con digito verficador **********
   *******************************************************************************************/
   function digitover($numero){
      for($i=strlen($numero);$i<7;$i++){
        $numero = "0".$numero;
      }

      $dig1 = suma(substr($numero, 0,1) * 2);
      $dig2 = substr($numero, 1,1);
      $dig3 = suma(substr($numero, 2,1) * 2);
      $dig4 = substr($numero, 3,1);
      $dig5 = suma(substr($numero, 4,1) * 2);
      $dig6 = substr($numero, 5,1);
      $dig7 = suma(substr($numero, 6,1) * 2);

      $total = $dig1 + $dig2 + $dig3 + $dig4 + $dig5 + $dig6 + $dig7;

      $digv = substr($total, strlen($total)-1,1);

      if($digv == 0)
         $digito = 0;
      else
         $digito = 10 - $digv;

      $numero = $numero.$digito;

      return($numero);
   }

   function suma($num){
      if(strlen($num) > 1){
         $add = substr($num, 0, 1) + substr($num, 1, 1);
         return($add);
      }
      else
         return($num);
   }

   /*********** Insert los boletos en la BD **********
   *******************************************************************************************/
   function inserta_boletos($idcode, $idpaquete, $cve_sorteo, $boletos, $idban){
  if($idban==0)
    $idban=$_SESSION[cve_envio];
    if(is_array($boletos)){
      foreach($boletos as $key){
        $tickets = $key.":".$tickets;
      }
      if(!existe_visita($idcode, $idpaquete, $cve_sorteo)){
        $chkqry = mysql_query("select id_paquete from visitapaquete where id_paquete=$idpaquete and cve_sorteo=$cve_sorteo and id_cliente='$idcode'");
        if(mysql_num_rows($chkqry) == 0){ 
          $qry = "insert into visitapaquete (cve_sorteo, id_paquete, id_cliente, boletos, id_banner, ip)";
          $qry .= " values($cve_sorteo, $idpaquete, '$idcode', '$tickets', $idban, '$_SERVER[REMOTE_ADDR]')";
          $execqry = mysql_query($qry);

          if(mysql_affected_rows()>0)
              return("true");
          else
              return("null");
        }
      }
      else
         return("true");
   }
   else{
  $qry = "insert into visitapaquete (cve_sorteo, id_paquete, id_cliente, boletos, id_banner, ip)";
          $qry .= " values($cve_sorteo, $idpaquete, '$idcode', '0', $idban, '$_SERVER[REMOTE_ADDR]')";
          $execqry = mysql_query($qry);
          if(mysql_affected_rows()>0)
              return("true");
     log_sinboleto($idcode,$idpaquete,$cve_sorteo,$idban);
     return("");
   }
  }

/*********** Insert maximo 30 boletos en la BD **********
   *******************************************************************************************/
   function inserta_30_boletos($idcode, $idpaquete, $cve_sorteo, $boletos, $idban){
  if($idban==0)
    $idban=$_SESSION[cve_envio];
    if(is_array($boletos)){
      foreach($boletos as $key){
        $tickets = $key.":".$tickets;
      }
      if(!existe_visita($idcode, $idpaquete, $cve_sorteo)){
        $chkqry = mysql_query("select id_paquete from visitapaquete_30bol where id_paquete=$idpaquete and cve_sorteo=$cve_sorteo and id_cliente='$idcode'");
        if(mysql_num_rows($chkqry) == 0){ 
          $qry = "insert into visitapaquete_30bol(cve_sorteo, id_paquete, id_cliente, boletos, id_banner, ip)";
          $qry .= " values($cve_sorteo, $idpaquete, '$idcode', '$tickets', $idban, '$_SERVER[REMOTE_ADDR]')";
          $execqry = mysql_query($qry);

          if(mysql_affected_rows()>0)
              return("true");
          else
              return("null");
        }
      }
      else
         return("true");
   }
   else{
  $qry = "insert into visitapaquete_30bol(cve_sorteo, id_paquete, id_cliente, boletos, id_banner, ip)";
          $qry .= " values($cve_sorteo, $idpaquete, '$idcode', '0', $idban, '$_SERVER[REMOTE_ADDR]')";
          $execqry = mysql_query($qry);
          if(mysql_affected_rows()>0)
              return("true");
     log_sinboleto($idcode,$idpaquete,$cve_sorteo,$idban);
     return("");
   }
  }



   /*********** Valid si existe la visita en la BD **********
   *******************************************************************************************/
   function existe_cliente($idcode){
       $qry = mysql_query("select * from Cliente where id_cliente='$idcode'");
       if(mysql_num_rows($qry)>0){
          $cliente['nombre'] = mysql_result($qry, 0, "nombre");
          $cliente['apellidos'] = mysql_result($qry, 0, "apellidos");
          $cliente['calle'] = mysql_result($qry, 0, "direccion");
          $cliente['numext'] = mysql_result($qry, 0, "numext");
          $cliente['numint'] = mysql_result($qry, 0, "numint");
          $cliente['colonia'] = mysql_result($qry, 0, "colonia");
          $cliente['poblacion'] = mysql_result($qry, 0, "poblacion");
          $cliente['zip'] = mysql_result($qry, 0, "codigo_postal");
          $cliente['estado'] = mysql_result($qry, 0, "id_estado");
          $cliente['lada'] = mysql_result($qry, 0, "lada");
          $cliente['telefono'] = mysql_result($qry, 0, "telefono");
          $cliente['calle1'] = mysql_result($qry, 0, "auxiliar1");
          $cliente['calle2'] = mysql_result($qry, 0, "auxiliar2");
          $cliente['email'] = mysql_result($qry, 0, "email");

          return($cliente);
       }
       else
          return(false);

   }

   /*********** Valid si existe la visita en la BD **********
   *******************************************************************************************/
   function existe_cliente_data($email){
       $qry = mysql_query("select * from Cliente where email='$email'");
  $num=mysql_numrows($qry);
  $n=$num-1;
       if(mysql_num_rows($qry)>0){
          $cliente['nombre'] = mysql_result($qry, $n, "nombre");
          $cliente['apellidos'] = mysql_result($qry, $n, "apellidos");
          $cliente['calle'] = mysql_result($qry, $n, "direccion");
          $cliente['numext'] = mysql_result($qry, $n, "numext");
          $cliente['numint'] = mysql_result($qry, $n, "numint");
          $cliente['colonia'] = mysql_result($qry, $n, "colonia");
          $cliente['poblacion'] = mysql_result($qry, $n, "poblacion");
          $cliente['zip'] = mysql_result($qry, $n, "codigo_postal");
          $cliente['estado'] = mysql_result($qry, $n, "id_estado");
          $cliente['telefono'] = mysql_result($qry, $n, "telefono");
          $cliente['email'] = mysql_result($qry, $n, "email");

          return($cliente);
       }
       else
          return(false);

   }

   /*********** Obtiene numero de cliente **********
   *******************************************************************************************/
   function get_num_cliente($email){
       $qry = mysql_query("select num_cliente from cliente_RD where email ='$email'");
  if(mysql_num_rows($qry)>0){
        return(mysql_result($qry, 0));          
     }
       else
          return(false);
   }

   /*********** Valid si existe la visita en la BD **********
   *******************************************************************************************/
   function get_idcode($email){
       $qry = mysql_query("select * from Cliente where email='$email' order by direccion desc");
       if(mysql_num_rows($qry)>0){
          $cliente['idcode'] = mysql_result($qry, 0, "id_cliente");
          $cliente['nombre'] = mysql_result($qry, 0, "nombre");
          $cliente['apellidos'] = mysql_result($qry, 0, "apellidos");
          $cliente['calle'] = mysql_result($qry, 0, "direccion");
          $cliente['numext'] = mysql_result($qry, 0, "numext");
          $cliente['numint'] = mysql_result($qry, 0, "numint");
          $cliente['colonia'] = mysql_result($qry, 0, "colonia");
          $cliente['poblacion'] = mysql_result($qry, 0, "poblacion");
          $cliente['zip'] = mysql_result($qry, 0, "codigo_postal");
          $cliente['estado'] = mysql_result($qry, 0, "id_estado");
          $cliente['telefono'] = mysql_result($qry, 0, "telefono");
          $cliente['email'] = mysql_result($qry, 0, "email");

          return($cliente);
       }
       else
          return(false);

   }


   function get_boletos($idcode, $id_paquete, $cve_sorteo){
     $qry = mysql_query("select boletos from visitapaquete where id_cliente='$idcode' and cve_sorteo=$cve_sorteo and id_paquete=$id_paquete");
//     if(strcmp(substr($idcode,0,2),'PR')==0)
//  echo "$select boletos from visitapaquete where id_cliente='$idcode' and cve_sorteo=$cve_sorteo and id_paquete=$id_paquete\n";
     if(@mysql_num_rows($qry)>0){
        $boletos = mysql_result($qry, 0, "boletos");
        return($boletos);
     }
     else
        return("No hay boletos");
   }



   function get_30_boletos($idcode, $id_paquete, $cve_sorteo){
     $qry = mysql_query("select boletos from visitapaquete_30bol where id_cliente='$idcode' and cve_sorteo=$cve_sorteo and id_paquete=$id_paquete");
//     if(strcmp(substr($idcode,0,2),'PR')==0)
//  echo "$select boletos from visitapaquete_30bol where id_cliente='$idcode' and cve_sorteo=$cve_sorteo and id_paquete=$id_paquete\n";
     if(@mysql_num_rows($qry)>0){
        $boletos = mysql_result($qry, 0, "boletos");
        return($boletos);
     }
     else
        return("No hay boletos");
   }
   /*********** Envia correo de promocion Joy **********
   *******************************************************************************************/
   function envia_Joy($email,$id_cliente,$nombre,$apellidos){
/*
  //Primero obtenemos los datos del cliente
      $qry = mysql_query("select id_cliente, nombre, apellidos from Cliente where email='$email'");
      if(mysql_num_rows($qry) > 0){
         $id_cliente = mysql_result($qry, 0, "id_cliente");
         $nombre = mysql_result($qry, 0, "nombre");
         $apellidos = mysql_result($qry, 0, "apellidos");
       }
       else
         return("null");
*/
      //Obtenemos el mail a enviar
      $image = date('dmY')."_envios.gif";
      $ruta = "/www/htdocs/edm/includes/mails/";
      $ruta = $ruta."mail_Joy.php";
      include $ruta;

      $subject = "�Ya me conoces $nombre?";
      $headers = "From: Joy <etapafinal@etapafinal.selecciones.com> \n";
      $headers .= "Content-Type: text/html; charset=iso-8859-1\n";


      if(!mail($email, $subject, $mailbody, $headers))
         echo "Hubo un problema al enviar el correo de confirmaci�n!";
   }

/********************************** Actualiza el Email para un idCode ****************************
****************************************************************************************************/
   function update_email($idcode,$email){
  $email=trim($email);
  $idcode=trim($idcode);
     if(!preg_match('/[a-z]{2}[0-9]{6}/i',$idcode,$matches1)||!preg_match('/[a-z0-9\._-]{2,255}@[a-z0-9_-]{2,255}\.[a-z0-9\._-]{2,255}/i',$email,$matches))
  return "false";
     else{
      $qry = "update Cliente set email='$email',ip='$_SERVER[REMOTE_ADDR]'";
      $qry .= "where id_cliente='$idcode'";
  mysql_query($qry);
      return("true");
  }
   }
   
   /************************ Actualiza nombre y apellidos para un idCode ****************************
****************************************************************************************************/
   function update_names($idcode,$fname, $lname){
    
      $qry = "update Cliente set nombre='$fname', apellidos='$lname',ip='$_SERVER[REMOTE_ADDR]'";
      $qry .= "where id_cliente='$idcode'";
      $execqry = mysql_query($qry);
  
    if(mysql_error()){
      return("null");
    }
    else
         return("true");
}

   /*********** Insert los boletos en la BD **********
   *******************************************************************************************/
   function inserta_boletos_speed($idcode, $idpaquete, $cve_sorteo, $boletos, $idban, $time){
    if(is_array($boletos)){
      foreach($boletos as $key){
        $tickets = $key.":".$tickets;
      }
      if(!existe_visita($idcode, $idpaquete, $cve_sorteo)){
        $chkqry = mysql_query("select id_paquete from visitapaquete where id_paquete=$idpaquete and cve_sorteo=$cve_sorteo and id_cliente='$idcode'");
        if(mysql_num_rows($chkqry) == 0){
          $qry = "insert into visitapaquete (cve_sorteo, id_paquete, id_cliente, boletos, time_to_load, id_banner, ip)";
          $qry .= " values($cve_sorteo, $idpaquete, '$idcode', '$tickets', '$time', '$idban', '$_SERVER[REMOTE_ADDR]')";
          $execqry = mysql_query($qry);
          if(mysql_affected_rows()>0)
              return("true");
          else
              return("null");
        }
      }
      else
         return("true");
   }
   else
     return("");
  }

  /****************** Log de Errores *************************/

  function log_sinboleto($idcode,$idpaquete,$cve_sorteo,$idban){
  $fp=fopen ('../sinboleto.csv','a');
  fwrite($fp,"$idcode,$idpaquete,$cve_sorteo,$idban,".date("m/d/Y")."\n");
  fclose($fp);
  return;
  }


/********* Returns a date in format plus a number of days ***********/
function fechamasdias($datetime,$days) {
    $meses=array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    $year = substr($datetime,0,4);
    $month = substr($datetime,5,2);
    $day = substr($datetime,8,2);
    $string=date('d/m/Y',mktime(0,0,0,$month,$day,$year)+($days*60*60*24));
    $fecha=explode('/',$string);
    $string=$fecha[0]." de ".$meses[(int)$fecha[1]]." ".$fecha[2];
    return $string; 
}
function trim_name($nombrevar){      
        $new_nombre = ""; 
        $nombre_array=explode(" ",$nombrevar);
       for($ni=0;$ni<count($nombre_array);$ni++){
               if((strlen($new_nombre) + strlen($nombre_array[$ni]))<=13)
                   $new_nombre.=$nombre_array[$ni]." ";   
               else
                   $new_nombre.=substr($nombre_array[$ni],0,1)." ";
        }
        $nombrevar=$new_nombre;
        return $nombrevar;
}

function registra_voto($idcliente, $idpaq, $voto, $otro){
     $qry = mysql_query("insert into poll (id_cliente, id_paquete, voto, otro) values('$idcliente',$idpaq,$voto,'$otro')");
  }

function get_codigo_barras($idcliente, $idpaq){
 $qry = mysql_query("select urlOxxo, url7 from orden where id_cliente='$idcliente' and id_paquete=$idpaq");
 if(mysql_num_rows($qry) > 0){
   $result['Oxxo_url'] = mysql_result($qry, 0, "urlOxxo");
   $result['7eleven_url'] = mysql_result($qry, 0, "url7");
   $result['Oxxo_numero'] = substr($result['Oxxo_url'], -26);
   $result['7eleven_numero'] = substr($result['7eleven_url'], -32);

 }
 return($result);
}

function get_lineas($idorden){
 $qry = mysql_query("select * from cliente_bancos where id_orden=$idorden");
 if(mysql_num_rows($qry) > 0){
   $result['ban'] = mysql_result($qry, 0, "linea_banamex");
   $result['bbva'] = mysql_result($qry, 0, "linea_bancomer");
   $result['inv'] = mysql_result($qry, 0, "linea_scotiabank");
   $result['hsbc'] = mysql_result($qry, 0, "linea_hsbc");
   $result['serf'] = mysql_result($qry, 0, "linea_santander");
 }
 return($result);
}


function get_codigo_oxxo($idcliente, $idpaq){
 $qry = mysql_query("select urlOxxo from orden where id_cliente='$idcliente' and id_paquete=$idpaq");
 if(mysql_num_rows($qry) > 0){
   $result = mysql_result($qry, 0, "urlOxxo"); 
   return($result);
 }
}

function get_codigo_seven($idcliente, $idpaq){
 $qry = mysql_query("select url7 from orden where id_cliente='$idcliente' and id_paquete=$idpaq");
 if(mysql_num_rows($qry) > 0){
   $result = mysql_result($qry, 0, "url7"); 
   return($result);
 }
}

?>

