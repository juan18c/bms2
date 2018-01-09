    <!--[if lt IE 9]>
        <div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
    <![endif]-->

<!-- wrappers for visual page editor and boxed version of template -->
<section class="page_topline ls ms section_padding_0 table_section table_section_md">
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-center text-md-left">
        <div class="page_social_icons">
            <a class="soc-facebook" href="#" title="Facebook">#</a><a class="soc-twitter" href="#" title="Twitter">#</a><a class="soc-google" href="#" title="Google">#</a><a class="soc-linkedin" href="#" title="LinkedIn">#</a>
        </div>                
            </div>

            <div class="col-md-9 text-center text-md-right">
                
                <span>
                    <!-- <i class="rt-icon2-pin-alt highlight"></i> Calle 50, PH Plaza Morica San Francisco, Panamá -->
                    <i class="rt-icon2-pin-alt highlight"></i> Panamá
                </span>

                <span>
                    <i class="rt-icon2-newspaper-alt highlight"></i> +507 836 7065
                </span>

                <span>
                    <i class="rt-icon2-envelope highlight"></i> biometabolicservice@gmail.com
                </span>
                
            </div>

        </div>
    </div>
</section>

<header class="page_header header_white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6">
                <a href="./" class="logo top_logo" style="font-size:28px;padding-top:20px">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" style="width:78px" alt="">Bio Metabolic Service                
                </a>
            <!-- header toggler -->    
            <span class="toggle_menu"><span></span></span>        
          </div>

          <div class="col-md-6 col-xs-6 col-lg-6">
            <h3 style="float: right; margin-top:20px ">Fundación BMS</h3>
          </div>
          
        </div>
        


    </div>
</header>


<section class="ls section_padding_100">
	<div class="container-fluid" style="padding: 0px !important;">
		
        <div class="row">
			<div class="col-sm-12">
				<?php             
                    $this->renderPartial('_formIndex',array('dataProvider1'=>$dataProvider1,'dataProvider2'=>$dataProvider2,'donador'=>1));
                ?>				
			</div>
		</div>
	</div>
</section>