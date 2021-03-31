<?php
$db = new mysqli("localhost","root","");
$query = "SHOW DATABASES LIKE 'implementation_exercise'";
$envio = $db->query($query);
if($envio->num_rows == 0){
 $query = "create database implementation_exercise";
 $db->query($query);
 $db = new mysqli("localhost","root","","implementation_exercise");
 $query = "create table accounts(id integer NOT NULL AUTO_INCREMENT,username varchar(30), password varchar(40),admin bit,PRIMARY KEY(id))";
 $db->query($query);
 $query= "insert into accounts(username,password) values ('admin','admin')";
 $db->query($query);
 $query = "create table folders(id integer NOT NULL AUTO_INCREMENT, folder_name varchar(50), user_id integer NOT NULL,PRIMARY KEY(id), FOREIGN KEY (user_id) REFERENCES accounts(id))";
 $db->query($query);
 $query = "create table tasks(id integer NOT NULL AUTO_INCREMENT, task_name varchar(50), status bit, folder_id integer NOT NULL,PRIMARY KEY(id), FOREIGN KEY (folder_id) REFERENCES folders(id))";
 $db->query($query);
}
$conexion = new mysqli("localhost","root","","implementation_exercise");
?>

