<?php


 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="design.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<script type="text/javascript">

function login(){
  us = document.getElementById('user').value;
  ps = document.getElementById('Password').value;

  if(us=="Manuel" && ps == "123"){window.location.href = "index.php?L=T";}
}

</script>


</head>

<body>
  <div class="divlogin">
    <p class="LogP">Login</p>
    <div style="text-align:center;">
      <a class="credential">Username: </a></br></br>
      <input type="text" name="user" id="user" class="myinput"/></br></br></br>

      <a class="credential">Password: </a></br></br>
      <input type="password" name="Password" id="Password" class="myinput"/></br></br></br></br>

      <a class="loginbtn" onclick="login()">Log in</a>

    </div>

  </div>
</body>
</html>
