<script type="text/javascript">
 
function send()
{
 	var data=$("#login-form").serialize();
 
  	$.ajax({
   		dataType:'json',
   		type: 'POST',
   		url: '<?php echo Yii::app()->createAbsoluteUrl("site/login"); ?>',
   		data:data,
		success:function(data){
			if(data.status==undefined){
				$.each(data, function(key, val) {									                        	
					$("#login-form #"+key+"_em_").text(val);                                                    
					$("#login-form #"+key+"_em_").show();
				});															
																
	 		}else{
				window.location=data.status;
			} 
			return false;
    	},
   		error: function(data) { // if error occured
        	alert("Error ajax login");
         	//alert(data);
    	},	  
  	});

  	return false;
}


function recuperar()
{ 
	var data=$("#recuperar-form").serialize(); 
  	$.ajax({
   		dataType:'json',
   		type: 'POST',
    	url: '<?php echo Yii::app()->createAbsoluteUrl("site/recuperar"); ?>',
   		data:data,
		success:function(data){

			if(data.status=="recuperado"){
				alert("Su clave fue enviada exitosamente a su correo.");
				$("#recuperar-form")[0].reset();
		 	}else{
				$.each(data, function(key, val) {
					$("#recuperar-form #"+key+"_em_").text(val);                                                    
					$("#recuperar-form #"+key+"_em_").show();
				});
			}
    	},
   		error: function(data) { // if error occured
        	alert("Error ajax login");
         
    	},  
  	}); 
}

// $(document).ready(function(){ 

// 	alert(this.responseData["status"][0])
// })

</script>
<br>

<style type="text/css">
	/*-------------------------------
            LOGIN STYLES
-------------------------------*/

.login-body {
    background: #fff fixed;
    background-size: cover;
    width: 100%;
    height: 100%;
}

.form-signin {
    max-width: 330px;
    margin: 100px auto;
    background: #820906;
    border-radius: 5px;
    -webkit-border-radius: 5px;
}

.form-signin .form-signin-heading {
    margin: 0;
    padding: 25px 15px;
    text-align: center;
    color: #fff;
    position: relative;
    background: #fff;
}

.sign-title {
    font-size: 24px;
    color: #820906;
    position: absolute;
    top: -60px;
    left: 0;
    text-align: center;
    width: 100%;
    text-transform: uppercase;
}

.form-signin .checkbox {
    font-weight: normal;
    color: #fff;
    font-weight: normal;
    font-family: 'Open Sans', sans-serif;
    /*position: absolute;
    bottom: -50px;*/
    width: 100%;
    margin-bottom: 14px;
    font-size: 13px;
    /*left: 0;*/
}

.form-signin .checkbox a, .form-signin .checkbox a:hover {
    color: #fff;
}

.form-signin .form-control:focus {
    z-index: 2;
}

.form-signin input[type="text"], .form-signin input[type="password"] {
    margin-bottom: 15px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    border: 1px solid #eaeaec;
    background: #eaeaec;
    box-shadow: none;
    /*font-size: 12px;*/
}


.form-signin p {
    text-align: left;
    color: #b6b6b6;
    font-size: 16px;
    font-weight: normal;
}

.form-signin a, .form-signin a:hover {
    color: #6bc5a4;
}

.form-signin a:hover {
    text-decoration: underline;
}

.login-wrap {
    padding: 20px 20px 40px;
    position: relative;
}


</style>

<body class="login-body">

<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'login-form',
              'enableAjaxValidation'=>false,
              'enableClientValidation'=>true,
              'htmlOptions'=>array(
              		'class'=>"form-signin",
                    'onsubmit'=>"return false;",/* Disable normal form submit */
                    'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
                   ),
            ));
            ?>  


    	
        <div class="form-signin-heading text-center">
        	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" alt="" width="100" class="sign-img"/>
            <h1 class="sign-title">Ingresa de nuevo!!!</h1>            
        </div>
        <div class="login-wrap">            
            
            <div  class="form-group" >
                <?php echo $form->labelEx($model,'username',array('style'=>'color:#FFF')) ?>
                <?php echo $form->textField($model,'username',array('class'=>'form-control','maxlength'=>60)); ?>
                <?php echo $form->error($model,'username',array('class'=>'errorMessage')); ?>
            </div> 
            <div class="form-group">
                <?php echo $form->labelEx($model,'password',array('style'=>'color:#FFF')); ?>
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control','maxlength'=>60)); ?>
                <?php echo $form->error($model,'password',array('class'=>'errorMessage','style'=>'padding-bottom:2px;')); ?>
            </div>                        
            <?php echo CHtml::button('Login',array('onclick'=>'send();','class'=>'theme_button btn-block btn-login color2')); ?>

            <label class="checkbox">
	            <span style="color:#FFFFF" class="greylinks pull-right">
	                <a data-toggle="modal" href="#myModal">Olvidaste tus datos?</a>
	            </span>
            </label>
            
        </div>

        

    <?php $this->endWidget(); ?>


    <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Olvidaste tus datos ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Ingresa tu dirección de correo electrónico.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                        <button class="btn btn-primary theme_button" type="button">Recordar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

</div>



