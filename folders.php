<?php
  session_start();
  include("conexion.php");
  if(!empty($_SESSION['id'])){
    if(isset($_POST['folder_name'])){
      $query= "insert into folders(folder_name,user_id) values ('".$_POST['folder_name']."','".$_SESSION['id']."')";
      $conexion->query($query);
      header("Location: index.php");
    }else{
      if(isset($_GET['remove'])){
        $query= "select user_id from folders where user_id=".$_SESSION['id']."";
        $envio = $conexion->query($query);
        if($envio->num_rows != 0){
          $query= "delete from tasks where folder_id=".$_GET['remove']."";
          $conexion->query($query);
          $query= "delete from folders where id=".$_GET['remove']."";
          $conexion->query($query);
          header("Location: index.php");
        }else{
          header("Location: index.php");
        }
        header("Location: index.php");
      }
      header("Location: index.php");
    }
  }else{
    header("Location: login.php");
  }
?>
