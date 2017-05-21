<?php session_start(); ?>
<header>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container hide-on-med-and-down">
      <a href="index.php" class="brand-logo">爱沙河</a>

      <ul class="right hide-on-med-and-down">
          <?php
          if ($_SESSION['type'] == '管委会' || $_SESSION['type'] == 'admin') {
              echo "<li><a href='guanweihui.php'>待分配问题</a></li>";
          }
          if ($_SESSION['type'] != 'student') {
              echo "<li><a href='gebumen.php'>部门问题</a></li>";
          }
          ?>
        <li><a href="new.php">发布问题</a></li>
        <li><a href="my.php">个人中心</a></li>
      </ul>
    </div>
    <div class="nav-wrapper hide-on-large-only">
      <a href="index.php" class="brand-logo">爱沙河</a>
      <a href="#" style="color:#8590a6" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="side-nav" id="mobile-demo">
          <?php
          if ($_SESSION['type'] == '管委会' || $_SESSION['type'] == 'admin') {
              echo "<li><a href='guanweihui.php'>待分配问题</a></li>";
          }
          if ($_SESSION['type'] != 'student') {
              echo "<li><a href='gebumen.php'>部门问题</a></li>";
          }
          ?>
        <li><a href="new.php">发布问题</a></li>
        <li><a href="my.php">个人中心</a></li>
      </ul>
    </div>
  </nav>
</header>
