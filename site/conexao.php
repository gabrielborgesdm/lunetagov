<?php
function conexaoDB(){
   $conn = new PDO("mysql:host=localhost;dbname=lunetagov", "root", "");
   return $conn;
}

?>