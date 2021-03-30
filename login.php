<?php
  session_start();
  include("conexion.php");
  if(empty($_SESSION['id'])){
    if (isset($_POST["username"]) && isset($_POST["password"])){
      $user =$_POST['username'];
      $pass =$_POST['password'];
      $query = "select id from accounts where username='$user' and password='$pass'";
      $envio = $conexion->query($query);
      if($envio->num_rows != 0){
        while($recive = $envio->fetch_assoc()){
          $_SESSION['id']=$recive['id'];
        }
        header("location: index.php");
    	}else{
        header("location: login.php?wrong=true");
      }
    }
  }else{
    header("location: index.php");
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <?php
      if(isset($_GET["wrong"]) && $_GET["wrong"] == 'true'){
        echo '<div class="log_error"><a>El nombre de usuario y/o la contraseña que has introducido son incorrectos.</a></div>';
      }
    ?>
    <form method="post" action="login.php" class="log_cont">
      <div class="log_input_cont1">
        <a style="color:white; font-size: 1vw;">SIGN IN</a>
        <a style="">into an existing account</a>
      </div>
      <div class="log_input_cont1">
        <a style="">Account name</a>
        <div class="log_input_cont2">
          <input class="input_style log_input_size" type="text" name="username" required/>
        </div>
      </div>
      <div class="log_input_cont1">
        <a style="">Password</a>
        <div class="log_input_cont2">
          <input class="input_style log_input_size" type="password" name="password" required/>
        </div>
      </div>
      <div class="log_input_cont1" style="justify-content: flex-end; align-items: center;">
        <button type="submit" class="submit_style log_button">Sign In</button>
      </div>
    </form>

  </body>
</html>
