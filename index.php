<?php

	if (!isset($_SESSION['infoTienda'])) {

	require_once './includes/Page.php';
	include_once "./includes/modelProductos.php";
	include_once "./includes/modelUsuarios.php";
	
		$productos = new productos;
		$allProd = $productos->getall();

		$user = new usuarios;

	$body='<h2>Bienvenido a VITRAUX la feria online!</h2>
	<p>El lugar donde podras encontrar los productos que necesitas, al mejor precio y ponerte en contacto directo con los vendedores.</p>
	<p>
		Para comenzar a publicar tus productos, <a href="./registrate.php">registrate haciendo click aqui!</a> 
	</p>
	
	<div class="flex-container">';
	if ($allProd != null){
	$filas=array();
			while ( $producto = $allProd->fetch_assoc()){
				$ArrayProd = array();
				
				$ArrayProd['id_producto'] = $producto["id_producto"];	
				$ArrayProd['titulo'] = $producto["titulo"];
				$ArrayProd['descripcion'] = $producto["descripcion"];
				$ArrayProd['precio'] = $producto["precio"];
				$ArrayProd['datetime'] = $producto["datetime"];
				$ArrayProd['id_user'] = $producto["id_user"];
				$provisorio = $user->getInfo_ID($producto["id_user"]);
				$ArrayProd['telefono'] = $provisorio['telefono'];

				array_push($filas, $ArrayProd);
			}

	foreach($filas as $p){
		$provisorio = $user->getInfo_ID($p['id_user']);

		$msj_wp="Hola,%20vengo%20de%20Vitreaux.%20Me%20interesa%20(ID".$p['id_producto'].")%20-%20".$p['titulo'];

		$body.='<div class="card mb-4 shadow-sm border">
					<div class="card-body">
					<big>'.$provisorio['nombre_tienda'].'</big><br>
					<big><strong>'.$p['titulo'].'</strong></big>	
					<p class="card-text">
                    <text class="descripcion">'.$p['descripcion'].'</text><br>    
                    <medium class="price"> $'.$p['precio'].'</medium> 
                </p>
				<a class="link" href="https://api.whatsapp.com/send?phone='.$p['telefono'].'&text='.$msj_wp.'">Contactate!</a>
				<div class="d-flex justify-content-between align-items-center">
				   <small class="text-muted">'.$p['datetime'].'</small>
				</div>
			</div>
		</div>';
	}
}
	$body.='</div>';

	}
	elseif(isset($_SESSION['infoTienda'])){
		header("Location: ./inicio.php");
	}

$oPage=new Page();

    $oPage->setBody($body);

    echo $oPage->getHtml();

	?>