<?php

function getConnection() {
  try {
    $db_username = 'itrt';
    $db_password = 'Itrt_P4ssw0rd';
    $conn = new PDO('mysql:host=db;dbname=itrt;charset=UTF8', $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
  return $conn;
}
