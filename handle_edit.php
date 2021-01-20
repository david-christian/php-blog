<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_permission.php');

  if (
    empty($_POST['id']) ||
    empty($_POST['title']) ||
    empty($_POST['content'])
  ) {
    header('Location: admin.php?errCode=1');
    die('資料不齊全');
  }

  $id = $_POST['id'];
  $content = $_POST['content'];
  $title = $_POST['title'];
  $sql ="update davidchristian_w11_hw2_comments set title=?, content=? where id=?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssi', $title, $content, $id);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header("Location: admin.php");
?>