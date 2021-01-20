<?php
  session_start();
  require_once('conn.php');

  if ( 
    empty($_POST['username']) || 
    empty($_POST['password'])
  ) {
    header('Location: register.php?errCode=1');
    die();
  }

  /* 如果傳進來的值有任何一項是空值的話，就帶 errcode 導回去 register.php */ 

  $username = $_POST['username'];
  $password = password_hash($_POST['password'], 
    PASSWORD_DEFAULT);
  // 將註冊的密碼 hash 處理

  $sql = "insert into davidchristian_w11_hw2_users(username, password) values(?, ?)";
  // "新增"一項資料到 dwh_users 中，該項資料的欄位(n, u, p)的值 = values (?, ?, ?)
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $password);
  $result = $stmt->execute();
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    }
    die($conn->error);
  }
  /* 因為資料庫欄位的 username 有唯一性，所以如果有重複錯誤的話，會出現 1062 的
  錯誤碼，有出現這個錯誤，就帶 errcode 導回 register 處理顯示錯誤。
  */

  $_SESSION['username'] = $username;
  header("Location: index.php");
  /* 如果註冊成功，就將 $username 放進 session，然後導回 index.php */
?>