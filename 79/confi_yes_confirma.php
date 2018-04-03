<?php
session_start();

include_once '../../includes/utilities.inc';
include '../../includes/conexion.inc';
include '../../includes/pagoenlinea_nuevo.inc';
include '../../includes/rc4.php';

 
function trae_id_orden($idcode, $idpaquete){ 
    $qry = mysql_query("select id_orden from orden where id_paquete=$idpaquete and id_cliente='$idcode'");
    $result=mysql_fetch_array($qry);
    return $result[0];
   }

/********************** Borra los productos comprados **********/
function elimina__los_producto_compra($id_paquete,$id_cliente,$id_orden){
      $query="DELETE FROM compra where id_paquete = '$id_paquete' and id_cliente = '$id_cliente' and id_orden = '$id_orden'";
      mysql_query($query);
}
/********************** Registra los productos comprados **********/
function agrega_productos_a_la_compra($id_paquete,$id_cliente,$productos,$id_orden){
  if(is_array($productos)){
    foreach($productos as $a =>$prod){
      $query="INSERT INTO compra (id_paquete,id_cliente,id_orden,id_producto) VALUES ('$id_paquete','$id_cliente','$id_orden','$prod')";
      mysql_query($query);
    }
      
  }
  else
    mysql_query("INSERT INTO compra (id_paquete,id_cliente,id_orden,id_producto) VALUES ('$id_paquete','$id_cliente','$id_orden','$productos')");
}


 if(isset($_REQUEST['producto1'])){  
   $prodm[] = '0616364'; 
}
 if(isset($_REQUEST['producto2'])){  
   $prodm[] = '0616685'; 
}
if(isset($_REQUEST['producto3'])){  
   $prodm[] = '0616709'; 
}
if(isset($_REQUEST['producto4'])){  
   $prodm[] = '0616504'; 
}

if(isset($_SESSION['nombre']) && isset($_SESSION['apellido']) ){
  $cliente=$_SESSION['id_cliente'];
  $id_orden = trae_id_orden($cliente, $_SESSION['idpaquete']);
  elimina__los_producto_compra($_SESSION['idpaquete'],$cliente,$id_orden);
  agrega_productos_a_la_compra($_SESSION['idpaquete'],$cliente,$prodm,$id_orden);

  $msg_t='ok';
  $msg="Gracias tu orden ha sido confirmada correctamente. ";
  header('Location:confirma.php?status='.$msg_t.'&msg='.$msg);
}else{
   $msg_t='err';
  $msg="Ocurrio un error intentalo mas tarde";
  header('Location:confirma.php?status='.$msg_t.'&msg='.$msg);
}
  
?>

