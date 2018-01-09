<?php
	if($this->style == 'vertical')
		$data_type = 'box_count';
	else
		$data_type = 'button';
?>

<div id="fb-root<?php echo $_GET['id']; ?>"></div>



 <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>



<?php 
	$cad=$this->data_via['datos']->foto;
	$findme   = '/bms/';
	$pos = strpos($cad, $findme);
	if ($pos === false){
		$domain=$cad;
	} else{
		$domain=substr($cad,strlen($findme),strlen($cad));
	}

	$cadena=$this->data_via['datos']->nombre_caso;
	$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    $CONTENIDO= utf8_encode($cadena);

?>

<div class="fb-share-button" style="padding: 8px 0px;" data-href="http://www.biometabolicservice.com/portalFacebook.php?ID=<?php echo $_GET['id']; ?>&CONTENIDO=<?php echo $CONTENIDO;?>&IMAGEN=<?php echo $domain?>" data-width="400" data-type="<?=$data_type?>" data-size="large"></div>
