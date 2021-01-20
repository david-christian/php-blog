<?php
  require_once("conn.php");

  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf("select * from davidchristian_w11_hw1_users where username = '%s'", 
      $username
    );
    // "讀取" dwh_users 的 *(全項) 資料中，符合 username = ? 條件的資料
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

?>