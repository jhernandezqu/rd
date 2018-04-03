
function verifica (){
      if (validate(document.forma)){
        if(document.forma.optPago[0].checked){
          if(!(document.forma.tipoPago[0].checked || document.forma.tipoPago[1].checked)){
            alert('Por favor, indique su modalidad de pago');
          }
          else{
            if(valida_Tarjeta(1)){
              document.forma.action = "confi_yes.php";
                            //validatel();
              document.forma.submit();
            }
          }               
        }         
        else if(document.forma.optPago[1].checked){
            document.forma.action = "paypal.php";
                        //validatel();
            document.forma.submit();
        }
        else if(document.forma.optPago[2].checked){
            document.forma.action = "confi_yes_BML.php";
                        //validatel();
            document.forma.submit();
        }
        else{
          alert("Por favor, seleccione una forma de pago");
        }     
      }       
}

function validate(form){
return true;
}

function valida_Tarjeta(type){
  if (type==1){
    if (document.forma.nombreTDC.value.length == 0) {
          alert("Por favor, ingrese el nombre del tarjetahabiente");
            document.forma.nombreTDC.focus();
            return false;
        }
    if (document.forma.numTDC.value.length == 0) {
          alert("Por favor, ingrese el numero de su tarjeta");
            document.forma.numTDC.focus();
            return false;
        }
    if (document.forma.seguridadTDC.value.length == 0) {
          alert("Por favor, ingrese el numero de seguridad de su tarjeta");
            document.forma.seguridadTDC.focus();
            return false;
        } 
    if(!validaTarjeta(document.forma.nombreTDC.value, "" , "55555555", document.forma.tipoTDC.value, document.forma.numTDC.value, document.forma.seguridadTDC.value, document.forma.mesfinalTDC.value , document.forma.aniofinalTDC.value ))
        return(false);      
  }         
  return true;          
}

function validarnum(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8) return true;
    patron =/[0-9]/;
  te = String.fromCharCode(tecla);
  return patron.test(te);
}


function  getMeses(id){
  if(id==3){  
    document.getElementById('lmeses').style.display='none';
    document.getElementById('meses').style.display='none';
    document.getElementById("lblTipoTDC").innerText="Tipo de Tarjeta:";
    document.forma.tipoTDC.options.length=0;
    document.forma.tipoTDC.options[0]=new Option("Visa", "1", true, false);
    document.forma.tipoTDC.options[1]=new Option("MasterCard", "2", false, false);
  }
  if(id==4){
    document.getElementById('lmeses').style.display='none';
    document.getElementById('meses').style.display='none';
    document.getElementById("lblTipoTDC").innerText="Banco:";
    document.forma.tipoTDC.options.length=0;
    document.forma.tipoTDC.options[0]=new Option("Bancomer", "5", true, false);
    document.forma.tipoTDC.options[1]=new Option("Santander", "9", false, false);
  }
}

function subir_scroll(){
   $("html, body").animate({ scrollTop: 0 }, "fast");
}

$('.collapse').collapse();

$( document ).ready(function() {

   $("input[type=radio][name=optPago]").change(function () {
       if($('#credit_card').is(':checked')) {  $('#collapseOne').collapse('show'); }
       else{$('#collapseOne').collapse('hide');}
   });  
    
    var navListItems = $('ul.setup-panel li a'),
    allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');

   $('#activate-step-1-AGAIN').on('click', function(e) {
        $('ul.setup-panel li:eq(10)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-11"]').trigger('click');
    });

  $('#activate-step-1-AGAIN2').on('click', function(e) {
       $('ul.setup-panel li:eq(10)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-11"]').trigger('click');
        return false;
    });

     $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $('ul.setup-panel li:eq(0)').addClass('active');
    });

       $('#activate-step-3').on('click', function(e) {    
        $('ul.setup-panel li:eq(2)').removeClass('disabled');    
        $('ul.setup-panel li:eq(0)').addClass('disabled');  
        $('ul.setup-panel li:eq(0)').addClass('pag');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $('ul.setup-panel li a[href="#step-3"]').html('<img src="imagenes/liston.png" style="float:left; margin-top:-12px"><p class="list-group-item-text menutext">REGALO 2</p>');
        $('ul.setup-panel li a[href="#step-1"]').html('<p class="orange list-group-item-text menutext"><strong><small>ABIERTO</small></strong></p>');
        //$(this).remove();

    });  

   $('#activate-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $('ul.setup-panel li:eq(2)').addClass('active');
    });


 $('#activate-step-5').on('click', function(e) {
        $('.modal_uno').modal('hide')
    }); 

 $('.modal_uno').on('hidden.bs.modal', function () {
     $('ul.setup-panel li:eq(4)').removeClass('disabled');   

            $('ul.setup-panel li:eq(2)').addClass('pag');
            $('ul.setup-panel li:eq(2)').addClass('disabled');  


            $('ul.setup-panel li a[href="#step-5"]').trigger('click');
            $('ul.setup-panel li a[href="#step-5"]').html('<img src="imagenes/liston.png" style="float:left; margin-top:-12px"><p class="list-group-item-text menutext">REGALO 3</p>');
            $('ul.setup-panel li a[href="#step-3"]').html('<p class="orange list-group-item-text menutext"><strong><small>ABIERTO</small></strong></p>');
            //$(this).remove();
});

     $('#activate-step-6').on('click', function(e) {
        $('ul.setup-panel li:eq(5)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-6"]').trigger('click');
        $('ul.setup-panel li:eq(4)').addClass('active');
    }); 

     $('#activate-step-7').on('click', function(e) {
        $('.modal_dos').modal('hide')
    }); 

      $('.modal_dos').on('hidden.bs.modal', function () {
          $('ul.setup-panel li:eq(6)').removeClass('disabled');   
        $('ul.setup-panel li:eq(4)').addClass('pag');
        $('ul.setup-panel li:eq(4)').addClass('disabled');  
        $('ul.setup-panel li a[href="#step-7"]').trigger('click');
        $('ul.setup-panel li a[href="#step-7"]').html('<img src="imagenes/liston.png" style="float:left; margin-top:-12px"><p class="list-group-item-text menutext">REGALO 4</p>');
        $('ul.setup-panel li a[href="#step-5"]').html('<p class="orange list-group-item-text menutext"><strong><small>ABIERTO</small></strong></p>');
        //$(this).remove();
    });


     $('#activate-step-8').on('click', function(e) {
        $('ul.setup-panel li:eq(7)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-8"]').trigger('click');
        $('ul.setup-panel li:eq(6)').addClass('active');
    }); 

      $('#activate-step-9').on('click', function(e) {
        $('ul.setup-panel li:eq(8)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-9"]').trigger('click');
        $('ul.setup-panel li a[href="#step-7"]').html('<p class="orange list-group-item-text menutext"><strong><small>ABIERTO</small></strong></p>');
        $('ul.setup-panel li:eq(6)').addClass('pag');
        $('ul.setup-panel li:eq(6)').addClass('disabled');  
    }); 

      $('#activate-step-10').on('click', function(e) {
        $('ul.setup-panel li:eq(9)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-10"]').trigger('click');
    }); 

      $('#activate-step-11').on('click', function(e) {
        $('ul.setup-panel li:eq(10)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-11"]').trigger('click');
    }); 

      $('#activate-step-11_AGAIN').on('click', function(e) {
        $('ul.setup-panel li:eq(10)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-11"]').trigger('click');
    }); 

        $('#activate-step-12').on('click', function(e) {
          selected = search_checked_item('.products3','.li_products3');
          if(selected == '1_5'){
            //Desde el principio no quiere regalos, vamos al paso 15
             $('ul.setup-panel li:eq(14)').removeClass('disabled');   
             $('ul.setup-panel li a[href="#step-15"]').trigger('click');
          }else{
            //El producto que eligio
             $('#nombre_producto_uno').html($("h4[data-storage='" + selected +"']").html());
             $('ul.setup-panel li:eq(11)').removeClass('disabled');   
             $('ul.setup-panel li a[href="#step-12"]').trigger('click');
          }
          //Guardar en el formulario el valor seleccionado
          $('#product1').val(selected);
    }); 

        $('#activate-step-13').on('click', function(e) {
            selected = search_checked_item('.products4','.li_products4');
            $('#product2').val(selected);
            var producto1 = $('#form_productos').find('input[name="product1"]').val();
            var producto2 = $('#form_productos').find('input[name="product2"]').val();

            if(producto1 == producto2.replace("2_", "1_") ){
              alert("Elige un producto diferente");
              return false;
            }
            if(producto2 == '2_5'){
              var precio1=traePrecio(producto1);
              texto=$("h4[data-storage='" + producto1 +"']").html()+ " con un precio de $" +precio1 ; 
            }else{
                  var precio1=traePrecio(producto1);
                  var precio2=traePrecio(producto2.replace("2_", "1_"));
                texto=$("h4[data-storage='" + producto1 +"']").html()+ " con un precio de $" +precio1+ " y " + $("h4[data-storage='" + producto2 +"']").html()+ " con un precio de $" +precio2; 
            }
            $('#nombre_productos_elegidos').html(texto);
            $('ul.setup-panel li:eq(12)').removeClass('disabled');   
            $('ul.setup-panel li a[href="#step-13"]').trigger('click');
            /*inputs hidden*/
            var pro_1     = producto1.split('_')[1],
                pro_2     = producto2.split('_')[1];
            $('input[name^="product"]:checkbox').prop( "checked", false );
            
            $( '#producto_' + pro_1 ).prop( "checked", true );
            $( '#producto_' + pro_2 ).prop( "checked", true );
            

      }); 

        $('#activate-step-14').on('click', function(e) {
            var producto1 = $('#form_productos').find('input[name="product1"]').val();
            var producto2 = $('#form_productos').find('input[name="product2"]').val();
            if(producto2 == '2_5'){
              var precio1=traePrecio(producto1);
              texto="Producto seleccionado: " + $("h4[data-storage='" + producto1 +"']").html() + " con un precio de $" +precio1  ;
              $('#img-producto-1').attr("src","imagenes/productos/"+ producto1 + ".png");     
              $('#div-imagen_producto-2').addClass('hidden');
            }else{
              var precio1=traePrecio(producto1);
              var precio2=traePrecio(producto2.replace("2_", "1_"));

                texto="Productos seleccionados: " + $("h4[data-storage='" + producto1 +"']").html() + " con un precio de $" +precio1 + " y " + $("h4[data-storage='" + producto2 +"']").html() + " con un precio de $" +precio2 ; 
                $('#img-producto-1').attr("src","imagenes/productos/"+ producto1 + ".png");  
                $('#img-producto-2').attr("src","imagenes/productos/"+ producto2.replace("2_", "1_") + ".png");  
                $('#div-imagen_producto-2').removeClass('hidden');
            }
            $('#nombre_productos_elegidos2').html(texto);
            $('ul.setup-panel li:eq(13)').removeClass('disabled');   
            $('ul.setup-panel li a[href="#step-14"]').trigger('click');
    }); 

          $('#activate-step-16').on('click', function(e) {
        $('ul.setup-panel li:eq(15)').removeClass('disabled');   
        $('ul.setup-panel li a[href="#step-16"]').trigger('click');

    }); 

});













    $('#click_izq').on('click', function(e) {
        var activo=0;
        var total_elementos=4;  //0,1,2,3
        izquierdo('.products','.li_products','#imagen_regalo',activo,total_elementos);
      }); 

     $('#click_der').on('click', function(e) {
        var activo=0;
        var total_elementos=4;  //0,1,2,3
         derecho('.products','.li_products','#imagen_regalo',activo,total_elementos);
      });

      $('#click_izq2').on('click', function(e) {
        var activo=0;
        var total_elementos=3;  //0,1,2,3
        izquierdo('.products2','.li_products2','#imagen_regalo2',activo,total_elementos);
      }); 

     $('#click_der2').on('click', function(e) {
        var activo=0;
        var total_elementos=3;  //0,1,2,3
         derecho('.products2','.li_products2','#imagen_regalo2',activo,total_elementos);
      });

        $('#click_izq3').on('click', function(e) {
        var activo=0;
        var total_elementos=4;  //0,1,2,3
        izquierdo('.products3','.li_products3','#imagen_regalo3',activo,total_elementos);
      }); 

     $('#click_der3').on('click', function(e) {
        var activo=0;
        var total_elementos=4;  //0,1,2,3
         derecho('.products3','.li_products3','#imagen_regalo3',activo,total_elementos);
      });

       $('#click_izq4').on('click', function(e) {
        var activo=0;
        var total_elementos=4;  //0,1,2,3
        izquierdo('.products4','.li_products4','#imagen_regalo4',activo,total_elementos);
      }); 

     $('#click_der4').on('click', function(e) {
        var activo=0;
        var total_elementos=4;  //0,1,2,3
         derecho('.products4','.li_products4','#imagen_regalo4',activo,total_elementos);
      });


    function izquierdo(prod_class,li_class,img_class,activo,total_elementos){
       $(prod_class).find(li_class).each(function(){
            if ($(this).hasClass('active')) {
                  if(activo == 0){
                    //Si es el primero, agregale la clase activo al ultimo
                   $(this).removeClass('active');
                   producto=$(prod_class).find(li_class+':eq('+parseInt(total_elementos)+')');
                   producto.addClass('active'); 
                   $(img_class).attr("src",producto.attr('data-val'));  
                  }else{
                    //Eliminar la clase activa al elemento actual
                    $(this).removeClass('active');
                    //Añadir clase activa al elemento de la izquierda
                    producto=$(prod_class).find(li_class+':eq('+parseInt(activo -1 )+')');
                    producto.addClass('active');
                    $(img_class).attr("src",producto.attr('data-val'));  
                  }
                  return false; 
            }
            else{
              activo++;
            }
            
          })
    }

    function derecho(prod_class,li_class,img_class,activo,total_elementos){
       $(prod_class).find(li_class).each(function(){
            if ($(this).hasClass('active')) {
                  if(activo == total_elementos){
                    //Si es el ultimo, agregale la clase activo al primero
                   $(this).removeClass('active');
                   producto= $(prod_class).find(li_class+':eq(0)');
                   producto.addClass('active'); 
                   $(img_class).attr("src",producto.attr('data-val'));  
                  }else{
                    //Eliminar la clase activa al elemento actual
                    $(this).removeClass('active');
                    //Añadir clase activa al elemento de la izquierda
                    producto= $(prod_class).find(li_class+':eq('+parseInt(activo + 1 )+')');
                    producto.addClass('active');
                    $(img_class).attr("src",producto.attr('data-val'));  
                  }
                  return false; 
            }
            else{
              activo++;
            }
            
          })
    }




    function search_checked_item(prod_class,li_class){
        $(prod_class).find(li_class).each(function(){
            if ($(this).hasClass('active')) {
              seleccionado= $(this).attr('data-storage');
            }
          })
        return seleccionado;
    }

    function traePrecio(idProducto){
      switch (idProducto) {
        case "1_1":
              var total = '359.80'  ; 
            break;
        case "1_2":
              var total = '359.80' ; 
            break;
        case "1_3":
              var total = '300.00'  ; 
            break;
        case "1_4":
              var total = '299.80'  ; 
            break;
    }
     return total;

    }


   
    

