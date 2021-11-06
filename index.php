<?php
	session_start();
	require_once './includes/Page.php';
	if (isset($_SESSION['infoTienda'])) {	//Si esta logeado, redirigir a inicio.php
		header('Location: ./inicio.php');
	}
	else{
	$body='<h2>Bienvenido a VITRAUX la feria online!</h2>
	<p>El lugar donde podras encontrar los productos que necesitas, al mejor precio y ponerte en contacto directo con los vendedores.</p>
	<p>
		Para comenzar a publicar tus productos, <a href="./registrate.php">registrate haciendo click aqui!</a> 
	</p>

		<div class="flex-container">
			<div class="card mb-4 shadow-sm border">
             <div class="card-body">
			 	<big>Nombre Tienda</big><br>
			 	<big><strong>Titulo del producto</strong></big>
				
                <p class="card-text">
                    <text class="descripcion">Descripcion: </text><br>    
                    <medium class="price">Precio: $150</medium> 
                </p>
                <a class="link" href="https://api.whatsapp.com/send?phone=34123456789&text=hola,%20qué%20tal?">Quiero saber mas</a>
                 <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Fecha de Publicacion</small>
                 </div>
             </div>
            </div>

		</div>
		
	<img class= "img_index" src="./imagenes/catalogo.png" alt="Imagen Decorativa">	';

$oPage=new Page();

      $oPage->setBody($body);

    echo $oPage->getHtml();
}
	?>