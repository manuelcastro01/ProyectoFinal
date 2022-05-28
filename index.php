<?php
session_start();

$is_initied = $_GET["L"];

if($is_initied == "T"){

  $_SESSION['User'] = "Manuel";
}


if (!isset($_SESSION['User'])) {
    header("Location: login.php");
}

$db_connection = pg_connect("host=db-postgresql-ams3-41156-do-user-11373447-0.b.db.ondigitalocean.com port=25060  dbname=defaultdb user=doadmin password=AVNS_ytodX_1UF_B4gdu");

?>



<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="design.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&?family=Poppins&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">

var tamaño = "";
var cocktail  = "" ;

function seleccionarproducto(activo){

  document.getElementById("1").style.backgroundColor = "#D3D3D3";
  document.getElementById("2").style.backgroundColor = "#D3D3D3";
  document.getElementById("3").style.backgroundColor = "#D3D3D3";

  document.getElementById("1").style.color = "#000000";
  document.getElementById("2").style.color = "#000000";
  document.getElementById("3").style.color = "#000000";

  document.getElementById(activo).style.backgroundColor = "#F13163";
  document.getElementById(activo).style.color = "#FFF";

  cocktail = activo;
  if(cocktail==1){
    document.getElementById("flavor").value = "M"; //Margarita
  }

  if(cocktail==2){
    document.getElementById("flavor").value = "S"; //Sangría
  }

  if(cocktail==3){
    document.getElementById("flavor").value = "P"; //Piña colada
  }



}

var timeout = setInterval(reloadvars, 2000);
function reloadvars () {

     $('#l1').load('index.php #l1');
     $('#l2').load('index.php #l2');
     $('#l3').load('index.php #l3');
     $('#l4').load('index.php #l4');

}


function seleccionartamaño(activo){

  document.getElementById("4").style.backgroundColor = "#D3D3D3";
  document.getElementById("5").style.backgroundColor = "#D3D3D3";
  document.getElementById("6").style.backgroundColor = "#D3D3D3";

  document.getElementById("4").style.color = "#000000";
  document.getElementById("5").style.color = "#000000";
  document.getElementById("6").style.color = "#000000";

  document.getElementById(activo).style.backgroundColor = "#F13163";
  document.getElementById(activo).style.color = "#FFF";

  tamaño = activo;

  if(tamaño==4){
    document.getElementById("size").value = "P"; //pequeño
  }

  if(tamaño==5){
    document.getElementById("size").value = "M"; //Mediano
  }

  if(tamaño==6){
    document.getElementById("size").value = "G"; //Grande
  }




}

function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < 300+milliseconds);
}



function preparar(){
  swal({
  title: "Seguro?",
  text: "Estás seguro que quieres preparar este cocktail? ",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Tu cocktail se está preparando 😉", {
      icon: "success",
    });


    $.ajax({
            url:'addorder.php',
            type:'post',
            data:$('#myorder').serialize(),
            success:function(data){

            }
        });
  } else {
    //swal("Your imaginary file is safe!");
  }
});
}



function enviar(){

}


</script>


</head>

<body style="font-family:Poppins;">

<div style=" float:left; width:50%;">

<div class="liquido">
<p class="TituiloPanel"> Líquido 1</p>
<p class="ValorLiquido" id="l1" name="l1">
  <?php

  $result = pg_query($db_connection, "select porcentaje from liquidoa where hora = (select max(hora) from liquidoa )");

  $i=0;
  while($row=pg_fetch_assoc($result)) {
    echo $row["porcentaje"]."%";
    $i++;
  }

?></p>
</div>

<div class="liquido">
<p class="TituiloPanel"> Líquido 2</p>
<p class="ValorLiquido" id="l2" name="l2">
  <?php

  $result = pg_query($db_connection, "select porcentaje from liquidob where hora = (select max(hora) from liquidob)");

  $i=0;
  while($row=pg_fetch_assoc($result)) {
    echo $row["porcentaje"]."%";
    $i++;
  }

?></p>
</div>

</br>

<div class="liquido">
<p class="TituiloPanel"> Temperatura</p>
<p class="ValorLiquido" id="l3" name="l3">
  <?php

  $result = pg_query($db_connection, "select temperatura from temperatura where hora = (select max(hora) from temperatura)");

  $i=0;
  while($row=pg_fetch_assoc($result)) {
    echo $row["temperatura"]."°C";
    $i++;
  }

?></p>
</div>





</div>

<div class="Divpanel">
  <p style="color:#F13163; font-size:230%; ">Crea tu cocktail 🍹</p>

  <div>
    <p class="TituiloPanel">Cocktail</p>
    <div class="opcion" id="1" onclick="seleccionarproducto(1)"> Margarita</div>
    <div class="opcion" id="2" onclick="seleccionarproducto(2)"> Sangría</div>
    <div class="opcion" id="3" onclick="seleccionarproducto(3)"> Piña Colada</div>
  </div>
  </br></br></br></br>

  <div >

    <p class="TituiloPanel">Tamaño</p>
    <div class="opcion" id="4" onclick="seleccionartamaño(4)"> Pequeño </div>
    <div class="opcion" id="5" onclick="seleccionartamaño(5)"> Mediano</div>
    <div class="opcion" id="6" onclick="seleccionartamaño(6)"> Grande</div>
  </div>

  <div class="Preparar" onclick="preparar()">
    Preparar
  </div>



</div>

<form style="display:none;" name="myorder" id="myorder">
  <input type="text" name="size" id="size"/>
  <input type="text" name="flavor" id="flavor"/>
 </form>

</body>
</html>
