<?php
$dsn = "pgsql:"
    . "host=ec2-18-204-101-137.compute-1.amazonaws.com;"
    . "dbname=d5kmh76vdh0gg0;"
    . "user=loncrrvntwfkrz;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=56260d67ee7cc3cb9e3c93cd54a25f531e5d9d26df5246236c7cce00d7b5b29c";
$conexion = new PDO($dsn);
$query = "SHOW TABLES LIKE 'accounts'";
$envio = $conexion->query($query);
if($envio->num_rows == 0){
 $query = "create table accounts(id integer NOT NULL AUTO_INCREMENT,username varchar(30), password varchar(40),admin bit,PRIMARY KEY(id))";
 $conexion->query($query);
 $query= "insert into accounts(username,password) values ('admin','admin')";
 $conexion->query($query);
 $query = "create table folders(id integer NOT NULL AUTO_INCREMENT, folder_name varchar(50), user_id integer NOT NULL,PRIMARY KEY(id), FOREIGN KEY (user_id) REFERENCES accounts(id))";
 $conexion->query($query);
 $query = "create table tasks(id integer NOT NULL AUTO_INCREMENT, task_name varchar(50), status bit, folder_id integer NOT NULL,PRIMARY KEY(id), FOREIGN KEY (folder_id) REFERENCES folders(id))";
 $conexion->query($query);
}
?>
