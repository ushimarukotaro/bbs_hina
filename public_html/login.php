<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>掲示板</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://fonts.googleapis.com/css?family=Charm|M+PLUS+Rounded+1c&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8bc1904d08.js"></script>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<!-- <header class="sticky-top header">
<div class="header__inner">
  <nav>
    <ul>
      <li><a href="./">ホーム</a></li> -->
      <!-- 非ログイン時のみ表示 -->
      <!-- <li class="user-btn"><a href="./login.html">ログイン</a></li>
      <li><a href="./signup.html">ユーザー登録</a></li>
    </ul>
  </nav> -->
  <!-- ログイン時のみ表示 -->
  <!-- <div class="header-r">
  </div>
</div>
</header> -->
<div class="wrapper">
<?php
require_once(__DIR__ .'/header.php');
$app = new Bbs\Controller\Login();
$app->run 
?>
<div class="container">
  <form action="" method="post" id="login" class="form">
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" class="form-control">
    </div>
    <div class="form-group">
      <label>パスワード</label>
      <input type="password" name="password" class="form-control">
    </div>
    <p class="err"><?= h($app->getErrors('login')); ?></p>
    <button class="btn btn-primary" onclick="document.getElementById('login').submit();">ログイン</button>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
  <p class="fs12"><a href="signup.php">ユーザー登録</a></p>
</div><!--container -->
<?php require_once(__DIR__ .'/footer.php') ?>
</div> <!-- wrapper -->
<!-- <p class="copy"><small>&copy; 2019 code lab.</small></p> -->
<script src="./js/bbs.js"></script>
</body>
</html>
