<?php
	require 'vendor/autoload.php';
	$app = new \Slim\Slim();
	$app->get('/',function(){
		echo "Solo es una prueba acción index";
	});


	/*
	 * veamos si tenemos algo para trabajar con PDO
	 *
	 * */

	$app->get(
		'/consulta',
		function(){
			/*probaremos la conexion para que nos devuelva los datos
			 * que tenemos insertados
			 * el problema era que esperaba que la ruta de la base de datos
			 * sea to-do el path 
			 * */
			$db = new PDO("sqlite:/home/wpanozo/slimejemplos/db/registros.db");
			$consulta = "SELECT * FROM datos;";
			foreach($db->query($consulta) as $registro){
				echo $registro['id']."-".$registro['infojson'];
			}
			$db = null;
		}
	);


	/*
	 *crearemos una ruta mas para probar que to-do esta bien
	 * */

	$app->get('/prueba',function(){
		echo "Ruta nueva... para probar<br>El contenido";
	});

	/*
	 *como ya probamos que to-do esta bien veamos la conexion con 
	 *algun motor de base de datos
	 * */

	$app->run();
?>
