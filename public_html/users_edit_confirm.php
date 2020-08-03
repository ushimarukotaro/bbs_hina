<?php
require_once(__DIR__ . '/header.php');

?>
<h1 class="page__ttl">ユーザー情報変更確認</h1>
<p class="user-disp">以下のユーザーを変更します。実行する場合は「実行」ボタンを押してください。</p>
<div class="container">
  <div class="form-group">
    <p>ユーザーid：<?= $_POST['id']; ?></p>
  </div>
  <div class="form-group">
    <p>ユーザー名：<?= $_POST['username' . $_POST['id']]; ?></p>
  </div>
  <div class="form-group">
    <p>メールアドレス：<?= $_POST['email' . $_POST['id']]; ?></p>
  </div>
  <div class="form-group">
    <p>イメージ画像：<?= $_POST['image' . $_POST['id']]; ?></p>
  </div>
  <div class="form-group">
    <p>権限：<?= $_POST['authority' . $_POST['id']]; ?></p>
  </div>
  <div class="form-group">
    <p>削除フラグ：<?= $_POST['delflag' . $_POST['id']]; ?></p>
  </div>
  <form class="user-delete user-confirm" action="user_edit_done.php" method="post">
    <a class="btn btn-primary" href="javascript:history.back();">まだしません。</a>
    <input type="submit" class="btn btn-primary" value="実行">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="id" value="<?= h($user['id']); ?>">
    <input type="hidden" name="username<?= $user['id']; ?>" value="<?= h($user['username']); ?>">
    <input type="hidden" name="email<?= $user['id']; ?>" value="<?= h($user['email']); ?>">
    <input type="hidden" name="image<?= $user['id']; ?>" value="<?= h($user['image']); ?>">
    <input type="hidden" name="authority<?= $user['id']; ?>" value="<?= h($user['authority']); ?>">
    <input type="hidden" name="delflag<?= $user['id']; ?>" value="<?= h($user['delflag']); ?>">
  </form>
</div>
<!--container -->

<?php
require_once(__DIR__ . '/footer.php');
