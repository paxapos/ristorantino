<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		//echo $html->css('cake');
		echo $html->css('Adicion');
		
		// para los modal window
		echo $html->css(array(
                    'windowthemes/default',
                    'windowthemes/alert',
                    'windowthemes/alert_simple',
                    'windowthemes/spread',
                    ));
	//	echo $html->css('windowthemes/ligthing');

                $cssUserRole = "acl-".$session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }

                

		echo $scripts_for_layout;
		
		echo $javascript->link(array(
                    'prototype',
                    'scriptaculous',
                    'ristorantino/generic',
                    'adicionar/head',
                    'ristorantino/categorias.class',
                    'ristorantino/producto.class',
                    'ristorantino/fabrica_mozo.class',
                    'ristorantino/fabrica_mesas.class',
                    'ristorantino/mesa.class',
                    'ristorantino/mozo.class',
                    'ristorantino/mensaje.class',
                    'ristorantino/cliente.class',
                    'ristorantino/comanda.class',
                    'ristorantino/comanda_sacar.class',
                    'ristorantino/comanda_cocina.class',
                    '/adition/js/adicion.class',
                    'adicionar/producto_comanda.class',
                    'adicionar/eventos_observados',
                    'numpad', // PAD numerico
                    'window', // Modal window  Prototype window by http://prototype-window.xilinus.com/index.html
                    ));		
	?>
	
<script type="text/javascript">
<!--
	var urlMesaCerrarMesa = "<?php echo $html->url('/mesas/cerrarMesa');?>" 
-->
</script>
	
</head>
<body>

	<div id="container">
		<div id="content">
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<?php echo $javascript->link('adicionar/tail'); ?>
	<?php echo $cakeDebug; ?>
	
</body>
</html>