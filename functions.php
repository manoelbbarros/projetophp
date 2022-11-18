<?php
    function OpenCon(){
      $dbhost = "localhost";
      $dbuser = "root";
      $dbpass = "senha123";
      $db = "projetosql";
      $conn = new mysqli($dbhost,$dbuser,$dbpass,$db) or die("Connect Failed: %s\n". $conn -> error);
      
      return $conn;
    }
?>