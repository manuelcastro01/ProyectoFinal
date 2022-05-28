<?php

$temperatura =$_REQUEST["Temp"];
$senA =$_REQUEST["SenA"];
$senB =$_REQUEST["SenB"];
$senC =$_REQUEST["SenC"];
//$temperatura = 400;

$date = new DateTime();
$timestamp = $date->getTimestamp();

$timestamp = date('Y-m-d H:i:s', $timestamp-18000);

$respuesta = "";

$db_connection = pg_connect("host=db-postgresql-ams3-41156-do-user-11373447-0.b.db.ondigitalocean.com port=25060  dbname=defaultdb user=doadmin password=AVNS_ytodX_1UF_B4gdu");
$result = pg_query($db_connection, "insert into temperatura values( '$timestamp', '$temperatura')");

$result = pg_query($db_connection, "insert into liquidoa values( '$timestamp', '$senA')");
$result = pg_query($db_connection, "insert into liquidob values( '$timestamp', '$senB')");
$result = pg_query($db_connection, "insert into liquidoc values( '$timestamp', '$senC')");

$result = pg_query($db_connection, "select cocktail, cocktailsize from orders where idorder = (select max(idorder) from orders o) and status like 'Q'");

$i=0;
while($row=pg_fetch_assoc($result)) {
  $cocktail =  $row["cocktail"]."-".$row["cocktailsize"];
  $i++;
}

if($cocktail == ""){
  $respuesta ="ok";
}else {
  $respuesta = "ok-".$cocktail;
}

echo $respuesta;




?>
