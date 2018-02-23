<?php
function conexaoDB(){
   $conn = new PDO("mysql:host=localhost;dbname=ddpbr_lunetagov", "root", "");
   return $conn;
}

?>