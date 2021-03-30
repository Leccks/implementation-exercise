<?php
  session_start();
  include("conexion.php");
  if(!empty($_SESSION['id'])){
    if(isset($_POST['task_name'])){
      $query= "insert into tasks(task_name,status,folder_id) values ('".$_POST['task_name']."',0,'".$_POST['folder_id']."')";
      $conexion->query($query);
      header("Location: index.php?viewfolder=".$_POST['folder_id']);
    }else{
      if(isset($_GET['remove'])){
        $query= "select folder_id from tasks where id=".$_GET['remove']."";
        $envio = $conexion->query($query);
        while($recive = $envio->fetch_assoc()){
          $folder_id = $recive['folder_id'];
          $query= "select folder_name from folders where id=$folder_id and user_id=".$_SESSION['id']."";
          $envio = $conexion->query($query);
          if($envio->num_rows != 0){
            $query= "delete from tasks where id=".$_GET['remove']."";
            $conexion->query($query);
            header("Location: index.php?viewfolder=".$recive['folder_id']."");
          }else{
            echo "No hay carpeta con la id cargada perteneciente al usuario actual";
          }
        }
      }else if(isset($_GET['change_status'])){
        $query= "select * from tasks where id=".$_GET['change_status']."";
        $envio= $conexion->query($query);
        while($recive = $envio->fetch_assoc()){
          $folder_id = $recive['folder_id'];
          if($recive['status']==1){
            $status = 0;
          }else{
            $status = 1;
          }
          $query = "select * from folders where id=".$folder_id." and user_id=".$_SESSION['id']."";
          $envio = $conexion->query($query);
          if($envio->num_rows != 0){
            $query= "update tasks set status =".$status." where id=".$_GET['change_status']."";
            $conexion->query($query);
            header("Location: index.php?viewfolder=".$folder_id."");
          }
        }
      }else if(isset($_GET['edit']) && isset($_POST['task_new']) && isset($_POST['id'])){
        $query= "select * from tasks where id=".$_POST['id'];
        $envio = $conexion->query($query);
        while($recive = $envio->fetch_assoc()){
          $query= "select * from folders where id=".$recive['folder_id']." and user_id=".$_SESSION['id'];
          if($envio->num_rows != 0){
            $query= "update tasks set task_name='".$_POST['task_new']."' where id=".$_POST['id'];
            $conexion->query($query);
            header("Location: index.php?viewfolder=".$recive['folder_id']."");
          }
        }
      }
    }
  }
?>
