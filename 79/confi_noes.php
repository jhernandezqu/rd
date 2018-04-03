<?php
session_start();
//include_once '../../includes/utilities.inc';
//include '../../includes/conexion.inc';

 /*if($_SESSION['idcliente']){
    $ord = @registra_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);
      $id_orden = @obtiene_orden($_SESSION['idcliente'], $_SESSION['idpaquete']);
      }
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.::Reader's Digest::.</title>
<style type="text/css">
<!--
body {
	background-image: url();
	margin-top: 10px;
	background-color: #efefef;
}
.style16 {font-size: 14px}
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style></head>

<body>
<table width="762" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td width="756" align="center"><img src="imagenes/h_confi.jpg" width="612" height="95" /></td>
  </tr>
  <tr>
    <td><table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"><p align="center"> <font face="Arial, Helvetica, sans-serif" size="4" color="CC0000"><b><br />
          &iexcl;MUCHAS GRACIAS!</b></font><br />
          <br />
          </p>
            <p><font face="Arial, Helvetica, sans-serif"><span class="style16">Apreciable <b><?php echo $_SESSION['nombre'] ?> <?php echo $_SESSION['apellido'] ?>,</b><br />
                    <br />
              Te confirmamos tus n&uacute;meros de participaci&oacute;n en el 53&deg; Gran Sorteo.</span></font>          </p>
            <div align="center">
              <table width="340" border="1" cellspacing="2" cellpadding="2" bordercolor="#666666">
                <tr>
                  <td height="52" align="center" valign="middle"><font face="Arial, Helvetica, sans-serif" style="font-size: 13px"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                  <?= $_SESSION['GS']?>
                   <? /*
 include_once '../includes/conexion.inc';
 include_once '../includes/utilities.inc';
 /*$boletos = get_boletos($_SESSION['idcliente'], $id_paquete, 1);*/
/*
$tickets = get_boletos($_SESSION[idcliente], $_SESSION[idpaquete], 1);
                            $bol = split(",",$tickets);
							foreach($bol as $tick){
								echo "$tick ";
							}
                                             */   ?>

                  </span></font></td>
                </tr>
              </table>
          </div>
          <p><br>
                <br>
          </p></td>
      </tr>
      <tr>
        <td align="center"><a href="http://selecciones.com/bases/53.php" target="_blank" class="style17">Bases de Sorteos</a><br>
          <br />
          <font face="Arial, Helvetica, sans-serif" style="font-size: 9px" color="#333399">D.R.

            &copy; 2018 READER'S DIGEST M&Eacute;XICO<br />
&quot;Las palabras 'Selecciones', 'Selecciones Reader's Digest' y 'Reader's Digest'

          son marcas registradas&quot;.</font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
