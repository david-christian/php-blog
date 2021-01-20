<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_POST['username']) || 
    empty($_POST['password'])
  ) {
    header('Location: login.php?errCode=1');
    die();
  }

  /* 如果透過 POST 帶過來的帳號密碼有空值，就用 GET 的方式帶 errcode 回
  login.php ，給它處理錯誤顯示的部分
  */

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "select * from davidchristian_w11_hw2_users where username=?";
  // "讀取" dwh_users 的 *(全項) 資料中，符合 username = ? 條件的資料
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    header("Location: login.php?errCode=2");
    exit();
  }
  
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
?>