<?php

$size =$_REQUEST["size"];
$flavor =$_REQUEST["flavor"];
//$temperatura = 400;

$date = new DateTime();
$timestamp = $date->getTimestamp();

$timestamp = date('Y-m-d H:i:s', $timestamp-18000);

$respuesta = "ok";

$db_connection = pg_connect("host=db-postgresql-ams3-41156-do-user-11373447-0.b.db.ondigitalocean.com port=25060  dbname=defaultdb user=doadmin password=AVNS_ytodX_1UF_B4gdu");
$result = pg_query($db_connection, "insert into orders values ((select max(idorder)+1 from orders), '$flavor','$size', 'Q', '$timestamp')");


sleep(8);


$result = pg_query($db_connection, "update orders set status = 'D' where idorder = (select max(idorder) from orders)");

?>
