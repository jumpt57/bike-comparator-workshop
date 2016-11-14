<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// ... definitions

//$app['debug'] = true;

try {
$pdo = new PDO("mysql:host=anarkhief.fr; dbname=anar33_comparateur", "anar33_comparat", "comparateur123");
} catch (PDOException $ex) { echo $ex->getMessage(); die(); }

$app->get('/hello/{name}', function($name) use ($app) {
	echo '<h1>Hello ' . $name . '</h1>';
});

$app->get('/manufactures?filtre={name}', function ($name) use ($app) {
	$arrayManufactures = array();
	$arrayManufactures['success'] = 1;
	$arrayManufactures['manufactures'] = array();

  	$query = "SELECT * FROM marques WHERE nom like '%".$name."%'";
  	$result = $pdo->query($query);
  	while( $resultat = $resultats->fetch()) {
  		array_push($arrayManufactures['manufactures'], $resultat->name);

  	}
	return print(json_encode($arrayManufactures));
});


$app->run();
?>