
 
  <div class="col-xs-12 col-md-6 col-md-6">
 

         
                <form name="productos_final" id="productos_final" method="post" action="<?php echo $_SERVER['BASE_SITE_ADMIN']; ?>valida-form.php" class="form-horizontal">
                        <input type="checkbox"  name="producto_1" id="producto_1" value="061672904" style="display:none"/>
                        <input type="checkbox"  name="producto_2" id="producto_2" value="061673604" style="display:none"/>
                        <input type="checkbox"  name="producto_3" id="producto_3" value="061668504" style="display:none"/>
                        <input type="checkbox"  name="producto_4" id="producto_4" value="061682704" style="display:none"/>
     
                       
                        
  	 <script>
					  $('#activate-step-14').on('click', function(e) {	
						  var pro1=$('#form_productos').find('input[name="product1"]').val();
						  var pro2=$('#form_productos').find('input[name="product2"]').val();
						  
						  console.log("Prod1: "+pro1);
						  console.log("Prod2: "+pro2);
						  
						     if(pro1=='1_1'){
							
								 
								  document.getElementById('producto_1').checked = true;
							
							 }
						  
						  
						  
						  
						  
						         if(pro1=='1_2'){
							
								  document.getElementById('producto_2').checked = true;	 
			 
							 }
						  
						      if(pro1=='1_3'){
							
								  $('input[name="producto_3"]').prop('checked');
							 }
						  
						      if(pro1=='1_4'){
								
								  $('input[name="producto_4"]').prop('checked');
							 }
						  
						      if(pro1=='1_5'){
								
							 }
						  
						  
						  
						    if(pro2=='2_1'){
								
							
								
								document.getElementById('producto_1').checked = true;
							
							 }
						         if(pro2=='2_2'){
								 
								document.getElementById('producto_2').checked = true;
								 
							 }
						  
						      if(pro2=='2_3'){
						
								 document.getElementById('producto_3').checked = true;
							 }
						  
						      if(pro2=='2_4'){
								
								  document.getElementById('producto_4').checked = true;
							 }
						  
						      if(pro2=='2_5'){
								
							 }
						  
						  
						  
							
						 });
							 </script> 
                
                   
                    
                    
                    <?php

                    $config = array('agente'=>false,
                                    'regalo'=>false,
                                    'paypal' => false,
									'pago_sucursal' => true,
                                    'cliente_siio' => isset($_SESSION['cliente_siio'])?$_SESSION['cliente_siio']:true,
                                    'magazine'=>'birthday',
									'tc'=>false,
                                    'campania'=>'601184918', 'subcampania'=>array('00280811','00280811'),
                                    'precio_productos'=>array('producto_1'=>359.80,'producto_2'=>359.80,'producto_3'=>300.00,'producto_4'=>299.80), 
                                  //  'monto_pago' => 379.00,
                                    'costo_envio' => 59.90,
                                    'obsequio' => isset($_GET['obsequio'])?true:false,
                                    'tipo_orden' => 'SS', //(suscripcion), (SS, series),
                                    'requiere_sorteo'=>false,
                                    'id_gs'=>'GS53-020718',
                                    'boletos_gs'=>isset($_SESSION['sorteo1'])?$_SESSION['sorteo1']:false,
                                    'id_yo'=>'YO-040717',
                                    'boletos_yo'=>isset($_SESSION['sorteo2'])?$_SESSION['sorteo2']:false
									
						//601174904 01282491
									 
                                );

                    include $_SERVER['BASE_PATH_ADMIN'].'form.php';

                    ?>

                </form>
        
            



</div>
 
 
 
 
 
 