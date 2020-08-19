<?php
require_once(__DIR__ . '/header.php');
// $app = new Bbs\Controller\UserEditDone();
// $app->run();
?>
<h1 class="page__ttl">ユーザー削除確認</h1>
<p class="user-disp">以下のユーザーを削除します。実行する場合は「実行」ボタンを押してください。</p>
<div class="container">
  <div class="form-group">
    <p>ユーザーid：<?= h($_POST['id']); ?></p>
  </div>
  <div class="form-group">
    <p>ユーザー名：<?= h($_POST['username' . $_POST['id']]); ?></p>
  </div>
  <div class="form-group">
    <p>メールアドレス：<?= h($_POST['email' . $_POST['id']]); ?></p>
  </div>
  <div class="form-group">
    <p>イメージ画像：<?= h($_POST['image' . $_POST['id']]); ?></p>
  </div>
  <div class="form-group">
    <p>権限：<?= h($_POST['authority' . $_POST['id']]); ?></p>
  </div>
  <div class="form-group">
    <p>削除フラグ：<?= h($_POST['delflag' . $_POST['id']]); ?></p>
  </div>
  <form class="user-delete user-confirm" action="admin_user_delete_done.php" method="post">
    <a class="btn btn-primary" href="javascript:history.back();">まだしません。</a>
    <input type="submit" class="btn btn-primary" value="実行">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="id" value="<?= h($_POST['id']); ?>">
    <input type="hidden" name="username<?= $_POST['id']; ?>" value="<?= h($_POST['username' . $_POST['id']]); ?>">
    <input type="hidden" name="email<?= $_POST['id']; ?>" value="<?= h($_POST['email' . $_POST['id']]); ?>">
    <input type="hidden" name="image<?= $_POST['id']; ?>" value="<?= h($_POST['image' . $_POST['id']]); ?>">
    <input type="hidden" name="authority<?= $_POST['id']; ?>" value="<?= h($_POST['authority' . $_POST['id']]); ?>">
    <input type="hidden" name="delflag<?= $_POST['id']; ?>" value="<?= h($_POST['delflag' . $_POST['id']]); ?>">
  </form>
</div>
<!--container -->

<?php
require_once(__DIR__ . '/footer.php');
