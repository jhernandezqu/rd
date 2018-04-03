<?php
session_start();
$_SESSION[file]=__FILE__;
include_once '../../includes/utilities.inc';
include '../../includes/conexion.inc';

/*
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/

if(isset($_REQUEST['product1'])){	
	 $_SESSION['producto1'] = $_REQUEST['product1'] ;
}
if(isset($_REQUEST['product2'])){
	if($_REQUEST['product2'] != '2_5'){
		 $_SESSION['producto2'] = $_REQUEST['product2'] ; 
	}
}

if(isset($_SESSION['producto1'])){  
    switch ($_SESSION['producto1']) {
        case "1_1":
             $prodm[] = '1'; 
            break;
        case "1_2":
             $prodm[] = '2'; 
            break;
        case "1_3":
             $prodm[] = '3'; 
            break;
        case "1_4":
             $prodm[] = '4'; 
            break;
    }
}
if(isset($_SESSION['producto2'])){  
    switch ($_SESSION['producto2']) {
        case "2_1":
             $prodm[] = '1'; 
            break;
        case "2_2":
             $prodm[] ='2'; 
            break;
        case "2_3":
             $prodm[] = '3'; 
            break;
        case "2_4":
             $prodm[] = '4'; 
            break;
    }
}



if(!$_SESSION['idcliente']) {
	    $fecha = date('dms');
	    $ran_num = rand(1, 1000000).$fecha ;
	    $idcode = genera_idcode($ran_num);
		//$reg_user = registra_usuario($idcode, trim(ucfirst($_REQUEST['fname'])), trim(ucfirst($_REQUEST['lname'])), trim($_REQUEST['email']),$_SESSION['idpaquete']);	
		$reg_user = registra_usuario($idcode, trim(ucfirst($_SESSION['nombre'])), trim(ucfirst($_SESSION['apellido'])), trim($_SESSION['email']),$_SESSION['idpaquete']);	
}

if($_SESSION['idcliente']){
		$ord = @registra_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);
	    $id_orden = @obtiene_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);		 
 	    	
}

if($_SESSION['compra']!=1){
	$id_orden = cliente_confirma($_SESSION['idcliente'], $_SESSION['idpaquete'], 1, 1);
	agrega_producto_compra($_SESSION[idpaquete],$_SESSION[idcliente],$prodm,$id_orden);
	//envia_correo($_SESSION['idcliente'], "BML", $_SESSION['idpaquete']);
	$_SESSION['compra']=1; 
}
?>  
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.::Reader's Digest::.</title>
<style type="text/css">
<!--
body {
	background-image: url();
	margin-top: 0px;
	background-color: #EDEDED;
}
.style111 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style12 {font-family: Arial, Helvetica, sans-serif}
.style14 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style8 {
	font-size: 22px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	text-align: left;
}
.style1 {	font-size: 9px;
	font-family: Verdana;
}
.style112 {font-family: Arial, Helvetica, sans-serif; font-size: 9px; }
.style22 {font-family: Arial, Helvetica, sans-serif; font-size: 13px; }
.bases {text-align: justify;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
}
.style11 {font-family: Arial, Helvetica, sans-serif}
.style121 {font-family: Arial, Helvetica, sans-serif; font-size: 12px;
}
.style121 {font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
.style131 {font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.style131 {font-size: 11px;
}
.style151 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-align: justify;
}
-->
</style></head>

<body>
<table width="706" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="700" align="center"><img src="imagenes/h_confi.jpg" width="612" height="95" /></td>
  </tr>
  <tr>
    <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"><p align="center"> <font face="Arial, Helvetica, sans-serif" size="4" color="CC0000"><b><br />
          &iexcl;MUCHAS GRACIAS POR TU ORDEN!</b></font><br />
          <br />
        </p>
            <p><font face="Arial, Helvetica, sans-serif" size="2">Apreciable <b><?php echo $_SESSION['nombre'] ?> <?php echo $_SESSION['apellido'] ?>,</b><br>
Adem&aacute;s de que recibir&aacute;s el o los productos de tu elecci&oacute;n directamente en la puerta de tu hogar junto con tu talonario de pagos, has confirmado lo siguiente</font><font size="2" face="Arial, Helvetica, sans-serif">:</font></p>
            <ul>
              <li><font face="Arial, Helvetica, sans-serif" size="2">Diez oportunidades  de participar para ganar el Gran Premio de $1&#8217;000,000.00 en el 53&ordm; Gran Sorteo.</font></li>
              <li><font size="2" face="Arial, Helvetica, sans-serif">Tu oportunidad de ganar un auto con valor de $250,000.00 en el sorteo Selección de Oro.</font><br>
                <br>
                <font face="Arial, Helvetica, sans-serif" size="2">Te recordamos...</font><br>
              </li>
            </ul>
            <div align="center">
              <div align="center">
               <div align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">Estos son tus n&uacute;meros para el 53&deg; Gran Sorteo<br>
              <br>
            <div style="border-style: outset; border-width: 1px; width:400px;">
            <?= $_SESSION['GS']?>  <? /*
 include_once '../includes/conexion.inc'; 
 include_once '../includes/utilities.inc';  
 /*$boletos = get_boletos($_SESSION['idcliente'], $id_paquete, 1);*/ 
 /*
 $boletos = asigna_numeros(1, $_SESSION['idpaquete']);
           $insbol = inserta_boletos($_SESSION['idcliente'], $_SESSION['idpaquete'], 1, $boletos, $cve_envio); 
 $tickets = get_boletos($_SESSION[idcliente], $_SESSION[idpaquete], 1);
                            $bol = split(":",$tickets);
							foreach($bol as $tick){
								echo "$tick ";
							}
                                              */  ?>   </div>         </div><br><br>
                                                
            <div align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">Éste es tu n&uacute;mero para el Sorteo Selección de Oro<br><br>
                   <div style="border-style: outset; border-width: 1px;width:400px;">
                   <?= $_SESSION['YO']?>  <? /*
 include_once '../includes/conexion.inc'; 
 include_once '../includes/utilities.inc'; 
 $boletos = asigna_numeros(2, $_SESSION['idpaquete']); 
             $insbol = inserta_boletos($_SESSION['idcliente'], $_SESSION['idpaquete'], 2, $boletos, $cve_envio);   
 $tickets = get_boletos($_SESSION[idcliente], $_SESSION[idpaquete], 2);
                            $bol = split(":",$tickets);
							foreach($bol as $tick){
								echo "$tick ";
							}
                                               */ ?>       </div>     </div>
                <p align="left" class="style14">&iexcl;Te deseo buena suerte en los sorteos!<br>
<br>
                  <br>
                  <br>
                  Sinceramente, <br>
                  <font helvetica, sans-serif color=""><img src="imagenes/GMendoza.png" alt="Gladys Mendoza" width="140" height="45" border=0></font><br>
                  Comit&eacute; de Sorteos<br>
                  Reader's Digest</p>
                <p align="justify" class="style14"><font color="CC0000"><b>MUY IMPORTANTE:</b></font> Imprime y conserva esta pantalla como comprobante. La necesitar&aacute;s en caso de que resultes el afortunado ganador de nuestro sorteo, porque sin ella no tendr&aacute;s derecho a reclamar el premio.                </p>
                <div align="left">                </div>
              </div><div align="left"></div>
            </div>
            <br>
            <br>
            <div align="left">
            </div>
            <div align="left"></div>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td align="center"><div align="center" class="Arial11Bold style1"><font face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><span style="font-size: 9px"><a href="http://selecciones.com/bases/53.php" target="_blank" style="font-size: 10px"  onClick='javascript:exit=false;'>Bases de Sorteos</a> &nbsp;|&nbsp; <a href="http://www.selecciones.com/privacidad/politicas.php" target="_blank" style="font-size: 10px"  onClick='javascript:exit=false;'>Aviso de Privacidad</a></span></font></div>
          <br />
            <font face="Arial, Helvetica, sans-serif" style="font-size: 9px" color="#333399">D.R. 
              
            &copy; 2018 Reader's Digest' y 'Reader's Digest' 
              
          son marcas registradas&quot;.<br>
            </font></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
