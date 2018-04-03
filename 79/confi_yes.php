<?php
session_start();
include_once '../../includes/utilities.inc';
include '../../includes/conexion.inc';
include '../../includes/pagoenlinea_nuevo.inc';

 
 if(isset($_REQUEST['product1'])){	
	 $_SESSION['producto1'] = $_REQUEST['product1'] ;
}
if(isset($_REQUEST['product2'])){
	if($_REQUEST['product2'] != '2_5'){
		 $_SESSION['producto2'] = $_REQUEST['product2'] ; 
	}
}
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if(!$_SESSION['idcliente']) {
	    $fecha = date('dms');
	    $ran_num = rand(1, 1000000).$fecha ;
	    $idcode = genera_idcode($ran_num);
		  $reg_user = registra_usuario($idcode, trim(ucfirst($_SESSION['nombre'])), trim(ucfirst($_SESSION['apellido'])), trim($_SESSION['email']),$_SESSION['idpaquete']);
}
*/
if($_SESSION['idcliente']){
		  $ord = @registra_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);
	    $id_orden = @obtiene_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);		 
}

$total=0;

if(isset($_SESSION['producto1'])){	
    switch ($_SESSION['producto1']) {
        case "1_1":
             $prodm[] = '1';
              $total += 359.80 ; 
            break;
        case "1_2":
             $prodm[] = '2'; 
              $total += 359.80 ; 
            break;
        case "1_3":
             $prodm[] = '3'; 
              $total += 300.00  ; 
            break;
        case "1_4":
             $prodm[] = '4'; 
              $total += 299.80  ; 
            break;
    }
}
if(isset($_SESSION['producto2'])){  
    switch ($_SESSION['producto2']) {
        case "2_1":
             $prodm[] = '1'; 
              $total +=  359.80 ; 
            break;
        case "2_2":
             $prodm[] ='2'; 
              $total += 359.80 ; 
            break;
        case "2_3":
             $prodm[] = '3'; 
              $total += 300.00 ; 
            break;
        case "2_4":
             $prodm[] = '4'; 
              $total += 299.80 ; 
            break;
    }
}


if($_SESSION['idcliente']){
    
    if($_REQUEST['optPago'] == "1")
    {
      if ($_REQUEST['tipoPago'] == '3')
         {
              $tpago = 3;
              $amount = $total+59.90;
         }
       else if ($_REQUEST['tipoPago'] == '4')
         {
              $tpago = 4;
              $amount = $total+59.90;
         }

    }
    else
        die("Error en el tipo de pago");
  

        $fechav = $_REQUEST['mesfinalTDC'].$_REQUEST['aniofinalTDC'];
          
		$fullname = $_REQUEST['nombreTDC'];
		$mes = $_REQUEST['mesfinalTDC'];
        $anio=$_REQUEST['aniofinalTDC'];
		$numero=$_REQUEST['numTDC'];
		$seguridad=$_REQUEST['seguridadTDC'];
        

        $card=array(
            "type"=>$_REQUEST['tipoTDC'],
            "name"=>$fullname,
            "number"=>$numero,
            "expmonth"=>$mes,
            "expyear"=>$anio,
            "cvvcsc"=>$seguridad,
        );
    
    if($_SESSION['compra']!=1){
          $reference=$_SESSION['idpaquete'].$_SESSION['idcliente'];
          $resultado=operacion($reference, $card, $amount);
       
          if(strcmp($resultado[CENTEROFPAYMENTS][response],"approved")==0){
              $tdc = ingresa_tdc1($_SESSION['idcliente'], $_SESSION['idpaquete'], $fullname,$amount, $_REQUEST['tipoTDC'], $resultado[CENTEROFPAYMENTS][cc_number], $_REQUEST['seguridadTDC'], $resultado[CENTEROFPAYMENTS][auth], $fechav);
        $res3=$rc4crypt->Salaa($rc4crypt->HexStringToString($resultado[CENTEROFPAYMENTS][voucher]),'BD48EA09');
              $id_orden = cliente_confirma($_SESSION['idcliente'], $_SESSION['idpaquete'], 1, $tpago);
        
              agrega_producto_compra($_SESSION[idpaquete],$_SESSION[idcliente],$prodm,$id_orden);
              //$boletos = asigna_numeros(1, $_SESSION['idpaquete']);
              //$insbol = inserta_boletos($_SESSION['idcliente'], $_SESSION['idpaquete'], 1, $boletos, $cve_envio); 
         
              //$boletos = asigna_numeros(2, $_SESSION['idpaquete']); 
              //$insbol = inserta_boletos($_SESSION['idcliente'], $_SESSION['idpaquete'], 2, $boletos, $cve_envio); 
              
              $_SESSION['compra']=1;

          }
      
        else{
                agrega_producto_compra($_SESSION[idpaquete],$_SESSION[idcliente],$prodm,$id_orden);
              $id_orden = @obtiene_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);
                $tipo_pago = 0;
                $conf = cliente_confirma($_SESSION['idcliente'], $_SESSION['idpaquete'], 1, $tipo_pago);
                    }
    }
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
.style8 {font-size: 22px;
  font-weight: bold;
  font-family: Arial, Helvetica, sans-serif;
}
.style1 { font-size: 9px;
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
.style151 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style></head>

<body>
<p>
 <?php
  
switch(($resultado[CENTEROFPAYMENTS][response])){
       case  "approved":
           // imprime el voucher donde indica la etiqueta.
           $voucher="<div id=\"VOUCHER\" style=\"position:absolute; left: 1050px; top:360px; z-index:1; border: 1px none #FFFFFF; visibility: visible;\">";
           $voucher.="<br><table border = 1><td>";
           // la funcion imprime voucher da formato al resultado
          $voucher.= imprime_voucher($res3);
         /*$voucher.=imprime_voucher(($resultado[CENTEROFPAYMENTS][voucher]));*/
           $voucher.="</td></table></div>";
           print $voucher;
           break;
       case  "denied":
             print "<center><font face=\"Arial, Helvetica, sans-serif\" style=\"font-size:22px; color:#CC0000\">\n";
             print "<br><br><b>Tarjeta rechazada.</b></font><br>";
             print "<font face=\"Arial, Helvetica, sans-serif\" style=\"font-size:16px; color:#000000\">\n";
             print "Verifique que sus datos son los que aparecen en la tarjeta. </font><br>";
             print "<br><FORM><INPUT type=\"button\" value=\"Regresar\" onClick=\"history.back()\"></FORM></html></body>";
             die();
             break;
       case  "error":
       if (strpos($resultado[CENTEROFPAYMENTS][nb_error],"aprobada")){
             print "<div id=\"VOUCHER\" style=\"position:absolute; left: 850px; top:360px; z-index:1; border: 1px none #FFFFFF; visibility: visible;\">";
             print "<br><table border = 1><td><center>";
             print $resultado[CENTEROFPAYMENTS][nb_error];
             print "</center></td></table></div>";
             }
             else{
             print "<center><br><br>";
             print "ERROR:<br>";
             print $resultado[CENTEROFPAYMENTS][nb_error];
             print "<br><FORM><INPUT type=\"button\" value=\"Regresar\" onClick=\"history.back()\"></FORM></html></body>";
             die();
             }
             break;
       default:
          if($_SESSION['compra']==1){
             print "<div id=\"VOUCHER\" style=\"position:absolute; left: 850px; top:360px; z-index:1; border: 1px none #FFFFFF; visibility: visible;\">";
               print "<br><table border = 1><td><center>";
               print "Su transaccion ya fue procesada.";
               print "</center></td></table></div>";
          }
             break;
             }// end of switch
       
?></p>
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
            <p><font face="Arial, Helvetica, sans-serif" size="2">Apreciable <b><?= $_SESSION['nombre'] ?> <?= $_SESSION['apellido'] ?>,</b><br>
Adem&aacute;s de que recibir&aacute;s el o los productos de tu elecci&oacute;n directamente en la puerta de tu hogar, has confirmado los siguientes beneficios: </font></p>
            <ul>
              <li><font face="Arial, Helvetica, sans-serif" size="2">Diez oportunidades  de participar para ganar el Gran Premio de $1&#8217;000,000.00 en el 53&ordm; Gran Sorteo.</font></li>
              <li><font face="Arial, Helvetica, sans-serif" size="2">La oportunidad de ganar un espectacular auto &uacute;ltimo modelo o $250,000.00 en efectivo, al participar en el Sorteo Selección de Oro.</font><br>
                   
<br>
    Monto total de su orden<b> $<?= $amount?>*. </b><br>
    <br>
                  <font face="Arial, Helvetica, sans-serif" size="2">Te recordamos que...</font><br>
            </li>
            </ul>
            <div align="center"><font face="Arial, Helvetica, sans-serif" style="font-size: 11px">Estos son tus n&uacute;mero de participaci&oacute;n en el 53º Gran Sorteo</font>
              <table width="300" border="1" cellspacing="2" cellpadding="2" bordercolor="#666666">
                  <tr>
                    <td align="center"><font face="Arial, Helvetica, sans-serif" style="font-size: 11px">
                    <?= $_SESSION['GS']?>
                  <? /*
 include_once '../includes/conexion.inc'; 
 include_once '../includes/utilities.inc';  
 $tickets = get_boletos($_SESSION[idcliente], $_SESSION[idpaquete], 1);
                            $bol = split(":",$tickets);
              foreach($bol as $tick){
                echo "$tick ";
              }
                                              */  ?> </font></td>
                  </tr>
                </table>
              <br>
              <font face="Arial, Helvetica, sans-serif" style="font-size: 11px">É</font><font face="Arial, Helvetica, sans-serif" style="font-size: 11px">ste es tu n&uacute;mero de participaci&oacute;n en el Sorteo Selección de Oro</font>
                <table width="50%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" width="45%"><table width="300" border="1" cellpadding="2" cellspacing="2" bordercolor="#666666">
                        <tr valign="middle">
                          <td align="center"><font face="Arial, Helvetica, sans-serif" style="font-size: 11px">
                          <?= $_SESSION['YO']?>
                            <? /*
 include_once '../includes/conexion.inc'; 
 include_once '../includes/utilities.inc';   
 $tickets = get_boletos($_SESSION[idcliente], $_SESSION[idpaquete], 2);
 print(str_replace(":","",$tickets));
                                                */?>
                          </font> </td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
              <p class="style22">
            </div>
          <p align="left" class="style14">&iexcl;Te deseo buena suerte en los sorteos!<br>
                <br>
                <br>
              Sinceramente, <br>
              <font helvetica, sans-serif color=""><img src="imagenes/GMendoza.png" alt="Gladys Mendoza" width="140" height="45" border=0></font><br>
Comit&eacute; de Sorteos<br>
              Reader's Digest</p>
            <p align="justify" class="style14"><font color="CC0000"><b>MUY IMPORTANTE:</b></font> Imprime y conserva esta pantalla como comprobante. La necesitar&aacute;s en caso de que resultes el afortunado ganador de nuestro sorteo, porque sin ella no tendr&aacute;s derecho a reclamar el premio.            </p>
            <p align="left">
          </td>
      </tr>
      <tr>
        <td align="center"><div align="center" class="Arial11Bold style1"><font face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><span style="font-size: 9px"><a href="http://selecciones.com/bases/53.php" target="_blank" style="font-size: 10px"  onClick='javascript:exit=false;'>Bases de Sorteos</a> &nbsp;|&nbsp; <a href="http://www.selecciones.com/privacidad/politicas.php" target="_blank" style="font-size: 10px"  onClick='javascript:exit=false;'>Aviso de Privacidad</a></span></font></div>
          <br />
            <font face="Arial, Helvetica, sans-serif" style="font-size: 9px" color="#333399">D.R. 
              
            &copy; 2018 READER'S DIGEST M&Eacute;XICO<br />
              &quot;Las palabras 'Selecciones', 'Selecciones Reader's Digest' y 'Reader's Digest' 
              
          son marcas registradas&quot;.<br>
            </font></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

