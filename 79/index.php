<?php
session_destroy();
 session_start();
 setlocale(LC_TIME,"es_ES");
//include_once '../../includes/utilities.inc';
//include '../../includes/conexion.inc';
 $_SESSION['idpaquete']=79;

  $fname=$_REQUEST['fName'];
  $lname=$_REQUEST['lName'];
  $email=$_REQUEST['email'];
  $boletosGS=$_REQUEST['calle'];
  $boletosYO=$_REQUEST['colonia'];

  $_SESSION['cte']=$_REQUEST['cte'];
  $_SESSION['nombre']=$fname;
  $_SESSION['apellido']=$lname;
  $_SESSION['email']=$email;
  $_SESSION['GS']=$boletosGS;
  $_SESSION['YO']=$boletosYO;


if(isset($_SESSION['producto1'])){
  unset($_SESSION['producto1']);
}
if(isset($_SESSION['producto2'])){
    unset($_SESSION['producto2']);
}

/*if(!$_SESSION['idcliente']) {
      $fecha = date('dms');
      $ran_num = rand(1, 1000000).$fecha ;
      $idcode = genera_idcode($ran_num);
      $reg_user = registra_usuario($idcode, trim(ucfirst($_SESSION['nombre'])), trim(ucfirst($_SESSION['apellido'])), trim($_SESSION['email']),$_SESSION['idpaquete']);
      //$boletos = asigna_numeros(1, $_SESSION['idpaquete']);
      //$insbol = inserta_boletos($_SESSION['idcliente'], $_SESSION['idpaquete'], 1, $boletos, $cve_envio);
}
//$tickets = get_boletos($_SESSION['idcliente'], $_SESSION['idpaquete'], 1);
//$bol = split(":",$tickets);
//array_pop($bol);


/*
Muestra los datos de la sesión y los datos que se metieron*/
/*
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/




 ?>


<!DOCTYPE html>
<html>
<head>
<title>CUMPLEAÑOS</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/normalize.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Raleway:400,300,200' rel='stylesheet' type='text/css'>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo $_SERVER['SITE_ADMIN']; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo $_SERVER['SITE_ADMIN']; ?>css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['SITE_ADMIN']; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['SITE_ADMIN']; ?>css/_all-skins.min.css">

    <link rel="stylesheet" href="<?php echo $_SERVER['SITE_ADMIN']; ?>plugins/sweetalert/sweetalert.css">


<style type="text/css">
body{
   font-size: 150%;
}a
hr.linea {
    height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
}
</style>
</head>
<body>

<br>
<div class="container">

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12 textologo">
            	<center><img src="imagenes/logo_readers.png"></center>
                <p>Reader's Digest te desea un muy Feliz Cumpleaños</p>
                <span><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?></span>
         </div>
    </div>


  <div class="row form-group menu">
  <br>
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel" style=" border: 1px solid black">
                <li  class="active"><a href="#step-1">
                    <img src="imagenes/liston.png" style="float:left; margin-top:-12px"><p class="list-group-item-text menutext">REGALO 1</p>
                </a></li>

                <li style="display:none;" class="disabled">
                  <a href="#step-2"></a></li>

                <li class="disabled"><a href="#step-3">
                    <p class="list-group-item-text menutext">REGALO 2</p>
                </a></li>

               <li style="display:none;" class="disabled">
                  <a href="#step-4"></a></li>

                <li class="disabled"><a href="#step-5">
                    <p class="list-group-item-text menutext">REGALO 3</p>
                </a></li>

                 <li style="display:none;" class="disabled">
                  <a href="#step-6"></a></li>

                   <li class="disabled"><a href="#step-7">
                    <p class="list-group-item-text menutext">REGALO 4</p>
                </a></li>

                 <li style="display:none;" class="disabled">
                  <a href="#step-8"></a></li>

                  <li style="display:none;" class="disabled">
                  <a href="#step-9"></a></li>

                  <li style="display:none;" class="disabled">
                  <a href="#step-10"></a></li>

                  <li style="display:none;" class="disabled">
                  <a href="#step-11"></a></li>

                   <li style="display:none;" class="disabled">
                  <a href="#step-12"></a></li>

                  <li style="display:none;" class="disabled">
                  <a href="#step-13"></a></li>

                   <li style="display:none;" class="disabled">
                  <a href="#step-14"></a></li>

                   <li style="display:none;" class="disabled">
                  <a href="#step-15"></a></li>

                  <li style="display:none;" class="disabled">
                  <a href="#step-16"></a></li>

            </ul>
        </div>
  </div>

</div>
<br><br>

  <!-- ******************************************** PASO 1 ********************************************************* -->
    <div class="row setup-content" id="step-1">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 ><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?></h2>
                <br>
                <div class="textocaja">&iquest;No sería genial celebrar tu cumpleaños ganando <strong>$1'000,000.00</strong>? <br>

          Abre tu <strong>primer</strong> regalo de cumpleaños...</div>
         </div>
         <div class="col-xs-8 col-xs-offset-2 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <div><center><img class="img-responsive" src="imagenes/regalo.png"></center></div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-2 caja">
              <div class="textocaja"><center><a href="#step-2" id="activate-step-2"><img class="img-responsive" src="imagenes/b_descubre.png"></a></center></div>
                <br>
         </div>
         <div class="col-xs-12">
         <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>
    </div>
</div>

    </div>
  <!-- ******************************************** PASO 2 ********************************************************* -->

    <div class="row setup-content" id="step-2">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 >&iexcl;Felicidades <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?> ! </h2>
              <div class="textocaja">Estos n&uacute;meros de participaci&oacute;n pueden hacerte ganar el dinero suficiente para que todos tus deseos de cumpleaños se hagan realidad.</div>
                <br>
         </div>
         <div class="col-xs-12 col-sm-7 col-md-7 caja">

                <div class="col-xs-12 col-sm-8">
                  <center>
                    <h4>10 N&Uacute;MEROS PARA EL GRAN SORTEO</h4>
                    <h2><strong>$1'000,000.00</strong></h2>
                  </center>
                </div>

                  <div class="col-xs-12 col-sm-4">
                  <center>
                    <a href="#step-3" id="activate-step-3">
                      <img class="img-responsive" src="imagenes/b_sig_regalo.png">
                    </a>
                    </center>
                  </div>

                <div class="col-xs-12">
                  <center>
                    <h4 class="orange boletos">
                    <?= $_SESSION['GS']?>
                      <?php  /*
                      $texto_tickets="";
                      foreach($bol as $tick){
                        $texto_tickets = $texto_tickets.$tick." ,";
                      }
                      $texto_tickets=substr($texto_tickets, 0, -1);
                      echo $texto_tickets; */
                    ?>
                    </h4>

                  </center>
                </div>

                <br><br>

                <div class="col-xs-12"><center><img class="img-responsive" src="imagenes/billetes.png"></center></div>


         </div>

         <div class="col-xs-12">
                  <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>
    </div>
</div>

    </div>


  <!-- ******************************************** PASO 3 ********************************************************* -->


 <div class="row setup-content" id="step-3">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 ><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?></h2>
                <br>
                <div class="textocaja">Celebra con estilo y un fabuloso <strong>BONO DE CUMPLEAÑOS</strong>:<br>
                esta increíble experiencia, la recordarás por siempre.<br>
                <br>
                Abre tu <strong>SEGUNDO</strong> REGALO...</div>
         </div>
         <div class="col-xs-8 col-xs-offset-2 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <div><center><img class="img-responsive" src="imagenes/regalo.png"></center></div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-2 caja">
              <div class="textocaja"><center><a href="#step-4" id="activate-step-4"><img class="img-responsive" src="imagenes/b_descubre.png"></a></center></div>
                <br>
         </div>
         <div class="col-xs-12">
         <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>
    </div>
</div>

    </div>

 <!-- ******************************************** PASO 4 ********************************************************* -->

<div class="row setup-content" id="step-4">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 >UN FABULOSO FIN DE SEMANA</h2>
              <div class="textocaja">En las <strong>paradisíacas playas de Cancún</strong>, en compañía de la persona que elijas.</div>
                <br>
         </div>
         <div class="col-xs-12 col-sm-7 col-md-7 caja">
                <div class="col-sm-8 col-xs-12">
                  <center>
                    <h4 ><strong>Viaja con el SÚPER BONO de $30,000.00</strong> si resultas ganador del GRAN PREMIO</h4>
                  </center>
                </div>
                <div class="col-xs-12 col-sm-4 caja">
                  <center>
                    <a href="#" data-toggle="modal" data-target=".modal_uno">
                      <img class="img-responsive" src="imagenes/b_sig_regalo.png">
                    </a>
                    </center>
                  </div>

                <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-0 caja"><center><img class="img-responsive" src="imagenes/viaje.png"></center></div>

         </div>

         <div class="col-xs-12">
                  <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
         </div>

    </div>
</div>

    </div>

 <!-- ******************************************** PASO 5 ********************************************************* -->

 <div class="row setup-content" id="step-5">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 ><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?></h2>
              <div class="textocaja">¡Disfruta de lo mejor que tenemos para ti!<br>
                </div>
              <div class="textocaja">Abre tu <strong>TERCER</strong> REGALO...</div>
         </div>
         <div class="col-xs-8 col-xs-offset-2 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <div><center><img class="img-responsive" src="imagenes/regalo.png"></center></div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-2 caja">
              <div class="textocaja"><center><a href="#step-6" id="activate-step-6"><img class="img-responsive" src="imagenes/b_descubre.png"></a></center></div>
                <br>
         </div>
         <div class="col-xs-12">
         <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>
    </div>
</div>

    </div>

<!-- ******************************************** PASO 6 ********************************************************* -->

<div class="row setup-content" id="step-6">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 >TAMBIÉN TE REGALAMOS </h2>
              <div class="textocaja">¡UNA TARJETA DE CUMPLEAÑOS!</div>
                <br>
         </div>
         <div class="col-xs-12 col-sm-7 col-md-7 caja">
                <div class="col-xs-12 col-sm-8 col-md-8">
                  <center>
                    <h4 ><strong>40% de descuento </strong>en nuestra Tienda de Cumpleaños.<br>
Usa el código</h4>
                    <h2>Cumple <?php echo $_SESSION['nombre']." ";  ?></h2>
                    <center>
                    <h4 class="orange">Válido por 72 horas a partir de este momento</h4>
                  </center>
                  </center>
                </div>

                 <div class="col-xs-12 col-sm-4 col-md-4 caja">
                  <center>
                    <a href="#" data-toggle="modal" data-target=".modal_dos">
                      <img class="img-responsive" src="imagenes/b_sig_regalo.png">
                    </a>
                    </center>
                  </div>

                <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-0 caja"><center><img class="img-responsive" src="imagenes/gift_card.png"></center></div>


         </div>

        <div class="col-xs-12">
                  <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>

    </div>
</div>

    </div>

<!-- ******************************************** PASO 7 ********************************************************* -->

  <div class="row setup-content" id="step-7">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 ><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?></h2>
              <div class="textocaja">UN REGALO ESPECIAL DE CUMPLEAÑOS</div>
                <br>
                <div class="textocaja">Abre tu <strong>CUARTO </strong>REGALO...</div>
         </div>
         <div class="col-xs-8 col-xs-offset-2 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <div><center><img class="img-responsive" src="imagenes/regalo.png"></center></div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-2 caja">
              <div class="textocaja"><center><a href="#step-8" id="activate-step-8"><img class="img-responsive" src="imagenes/b_descubre.png"></a></center></div>
                <br>
         </div>
         <div class="col-xs-12">
         <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>
    </div>
</div>

    </div>


<!-- ******************************************** PASO 8 ********************************************************* -->
<div class="row setup-content" id="step-8">

<div class="container">
    <div class="row">
         <div class="col-xs-9 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-5 caja">
               <h2 >Utiliza tu <strong>Tarjeta de Beneficios de Cumpleaños</strong> y recibe <strong> GRATIS un REGALO sorpresa</strong>! </h2>
                <div class="textocaja"><u><strong>Tenemos para ti un increíble REGALO que  no te puedes perder.</strong></u></div>
                <br>
         </div>
         <div class="col-xs-12 col-sm-7 col-md-7 caja">
                <div class="col-xs-12 col-sm-8">
                  <center>
                   <h4 >&nbsp;</h4>

                  </center>
                </div>
                 <div class="col-xs-12 col-sm-4 col-md-4 caja">
                  <center>
                    <a href="#step-9" id="activate-step-9">
                      <img class="img-responsive" src="imagenes/b_regalos.png">
                    </a>
                    </center>
                  </div>

                <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-0 caja"><center><img class="img-responsive" src="imagenes/cd.png"><br>
                  <br>
                </center></div>


         </div>

        <div class="col-xs-12">
                  <center>
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
        </div>

    </div>
</div>

    </div>

  <!-- ********************************************  PASO 9   ******************************************************** -->

    <div class="row setup-content" id="step-9">

<div class="container">
    <div class="row">
         <div class="col-xs-12 col-sm-6 col-md-8 caja">
               <div class="col-xs-12">
                   <h2 >¡HURRA! Un regalo más</h2>
                    <div class="textocaja">Una oportunidad extraordinariamente especial para celebrar tu cumpleaños.
                    Usar tu tarjeta de regalo podría hacerte ganar una fabulosa Renault Duster.</div>
                    <br>
                    <div class="textocaja"><strong>¡Escoge el color ahora!</strong></div>
                    <br>
                </div>
                <div class="col-xs-12">
                    <center>
                       <img id="imagen_regalo" class="img-responsive" src="imagenes/camioneta1.png">
                    </center>
                </div>
         </div>
         <div class="col-xs-12 col-sm-6 col-md-4 caja">
                   <center>
                    <ul class="products">
                      <li><h4 data-val="imagenes/camioneta1.png"  class="active li_products">Rojo fuego</h4></li>
                      <li><h4 data-val="imagenes/camioneta2.png" class="li_products">Gris estrella</h4></li>
                      <li><h4 data-val="imagenes/camioneta3.png" class="li_products">Negro nacarado</h4></li>
                      <li><h4 data-val="imagenes/camioneta4.png" class="li_products">Beige timber</h4></li>
                      <li>
                        <h4 data-val="imagenes/1billete.png" class="li_products">Si lo prefieres, recibe<br>
                      $250,000.00 en efectivo</h4></li>
                    </ul>
                  </center>

                  <div class="col-xs-3">
                    <a  id="click_izq">
                      <img class="img-responsive" src="imagenes/izq.png" onmouseover="this.src='imagenes/izq_hover.png'"
                                        onmouseout="this.src='imagenes/izq.png'">
                    </a>
                  </div>
                  <div class="col-xs-6">
                    <img class="img-responsive" src="imagenes/roulette.png">
                  </div>
                  <div class="col-xs-3">
                    <a  id="click_der">
                      <img class="img-responsive" src="imagenes/der.png" onmouseover="this.src='imagenes/der_hover.png'"
                                        onmouseout="this.src='imagenes/der.png'"  >
                    </a>
                  </div>
                   <div class="col-xs-12">
                    <center><small style="color:#4440C3;">Haz clic en la flecha para ver más</small> </center>
                  </div>

                  <center>
                    <br>
                      <a href="#step-11" id="activate-step-11">
                       <img class="img-responsive" src="imagenes/b_confirmar.png">
                      </a>
                    </center>
         </div>
    </div>
    <br>
    <center>
                         <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
</div>

    </div>

<!-- ********************************************  PASO 10   ******************************************************** -->
<div class="row setup-content" id="step-10">

<div class="container">
    <div class="row">

         <div class="col-xs-12 col-sm-6 col-md-8 caja">
               <div class="col-xs-12">
                   <h2 >HOORAY 2</h2>
                    <div class="textocaja">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </div>
                    <br>
                    <div class="textocaja">Unwrap your <strong>FOURTH </strong>REGALO... </div>
                    <br>
                </div>
                <div class="col-xs-12">
                    <center>
                      <img id="imagen_regalo2" class="img-responsive" src="imagenes/billetes.png">
                    </center>
                </div>
         </div>

        <div class="col-xs-12 col-sm-6 col-md-4 caja">
                   <center>
                    <ul class="products2">
                      <li><h4 data-val="imagenes/billetes.png" class="active li_products2">producto 1</h4></li>
                      <li><h4 data-val="imagenes/billetes.png" class="li_products2">producto 1</h4></li>
                      <li><h4 data-val="imagenes/billetes.png" class="li_products2">Word Power</h4></li>
                      <li><h4 data-val="imagenes/billetes.png" class="li_products2">producto 1</h4></li>
                    </ul>
                  </center>

                 <center>
                    <div class="col-xs-3">
                      <a  id="click_izq2">
                        <img class="img-responsive" src="imagenes/izq.png" onmouseover="this.src='imagenes/izq_hover.png'"
                                        onmouseout="this.src='imagenes/izq.png'">
                      </a>
                    </div>
                    <div class="col-xs-6">
                      <img class="img-responsive" src="imagenes/roulette.png">
                    </div>
                    <div class="col-xs-3">
                      <a  id="click_der2">
                        <img class="img-responsive" src="imagenes/der.png" onmouseover="this.src='imagenes/der_hover.png'"
                                        onmouseout="this.src='imagenes/der.png'">
                      </a>
                    </div>
                 </center>
                   <center>
                      <a href="#step-11" id="activate-step-11">
                       <img class="img-responsive" src="imagenes/b_confirmar.png">
                      </a>
                    </center>
         </div>
    </div>

          <center>
                         <br><a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
</div>

    </div>

<!-- ********************************************  PASO 11   ******************************************************** -->
<div class="row setup-content" id="step-11">

<div class="container">
    <div class="row">
         <div class="col-xs-12 caja">
                <div class="col-xs-12">
                     <div class=" col-xs-12 col-md-12">
                          <h2 >¡Bienvenido a la Tienda de Cumpleaños!</h2>
                        <div class="textocaja">Una oferta extraordinariamente especial para <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?>

                       </div>
                        <br>
                        <p>
                          Utilizar tu código de regalo te dará un <strong>40% de descuento, un REGALO y la oportunidad de ganar una Renault Duster.</strong>
                         </p>
                      </div>

                      <div class="col-xs-12 col-md-9">
                       <center>
                          <img id="imagen_regalo3" class="img-responsive" src="imagenes/productos/1_1.png">
                       </center>
                      </div>

                      <div class="col-xs-12 col-md-3">
                         <center>
                            <ul class="products3">
                              <li><h4 data-storage="1_1" data-val="imagenes/productos/1_1.png" class="active li_products3">COORDINADO MONARCA LILA</h4></li>
                              <li><h4 data-storage="1_2" data-val="imagenes/productos/1_2.png" class="li_products3">COORDINADO CATALINA</h4></li>
                              <li><h4 data-storage="1_3" data-val="imagenes/productos/1_3.png" class="li_products3">NAVAJA MULTIUSOS</h4></li>
                              <li>
                                <h4 data-storage="1_4" data-val="imagenes/productos/1_4.png" class="li_products3">RELOJ CABALLERO VERDE	</h4></li>
                              <li><h4 data-storage="1_5" data-val="imagenes/productos/1_5.png" class="li_products3">NO QUIERO NADA</h4></li>
                            </ul>
                          </center>

                         <center>
                            <div class="col-xs-3">
                              <a  id="click_izq3">
                                <img class="img-responsive" src="imagenes/izq.png" onmouseover="this.src='imagenes/izq_hover.png'"
                                        onmouseout="this.src='imagenes/izq.png'" >
                              </a>
                            </div>
                            <div class="col-xs-6">
                              <img class="img-responsive" src="imagenes/roulette.png">
                            </div>
                            <div class="col-xs-3">
                              <a  id="click_der3">
                                <img class="img-responsive" src="imagenes/der.png" onmouseover="this.src='imagenes/der_hover.png'"
                                        onmouseout="this.src='imagenes/der.png'">
                              </a>
                            </div>

                            <div class="col-xs-12">
                              <center><small style="color:#4440C3;">Haz clic en la flecha para ver más</small> </center>
                            </div>

                         </center>

                          <center>
                              <a href="#step-12" id="activate-step-12">
                               <img class="img-responsive" src="imagenes/b_confirmar.png">
                              </a>
                          </center>

                      </div>

                </div>
         </div>
    </div>
     <center>
                         <br><a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
</div>

    </div>



<!-- ********************************************  PASO 12   ******************************************************** -->
<div class="row setup-content" id="step-12">

<div class="container">
    <div class="row">
         <div class="col-xs-12 caja">

                <div class="col-xs-12">
                     <div class="col-xs-12 col-md-12">
                            <h2 >¡Vuelve a usar tu TARJETA DE REGALO!</h2>
                          <div class="textocaja">Puedes usarla cuantas veces quieras para reclamar tu descuento.</div>
                          <div class="textocaja">Has elegido el producto: <strong id="nombre_producto_uno"></strong>.</div>


                          <br>
                        <p>
                         <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?> , elije otro y sigue disfrutando de tu <strong>descuento de 40%</strong></p>
                      </div>

                      <div class="col-xs-12 col-md-9">
                       <center>
                          <img id="imagen_regalo4" class="img-responsive" src="imagenes/productos/1_1.png">
                       </center>
                      </div>

                      <div class="col-xs-12 col-md-3">
                          <center>
                            <ul class="products4">
                              <li><h4 data-storage="2_1" data-val="imagenes/productos/1_1.png"  class="active li_products4">COORDINADO MONARCA LILA</h4></li>
                              <li><h4 data-storage="2_2" data-val="imagenes/productos/1_2.png" class="li_products4">COORDINADO CATALINA</h4></li>
                              <li><h4 data-storage="2_3" data-val="imagenes/productos/1_3.png" class="li_products4">NAVAJA MULTIUSOS</h4></li>
                              <li>
                                <h4 data-storage="2_4" data-val="imagenes/productos/1_4.png" class="li_products4">RELOJ CABALLERO VERDE</h4></li>
                              <li><h4 data-storage="2_5" data-val="imagenes/productos/1_5.png" class="li_products4">No deseo elegir otro producto</h4></li>
                            </ul>
                          </center>

                         <center>
                            <div class="col-xs-3">
                              <a  id="click_izq4">
                                <img class="img-responsive" src="imagenes/izq.png" onmouseover="this.src='imagenes/izq_hover.png'"
                                        onmouseout="this.src='imagenes/izq.png'">
                              </a>
                            </div>
                            <div class="col-xs-6">
                              <img class="img-responsive" src="imagenes/roulette.png">
                            </div>
                            <div class="col-xs-3">
                              <a  id="click_der4">
                                <img class="img-responsive" src="imagenes/der.png" onmouseover="this.src='imagenes/der_hover.png'"
                                        onmouseout="this.src='imagenes/der.png'">
                              </a>
                            </div>
                            <div class="col-xs-12">
                              <center><small style="color:#4440C3;">Haz clic en la flecha para ver más</small> </center>
                            </div>
                         </center>

                           <center>
                              <a href="#step-13" id="activate-step-13">
                               <img class="img-responsive" src="imagenes/b_confirmar.png">
                              </a>
                            </center>

                      </div>

                </div>
         </div>
    </div>
     <center>
                         <br><a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
</div>

    </div>


    <!-- ********************************************  PASO 13   ******************************************************** -->
<div class="row setup-content" id="step-13">

<div class="container">
    <div class="row">
         <div class="col-xs-12  caja">
               <div class=" espaciado col-xs-12">
                   <h2 >&iexcl;BUENA ELECCIÓN!</h2>
                    <div class="textocaja"><?php echo $_SESSION['nombre']." " ?>, gracias por elegir <strong id="nombre_productos_elegidos"></strong>, aprovechando tu descuento de cumpleaños. Seguramente lo disfrutarás mucho.
                 </div>
                    <br>
               </div>

                <div class="col-xs-12">
                  <div class="espaciado col-xs-12 col-sm-6">
                       <div class="col-xs-3">
                          <img class="img-responsive" src="imagenes/check.jpg">
                        </div>
                        <div class="col-xs-9">
                          También te entregaremos $1'000,000.00  en efectivo en caso de que ganes el 53º Gran Sorteo.</div>
                  </div>
                  <div class="espaciado col-xs-12 col-sm-6">
                       <div class="col-xs-3">
                            <img class="img-responsive" src="imagenes/check.jpg">
                        </div>
                        <div class="col-xs-9">
                          Además podrás disfrutar de un fabuloso fin de semana en Cancún, si resultas ganador.
                        </div>
                  </div>
                  <div class="espaciado col-xs-12 col-sm-6">
                       <div class="col-xs-3">
                            <img class="img-responsive" src="imagenes/check.jpg">
                        </div>
                        <div class="col-xs-9">
                          Te enviaremos un REGALO junto con tu orden.
                        </div>
                  </div>
                  <div class="espaciado col-xs-12 col-sm-6">
                       <div class="col-xs-3">
                            <img class="img-responsive" src="imagenes/check.jpg">
                        </div>
                        <div class="col-xs-9">
                          Y si además ganaras el sorteo Selección de Oro, una Renault Duster en el color que elegiste podría ser tuya.
                        </div>
                  </div>
                </div>

                <div class="col-xs-6">
                   <h3 class="red">&iexcl;Feliz cumpleaños, <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?>! La diversión apenas empieza.</h3>
                </div>
                <div class="col-xs-6">
                   <center>
                      <a href="#step-14" id="activate-step-14">
                       <img class="img-responsive" src="imagenes/b_say_yes.png">
                      </a>
                    </center>
                </div>
         </div>

    </div>
    <br><br>
    <center class="espaciado">
                    <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a></center>
</div>

    </div>


     <!-- ********************************************  PASO 14   ******************************************************** -->
<div class="row setup-content" id="step-14">

<div class="container">
    <div class="row">
               <div class="col-xs-12">
                   <h2 >&iexcl;FELICIDADES!</h2>
                    <div class="textocaja">Eso es todo por el momento, <?php echo $_SESSION['nombre']." ";  ?>. Te notificaremos dentro de las primeras 72 horas de realizado el sorteo si resultas ganador. Tu pedido está en camino.
</div>
                    <div class="col-xs-6">
                      <h3 class="red">Te deseamos un muy feliz cumpleaños.</h3>
                    </div>
                    <div class="col-xs-6">
                    <h3 id="nombre_productos_elegidos2"></h3>
                     </div>
                    <br>
                    <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-6">
                            <center><img id="img-producto-1" class="img-responsive" src=""></center>
                            <hr class="linea">
                            <center><img id="img-producto-2" class="img-responsive" src=""></center>
                       </div>


                         <form id="form_productos"  name="forma"  action='' hidden>
                          <input type="hidden" id="product1" name="product1" value="" />
                          <input type="hidden" id="product2" name="product2" value="" />





                       </form>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                       <?php include_once 'form_tarjeta.php'; ?>

                  </div>

                     <div class="row">
                     <div id="div-imagen_producto-2" class="col-xs-12 col-sm-6 col-md-6">

                     </div>
                     </div>

                </div>




    </div>
    <center>
        <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a>
    </center>
</div>

    </div>

    <!-- ********************************************  PASO 15   ******************************************************** -->

<div class="row setup-content" id="step-15">

<div class="container">
    <div class="row">
         <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 caja">
               <div class="col-xs-12">
                   <h2 >¿Estás seguro de que no deseas aprovechar todos tus regalos de cumpleaños?</h2>
                   <p>Tu participación en el 53º Gran Sorteo está asegurada, pero estarías perdiendo mucho más: un insuperable ahorro en los productos Reader's Digest, un fabuloso REGALO y la oportunidad de ganar una Renault Duster con valor de $250,000.00</p>
                   <div class="col-xs-8"><h3 class="red">Cuando piensas en todo lo que podrías disfrutar, vale la pena reconsiderarlo.</h3></div>
                   <div class="col-xs-4">
                    <a href="#step-11" id="activate-step-11_AGAIN">
                       <img class="img-responsive" src="imagenes/b_verprod.png">
                      </a>
                   </div>

                    <div class="col-xs-offset-8 col-xs-4">
                      <a href="#step-16" id="activate-step-16">
                       <img class="img-responsive" src="imagenes/b_noes.png">
                      </a>
                    </div>
                 </div>
                    <br>
          </div>
    </div>
    <center>
        <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a>
    </center>
</div>
</div>


  <!-- ********************************************  PASO 16   ******************************************************** -->

<div class="row setup-content" id="step-16">

<div class="container">
    <div class="row">
         <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 caja">
               <div class="col-xs-12">
                   <h2 >Si así lo deseas, <?php echo $_SESSION['nombre']." ";  ?>...</h2>
                   <p>Daremos entrada a tu participación en el 53º Gran Sorteo, donde podrías ganar $1'000,000.00 y un SÚPER BONO si respondes antes de 7 días.</p>

                   <p>Te deseamos la mejor de las suertes, y de nuevo un muy feliz cumpleaños.</p>
              </div>
                    <br>

                <div class="col-xs-8"><h3 class="red">&iexcl;Vuelve a ver tu oferta de cumpleaños!</h3></div>
                   <div class="col-xs-4">
                    <a href="" id="activate-step-1-AGAIN2">
                       <img class="img-responsive" src="imagenes/b_back.png">
                      </a>
                   </div>

                    <div class="col-xs-offset-8 col-xs-4">
                      <a href="confi_noes.php" >
                       <img class="img-responsive" src="imagenes/b_enter.png">
                      </a>
                    </div>

          </div>

         </div>
    </div>
</div>



  <!-- ********************************************  MODAL 1********************************************************* -->
    <div class="modal fade modal_uno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="el_model modal-body">

        <button id="activate-step-5" type="button" class="close" aria-hidden="true">CERRAR <img width="25" src="imagenes/close.png"></button>
        <div class="row">
          <div class="col-xs-12">
            <h2><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];  ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <p>El ganador del Gran Sorteo puede elegir este magnífico viaje para 2 personas. </p>
                    <br>
            Alternativa en efectivo: $30,000.00</p>

          </div>

          <div class="col-xs-6">
            <img src="imagenes/viaje_popUp.png" class="img-responsive img-rounded center-block" alt="">
          </div>
         </div>

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal mixer image -->


    <!-- ********************************************  MODAL 1********************************************************* -->
    <div class="modal fade modal_dos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="el_model modal-body">

        <button id="activate-step-7" type="button" class="close" aria-hidden="true">CERRAR <img width="25" src="imagenes/close.png"></button>
        <div class="row">
          <div class="col-xs-12">
            <h2>TARJETA DE REGALO DE CUMPLEAÑOS</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <p class="red">Código:</p>
            <p ><h3 class="red">CUMPLE <?php echo $_SESSION['nombre']." ";  ?></h3></p>

            <p class="red">40% de descuento</p>

            <p>en nuestra Tienda de Cumpleaños<br>
<br>
<strong>Válida por 72 horas a partir de este momento</strong></p>

          </div>

          <div class="col-xs-6">
            <img src="imagenes/giftcard_popUp.png" class="img-responsive img-rounded center-block" alt="">
          </div>
         </div>

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal mixer image -->

</body>


<script src="../../includes/bootstrap/js/jquery.rwdImageMaps.min.js"></script>



<script>



</script>





<script language="JavaScript" type="text/JavaScript" src="js/regalos.js"></script>

<script>

$('#activate-step-14').click(function(){
    $("#usuario_siio_id_search").val("<?php echo $_SESSION['cte'] ?>");
    console.log("Click ");
     //   $('.termycond').prop('checked', true);
//     document.getElementById("#usuario_siio_id_search").focus();
$("#usuario_siio_id_search").focus();
$("#fname").focus();
   //	$('#datosenvio').click();
});

function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
}
preload([

    'imagenes/camioneta1.png',
    'imagenes/camioneta2.png',
    'imagenes/camioneta3.png',
    'imagenes/camioneta4.png',
    'imagenes/productos/1_1.png',
    'imagenes/productos/1_2.png',
    'imagenes/productos/1_3.png',
    'imagenes/productos/1_4.png',
    'imagenes/billetes.png',
    'imagenes/der.png',
    'imagenes/der_hover.png',
    'imagenes/izq.png',
    'imagenes/izq_hover.png'
]);

</script>
</html>
