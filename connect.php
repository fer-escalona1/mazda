<?php 
    $servidor = "localhost";
    $usuario = "root";
    $password = "root";
    $bd = "mazda";

    $connect = mysqli_connect($servidor,$usuario,$password,$bd);
    if($connect->connect_error){
        die("Error al conectar la bd". $connect->connect_error);
    }
?>