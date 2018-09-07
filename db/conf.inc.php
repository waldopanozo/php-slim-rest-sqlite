<?php
	function getDB(){
		$host = "localhost";//esto solo seria necesario para una BD tipo MariaDb o pg
		$name = "sqlite:/home/admin/web/ws.miskosas.com/public_html/db/registros.db";
		$db = new PDO($name);
		return $db;
	}
?>
