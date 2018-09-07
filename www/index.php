<?php
/*
 * organizaremos un poco el codigo para poder trabajar mas rapido
 * el archivo conf.inc.php tendra la configuracion dela base de datos para 
 * no estar llamando a cada momenot el pdo
 * */
	require '/home/admin/web/ws.miskosas.com/public_html/db/conf.inc.php';
	
	require '/home/admin/web/ws.miskosas.com/public_html/vendor/autoload.php';
	$app = new \Slim\Slim();
	$app->get('/',function(){
		/*
		 * aca pondremos algo un poco mas visual para mostrar los res
		 * */
		echo "<pre>";
		$db = getDB();
		
		$consulta = "SELECT * FROM datos ORDER BY id  DESC ;";
		foreach($db->query($consulta) as $registro){
				echo ($registro['infojson']." A las: ".$registro['horaregistro']."<br>");
		}
		$db = null;	
		echo "</pre>";
	});

	$app->get(
		'/datos',
		function(){
			$db = getDB();
			$consulta = "SELECT * FROM datos ORDER BY id DESC;";
			/*
			 * ya no requerimos que imprima los datos como antes
			 * sino mas bien necesitamos que lo devuelva
			 * en formato json entonces realizamos una consulta directa
			 * */
			$query = $db->query($consulta);
			$resultado = $query->fetchAll();
			echo json_encode($resultado);
		}
	);

	$app->post('/setdato',function(){
		/*
		 * solo debemos hacer la consulta, preparar el sql y listo, bueno
		 * ya que es un web service devolvemos un mensaje en json
		 * */
		$db = getDB();
		$consulta = "INSERT INTO datos (infojson,horaregistro) VALUES (:info,datetime('now'));";
		$stmt = $db->prepare($consulta);
		$stmt->bindParam("info", $_POST["info"]);
		$retorno = $stmt->execute();		
		return json_encode($retorno);
	});
	$app->run();
?>
