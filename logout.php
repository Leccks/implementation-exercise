<?php
session_start();
if(!empty($_SESSION['id'])){
  session_destroy();
  header("Location: index.php");
}else{
  header("Location: index.php");
}
?>
