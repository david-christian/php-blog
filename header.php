
<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  require_once('conn.php');
  require_once('utils.php');
  $uri = $_SERVER['REQUEST_URI'];
  // 拿到當前網址
  $isAdminPage = (strpos($uri, 'admin.php') !== false)
  // 檢查當前網址字串有沒有 admin.php 
?>
<nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Who's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="list.php">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
        <?php if (!empty($_SESSION['username'])) { ?>
          <?php if ($isAdminPage) { ?>
            <li><a href="article.php">發表文章</a></li>
          <?php } else { ?>
            <li><a href="admin.php">管理後台</a></li>
          <?php } ?>
          <li><a href="logout.php">登出</a></li>
        <?php } else { ?>
          <li><a href="login.php">登入</a></li>
        <?php } ?>
        </div>
      </ul>
    </div>
</nav>