<?php
require 'zdb.php';
$_SESSION['username'] = $username;

if($_SESSION['username']){
    header("Location:home.php?user=" .$username);
}

?>