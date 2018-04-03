///////////////////////////////////////

function validaTarjeta(fName, lName, phone, cardType, cardNumber,cardNumSeg,cardMonth,cardYear)
{
    var result=true;
    var arrayDig = new Array();
    
        //credit card digits
    for(var i=0;i<cardNumber.length;i++)
    {
        arrayDig[i]=cardNumber.charAt(i);
    }
 
        //Validating first name, last name and telephone number
         if(fName == ""){
            alert('Introduzca el nombre del titular de la Tarjeta!');
           return false;
         }
         if(!isNaN(fName)){
            alert('Introduzca el nombre del titular de la Tarjeta correctamente!');
            return false;
         }
         //if(lName == ""){
         //   alert('Introduzca el apellido del titular de la Tarjeta de Crédito!');
         //   return false;
         //}
         //if(!isNaN(lName)){
         //   alert('Introduzca el apellido del titular de la Tarjeta de Crédito correctamente!');
         //   return false;
         //}
         if(phone == ""){
             alert('Introduzca el teléfono del titular de la Tarjeta!');
             return false;
         }
         if(isNaN(phone)){
             alert('Introduzca el teléfono del titular de la Tarjeta correctamente!');
             return false;
         }
         if(cardType == 0||isNaN(cardType)){
             alert('Seleccione el tipo de la Tarjeta!');
             return false;
         }
         if(cardNumber == ""||isNaN(cardNumber)){
             alert('Escriba correctamente el numero de su tarjeta!');
             return false;
         }
         if(cardNumSeg == ""||isNaN(cardNumSeg)){
             alert('Escriba el numero de seguridad de su tarjeta!');
             return false;
         }


    //validating credit card type and number of digits
    cardType = ""+cardType+"";
    switch(cardType)
    {
        case '1':  //visa
            if(!(cardNumber.substring(0,1)=='4'))
            {
                alert('Por favor introduce correctamente el número de tarjeta de crédito');
                return false;
            }
            //Number of digits
            if(!(arrayDig.length==13 || arrayDig.length==16))
            {
                alert('Por favor introduce el número de tarjeta de crédito!');
                return false;
            }
             /* Validation for debit cards. We do not allow them!!!
            if(cardNumber.substr(0,4) == "4152" || cardNumber.substr(0,4) == "5204" || cardNumber.substr(0,4) == "5177" || cardNumber.substr(0,4) == "5579"){
                alert('El número de tarjeta introducido corresponde a una tarjeta de débito.\n Por su seguridad, solo aceptamos tarjetas de crédito!.');
                return false;
            }*/
            if(cardNumSeg.length != 3)
            {
                alert('Por favor introduce el número de seguridad de tu tarjeta!');
                return false;
            }  

        break;
        case '2':  //master card
            var num = parseInt(cardNumber.substring(0,2));
            if(!(num>=51 && num <=55))
            {
                alert('Por favor introduce correctamente el número de tarjeta de crédito');
                return false;
            }
            //Number of digits
            if(arrayDig.length!=16)
            {
                alert('Por favor introduce el número de tarjeta de crédito!');
                return false;
            }
            // Validation for debit cards. We do not allow them!!!
            if(cardNumber.substr(0,4) == "4152" || cardNumber.substr(0,4) == "5204" || cardNumber.substr(0,4) == "5177" || cardNumber.substr(0,4) == "5579"){
                alert('El número de tarjeta introducido corresponde a una tarjeta de débito.\n Por su seguridad, solo aceptamos tarjetas de crédito!.');
                return false;
           }
           if(cardNumSeg.length != 3)
            {
                alert('Por favor introduce el número de seguridad de tu tarjeta!');
                return false;
            }  
            
        break;
        case '3':  //American express
            var num = parseInt(cardNumber.substring(0,2));
            if(!(num==34 || num ==37))
            {
                alert('Por favor introduce correctamente el número de tarjeta de crédito');
                return false;
            }
            //Number of digits
            if(!(arrayDig.length==15))
            {
                alert('Por favor introduce el número de tarjeta de crédito!');
                return false;
            }

                        //Validating security number for American Express
            if(cardNumSeg.length != 4)
            {
                alert('Por favor introduce el número de seguridad de tu tarjeta!');
                return false;
            }   
        break;
        default:
             break;
        
    }//end of switch

    //Credit card number alghorythm
    var suma=0;
    for(var i=arrayDig.length-2;i>=0;i-=2)  //Inits in the second last digit
    {
        arrayDig[i]=arrayDig[i]*2;
            if(arrayDig[i]>=9)
                arrayDig[i]=arrayDig[i]-9;
    }
    for(var i=0;i<arrayDig.length;i++)
    {
        suma+=parseInt(arrayDig[i]);    
    }   
    if(!(suma %10 ==0 && suma <=150))
    {
        alert('El número de tarjeta de crédito está incorrecto. Vuelva a intentarlo por favor!');
        return false;
    }
    //Validates input of expire date
    if(cardMonth == "00" || cardYear == "00"){
              alert('Introduzca correctamente la fecha de vencimiento!');
              return false;
        }

        var hoy = new Date();
        var anio = new String(hoy.getFullYear());
        var anioc = anio.substr(2,2);
        
        //Validates that expire date has not reached
        if(cardYear == anioc){
           if(cardMonth < (hoy.getMonth() + 1)){
               alert('La fecha de vencimiento ha expirado!');
               return false;
           }
        }else if(cardYear < anioc){
                alert('La fecha de vencimiento ha expirado!');
               return false;
        }
    
    return true; 
}
