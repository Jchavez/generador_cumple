// JavaScript Document
$(document).ready(function() {
	$('input[ng-maxlength]').keyup(function(){  
        //get the limit from maxlength attribute  
        var limit = parseInt($(this).attr('ng-maxlength'));  
        //get the current text inside the textarea  
        var text = $(this).val();  
        //count the number of characters in the text  
        var chars = text.length;  
  
        //check if there are more characters then allowed  
        if(chars > limit){  
            //and if there are use substr to get the text before the limit  
            var new_text = text.substr(0, limit);  
  
            //and change the current text with the new text  
            $(this).val(new_text);  
        }  
    });  
});
/*==Clen Form==*/
function clean(){
	jQuery(".clean").focusin(function() {
		var textareaTxt = this.value;
		if(textareaTxt == 'Nombre' || textareaTxt == 'Email' || textareaTxt == 'Mensaje'){
			this.value = '';
			jQuery(this).css({'color':'#000'});
		}
	});
}
/*== Email Validator==*/
function validateEmail(email){
   	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
   	isValid = emailPattern.test(email);
	if(isValid){
		return true;
	}else{
		return false;
	}
}
/*== FORM VALIDATOR ==*/

function checkRequired(){
	//Check if required fields are filled
	var counter = 0;
	jQuery("input.required, select.required").each(function(index) {
		contentField = jQuery(this).val();
		//Check if empty
		if(contentField == '' || contentField == null || contentField == '0'){
			//Change BG style
			jQuery(this).css({'background-color':'#a94442'});
			//Take the cursor to the first field
			if(counter == 0){
				jQuery(this).focus();
			}
			counter++;
		}else{
			//Reset style
			jQuery(this).css({'background-color':'#fff'});
		}
	});

	//If any field is "not valid"
	if(counter > 0){
		//Set this message
		alert('Los campos de E-mail y Nombre no pueden estar vacios');
		return false;
	}else{
		//Reset the error message
		return true;
	}
}

function sendInvitation(){
	one = checkRequired();
	jQuery("input.validEmail").each(function(index) {
		contentField = jQuery(this).val();
		two = validateEmail(contentField);
		if(!two){
			alert('Inserte un email valido');
		}
	});
	if(one && two){
		var name = $('#name').val();
		var gender = $('#gender').val();
		var email = $('#email').val();
		var language = $('#language').val();
		var cc = $('#cc').val();
		$('#currentForm').html('<div id="response_div"><img src="images/ajax-loader.gif" /></div>');


		$.ajax({
			type: "GET", 
			url: "generateImage.php",
			data: 'pname='+name+'&pgender='+gender+'&planguage='+language,
			success: function(file){
			if(file){

				image=file;
				$.ajax({
					type: "GET", 
					url: "sendform.php",
					data: '&pemail='+email+'&pcc='+cc+'&pimage='+image,
					success: function(msg){
						if(msg){ 
							//alert('Su mensaje ha sido enviado.');
							messag='Su mensaje ha sido enviado. <br /> Puede descargar la imagen en: <a href="http://grupoindustrialeec.com/cumple/'+image+'" alt="INGRUP">IMAGEN </a>';

							$('#currentForm').html(messag);
							//clean();
							//$('.form').html('<div id="response_div">&iexcl;Gracias!, su mensaje ha sido enviado.<br /></div>');
						}else{
							//$('.form').html('<div id="response_div">Su mensaje NO a sido enviado, por favor intente mas tarde.</div>');
							//alert('Su mensaje NO a sido enviado, por favor intente mas tarde.');
							$('#currentForm').html('Su mensaje NO a sido enviado, por favor intente mas tarde.');
						}
					}
				});



				//alert(file);
			}else{
				alert('No se genero la imagen');
			}
		   }
		 });

		
			return true; 
	}else{
		return false;
	}
}

