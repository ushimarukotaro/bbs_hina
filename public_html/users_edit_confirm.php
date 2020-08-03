<?php
require_once(__DIR__ .'/header.php');

?>
<h1 class="page__ttl">ユーザー情報変更確認</h1>
<p class="user-disp">以下のユーザーを変更します。実行する場合は「実行」ボタンを押してください。</p>
<div class="container">
    <div class="form-group">
      <p>メールアドレス：<?= isset($app->getValues()->email) ? h($app->getValues()->email): ''; ?></p>
    </div>
    <div class="form-group">
      <p>ユーザー名：<?= isset($app->getValues()->username) ? h($app->getValues()->username): ''; ?></p>
    </div>
  <form class="user-delete user-confirm" action="user_edit_done.php" method="post">
    <a class="btn btn-primary" href="javascript:history.back();">まだしません。</a>
    <input type="submit" class="btn btn-primary" value="実行">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="user_id" value="<?= h($user['id']); ?>">
    <input type="hidden" name="username" value="<?= h($user['username']); ?>">
    <input type="hidden" name="email" value="<?= h($user['email']); ?>">
    <input type="hidden" name="image" value="<?= h($user['image']); ?>">
    <input type="hidden" name="authority" value="<?= h($user['authority']); ?>">
    <input type="hidden" name="delflag" value="<?= h($user['delflag']); ?>">
  </form>
</div><!--container -->

<?php
require_once(__DIR__ .'/footer.php');