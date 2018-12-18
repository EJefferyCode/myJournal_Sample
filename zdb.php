<?php
session_start();
  $host = 'localhost';
  $user = 'id8189702_emilyjournalpro';
  $pwd  = 'butter41';
  $db   = 'id8189702_myjournal';

  $dataBase = new mysqli($host, $user, $pwd, $db);

if($dataBase->connect_error) {
    die("Connection failed: " . $dataBase->connect_error);
}
?>