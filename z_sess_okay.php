<?php
require 'zdb.php';

if(!$_SESSION['username']) {
    header("Location:index.php");
}

?>