<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;

header('Access-Control-Allow-Origin: *');  
$app = new Silex\Application();

header('Content-Type: application/json; charset=utf-8');

// ... definitions

$app['debug'] = true;

try {
$pdo = new PDO("mysql:host=anarkhief.fr; dbname=anar33_comparateur; charset=utf8mb4", "anar33_comparat", "comparateur123");
} catch (PDOException $ex) { echo $ex->getMessage(); die(); }

$app->get('/hello/{name}', function($name) use ($app) {
	return '<h1>Hello ' . $name . '</h1>';
});

$app->get('/manufacturer/{id}', function (Request $request, $id) use ($app, $pdo) {
	$name = $request->get('filter');
	
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['manufactures'] = array();
  	$query = "SELECT * FROM manufacturer man WHERE id = ".$id."";
	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = $resultat['name'];
	  		$manuf['years'] = $resultat['years'];
	  		$manuf['imgurl'] = $resultat['imgurl'];
	  	

	  		array_push($arrayManufactures['manufactures'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});

$app->get('/manufacturers', function (Request $request) use ($app, $pdo) {
	$name = $request->get('filter');
	
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['manufactures'] = array();
  	$query = "SELECT m.id,m.name,m.imgurl,Count(b.id) as num_bike FROM manufacturer m INNER JOIN bike b on b.id_manufacturer=m.id WHERE m.name like '%".$name."%' GROUP BY m.id,m.name,m.imgurl";
	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = $resultat['name'];
	  		$manuf['image'] = $resultat['imgurl'];
			$manuf['nb_bike'] = $resultat['num_bike'];
	  		

	  		array_push($arrayManufactures['manufactures'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});


$app->get('/category', function (Request $request) use ($app, $pdo) {
	
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['category'] = array();
  	$query = "SELECT * FROM anar33_comparateur.category";

	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = $resultat['name'];	

	  		array_push($arrayManufactures['category'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
  	
	return json_encode($arrayManufactures);
});


$app->get('/category', function (Request $request) use ($app, $pdo) {
	
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['category'] = array();
  	$query = "SELECT * FROM anar33_comparateur.category";

	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = ($resultat['name']);	

	  		array_push($arrayManufactures['category'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
  	
	return json_encode($arrayManufactures);
});


$app->get('/category/{idCategory}/manufacturer/{idManufacturer}', function (Request $request, $idCategory, $idManufacturer) use ($app, $pdo) {
	
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['modele'] = array();
  	$query = "SELECT distinct m.id, m.name FROM bike b INNER JOIN modele m ON m.id = b.id_modele WHERE id_category = " .$idCategory." AND id_manufacturer = " . $idManufacturer;

	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = ($resultat['name']);	

	  		array_push($arrayManufactures['modele'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
  	
	return json_encode($arrayManufactures);
});


$app->get('/search', function (Request $request, $idCategory, $idManufacturer) use ($app, $pdo) {
	$idCategory = $request->get('idCategory');
	$idManufacturer = $request->get('idManufacturer');
	$idModele = $request->get('idModele');
	$minCylindree = $request->get('minCylindree');
	$maxCylindree = $request->get('maxCylindree');
	
	$minTarif = $request->get('minTarif');
	$maxTarif = $request->get('maxTarif');



	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['modele'] = array();
  	$query = "SELECT * FROM bike 
  	INNER JOIN engine ON engine.id = bike.id_engine
  	WHERE 1=1";
    if(!empty($idCategory))
  		$query .= " AND id_category = ".$idCategory;
  	if(!empty($idManufacturer))
  		$query .= " AND id_manufacturer = ".$idManufacturer;
  	if(!empty($idModele))
  		$query .= " AND id = ".$idModele;
  	if(!empty($minTarif))
  		$query .= " AND price >= ".$minTarif;
  	if(!empty($maxTarif))
  		$query .= " AND price <= ".$maxTarif;
	if(!empty($minCylindree))
  		$query .= " AND cylindree >= ".$minCylindree;
	if(!empty($maxCylindree))
  		$query .= " AND cylindree <= ".$maxCylindree;

	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
			$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = ($resultat['name']);
	  		$manuf['image'] = ($resultat['imgurl']);

	  		array_push($arrayManufactures['modele'], $manuf);
	  	}
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
  	
	return json_encode($arrayManufactures);
});


$app->get('/manufacturer/{id}/bike', function (Request $request, $id) use ($app, $pdo) {

	$year = $request->get('year');

	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['message'] = null;
	$arrayManufactures['bikes'] = array();
  	$query = "SELECT b.id,b.name,b.imgurl,c.name as cat_name FROM bike b INNER JOIN category c ON c.id = b.id_category WHERE id_manufacturer = ".$id;

  	if(!empty($year))
  		$query .= " AND year = " . $year;


	try {
	  	$result = $pdo->query($query);
	  	while($resultat = $result->fetch()) {
	  		$manuf = array();
	  		$manuf['id'] = $resultat['id'];
	  		$manuf['name'] = ($resultat['name']);
	  		$manuf['imgurl'] = ($resultat['imgurl']);
			$manuf['category'] = $resultat['cat_name'];

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
	  		$manuf['name'] = ($resultat['name']);
	  		$manuf['image'] = ($resultat['imgurl']);
	  		$manuf['date'] = ($resultat['date_added']);
	  		

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
	  		$manuf['name'] = ($resultat['name']);
	  		$manuf['image'] = ($resultat['imgurl']);

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
		$arrayManufactures['bike']['img_url'] = $resultat['b.imgurl'];
		$arrayManufactures['bike']['year'] = $resultat['b.year'];
		$arrayManufactures['bike']['zero_to_hundred'] = $resultat['b.zero_to_hundred'];
		$arrayManufactures['bike']['rear']['rear_shock'] = ($resultat['rear.rear_shock']);
		$arrayManufactures['bike']['rear']['rear_brake'] = ($resultat['rear.rear_brake']);
		$arrayManufactures['bike']['rear']['type'] = ($resultat['rear.type']);
		$arrayManufactures['bike']['rear']['rear_wheel'] = ($resultat['rear.rear_wheel']);

		$arrayManufactures['bike']['front_axle']['front_shock'] = ($resultat['front.front_shock']);
		$arrayManufactures['bike']['front_axle']['fork'] = ($resultat['front.fork']);
		$arrayManufactures['bike']['front_axle']['front_wheel'] = ($resultat['front.front_wheel']);
		$arrayManufactures['bike']['front_axle']['front_brake'] = ($resultat['front.front_brake']);

		$arrayManufactures['bike']['engine']['gas_supply'] = ($resultat['eng.gas_supply']);
		$arrayManufactures['bike']['engine']['torque'] = ($resultat['eng.torque']);
		$arrayManufactures['bike']['engine']['act'] = ($resultat['eng.act']);
		$arrayManufactures['bike']['engine']['power'] = ($resultat['eng.power']);
		$arrayManufactures['bike']['engine']['cooling'] = ($resultat['eng.cooling']);
		$arrayManufactures['bike']['engine']['displacement'] = ($resultat['eng.displacement']);
		$arrayManufactures['bike']['engine']['type'] = ($resultat['eng.type']);
		$arrayManufactures['bike']['engine']['power_to_weight_ratio'] = ($resultat['eng.power_to_weight_ratio']);
		$arrayManufactures['bike']['engine']['valve'] = ($resultat['eng.valve']);
		$arrayManufactures['bike']['engine']['valve_command'] = ($resultat['eng.valve_command']);
		$arrayManufactures['bike']['engine']['bridable'] = ($resultat['eng.bridable']);
		$arrayManufactures['bike']['engine']['engine_intake'] = ($resultat['eng.engine_intake']);

		$arrayManufactures['bike']['transmission']['gearbox_speeds'] = ($resultat['trans.gearbox_speeds']);
		$arrayManufactures['bike']['transmission']['geerbox_type'] = ($resultat['trans.gearbox_type']);
		$arrayManufactures['bike']['transmission']['secondary_transmission'] = ($resultat['trans.secondary_transmission']);
		$arrayManufactures['bike']['transmission']['type'] = ($resultat['trans.type']);

		$arrayManufactures['bike']['frame']['dry_weight'] = ($resultat['frm.dry_weight']);
		$arrayManufactures['bike']['frame']['seat_height'] = ($resultat['frm.seat_height']);
		$arrayManufactures['bike']['frame']['type'] = ($resultat['frm.type']);
		$arrayManufactures['bike']['frame']['tank_capacity'] = ($resultat['frm.tank_capacity']);
		$arrayManufactures['bike']['frame']['length'] = ($resultat['frm.length']);
		$arrayManufactures['bike']['frame']['wheel_base'] = ($resultat['frm.wheelbase']);
		$arrayManufactures['bike']['frame']['width'] = ($resultat['frm.width']);
		$arrayManufactures['bike']['frame']['height'] = ($resultat['frm.height']);
		$arrayManufactures['bike']['frame']['moving_weight'] = ($resultat['frm.moving_weight']);

	  	$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, false);
  	}
  	catch(Exception $ex) {
  		$arrayManufactures['success'] = 0;
  		$arrayManufactures['message'] = $ex->getMessage();
  	}
	return json_encode($arrayManufactures);
});

$app->get('/leboncoin', function (Request $request, $id) use ($app, $pdo) {
	$name = $request->get('name');
	$year_min = $request->get('year_min');
	$year_max = $request->get('year_max');
	$post = array('app_id'=> 'leboncoin_android',
                'key'=> 'd2c84cdd525dddd7cbcc0d0a86609982c2c59e22eb01ee4202245b7b187f49f1546e5f027d48b8d130d9aa918b29e991c029f732f4f8930fc56dbea67c5118ce');
	$url = "https://mobile.leboncoin.fr/templates/api/list.json?c=3&ps=1&it=1&";
	if(!empty($name)){
		$url.="q=".str_replace(" ","%20",$name)."&";
	}
	if(!empty($year_min)){
		$url.="rs=".$year_min."&";
	}
	if(!empty($year_max)){
		$url.="re=".$year_max."&";
	}
	$url=rtrim($url, '&');
	//echo $url;
	
	foreach($post as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); // -X
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE); // --data-binary
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']); // -H
	curl_setopt($ch,CURLOPT_POST, 2);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); 
	$output = curl_exec($ch);
	$output = json_decode(utf8_encode($output),true);
	$output = (json_encode($output));
	curl_close($ch);
	//echo utf8_encode($output);
	//return json_encode($output);
	return $output;
	//return json_decode(utf8_encode($output));
});



$app->run();
?>