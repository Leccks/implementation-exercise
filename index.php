<!DOCTYPE html>
<?php
  session_start();
  include("conexion.php");
  if(empty($_SESSION['id'])){
    header("Location: login.php");
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Implementation exercise</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body class="index_body">

    <div class="extra">
      <a>You are in the index!</a>
      <a style="color: rgb(112, 146, 255)" href="logout.php">Log Out</a>
    </div>

    <div class="index_main">
      <form method="post" action="folders.php" class="folders_cont">
        <div class="folders_header">FOLDERS</div>
        <div class="folders_body">
          <?php
            $query= "select id,folder_name from folders where user_id='".$_SESSION['id']."'";
            $envio = $conexion->query($query);
            if($envio->num_rows != 0){
              while($recive = $envio->fetch_assoc()){
                echo "<div class='folders_folder'> - <a style='width: 50%;'>".$recive['folder_name']."</a><a class='folders_folder_option' href='index.php?viewfolder=".$recive['id']."'>View items</a><a class='folders_folder_option' href='folders.php?remove=".$recive['id']."'>Remove</a></div>";
              }
            }else{
              echo "There are no folders. Create a new one!";
            }
          ?>
        </div>
        <div class="folders_header">
          <input class="input_style folder_input_size" type="text" name="folder_name" required>
          <button type="submit" class="submit_style folders_button">Create</button>
        </div>
      </form>

    </div>
    <div class="index_main">

      <?php
        if(isset($_GET['viewfolder'])){
          $query= "select * from folders where id='".$_GET['viewfolder']."' and user_id='".$_SESSION['id']."'";
          $envio = $conexion->query($query);
          if($envio->num_rows != 0){
            echo"<form method='post' action='tasks.php' class='folders_cont'>
              <div class='folders_header'>";
                  if(isset($_GET['viewfolder'])){
                    $query = "select folder_name from folders where id='".$_GET['viewfolder']."'";
                    $envio = $conexion->query($query);
                    while($recive = $envio->fetch_assoc()){
                      echo "FOLDERS > ".$recive['folder_name'];
                    }
                  }
              echo"</div>
              <div class='folders_body'>";
                    $query= "select * from tasks where folder_id='".$_GET['viewfolder']."'";
                    $envio = $conexion->query($query);
                    if($envio->num_rows != 0){
                      while($recive = $envio->fetch_assoc()){
                        echo "<div class='folders_folder'><a class='checked_style' href='tasks.php?change_status=".$recive['id']."'>";
                        if($recive['status']==0){
                          echo "";
                        }else{
                          echo "&#10003";
                        }
                        echo "</a><input type='hidden' name='folder-id' value='".$_GET['viewfolder']."'/><a style='width: 50%;'>".$recive['task_name']."</a><a class='folders_folder_option' href='index.php?viewfolder=".$_GET['viewfolder']."&edit=".$recive['id']."'>Edit</a><a class='folders_folder_option' href='tasks.php?remove=".$recive['id']."'>Remove</a></div>";
                      }
                    }else{
                      echo "This folder is empty.";
                    }
              echo"</div>
              <div class='folders_header'>
                <input class='input_style folder_input_size' type='text' name='task_name' required>
                <input type='hidden' name='folder_id' value='".$_GET['viewfolder']."'>
                <button type='submit' class='submit_style folders_button'>Add</button>
              </div>
            </form>";
          }
        }
      ?>
    </div>
    <div class="index_main">

      <?php
        if(isset($_GET['edit'])){
          $query= "select * from tasks where id=".$_GET['edit'];
          $envio = $conexion->query($query);
          while($recive = $envio->fetch_assoc()){
            $query= "select * from folders where id='".$recive['folder_id']."and user_id=".$_SESSION['id'];
            if($envio->num_rows != 0){
              echo '<form method="post" action="tasks.php?edit" class="folders_cont edit_cont">
                <div class="folders_header edit_header">Editing Task "'.$recive['task_name'].'"</div>
                <div class="folders_body edit_body">
                  <input class="input_style task_input_size" type="text" name="task_new" required>
                  <input type="hidden" name="id" value="'.$_GET['edit'].'">
                </div>
                <div class="folders_header edit_header">
                  <button type="submit" class="submit_style folders_button">Save</button>
                  <a class="submit_style folders_button edit_button" href="index.php?viewfolder='.$recive['folder_id'].'">Cancel</a>
                </div>
              </form>';
            }
          }
        }
      ?>

    </div>

  </body>
</html>
