<?php
$conn = new PDO("mysql:host=[you_host_here];dbname=[your_db_name_here]","[name_here]","[password_here]");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>