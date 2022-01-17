<?php

//VYpíše idno záznamu, u kterého jsou interstitial fields 
include "setup.php";

$dsn = 'mysql:dbname=' . __CA_DB_DATABASE__ . ';host=' .__CA_DB_HOST__ . '';
$user = __CA_DB_USER__;
$password = __CA_DB_PASSWORD__;


try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if(!isset($argv[1])) die ("no param");

switch($argv[1]){
	case  "task_queue":
    $Query="SELECT count(*) as result
      FROM `ca_task_queue`
      WHERE `completed_on` IS NULL
      ";  
	break;
  
case "indexing_queue":
    $Query="SELECT count(*) as result
      FROM `ca_search_indexing_queue`
      ";
      break;
default:
  die ("wrong param");
}

$dotaz = $pdo->query($Query);
foreach($dotaz  as $Row){
  echo $Row["result"];
}
