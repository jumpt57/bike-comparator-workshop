<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;


$app = new Silex\Application();



// ... definitions

$app['debug'] = false;

try {
$pdo = new PDO("mysql:host=anarkhief.fr; dbname=anar33_comparateur", "anar33_comparat", "comparateur123");
} catch (PDOException $ex) { echo $ex->getMessage(); die(); }

$app->get('/hello/{name}', function($name) use ($app) {
	return '<h1>Hello ' . $name . '</h1>';
});

$app->get('/manufacturers', function (Request $request) use ($app, $pdo) {
	$name = $request->get('filter');
	
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['manufactures'] = array();
  	$query = "SELECT * FROM manufacturer man WHERE name like '%".$name."%'";
	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = $resultat['name'];
	  		$manuf['image'] = $resultat['imgurl'];
	  		

	  		array_push($arrayManufactures['manufactures'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});

$app->get('/manufacturer/{id}/bike', function ($id) use ($app, $pdo) {
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['bikes'] = array();
  	$query = "SELECT * FROM bike WHERE id_manufacturer = ".$id;

	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = utf8_encode($resultat['name']);
	  		

	  		array_push($arrayManufactures['bikes'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});

$app->get('/bike/recent', function ($id) use ($app, $pdo) {
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['bikes'] = array();

  	$query = "SELECT * FROM bike
  	ORDER BY date_added DESC
  	LIMIT 5";


	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = utf8_encode($resultat['name']);
	  		$manuf['image'] = utf8_encode($resultat['imgurl']);
	  		$manuf['date'] = utf8_encode($resultat['date_added']);
	  		

	  		array_push($arrayManufactures['bikes'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});

$app->get('/bike', function (Request $request, $id) use ($app, $pdo) {
	$name = $request->get('filter');
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['bikes'] = array();

  	$query = "SELECT * FROM bike
  	WHERE name LIKE '%".$name."%'";


	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = utf8_encode($resultat['name']);
	  		$manuf['image'] = utf8_encode($resultat['imgurl']);

	  		array_push($arrayManufactures['bikes'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});


$app->get('/bike/{id}', function ($id) use ($app, $pdo) {
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	

  	$query = "SELECT * FROM bike b
  	INNER JOIN category cat ON cat.id = b.id_category
  	INNER JOIN rear_axle rear ON rear.id = b.id_rear_axle 
  	INNER JOIN front_axle front ON front.id = b.id_front_axle  
  	INNER JOIN engine eng ON eng.id = b.id_engine 
  	INNER JOIN transmission trans ON trans.id = b.id_transmission 
  	INNER JOIN frame frm ON frm.id = b.id_frame 
  	INNER JOIN manufacturer man ON man.id = b.id_manufacturer 
  	WHERE b.id = ".$id;


	try {
		$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, true);
	  	$result = $pdo->query($query);
	  	$resultat = $result->fetch();

		$arrayManufactures['bike']['id'] = $resultat['b.id'];
		$arrayManufactures['bike']['name'] = $resultat['b.name'];
		$arrayManufactures['bike']['max_speed'] = $resultat['b.max_speed'];
		$arrayManufactures['bike']['price'] = $resultat['b.price'];
		$arrayManufactures['bike']['category_name'] = $resultat['cat.name'];
		$arrayManufactures['bike']['rear']['rear_shock'] = utf8_encode($resultat['rear.rear_shock']);
		$arrayManufactures['bike']['rear']['rear_brake'] = utf8_encode($resultat['rear.rear_brake']);
		$arrayManufactures['bike']['rear']['type'] = utf8_encode($resultat['rear.type']);
		$arrayManufactures['bike']['rear']['rear_wheel'] = utf8_encode($resultat['rear.rear_wheel']);

		$arrayManufactures['bike']['front_axle']['front_shock'] = utf8_encode($resultat['front.front_shock']);
		$arrayManufactures['bike']['front_axle']['fork'] = utf8_encode($resultat['front.fork']);
		$arrayManufactures['bike']['front_axle']['front_wheel'] = utf8_encode($resultat['front.front_wheel']);
		$arrayManufactures['bike']['front_axle']['front_brake'] = utf8_encode($resultat['front.front_brake']);

		$arrayManufactures['bike']['engine']['gas_supply'] = utf8_encode($resultat['eng.gas_supply']);
		$arrayManufactures['bike']['engine']['torque'] = utf8_encode($resultat['eng.torque']);
		$arrayManufactures['bike']['engine']['act'] = utf8_encode($resultat['eng.act']);
		$arrayManufactures['bike']['engine']['power'] = utf8_encode($resultat['eng.power']);
		$arrayManufactures['bike']['engine']['cooling'] = utf8_encode($resultat['eng.cooling']);
		$arrayManufactures['bike']['engine']['displacement'] = utf8_encode($resultat['eng.displacement']);
		$arrayManufactures['bike']['engine']['type'] = utf8_encode($resultat['eng.type']);
		$arrayManufactures['bike']['engine']['power_to_weight_ratio'] = utf8_encode($resultat['eng.power_to_weight_ratio']);
		$arrayManufactures['bike']['engine']['valve'] = utf8_encode($resultat['eng.valve']);
		$arrayManufactures['bike']['engine']['valve_command'] = utf8_encode($resultat['eng.valve_command']);
		$arrayManufactures['bike']['engine']['bridable'] = utf8_encode($resultat['eng.bridable']);

		$arrayManufactures['bike']['transmission']['gearbox_speeds'] = utf8_encode($resultat['trans.gearbox_speeds']);
		$arrayManufactures['bike']['transmission']['geerbox_type'] = utf8_encode($resultat['trans.gearbox_type']);
		$arrayManufactures['bike']['transmission']['secondary_transmission'] = utf8_encode($resultat['trans.secondary_transmission']);
		$arrayManufactures['bike']['transmission']['type'] = utf8_encode($resultat['trans.type']);

		$arrayManufactures['bike']['frame']['dry_weight'] = utf8_encode($resultat['frm.dry_weight']);
		$arrayManufactures['bike']['frame']['seat_height'] = utf8_encode($resultat['frm.seat_height']);
		$arrayManufactures['bike']['frame']['type'] = utf8_encode($resultat['frm.type']);
		$arrayManufactures['bike']['frame']['tank_capacity'] = utf8_encode($resultat['frm.tank_capacity']);
		$arrayManufactures['bike']['frame']['length'] = utf8_encode($resultat['frm.length']);
		$arrayManufactures['bike']['frame']['wheel_base'] = utf8_encode($resultat['frm.wheelbase']);
		$arrayManufactures['bike']['frame']['width'] = utf8_encode($resultat['frm.width']);
		$arrayManufactures['bike']['frame']['height'] = utf8_encode($resultat['frm.height']);
		$arrayManufactures['bike']['frame']['moving_weight'] = utf8_encode($resultat['frm.moving_weight']);

	  	$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, false);
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});





$app->run();
?>