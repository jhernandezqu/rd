<?php
 session_start();
 setlocale(LC_TIME,"es_ES");

if(isset($_SESSION['idorden'])){  
  unset($_SESSION['idorden']);
}

 $_SESSION['idpaquete']=79;

  $fname=$_REQUEST['fName'];
  $lname=$_REQUEST['lName'];
  $id_cliente=$_REQUEST['id_cliente']; 
  $_SESSION['nombre']=$fname;
  $_SESSION['apellido']=$lname;
  $_SESSION['id_cliente']=$id_cliente;
  
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
<link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Raleway:400,300,200' rel='stylesheet' type='text/css'>
<style type="text/css">
body{
   font-size: 150%;
   background-color:#ededed;
}
.btn span.glyphicon {         
  opacity: 0;       
}
.btn.active span.glyphicon {        
  opacity: 1;       
}
.textologo {
    margin-top: 2%;
    margin-bottom: 2%;
    font-size: 18px;
    color: #ED1B42;
    text-align: center;
}
#texto_info{
   font-size: 20px;
}

</style>

<script language="javascript">

function verifica(){
  if (validate(document.forma)){
    document.forma.action = "confi_yes_confirma.php";
      document.forma.submit();
  }
  
}

function validate(form){

if (document.forma.producto1.checked==false && document.forma.producto2.checked==false && document.forma.producto3.checked==false && document.forma.producto4.checked==false){
  alert('Eliga al menos un producto!');
  return false;
  } 
return true;
}


function validacheck(objeto){
  var suma = 0;
  var revista = 0;
  if(document.forma.producto1.checked)
    suma = suma+1;
  if(document.forma.producto2.checked)
    suma = suma+1;
  if(document.forma.producto3.checked)
    suma = suma+1;
  if(document.forma.producto4.checked)
    suma = suma+1;
if(suma > 2){
     alert('Recuerde que solo puede seleccionar máximo dos productos');
     objeto.checked = false;
  }
}
</script>

</head>
<body>
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 textologo">
              <center><img src="imagenes/logo_readers.png"></center>
                <p>Reader's Digest te desea un muy Feliz Cumpleaños</p>
    </div>
    <div class="col-xs-12">
      <?php if (isset($_GET['status'])){?>
        <center>
                  <?php if ($_GET['status'] == 'ok'){?>
                  <h2 class="text-success"><?php echo $_GET['msg']; ?></h2>
                  <?php }else if ($_GET['status'] == 'err'){ ?>
                  <h2 class="text-danger"><?php echo $_GET['msg']; ?></h2>
                  <?php } ?>
        </center>
      <?php } else{ ?>

      <div id="texto_info" class="text-info">
        <?php if (isset($_SESSION['nombre'])) { ?>
        <center>
        <?php echo "<strong>" . $_SESSION['nombre']." ".$_SESSION['apellido'] . "</strong> selecciona los productos que ordenaste" ;?> 
        </center>
        <?php } ?>
      </div>
          
    </div>

    <form name="forma" method="post">
       <div class="col-xs-12 col-sm-6  col-md-5">
          <div class="panel panel-info">
          <div class="panel-body">
              <img class="img-responsive"src="imagenes/productos/1_1.png">
              <center>
                <div class="checkbox checkbox-success">
                  <input type="checkbox" id="checkbox1" name="producto1"  onclick='validacheck(document.forma.producto1);'>
                  <label for="checkbox1">
                      Selecccionar
                  </label>
                </div>
              </center>
          </div>
        </div>
       </div>
       <div class="col-xs-12  col-sm-6 col-md-5 col-md-offset-1">
        <div class="panel panel-info">
          <div class="panel-body">
            <img class="img-responsive"src="imagenes/productos/1_2.png">
              <center>
                  <div class="checkbox checkbox-success">
                  <input type="checkbox" id="checkbox2" name="producto2"  onclick='validacheck(document.forma.producto2);'>
                  <label for="checkbox2">
                      Selecccionar
                  </label>
                </div>
              </center>
          </div>
       </div>
      </div>
       <div class="col-xs-12  col-sm-6  col-md-5 ">
          <div class="panel panel-info">
            <div class="panel-body">
              <img class="img-responsive"src="imagenes/productos/1_3.png">
              <center>
                  <div class="checkbox checkbox-success">
                  <input type="checkbox" id="checkbox3" name="producto3"  onclick='validacheck(document.forma.producto3);'>
                  <label for="checkbox3">
                      Selecccionar
                  </label>
                </div>
              </center>

            </div>
          </div>
      </div>
       <div class="col-xs-12  col-sm-6  col-md-5 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-body">
              <img class="img-responsive"src="imagenes/productos/1_4.png">
                <center>
                 <div class="checkbox checkbox-success">
                  <input type="checkbox" id="checkbox4" name="producto4"  onclick='validacheck(document.forma.producto4);'>
                  <label for="checkbox4">
                      Selecccionar
                  </label>
                </div>
              </center>
            </div>
          </div>

        
      </div>
     <div class="col-xs-12 col-md-4 col-md-offset-4">
             <center>
                 <a class="btn btn-lg btn-danger btn-block" onClick="javascript:verifica(1);">CONFIRMAR</a>
              </center>
            </div>


      </div>
     
    </form>

    <?php } ?>

   <div class="col-xs-12">
         <center>
            <a href="http://selecciones.com/bases/53.php">Bases de sorteos</a> | <a href="http://www.selecciones.com/privacidad/politicas.php">Políticas de privacidad</a>
          </center>
        </div>


  </div>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script>


function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
}
preload([
    'imagenes/productos/1_1.png',
    'imagenes/productos/1_2.png',
    'imagenes/productos/1_3.png',
    'imagenes/productos/1_4.png',
]);

</script>
</html>
