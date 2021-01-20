<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');


  $id = intval($_GET['id']);
  $stmt = $conn->prepare(
    'select ' . 
    'C.id as id, C.content as content, C.title as title, ' . 
    'C.created_at as created_at, U.username as username ' . 
    'from davidchristian_w11_hw2_comments as C ' . 
    'left join davidchristian_w11_hw2_users as U on C.username = U.username ' . 
    'where C.id = ? '
  );
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc()
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php include_once('header.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div>
            <?php echo escape($row['title']); ?>
          </div>
        </div>
        <div class="post__info">
          <?php echo escape($row['created_at']); ?>
        </div>
        <div class="post__content">
          <?php echo escape($row['content']); ?>
        </div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>